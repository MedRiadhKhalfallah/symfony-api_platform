<?php
/**
 * test test MSI
 * le fichier est cree le 08/03/2022
 * symfony-api_platform
 * PhpStorm
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class MeController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function __invoke()
    {
        $user= $this->security->getUser();
        return $user;
    }
}
