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
        //     $request->query->getInt('page', 1), /*page number*/
        //     12 /*limit per page*/
        // );
        return $this->render('subfamilia/index.html.twig', [
            'subfamilias' => $subfamiliaRepository->findAll(),
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

        return $this->renderForm('subfamilia/new.html.twig', [
            'subfamilium' => $subfamilium,
            'typeButton' => 'success',
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codsubfamilia}", name="app_subfamilia_show", methods={"GET"})
     */
    public function show(Subfamilia $subfamilium): Response
    {
        $base64Image = null;
        if ($subfamilium->getImagen() !== null)
            $base64Image = base64_encode(stream_get_contents($subfamilium->getImagen()));
        return $this->render('subfamilia/show.html.twig', [
            'subfamilium' => $subfamilium,
            'base64Image' => $base64Image
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
            $codigo = $form->get("codigo")->getData();
            $subfamilium->setCodSubFamilia($codigo);
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

        return $this->renderForm('subfamilia/edit.html.twig', [
            'subfamilium' => $subfamilium,
            'typeButton' => 'warning',
            'form' => $form,
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
}
