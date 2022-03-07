<?php
/**
 * test test MSI
 * le fichier est cree le 05/03/2022
 * symfony-api_platform
 * PhpStorm
 */

namespace App\Controller;


use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostCountController extends AbstractController
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(Request $request): int
    {
        $online = $request->get('online');
        $cretiria = [];
        if ($online!=null) {
            $cretiria['online'] = ($online === '1' ? true : false);
        }
        return $this->postRepository->count($cretiria);
    }
}
