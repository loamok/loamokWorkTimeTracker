<?php

namespace App\Controller;

use App\Entity\WorkingDurationStore;
use App\Form\WorkingDurationStoreType;
use App\Repository\WorkingDurationStoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/working/duration/store")
 */
class WorkingDurationStoreController extends AbstractController
{
    /**
     * @Route("/", name="working_duration_store_index", methods={"GET"})
     */
    public function index(WorkingDurationStoreRepository $workingDurationStoreRepository): Response
    {
        return $this->render('working_duration_store/index.html.twig', [
            'working_duration_stores' => $workingDurationStoreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="working_duration_store_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $workingDurationStore = new WorkingDurationStore();
        $form = $this->createForm(WorkingDurationStoreType::class, $workingDurationStore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workingDurationStore);
            $entityManager->flush();

            return $this->redirectToRoute('working_duration_store_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('working_duration_store/new.html.twig', [
            'working_duration_store' => $workingDurationStore,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="working_duration_store_show", methods={"GET"})
     */
    public function show(WorkingDurationStore $workingDurationStore): Response
    {
        return $this->render('working_duration_store/show.html.twig', [
            'working_duration_store' => $workingDurationStore,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="working_duration_store_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WorkingDurationStore $workingDurationStore): Response
    {
        $form = $this->createForm(WorkingDurationStoreType::class, $workingDurationStore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('working_duration_store_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('working_duration_store/edit.html.twig', [
            'working_duration_store' => $workingDurationStore,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="working_duration_store_delete", methods={"POST"})
     */
    public function delete(Request $request, WorkingDurationStore $workingDurationStore): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workingDurationStore->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workingDurationStore);
            $entityManager->flush();
        }

        return $this->redirectToRoute('working_duration_store_index', [], Response::HTTP_SEE_OTHER);
    }
}
