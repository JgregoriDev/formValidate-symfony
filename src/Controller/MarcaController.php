<?php

namespace App\Controller;

use App\Entity\Marca;
use App\Form\MarcaType;
use App\Repository\MarcaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marca")
 */
class MarcaController extends AbstractController
{
    /**
     * @Route("/", name="app_marca_index", methods={"GET"})
     */
    public function index(MarcaRepository $marcaRepository): Response
    {
        return $this->render('marca/index.html.twig', [
            'marcas' => $marcaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_marca_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MarcaRepository $marcaRepository): Response
    {
        $marca = new Marca();
        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marcaRepository->add($marca, true);

            return $this->redirectToRoute('app_marca_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('marca/new.html.twig', [
            'marca' => $marca,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codmarca}", name="app_marca_show", methods={"GET"})
     */
    public function show(Marca $marca): Response
    {
        return $this->render('marca/show.html.twig', [
            'marca' => $marca,
        ]);
    }

    /**
     * @Route("/{codmarca}/edit", name="app_marca_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Marca $marca, MarcaRepository $marcaRepository): Response
    {
        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marcaRepository->add($marca, true);

            return $this->redirectToRoute('app_marca_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('marca/edit.html.twig', [
            'marca' => $marca,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codmarca}", name="app_marca_delete", methods={"POST"})
     */
    public function delete(Request $request, Marca $marca, MarcaRepository $marcaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$marca->getCodmarca(), $request->request->get('_token'))) {
            $marcaRepository->remove($marca, true);
        }

        return $this->redirectToRoute('app_marca_index', [], Response::HTTP_SEE_OTHER);
    }
}
