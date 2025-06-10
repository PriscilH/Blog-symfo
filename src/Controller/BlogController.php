<?php
// src/Controller/BlogController.php
namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_index')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/blog/{id}', name: 'blog_show')]
    public function show(PostRepository $postRepository, int $id): Response
    {
        $post = $postRepository->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Article non trouvé.');
        }

        return $this->render('blog/show.html.twig', [
            'post' => $post,
        ]);
    }
}
