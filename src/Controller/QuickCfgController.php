<?php

namespace App\Controller;

use App\Entity\QuickCfg;
use App\Form\QuickCfgType;
use App\Repository\QuickCfgRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/quick/cfg")
 * @isGranted("IS_AUTHENTICATED_REMEMBERED")
 */
class QuickCfgController extends AbstractController {
    
    /**
     * @Route("/", name="quick_cfg_index", methods={"GET"})
     */
    public function index(QuickCfgRepository $quickCfgRepository): Response {
        $session = new Session();
        
//        $session->getFlashBag()->add('warning', 'this test warning');
//        $session->getFlashBag()->add('info', 'just a test of info');
//        $session->getFlashBag()->add('error', 'test of error');
//        $session->getFlashBag()->add('error', 'Another error');
//        $session->getFlashBag()->add('success', 'Test of success');
        
        return $this->render('quick_cfg/index.html.twig', [
            'quick_cfgs' => $quickCfgRepository->findAll(),
        ]);
    }

    protected function computeCfgValues(QuickCfg $qc, ?bool $new = false) : QuickCfg {
        
        $entityManager = $this->getDoctrine()->getManager();
        if($new) {
            $entityManager->persist($qc);
        }
        $entityManager->flush();
        $entityManager->refresh($qc);
        
        return $qc;
    }
    
    /**
     * @Route("/new", name="quick_cfg_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response {
        $quickCfg = new QuickCfg();
        $form = $this->createForm(QuickCfgType::class, $quickCfg);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $quickCfg = $this->computeCfgValues($quickCfg, true);

            return $this->redirectToRoute('quick_cfg_index');
        }

        return $this->render('quick_cfg/new.html.twig', [
            'quick_cfg' => $quickCfg,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quick_cfg_show", methods={"GET"})
     */
    public function show(QuickCfg $quickCfg): Response {
        return $this->render('quick_cfg/show.html.twig', [
            'quick_cfg' => $quickCfg,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quick_cfg_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QuickCfg $quickCfg): Response {
        $form = $this->createForm(QuickCfgType::class, $quickCfg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quickCfg = $this->computeCfgValues($quickCfg);

            return $this->redirectToRoute('quick_cfg_index');
        }

        return $this->render('quick_cfg/edit.html.twig', [
            'quick_cfg' => $quickCfg,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quick_cfg_delete", methods={"POST"})
     */
    public function delete(Request $request, QuickCfg $quickCfg): Response {
        if ($this->isCsrfTokenValid('delete'.$quickCfg->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quickCfg);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quick_cfg_index');
    }
    
}
