<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostTypeForm;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    private $em;
    private $postRepository;

    public function __construct(EntityManagerInterface $em, PostRepository $postRepository)
    {
        $this->em = $em;
        $this->postRepository = $postRepository;
    }

    #[Route('/admin/list', name: 'app_list', methods:['GET'])]
    public function list(Request $request): Response
    {

        /** 
         * TODO:
         * Frontend task: 
         * Tidy up the frontend design make it pretty.
         * Add a pop up warning sign when deleting 
         * Add a user and authication function
         * 
         * 
         * 
        */

        $posts = $this->postRepository->findAll(array(), array('createdAt' => 'DESC'));
        return $this->render('admin/dashboard.html.twig', [
            'posts' => $posts,
        ]);
    }
    
    #[Route('/admin/post', name: 'app_post', methods: ['POST', 'GET'])]
    public function post(Request $request): Response
    {
        $post = new Post();
        $post->setCreatedAt(new \DateTime('now'));
        $form = $this->createForm(PostTypeForm::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();  
            if($data->isPublished()){
                $data->setPublishedAt(new \DateTime('now'));
            }

            $this->em->persist($data);
            $this->em->flush();
            $this->addFlash('success', 'Post successful! Knowledge is power!');
            return $this->redirectToRoute('app_post');
        }
        return $this->render('admin/post.html.twig',[
            'form' => $form,
        ]);
    }

    #[Route('/admin/edit/{id}', name: 'app_edit', methods: ['POST', 'GET'])]
    public function edit(Post $post, Request $request): Response
    {

        $form = $this->createForm(PostTypeForm::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData(); 
            $this->em->persist($data);
            $this->em->flush();

            $this->addFlash('success', 'Edit successful! Knowledge is power!');
            return $this->redirectToRoute('app_edit', [
                'id' => $post->getId()
            ]);
        }
        return $this->render('admin/edit.html.twig',[
            'form' => $form,
        ]);
    }


    #[Route('/admin/delete/{id}', name: 'app_delete', methods: ['GET', 'DELETE'])]
    public function delete($id): Response
    {
        $post = $this->postRepository->find($id);
        $this->em->remove($post);
        $this->em->flush();
        $this->addFlash('success', 'Delete successful! Knowledge is power!');
        return $this->redirectToRoute('app_list');

    }
}
