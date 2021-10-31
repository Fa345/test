<?php

namespace App\Controller;
use App\Entity\Testimonial;

use App\Form\TestimonialType;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    
    /**
     * @Route("/", name="home_create")
     */
    public function create(Request $request)
    {
        $testimonial = new Testimonial();
        $form = $this->createFormBuilder($testimonial);
        $form = $this->createForm(TestimonialType::class , $testimonial);
        $form->handleRequest($request);
        if( $form->isSubmitted() ){
            $file = $request->files->get('testimonial')['image'];
            $upload_directory = $this->getParameter('uploads_directory');

            $file_name = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $upload_directory,
                $file_name
            );
            $testimonial->setImage($file_name);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($testimonial);
            $em->flush();
            $this->addFlash('success', 'Testimonial Created!');
        }            


        return $this->render('home/create.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
