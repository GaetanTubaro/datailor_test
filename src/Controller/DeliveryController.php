<?php

namespace App\Controller;

use App\DTO\DeliveryEnquiry;
use App\Entity\DeliveryOrder;
use App\Repository\DeliveryOrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DeliveryController extends AbstractController
{
    #[Route('/delivery', name: 'delivery')]
    public function index(Request $request, SerializerInterface $serializer, DeliveryOrderRepository $deliveryRepo, UserRepository $userRepo): Response
    {
        /** @var DeliveryEnquiry $deliveryEnquiry */
        $deliveryEnquiry = $serializer->deserialize($request->getContent(), DeliveryEnquiry::class, 'json');

        /** Verification de la difference entre la date de commande et la de livraison voulue */
        if(!$deliveryEnquiry->timeDiff($deliveryEnquiry->getOrderDate(),$deliveryEnquiry->getDeliveryEnquiry()))
        {

            return new JsonResponse([
                'error' => 400,
                'message' => "La livraison n'est possible que 2 jours après la commande."
            ], 400);
        }

        /** Verification si la date est déjà en base de données */
        if($deliveryRepo->findOneBy(['deliveryDate' => $deliveryEnquiry->getDeliveryEnquiry()]) !== null)
        { 

            return new JsonResponse([
                'error' => 400,
                'message' => "créneau déjà réservé."
            ], 400);
        }
        ;

        /** Création de l'objet a push en bdd */
        $user = $userRepo->findOneBy(['id'=> $deliveryEnquiry->getUserId()]);
        $deliveryOrder = new DeliveryOrder;
        $deliveryOrder->setDeliveryDate($deliveryEnquiry->getDeliveryEnquiry())
            ->setOrderId($deliveryEnquiry->getOrderId())
            ->setUser($user)
            ;

        $deliveryRepo->add($deliveryOrder);
        $deliveryEnquiry->setDeliveryValidate(true);

        $responseContent = $serializer->serialize($deliveryEnquiry, 'json');

        return new Response($responseContent ,200);
    }
}
