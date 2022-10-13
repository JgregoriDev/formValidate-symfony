<?php

namespace App\Controller;

use App\Entity\Familia;
use App\Form\FamiliaType;
use App\Repository\FamiliaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/familia")
 */
class FamiliaController extends AbstractController
{
    /**
     * @Route("/", name="app_familia_index", methods={"GET"})
     */
    public function index(FamiliaRepository $familiaRepository): Response
    {
        return $this->render('familia/index.html.twig', [
            'familias' => $familiaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_familia_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FamiliaRepository $familiaRepository): Response
    {
        $familium = new Familia();
        $form = $this->createForm(FamiliaType::class, $familium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $familiaRepository->add($familium, true);

            return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('familia/new.html.twig', [
            'familium' => $familium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codfamilia}", name="app_familia_show", methods={"GET"})
     */
    public function show(Familia $familium): Response
    {
        return $this->render('familia/show.html.twig', [
            'familium' => $familium,
        ]);
    }

    /**
     * @Route("/{codfamilia}/edit", name="app_familia_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Familia $familium, FamiliaRepository $familiaRepository): Response
    {
        $form = $this->createForm(FamiliaType::class, $familium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $familiaRepository->add($familium, true);

            return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('familia/edit.html.twig', [
            'familium' => $familium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codfamilia}", name="app_familia_delete", methods={"POST"})
     */
    public function delete(Request $request, Familia $familium, FamiliaRepository $familiaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$familium->getCodfamilia(), $request->request->get('_token'))) {
            $familiaRepository->remove($familium, true);
        }

        return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
    }
}
