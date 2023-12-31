<?php

namespace App\Controller;

use App\Repository\StylistRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 /**
  * Class StylistController
  * @package App\Controller
  * @IsGranted("ROLE_USER")
  */
class StylistController extends AbstractController
{
    #[Route('/stylist/{serviceId}', name: 'app_stylist')]
    public function getHairdressers($serviceId, StylistRepository $stylistRepository): Response
    {
        $stylists = $stylistRepository->findBy(['category' => $serviceId]);

        $stylistsArray =[];
        foreach ($stylists as $stylist){
            $stylistsArray[] = [
                'id' => $stylist->getId(),
                'name' => $stylist->getName(),
                'photo' => $stylist->getPhoto(),
                'instagram' => $stylist->getInstagramAccount(),
                'description' => $stylist->getDescription()
            ];
        }

        return $this->render('stylist/index.html.twig', [
            'stylistsArray' => $stylistsArray,
        ]);
    }
}
