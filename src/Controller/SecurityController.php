<?php
/**
 * test test MSI
 * le fichier est cree le 07/03/2022
 * symfony-api_platform
 * PhpStorm
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login", name="api_login", methods={"POST"})
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login()
    {
        $user = $this->getUser();
        return $this->json([
           'userName'=>$user->getUserIdentifier(),
           'roles'=>$user->getRoles()
        ]);
    }
}
