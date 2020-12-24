<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Form\PostProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="shop")
     */
    public function shop(): Response
    {
        $posts = $this->getDoctrine()->getRepository(Shop::class)->findAll();

        return $this->render('shop/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request): Response
    {
        $post = new Shop();

        $form = $this->createForm(PostProductType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('attachment')->getData();

            if ($file) {
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();


                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $filename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $post->setImage($filename);
            }
            $post->setCreated(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('index');

        }
        return $this->render('shop/create.html.twig', [
            'post_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete{id}", name="delete")
     */
    public function delete(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->attributes->get('id');

        $post = $em->getRepository(Shop::class)->findOneBy([
            'id' => $id
        ]);

        $form = $this->createForm(PostProductType::class, $post);

        $success = $form->handleRequest($request);

        $em->remove($post);
        $em->flush();

        if($success){
            return $this->redirectToRoute('shop');
        }


        return $this->render('shop/index.html.twig');
    }


    /**
     * @Route("/shop/view{id}", name="view")
     */
    public function view(Request $request): Response
    {
        $id = $request->attributes->get('id');

        $posts = $this->getDoctrine()->getRepository(Shop::class)->findOneBy([
            'id' => $id
        ]);

        return $this->render('shop/view.html.twig', [
            'post' => $posts,
        ]);
    }

}
