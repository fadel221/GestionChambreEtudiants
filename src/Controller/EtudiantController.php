<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Symfony\Component\HttpFoundation\Response;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/", name="etudiant")
     */
    public function index()
    {
        return $this->render('/base.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }


    /**
     * @Route("/etudiant/create", name="etudiant_create")
     */

    public function add(Request $request,EntityManagerInterface $em)
    {
        $etudiant=new Etudiant();
        $form=$this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($etudiant);
            $em->flush();
            $matricule=$etudiant->createMatricule($etudiant->getId());
            $etudiant->setMatricule($matricule);
            $em->persist($etudiant);
            $em->flush();
            

        }
        return $this->render('etudiant/create.html.twig', [
            'controller_name' => 'EtudiantController',
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/etudiant/lister/", name="etudiant_liste")
     */
    public function lister (EtudiantRepository $etudiantRepository,  Request $request)
    {
        $etudiants = $etudiantRepository->findAll();
        
        return $this->render('etudiant/lister.html.twig',compact('etudiants'));
    }

    /**
     * @Route("/etudiant/{id}/update", name="etudiant_update", methods={"POST","GET"})
     */

    public function update(Request $request,EntityManagerInterface $em,Etudiant $etudiant)
    {
        $form=$this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($etudiant);
            $em->flush();
        }
        return $this->render('etudiant/create.html.twig', [
            'etudiant' => $etudiant,
            'form'=>$form->createView(),

        ]);
    }
    
}
