<?php
/**
 * test test MSI
 * le fichier est cree le 05/03/2022
 * symfony-api_platform
 * PhpStorm
 */

namespace App\Controller;


use App\Entity\Post;

class PostPublicationController
{
    public function __invoke(Post $data): Post
    {
        $data->setOnline(true);
        return $data;
    }
}
