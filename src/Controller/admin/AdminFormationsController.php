<?php

namespace App\Controller\admin;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminFormationsController
 *
 * @author theok
 */
class AdminFormationsController extends AbstractController {
    /**
     * 
     * @var FormationRepository
     */
    private $formationRepository;
    
    /**
     * 
     * @var CategorieRepository
     */
    private $categorieRepository;
    
    function __construct(FormationRepository $formationRepository, CategorieRepository $categorieRepository) {
        $this->formationRepository = $formationRepository;
        $this->categorieRepository= $categorieRepository;
    }
    
    /**
     * @Route("/admin/formations", name="admin.formation")
     * @return Response
     */
    public function index(): Response{
        $formations = $this->formationRepository->findAll();
        $categories = $this->categorieRepository->findAll();
        return $this->render("admin/admin.formations.html.twig", [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }
    
    /**
     * @Route ("/admin/formations/suppr/{id}", name="admin.formations.suppr")
     * @param Formation $formation
     * @return Response
     */
    public function suppr(Formation $formation): Response {
        $this->formationRepository->remove($formation, true);
        return $this->redirectToRoute('admin.formations');
    }
    
    /**
     * @Route ("/admin/formations/edit/{id}", name="admin.formations.edit")
     * @param Formation $formation
     * @param Request $request
     * @return Response
     */
    public function edit(Formation $formation, Request $request): Response {
        $formFormation = $this->createForm(FormationType::class, $formation);
        
        $formFormation->handleRequest($request);
        if($formFormation->isSubmitted() && $formFormation->isValid()){
            $this->formationRepository->add($formation, true);
            return $this->redirectToRoute('admin.formation');
        }
        
        return $this->render('admin/admin.formation.edit.html.twig', [
            'formation' => $formation,
            'formformation' => $formFormation->createView()
        ]);
    }
    
    /**
     * @Route ("/admin/formations/ajout/", name="admin.formations.ajout")
     * @param Formation $formation
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request): Response {
        $formation = new Formation();
        $formFormation = $this->createForm(FormationType::class, $formation);
        
        $formFormation->handleRequest($request);
        if($formFormation->isSubmitted() && $formFormation->isValid()){
            $this->formationRepository->add($formation, true);
            return $this->redirectToRoute('admin.formation');
        }
        
        return $this->render('admin/admin.formation.ajout.html.twig', [
            'formation' => $formation,
            'formformation' => $formFormation->createView()
        ]);
    }
}
