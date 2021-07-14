<?php

namespace App\Controller;

use App\Entity\DailyWorkDuration;
use App\Form\DailyWorkDurationType;
use App\Repository\DailyWorkDurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/daily/work/duration")
 */
class DailyWorkDurationController extends AbstractController
{
    /**
     * @Route("/", name="daily_work_duration_index", methods={"GET"})
     */
    public function index(DailyWorkDurationRepository $dailyWorkDurationRepository): Response
    {
        return $this->render('daily_work_duration/index.html.twig', [
            'daily_work_durations' => $dailyWorkDurationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="daily_work_duration_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dailyWorkDuration = new DailyWorkDuration();
        $form = $this->createForm(DailyWorkDurationType::class, $dailyWorkDuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dailyWorkDuration);
            $entityManager->flush();

            return $this->redirectToRoute('daily_work_duration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('daily_work_duration/new.html.twig', [
            'daily_work_duration' => $dailyWorkDuration,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="daily_work_duration_show", methods={"GET"})
     */
    public function show(DailyWorkDuration $dailyWorkDuration): Response
    {
        return $this->render('daily_work_duration/show.html.twig', [
            'daily_work_duration' => $dailyWorkDuration,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="daily_work_duration_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DailyWorkDuration $dailyWorkDuration): Response
    {
        $form = $this->createForm(DailyWorkDurationType::class, $dailyWorkDuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('daily_work_duration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('daily_work_duration/edit.html.twig', [
            'daily_work_duration' => $dailyWorkDuration,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="daily_work_duration_delete", methods={"POST"})
     */
    public function delete(Request $request, DailyWorkDuration $dailyWorkDuration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dailyWorkDuration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dailyWorkDuration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('daily_work_duration_index', [], Response::HTTP_SEE_OTHER);
    }
}
