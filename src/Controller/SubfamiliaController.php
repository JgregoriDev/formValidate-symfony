<?php

namespace App\Controller;

use App\Entity\Subfamilia;
use App\Form\SubfamiliaType;
use App\Repository\SubfamiliaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\BusquedaType;

/**
 * @Route("/subfamilia")
 */
class SubfamiliaController extends AbstractController
{
    /**
     * @Route("/", name="app_subfamilia_index", methods={"GET"})
     */
    public function index(SubfamiliaRepository $subfamiliaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $querySubfamilia = $subfamiliaRepository->obtenerQuerySubfamilias();
        // $pagination = $paginator->paginate(
        //     $querySubfamilia,
        //     $request->query->getInt('pagina', 1), /*page number*/
        //     12 /*limit per page*/
        // );
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_subfamilia_search', ['slug' => $textABuscar]);
        }
        return $this->render('subfamilia/index.html.twig', [
            'subfamilias' => $subfamiliaRepository->findAll(),
            'formBusqueda' => $formBusqueda->createView()
        ]);
    }

    /**
     * @Route("/nuevo", name="app_subfamilia_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SubfamiliaRepository $subfamiliaRepository): Response
    {
        $subfamilium = new Subfamilia();
        $form = $this->createForm(SubfamiliaType::class, $subfamilium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $codigo = $form->get("codigo")->getData();
            // $subfamilium->setCodSubFamilia($codigo);
            $blobData = $form->get("img")->getData();
            if ($blobData) {
                $imageContent = file_get_contents($blobData);
                $subfamilium->setImagen($imageContent);
            }
            $subfamiliaRepository->add($subfamilium, true);
            $this->addFlash("success", "Ha sido introducido de manera correcta");
            return $this->redirectToRoute('app_subfamilia_index', [], Response::HTTP_SEE_OTHER);
        }
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_subfamilia_search', ['slug' => $textABuscar]);
        }

        return $this->renderForm('subfamilia/new.html.twig', [
            'subfamilium' => $subfamilium,
            'typeButton' => 'success',
            'form' => $form,
            'formBusqueda' => $formBusqueda
        ]);
    }

    /**
     * @Route("/{codsubfamilia}", name="app_subfamilia_show", methods={"GET"})
     */
    public function show(Subfamilia $subfamilium, Request $request): Response
    {
        $base64Image = null;
        if ($subfamilium->getImagen() !== null)
            $base64Image = base64_encode(stream_get_contents($subfamilium->getImagen()));
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_subfamilia_search', ['slug' => $textABuscar]);
        }
        return $this->render('subfamilia/show.html.twig', [
            'subfamilium' => $subfamilium,
            'base64Image' => $base64Image,
            'formBusqueda' => $formBusqueda->createView()
        ]);
    }

    /**
     * @Route("/{codsubfamilia}/editar", name="app_subfamilia_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Subfamilia $subfamilium, SubfamiliaRepository $subfamiliaRepository): Response
    {
        $form = $this->createForm(SubfamiliaType::class, $subfamilium);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $blobData = $form->get("img")->getData();
            if ($blobData) {
                $imageContent = file_get_contents($blobData);
                $subfamilium->setImagen($imageContent);
            }
            $subfamiliaRepository->add($subfamilium, true);
            $this->addFlash(
                'success',
                'Has edidatado de manera satisfactoria la subfamilia'
            );
            return $this->redirectToRoute('app_subfamilia_index', [], Response::HTTP_SEE_OTHER);
        }
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_subfamilia_search', ['slug' => $textABuscar]);
        }
        return $this->renderForm('subfamilia/edit.html.twig', [
            'subfamilium' => $subfamilium,
            'typeButton' => 'warning',
            'form' => $form,
            'formBusqueda' => $formBusqueda
        ]);
    }

    /**
     * @Route("/{codsubfamilia}", name="app_subfamilia_delete", methods={"POST"})
     */
    public function delete(Request $request, Subfamilia $subfamilium, SubfamiliaRepository $subfamiliaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $subfamilium->getCodsubfamilia(), $request->request->get('_token'))) {
            $subfamiliaRepository->remove($subfamilium, true);
            $this->addFlash(
                'success',
                'Has borrado de manera satisfactoria la subfamilia'
            );
        }

        return $this->redirectToRoute('app_subfamilia_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/buscar/{slug}", name="app_subfamilia_search", methods={"GET","POST"})
     */
    public function searchSubfamilia(SubfamiliaRepository $subfamilia, String $slug, Request $request)//: Response
    {
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        // $subfamilia = $subfamilia->searchSubfamilyByNombre($slug);
        $subfamilia=$subfamilia->findBy(['nombre'=>$slug],['nombre' => 'ASC'],1 ,0);
        
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_subfamilia_search', ['slug' => $textABuscar]);
        }
         return $this->render('subfamilia/search.html.twig', [
             'formBusqueda' => $formBusqueda->createView(),
             'textoBuscado' => $slug,
             'subfamilias' => $subfamilia,
        //      'articulo' => $articulo,
         ]);
    }
}
