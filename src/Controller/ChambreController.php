<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChambreController extends AbstractController
{
    /**
     * @Route("/index", name="chambre")
     */
    public function index()
    {
        return $this->render('/base.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }

    /**
     * @Route("/chambre/create", name="chambre_create", methods={"POST","GET"})
     */

    public function create(Request $request,EntityManagerInterface $em):Response
    {
        $chambre=new Chambre();
        $form=$this->createForm(ChambreType::class,$chambre);
        $form->handleRequest($request);
        $chambre->setMatricule(2);
        if ($form->isSubmitted() && $form->isValid())
        {
            $idBatiment=$chambre->getBatiment()->getId();
            $em->persist($chambre);
            $em->flush();
            $idChambre=$chambre->getId();
            $matricule= $chambre->createMatricule($idBatiment,$idChambre);
            $chambre->setMatricule($matricule);
            $em->persist($chambre);
            $em->flush();
        }
        return $this->render('chambre/create.html.twig', [
            'controller_name' => 'ChambreController',
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/chambre/liste", name="chambre_liste" ,methods={"GET"})
     */
    
    public function lister (ChambreRepository $chambreRepository, PaginatorInterface $paginator, Request $request)
    {
        $chambres=$chambreRepository->findAll();
        return $this->render('chambre/lister.html.twig',compact("chambres")
        );
    }
    
    /**
     * @Route("/chambre/{id<[0-9]+>}/delete", name="chambre_delete", methods={"POST","GET"})
     */

    public function delete (Request $request,EntityManagerInterface $em,Chambre $chambre):Response
    {
        $em->remove($chambre);
        $em->flush();
        return $this->redirectToRoute('chambre_liste');
    }

    /**
     * @Route("/chambre/{id<[0-9]+>}/update", name="chambre_update")
     */

    public function add(Request $request,EntityManagerInterface $em,Chambre $chambre)
    {
        $form=$this->createForm(ChambreType::class,$chambre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($chambre);
            $em->flush();
            return $this->redirectToRoute('/chambre/liste');
        }
        return $this->render('chambre/create.html.twig', [
            'chambre' => $chambre,
            'form'=>$form->createView(),
        ]);
    }

}
