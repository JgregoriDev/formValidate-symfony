<?php

namespace App\Controller;

use App\Entity\Fp;
use App\Form\FpType;
use App\Repository\FpRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\BusquedaType;

/**
 * @Route("/fp")
 */
class FpController extends AbstractController
{
    private EntityManagerInterface $emi;
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi = $emi;
    }
    /**
     * @Route("/", name="app_fp_index", methods={"GET","POST"})
     */
    public function index(FpRepository $fpRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $queryArticulos = $fpRepository->obtenerQueryFP();
        $pagination = $paginator->paginate(
            $queryArticulos,
            $request->query->getInt('pagina', 1), /*page number*/
            12 /*limit per page*/
        );

        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_fp_search', ['slug' => $textABuscar]);
        }
        return $this->render('fp/index.html.twig', [
            'fps' => $pagination,
            'formBusqueda' => $formBusqueda->createView(),
        ]);
    }

    /**
     * @Route("/nuevo", name="app_fp_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FpRepository $fpRepository): Response
    {
        $fp = new Fp();
        $form = $this->createForm(FpType::class, $fp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fpRepository->add($fp, true);
            $this->addFlash(
                'success',
                'Se ha introducido la forma de pago de manera correcta'
            );
            return $this->redirectToRoute('app_fp_index', [], Response::HTTP_SEE_OTHER);
        }
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_fp_search', ['slug' => $textABuscar]);
        }
        return $this->renderForm('fp/new.html.twig', [
            'fp' => $fp,
            'typeButton' => 'success',
            'form' => $form,
            'formBusqueda' => $formBusqueda->createView(),
        ]);
    }

    /**
     * @Route("/{codfp}", name="app_fp_show", methods={"GET"})
     */
    public function show(Fp $fp, Request $request): Response
    {
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_fp_search', ['slug' => $textABuscar]);
        }
        return $this->render('fp/show.html.twig', [
            'fp' => $fp,
            'formBusqueda' => $formBusqueda->createView(),
        ]);
    }

    /**
     * @Route("/{codfp}/editar", name="app_fp_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Fp $fp, FpRepository $fpRepository): Response
    {
        $form = $this->createForm(FpType::class, $fp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fpRepository->add($fp, true);
            $this->addFlash(
                'success',
                'Se ha editado la forma de pago de manera correcta'
            );
            return $this->redirectToRoute('app_fp_index', [], Response::HTTP_SEE_OTHER);
        }
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_fp_search', ['slug' => $textABuscar]);
        }
        return $this->renderForm('fp/edit.html.twig', [
            'fp' => $fp,
            'typeButton' => 'warning',
            'form' => $form,
            'formBusqueda' => $formBusqueda,
        ]);
    }

    /**
     * @Route("/{codfp}", name="app_fp_delete", methods={"POST"})
     */
    public function delete(Request $request, Fp $fp, FpRepository $fpRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $fp->getCodfp(), $request->request->get('_token'))) {
            $fpRepository->remove($fp, true);
            $this->addFlash(
                'success',
                'Has borrado de manera satisfactoria la forma de pago'
            );
        }

        return $this->redirectToRoute('app_fp_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/buscar/{slug}", name="app_fp_search", methods={"GET","POST"})
     */
    public function searchFp(FpRepository $fpRepository, String $slug, Request $request, PaginatorInterface $paginator): Response
    {
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_fp_search', ['slug' => $textABuscar]);
        }
        $fp = $fpRepository->searchFpByNombre($slug);
        // var_dump($subfamilia);
        $pagination = $paginator->paginate(
            $fp,
            $request->query->getInt('pagina', 1), /*page number*/
            12 /*limit per page*/
        );

        return $this->render('fp/search.html.twig', [
            'textoBuscado' => $slug,
            'fps' => $pagination,
            'formBusqueda' => $formBusqueda->createView(),
            // 'articulo' => $articulo,
        ]);
    }
}
