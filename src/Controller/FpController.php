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
/**
 * @Route("/fp")
 */
class FpController extends AbstractController
{
    private EntityManagerInterface $emi;
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi=$emi;
    }
    /**
     * @Route("/", name="app_fp_index", methods={"GET","POST"})
     */
    public function index(FpRepository $fpRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $queryArticulos = $fpRepository->obtenerQueryFP();
        $pagination = $paginator->paginate(
            $queryArticulos,
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );

        if (isset($_POST['send'])) {
            $familia = $fpRepository->find($_POST['id']);
            if ($familia !== null) {
                $this->emi->remove($familia);
                $this->emi->flush();
                $this->addFlash("success", "La forma de pago ha sido borrada de manera satisfactoria");
                return $this->redirectToRoute('app_familia_index', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->render('fp/index.html.twig', [
            'fps' => $pagination,
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

            return $this->redirectToRoute('app_fp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fp/new.html.twig', [
            'fp' => $fp,
            'typeButton'=>'success',
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
     * @Route("/{codfp}/editar", name="app_fp_edit", methods={"GET", "POST"})
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
            'typeButton'=>'warning',
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
            $this->addFlash(
               'success',
               'Has borrado de manera satisfactoria la forma de pago'
            );
        }

        return $this->redirectToRoute('app_fp_index', [], Response::HTTP_SEE_OTHER);
    }
}
