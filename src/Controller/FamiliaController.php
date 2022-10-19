<?php

namespace App\Controller;

use App\Entity\Familia;
use App\Form\FamiliaType;
use App\Repository\FamiliaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\BusquedaType;

/**
 * @Route("/familia")
 */
class FamiliaController extends AbstractController
{
    private EntityManagerInterface $emi;
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi = $emi;
    }
    /**
     * @Route("/", name="app_familia_index", methods={"GET", "POST"})
     */
    public function index(FamiliaRepository $familiaRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $queryArticulos = $familiaRepository->obtenerQueryArticulos();
        $pagination = $paginator->paginate(
            $queryArticulos,
            $request->query->getInt('pagina', 1), /*page number*/
            12 /*limit per page*/
        );

        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_familia_search', ['slug' => $textABuscar]);
        }
        return $this->render('familia/index.html.twig', [
            'pagination' => $pagination,
            'formBusqueda' => $formBusqueda->createView()
        ]);
    }
    // public function index(FamiliaRepository $familiaRepository): Response
    // {
    //     return $this->render('familia/index.html.twig', [
    //         'familias' => $familiaRepository->findAll(),
    //     ]);
    // }

    /**
     * @Route("/nuevo", name="app_familia_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FamiliaRepository $familiaRepository, SluggerInterface $slugger): Response
    {
        $familium = new Familia();
        $form = $this->createForm(FamiliaType::class, $familium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blobData = $form->get("img")->getData();
            if ($blobData) {
                $imageContent = file_get_contents($blobData);
                $familium->setImagen($imageContent);
            }
            $familiaRepository->add($familium, true);
            $this->addFlash(
                'success',
                'Se ha introducido la forma de pago de manera correcta'
            );
            return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
        }
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_familia_search', ['slug' => $textABuscar]);
        }
        return $this->renderForm('familia/new.html.twig', [
            'familium' => $familium,
            'typeButton' => 'success',
            'form' => $form,
            'formBusqueda' => $formBusqueda,
        ]);
    }

    /**
     * @Route("/{codfamilia}", name="app_familia_show", methods={"GET"})
     */
    public function show(Familia $familium, Request $request): Response
    {
        $base64Image = null;
        if ($familium->getImagen() !== null)
            $base64Image = base64_encode(stream_get_contents($familium->getImagen()));
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_familia_search', ['slug' => $textABuscar]);
        }
        return $this->render('familia/show.html.twig', [
            'familium' => $familium,
            'base64Image' => $base64Image,
            "formBusqueda" => $formBusqueda->createView()
        ]);
    }
    
    /**
     * @Route("/buscar/{slug}", name="app_familia_search", methods={"GET","POST"})
     */
    public function searchFamilia(FamiliaRepository $familiaRepository, String $slug, Request $request, PaginatorInterface $paginator): Response
    {
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        $familiasQuery = $familiaRepository->searchFamilyByNombre($slug);
        $pagination = $paginator->paginate(
            $familiasQuery,
            $request->query->getInt('pagina', 1), /*page number*/
            12 /*limit per page*/
        );

        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_familia_search', ['slug' => $textABuscar]);
        }
        return $this->render('familia/search.html.twig', [
            'formBusqueda' => $formBusqueda->createView(),
            'textoBuscado' => $slug,
            'familias' => $pagination,
            // 'articulo' => $articulo,
        ]);
    }

    /**
     * @Route("/{codfamilia}/editar", name="app_familia_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Familia $familium, FamiliaRepository $familiaRepository): Response
    {
        $form = $this->createForm(FamiliaType::class, $familium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blobData = $form->get("img")->getData();
            if ($blobData) {
                $imageContent = file_get_contents($blobData);
                $familium->setImagen($imageContent);
            }
            $familiaRepository->add($familium, true);
            $this->addFlash(
                'success',
                'Se ha editado la forma de pago de manera correcta'
            );
            return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
        }
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_familia_search', ['slug' => $textABuscar]);
        }
        return $this->renderForm('familia/edit.html.twig', [
            'familium' => $familium,
            'typeButton' => 'warning',
            'form' => $form,
            'formBusqueda' => $formBusqueda
        ]);
    }

    /**
     * @Route("/{codfamilia}", name="app_familia_delete", methods={"POST"})
     */
    public function delete(Request $request, Familia $familium, FamiliaRepository $familiaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $familium->getCodfamilia(), $request->request->get('_token'))) {
            $familiaRepository->remove($familium, true);
            $this->addFlash("success", "Has borrado de manera satisfactoria la familia.");
        }

        return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
    }
}
