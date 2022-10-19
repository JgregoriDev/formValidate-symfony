<?php

namespace App\Controller;

use App\Entity\Marca;
use App\Form\MarcaType;
use App\Repository\MarcaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\BusquedaType;

/**
 * @Route("/marca")
 */
class MarcaController extends AbstractController
{
    private EntityManagerInterface $emi;
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi = $emi;
    }
    /**
     * @Route("/", name="app_marca_index", methods={"GET"})
     */
    public function index(MarcaRepository $marcaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $queryMarcas = $marcaRepository->obtenerQueryMarcas();
        $pagination = $paginator->paginate(
            $queryMarcas,
            $request->query->getInt('pagina', 1), /*page number*/
            12 /*limit per page*/
        );
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_marca_search', ['slug' => $textABuscar]);
        }
        return $this->render('marca/index.html.twig', [
            'marcas' => $pagination,
            'formBusqueda' => $formBusqueda->createView()
        ]);
    }

    /**
     * @Route("/nuevo", name="app_marca_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MarcaRepository $marcaRepository): Response
    {
        $marca = new Marca();
        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marcaRepository->add($marca, true);
            $this->addFlash(
                'success',
                'Se ha introducido la marca de manera correcta'
            );
            return $this->redirectToRoute('app_marca_index', [], Response::HTTP_SEE_OTHER);
        }
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_marca_search', ['slug' => $textABuscar]);
        }
        return $this->renderForm('marca/new.html.twig', [
            'marca' => $marca,
            'typeButton' => 'success',
            'form' => $form,
            'formBusqueda' => $formBusqueda
        ]);
    }

    /**
     * @Route("/{codmarca}", name="app_marca_show", methods={"GET"})
     */
    public function show(Marca $marca, Request $request): Response
    {
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_marca_search', ['slug' => $textABuscar]);
        }
        return $this->render('marca/show.html.twig', [
            'marca' => $marca,
            'formBusqueda' => $formBusqueda->createView()
        ]);
    }

    /**
     * @Route("/{codmarca}/editar", name="app_marca_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Marca $marca, MarcaRepository $marcaRepository): Response
    {
        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marcaRepository->add($marca, true);
            $this->addFlash(
                'success',
                'Se ha editado la marca de manera correcta'
            );
            return $this->redirectToRoute('app_marca_index', [], Response::HTTP_SEE_OTHER);
        }
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_marca_search', ['slug' => $textABuscar]);
        }

        return $this->renderForm('marca/edit.html.twig', [
            'marca' => $marca,
            'typeButton' => 'warning',
            'form' => $form,
            'formBusqueda' => $formBusqueda
        ]);
    }

    /**
     * @Route("/{codmarca}", name="app_marca_delete", methods={"POST"})
     */
    public function delete(Request $request, Marca $marca, MarcaRepository $marcaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $marca->getCodmarca(), $request->request->get('_token'))) {
            $marcaRepository->remove($marca, true);
            $this->addFlash(
                'success',
                'Has borrado de manera satisfactoria la forma de pago'
            );
        }

        return $this->redirectToRoute('app_marca_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/buscar/{slug}", name="app_marca_search", methods={"GET","POST"})
     */
    public function searchArticle(MarcaRepository $marcaRepository, String $slug, Request $request, PaginatorInterface $paginator): Response
    {

        $articulos = $marcaRepository->searchMarcaByNombre($slug);
        $pagination = $paginator->paginate(
            $articulos,
            $request->query->getInt('pagina', 1), /*page number*/
            12 /*limit per page*/
        );
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_marca_search', ['slug' => $textABuscar]);
        }
        return $this->render('marca/search.html.twig', [
            'formBusqueda' => $formBusqueda->createView(),
            'textoBuscado' => $slug,
            'marcas' => $pagination,
            // 'articulo' => $articulo,
        ]);
    }
}
