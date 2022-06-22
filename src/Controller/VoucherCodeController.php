<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoucherCodeController extends AbstractController
{
    #[Route('/vouchercode/{id}/user', name: 'validate_voucher')]
    public function validateVoucherCode(Request $request, $voucherCode, $id): Response
    {
        return $this->render('voucher_code/index.html.twig', [
            'controller_name' => 'VoucherCodeController',
        ]);
    }
}