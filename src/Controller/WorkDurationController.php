<?php

namespace App\Controller;

use App\Entity\WorkDuration;
use App\Form\WorkDurationType;
use App\Repository\WorkDurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/work/duration")
 */
class WorkDurationController extends AbstractController
{
    /**
     * @Route("/", name="work_duration_index", methods={"GET"})
     */
    public function index(WorkDurationRepository $workDurationRepository): Response
    {
        return $this->render('work_duration/index.html.twig', [
            'work_durations' => $workDurationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="work_duration_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $workDuration = new WorkDuration();
        $form = $this->createForm(WorkDurationType::class, $workDuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workDuration);
            $entityManager->flush();

            return $this->redirectToRoute('work_duration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('work_duration/new.html.twig', [
            'work_duration' => $workDuration,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="work_duration_show", methods={"GET"})
     */
    public function show(WorkDuration $workDuration): Response
    {
        return $this->render('work_duration/show.html.twig', [
            'work_duration' => $workDuration,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="work_duration_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WorkDuration $workDuration): Response
    {
        $form = $this->createForm(WorkDurationType::class, $workDuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('work_duration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('work_duration/edit.html.twig', [
            'work_duration' => $workDuration,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="work_duration_delete", methods={"POST"})
     */
    public function delete(Request $request, WorkDuration $workDuration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workDuration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workDuration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('work_duration_index', [], Response::HTTP_SEE_OTHER);
    }
}
