<?php

namespace App\Controller;

use App\Entity\Origengasto;
use App\Form\OrigengastoType;
use App\Repository\OrigengastoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/origengasto")
 */
class OrigengastoController extends AbstractController
{

    private EntityManagerInterface $emi;
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi = $emi;
    }

    /**
     * @Route("/", name="app_origengasto_index", methods={"GET","POST{{ include('origengasto/_delete_form.html.twig') }}"})
     */
    public function index(OrigengastoRepository $origengastoRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $queryArticulos = $origengastoRepository->obtenerQueryOrigenGastos();
        $pagination = $paginator->paginate(
            $queryArticulos,
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );

        return $this->render('origengasto/index.html.twig', [
            'origengastos' => $pagination,
        ]);
    }

    /**
     * @Route("/nuevo", name="app_origengasto_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OrigengastoRepository $origengastoRepository): Response
    {
        $origengasto = new Origengasto();
        $form = $this->createForm(OrigengastoType::class, $origengasto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $origengastoRepository->add($origengasto, true);
            $this->addFlash(
                'success',
                'Se ha introducido el ordigen de gasto de manera correcta'
            );
            return $this->redirectToRoute('app_origengasto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('origengasto/new.html.twig', [
            'origengasto' => $origengasto,
            'typeButton' => 'success',
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
     * @Route("/{codorigen}/editar", name="app_origengasto_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Origengasto $origengasto, OrigengastoRepository $origengastoRepository): Response
    {
        $form = $this->createForm(OrigengastoType::class, $origengasto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $origengastoRepository->add($origengasto, true);
            $this->addFlash(
                'success',
                'Se ha editado el origen de gasto de manera correcta'
            );
            return $this->redirectToRoute('app_origengasto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('origengasto/edit.html.twig', [
            'origengasto' => $origengasto,
            'typeButton' => 'warning',
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codorigen}", name="app_origengasto_delete", methods={"POST"})
     */
    public function delete(Request $request, Origengasto $origengasto, OrigengastoRepository $origengastoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $origengasto->getCodorigen(), $request->request->get('_token'))) {
            $origengastoRepository->remove($origengasto, true);
            $this->addFlash(
                'success',
                'Has borrado de manera satisfactoria el origen de gasto'
            );
        }

        return $this->redirectToRoute('app_origengasto_index', [], Response::HTTP_SEE_OTHER);
    }
}
