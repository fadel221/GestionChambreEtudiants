<?php

namespace App\Controller;

use App\Entity\Batiment;
use App\Form\BatimentType;
use App\Repository\BatimentRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BatimentController extends AbstractController
{
    /**
     * @Route("/index", name="batiment")
     */
    public function index()
    {
        return $this->render('/base.html.twig', [
            'controller_name' => 'BatimentController',
        ]);
    }

    /**
     * @Route("/batiment/create", name="batiment_create",methods={"POST","GET"})
     */

    public function create(Request $request,EntityManagerInterface $em):Response
    {
        $batiment=new Batiment();
        $form=$this->createForm(BatimentType::class,$batiment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($batiment);
            $em->flush();
        }
        return $this->render('batiment/create.html.twig', [
            'controller_name' => 'BatimentController',
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/batiment/liste", name="batiment_liste" ,methods={"GET","POST"})
     */
    public function liste(BatimentRepository $batimentRepository)
    {
        $batiments=$batimentRepository->findAll();
        
        return $this->render('batiment/lister.html.twig',compact('batiments'));
    }
}
