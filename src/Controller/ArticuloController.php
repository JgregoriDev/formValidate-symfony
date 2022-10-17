<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Form\ArticuloType;
use App\Repository\ArticuloRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/articulo")
 */
class ArticuloController extends AbstractController
{
    /**
     * @Route("/", name="app_articulo_index", methods={"GET"})
     */
    public function index(ArticuloRepository $articuloRepository, PaginatorInterface $paginator, Request $request): Response
    {
            $queryArticulos=$articuloRepository->obtenerQueryArticulos();

            
            $pagination = $paginator->paginate(
                $queryArticulos,
                $request->query->getInt('page', 1), /*page number*/
                12 /*limit per page*/
            );
        return $this->render('articulo/index.html.twig', [
            'articulos' => $pagination,
        ]);
    }

    /**
     * @Route("/nuevo", name="app_articulo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $articulo = new Articulo();
        $form = $this->createForm(ArticuloType::class, $articulo);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($articulo);
            $entityManager->flush();

            return $this->redirectToRoute('app_articulo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articulo/new.html.twig', [
            'articulo' => $articulo,
            'typeButton'=>'success',
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codarticulo}", name="app_articulo_show", methods={"GET"})
     */
    public function show(Articulo $articulo): Response
    {
        return $this->render('articulo/show.html.twig', [
            'articulo' => $articulo,
        ]);
    }

    /**
     * @Route("/{codarticulo}/editar", name="app_articulo_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Articulo $articulo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticuloType::class, $articulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_articulo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articulo/edit.html.twig', [
            'articulo' => $articulo,
            'typeButton'=>'warning',
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codarticulo}", name="app_articulo_delete", methods={"POST"})
     */
    public function delete(Request $request, Articulo $articulo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articulo->getCodarticulo(), $request->request->get('_token'))) {
            $entityManager->remove($articulo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_articulo_index', [], Response::HTTP_SEE_OTHER);
    }
}
