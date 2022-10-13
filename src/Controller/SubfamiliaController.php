<?php

namespace App\Controller;

use App\Entity\Subfamilia;
use App\Form\SubfamiliaType;
use App\Repository\SubfamiliaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subfamilia")
 */
class SubfamiliaController extends AbstractController
{
    /**
     * @Route("/", name="app_subfamilia_index", methods={"GET"})
     */
    public function index(SubfamiliaRepository $subfamiliaRepository): Response
    {
        return $this->render('subfamilia/index.html.twig', [
            'subfamilias' => $subfamiliaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_subfamilia_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SubfamiliaRepository $subfamiliaRepository): Response
    {
        $subfamilium = new Subfamilia();
        $form = $this->createForm(SubfamiliaType::class, $subfamilium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subfamiliaRepository->add($subfamilium, true);

            return $this->redirectToRoute('app_subfamilia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('subfamilia/new.html.twig', [
            'subfamilium' => $subfamilium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codsubfamilia}", name="app_subfamilia_show", methods={"GET"})
     */
    public function show(Subfamilia $subfamilium): Response
    {
        return $this->render('subfamilia/show.html.twig', [
            'subfamilium' => $subfamilium,
        ]);
    }

    /**
     * @Route("/{codsubfamilia}/edit", name="app_subfamilia_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Subfamilia $subfamilium, SubfamiliaRepository $subfamiliaRepository): Response
    {
        $form = $this->createForm(SubfamiliaType::class, $subfamilium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subfamiliaRepository->add($subfamilium, true);

            return $this->redirectToRoute('app_subfamilia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('subfamilia/edit.html.twig', [
            'subfamilium' => $subfamilium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codsubfamilia}", name="app_subfamilia_delete", methods={"POST"})
     */
    public function delete(Request $request, Subfamilia $subfamilium, SubfamiliaRepository $subfamiliaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subfamilium->getCodsubfamilia(), $request->request->get('_token'))) {
            $subfamiliaRepository->remove($subfamilium, true);
        }

        return $this->redirectToRoute('app_subfamilia_index', [], Response::HTTP_SEE_OTHER);
    }
}
