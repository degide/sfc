<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class PostController extends AbstractController {

    public function __construct(private ManagerRegistry $doctrine) {}

    /**
     * @Route("/post", name="post")
     */
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * @Route("/post/create",name="create_post")
     */
    public function create(ManagerRegistry $doctrine, Request $request){
        $post = new Post();
        $post->setTitle("New Post");

        $em = $this->doctrine->getManager();
        $em->persist($post);
        $em->flush();
        
        return new Response('Post created. ID='.$post->getId());
    }
}
