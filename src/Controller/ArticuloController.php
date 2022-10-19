<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Form\ArticuloType;
use App\Form\BusquedaArticuloType;
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
        $queryArticulos = $articuloRepository->obtenerQueryArticulos();


        $pagination = $paginator->paginate(
            $queryArticulos,
            $request->query->getInt('pagina', 1), /*page number*/
            12 /*limit per page*/
        );
        $formBusqueda = $this->createForm(BusquedaArticuloType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_articulo_search', ['slug' => $textABuscar]);
        }
        return $this->render('articulo/index.html.twig', [
            'articulos' => $pagination,
            'formBusqueda' => $formBusqueda->createView()
        ]);
    }

    /**
     * @Route("/nuevo", name="app_articulo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formBusqueda = $this->createForm(BusquedaArticuloType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_articulo_search', ['slug' => $textABuscar]);
        }
        $articulo = new Articulo();
        $form = $this->createForm(ArticuloType::class, $articulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blobData = $form->get("img")->getData();

            if ($blobData) {
                $imageContent = file_get_contents($blobData);
                $articulo->setImagen($imageContent);
            }
            // $subfamilia = $form->get("codsubfamilia")->getData();

            $entityManager->persist($articulo);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Se ha introducido el articulo de manera correcta'
            );
            return $this->redirectToRoute('app_articulo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articulo/new.html.twig', [
            'articulo' => $articulo,
            'typeButton' => 'success',
            'formBusqueda' => $formBusqueda,
            'form' => $form
        ]);
    }


    /**
     * @Route("/{codarticulo}", name="app_articulo_show", methods={"GET"})
     */
    public function show(Articulo $articulo, Request $request): Response
    {
        $formBusqueda = $this->createForm(BusquedaArticuloType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_articulo_search', ['slug' => $textABuscar]);
        }
        $base64Image = null;
        if ($articulo->getImagen()) {
            $base64Image = base64_encode(stream_get_contents($articulo->getImagen()));
        }
        return $this->render('articulo/show.html.twig', [
            'articulo' => $articulo,
            'base64Image' => $base64Image,
            'formBusqueda' => $formBusqueda->createView()
        ]);
    }

    /**
     * @Route("/buscar/{slug}", name="app_articulo_search", methods={"GET","POST"})
     */
    public function searchArticle(ArticuloRepository $articuloRepository, String $slug, Request $request, PaginatorInterface $paginator): Response
    {
        $formBusqueda = $this->createForm(BusquedaArticuloType::class);
        $formBusqueda->handleRequest($request);
        $articulos = $articuloRepository->searchByDescription($slug);
        $pagination = $paginator->paginate(
            $articulos,
            $request->query->getInt('pagina', 1), /*page number*/
            12 /*limit per page*/
        );

        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_articulo_search', ['slug' => $textABuscar]);
        }
        return $this->render('articulo/search.html.twig', [
            'formBusqueda' => $formBusqueda->createView(),
            'textoBuscado' => $slug,
            'articulos' => $pagination,
            // 'articulo' => $articulo,
        ]);
    }

    /**
     * @Route("/{codarticulo}/editar", name="app_articulo_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Articulo $articulo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticuloType::class, $articulo);
        $form->handleRequest($request);
        $formBusqueda = $this->createForm(BusquedaArticuloType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_articulo_search', ['slug' => $textABuscar]);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $blobData = $form->get("img")->getData();
            if ($blobData) {
                $imageContent = file_get_contents($blobData);
                $articulo->setImagen($imageContent);
            }
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Se ha editado el articulo de manera correcta'
            );
            return $this->redirectToRoute('app_articulo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articulo/edit.html.twig', [
            'articulo' => $articulo,
            'fromBusqueda' => $formBusqueda,
            'typeButton' => 'warning',
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codarticulo}", name="app_articulo_delete", methods={"POST"})
     */
    public function delete(Request $request, Articulo $articulo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $articulo->getCodarticulo(), $request->request->get('_token'))) {
            $entityManager->remove($articulo);
            $this->addFlash("success", "Has borrado de manera satisfactoria el artículo.");
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_articulo_index', [], Response::HTTP_SEE_OTHER);
    }
}
