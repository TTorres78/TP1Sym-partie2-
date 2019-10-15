<?php

namespace App\Controller;

use App\Form\AdType;
use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="ads_index")
     */
    public function index(ArticlesRepository $repo)
    {
    
        $ads = $repo->findAll();

        return $this->render('home.html.twig', [
            'ads' => $ads
        ]);
    } 

    /**
     * Permet de créeer une annonce
     * 
     * @Route("/ads/new", name="ads_create")
     * 
     * 
     *
     * @return Response
     */
    public function create(Request $request,ObjectManager $manager){
        $ad = new Articles();
        
        

        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){


            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getLibelle()}</strong> a bien été enregistrée !"
            );
            

            return $this->redirectToRoute('ads_show', [
                'libelle' => $ad->getLibelle()
            ]);

        }
        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
        ]);

    }

/**
 * Permet d'afficher une seul annonce
 *
 * @Route("/ads/{libelle}", name="ads_show")
 * 
 * @return Response
 */
    public function show(Articles $ad){
    return $this->render('ad/show.html.twig', [
        'ad' => $ad 
    ]);
    }
/**
 * Permet de faire un tableau d'articles
 *
 * @Route("/ads", name="ads_list")
 */
    public function list(ArticlesRepository $repo){
        $list= $repo->findALl();
        return $this->render('ad/index.html.twig', [
            'list' => $list
        ]);
    }

     /**
     * Permet d'afficher le formulaire d'édition
     * @Route("/ads/{id}/edit", name="ads_edit")
     * 
     * @return Response
     */
    public function edit(Articles $ad, Request $request, ObjectManager $manager){
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications de l'annonce <strong>{$ad->getLibelle()}</strong> ont bien été effectuée !"
            );
            

            return $this->redirectToRoute('ads_show', [
                'libelle' => $ad->getLibelle()
            ]);

        }
        return $this->render('ad/edit.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad
        ]);
    }

    /**
     * Permet de supprimer une annonce
     *
     * @Route("/ads/{id}/delete", name="ads_delete")
     * 
     * 
     * @param Articles $ad
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Articles $ad, ObjectManager $manager){
        $manager->remove($ad);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'annonce <strong>{$ad->getLibelle()}</strong> a bien été supprimée ! "

        );

        return $this->redirectToRoute("ads_index");
    }

    
}

    