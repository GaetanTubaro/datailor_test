<?php

namespace App\Controller;


use App\Repository\UserRepository;
use App\Repository\VoucherCodeRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoucherCodeController extends AbstractController
{
    #[Route('/voucher/{code}/user/{id}', name: 'validate_voucher', methods: 'GET')]
    public function validateVoucherCode($code, $id, UserRepository $userRepo, VoucherCodeRepository $voucherRepo): Response
    {
        $user = $userRepo->findOneBy(['id' => $id]); // recupération données du user
        $voucher = $voucherRepo->findOneBy(['name' => $code]); // recupération données du voucher

        if (!$user || !$voucher) 
        { // check si user et voucher existent

            return $this->json([
                'error' => 'user ou voucher introuvable'
            ], 400);
        }

        if ($voucher->getCityLimit() != null) 
        { // check si $voucher->getCityLimit() n'est pas nulle
            if ($user->getCity() != $voucher->getCityLimit()) 
            { // check si contrainte respectée

                return $this->json([
                    'error' => 'contrainte de lieu non respectée'
                ], 400);
            }
        }

        if ($voucher->getBirthLimit() != null) 
        { // check si $voucher->getBirthLimit() n'est pas nulle
            
            /** @var Datetime $birthUser */
            $birthUser = $user->getBirthDate(); 
            $present = new DateTime();
            $ageUser = $present->diff($birthUser)->y; ;
            if ($ageUser < $voucher->getBirthLimit())
            { // check si contrainte respectée

                return $this->json([
                    'error' => "contrainte d'age non respectée"
                ], 400);
            }
        }

        if($voucher->getStartingDate() != null )
        { // check si $voucher->getStartingDate() n'est pas nulle
            $present = new DateTime();

            if($voucher->getStartingDate() > $present)
            { // check si contrainte respectée
                return $this->json([
                    'error' => "Promotion pas encore active"
                ], 400);
            }
        }

        if($voucher->getEndingDate() != null )
        { // check si $voucher->getEndingDate() n'est pas nulle
            $present = new DateTime();
            
            if($voucher->getEndingDate() < $present)
            { // check si contrainte respectée
                return $this->json([
                    'error' => "periode de promotion terminée"
                ], 400);
            }
        }

        $user->addVoucherCodeUsed($voucher);

        return $this->json([
            'success' => 'coupon valide',
            'user' => $user,
            'voucher' => $voucher,
        ], 200);
    }
}
