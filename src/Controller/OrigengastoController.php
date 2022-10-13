<?php

namespace App\Controller;

use App\Entity\Origengasto;
use App\Form\OrigengastoType;
use App\Repository\OrigengastoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/origengasto")
 */
class OrigengastoController extends AbstractController
{
    /**
     * @Route("/", name="app_origengasto_index", methods={"GET"})
     */
    public function index(OrigengastoRepository $origengastoRepository): Response
    {
        return $this->render('origengasto/index.html.twig', [
            'origengastos' => $origengastoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_origengasto_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OrigengastoRepository $origengastoRepository): Response
    {
        $origengasto = new Origengasto();
        $form = $this->createForm(OrigengastoType::class, $origengasto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $origengastoRepository->add($origengasto, true);

            return $this->redirectToRoute('app_origengasto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('origengasto/new.html.twig', [
            'origengasto' => $origengasto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codorigen}", name="app_origengasto_show", methods={"GET"})
     */
    public function show(Origengasto $origengasto): Response
    {
        return $this->render('origengasto/show.html.twig', [
            'origengasto' => $origengasto,
        ]);
    }

    /**
     * @Route("/{codorigen}/edit", name="app_origengasto_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Origengasto $origengasto, OrigengastoRepository $origengastoRepository): Response
    {
        $form = $this->createForm(OrigengastoType::class, $origengasto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $origengastoRepository->add($origengasto, true);

            return $this->redirectToRoute('app_origengasto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('origengasto/edit.html.twig', [
            'origengasto' => $origengasto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codorigen}", name="app_origengasto_delete", methods={"POST"})
     */
    public function delete(Request $request, Origengasto $origengasto, OrigengastoRepository $origengastoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$origengasto->getCodorigen(), $request->request->get('_token'))) {
            $origengastoRepository->remove($origengasto, true);
        }

        return $this->redirectToRoute('app_origengasto_index', [], Response::HTTP_SEE_OTHER);
    }
}
