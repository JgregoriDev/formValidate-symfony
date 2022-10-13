<?php

namespace App\Controller;

use App\Entity\Fp;
use App\Form\FpType;
use App\Repository\FpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fp")
 */
class FpController extends AbstractController
{
    /**
     * @Route("/", name="app_fp_index", methods={"GET"})
     */
    public function index(FpRepository $fpRepository): Response
    {
        return $this->render('fp/index.html.twig', [
            'fps' => $fpRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_fp_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FpRepository $fpRepository): Response
    {
        $fp = new Fp();
        $form = $this->createForm(FpType::class, $fp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fpRepository->add($fp, true);

            return $this->redirectToRoute('app_fp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fp/new.html.twig', [
            'fp' => $fp,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codfp}", name="app_fp_show", methods={"GET"})
     */
    public function show(Fp $fp): Response
    {
        return $this->render('fp/show.html.twig', [
            'fp' => $fp,
        ]);
    }

    /**
     * @Route("/{codfp}/edit", name="app_fp_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Fp $fp, FpRepository $fpRepository): Response
    {
        $form = $this->createForm(FpType::class, $fp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fpRepository->add($fp, true);

            return $this->redirectToRoute('app_fp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fp/edit.html.twig', [
            'fp' => $fp,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{codfp}", name="app_fp_delete", methods={"POST"})
     */
    public function delete(Request $request, Fp $fp, FpRepository $fpRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fp->getCodfp(), $request->request->get('_token'))) {
            $fpRepository->remove($fp, true);
        }

        return $this->redirectToRoute('app_fp_index', [], Response::HTTP_SEE_OTHER);
    }
}
