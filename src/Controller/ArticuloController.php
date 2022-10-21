<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Form\ArticuloType;
use App\Form\BusquedaType;
use App\Repository\ArticuloRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $formBusqueda = $this->createForm(BusquedaType::class);
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
    public function new(Request $request, ArticuloRepository $articuloRepository, SluggerInterface $slugger): Response
    {
        $formBusqueda = $this->createForm(BusquedaType::class);
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
            foreach ($blobData as $brochureFile) {
                # code...
                if ($brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $brochureFile->move(
                            $this->getParameter('brochures_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $arrayFile[] = $newFilename;
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                }
            }
            if (count($arrayFile) > 0) {
                $encoders = [new XmlEncoder(), new JsonEncoder()];
                $normalizers = [new ObjectNormalizer()];

                $serializer = new Serializer($normalizers, $encoders);
                $jsonContent = $serializer->serialize($arrayFile, 'json');
                $articulo->setImagen($jsonContent);

                $articuloRepository->add($articulo, true);
            }
            // var_dump($blobData);
            // if ($blobData) {
            //     $imageContent = file_get_contents($blobData);
            //     $articulo->setImagen($imageContent);
            // }
            // // $subfamilia = $form->get("codsubfamilia")->getData();

            // $entityManager->persist($articulo);
            // $entityManager->flush();
            // $this->addFlash(
            //     'success',
            //     'Se ha introducido el articulo de manera correcta'
            // );
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
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_articulo_search', ['slug' => $textABuscar]);
        }
        // if ($articulo->getImagen()) {
        //     $base64Image = base64_encode(stream_get_contents($articulo->getImagen()));
        // }
        $imgArrayJson = stream_get_contents($articulo->getImagen());
        $arrayImages = json_decode($imgArrayJson);
        // dump($imgArrayJson);
        return $this->render('articulo/show.html.twig', [
            'articulo' => $articulo,
            'imgArrayJson' => $arrayImages,
            'formBusqueda' => $formBusqueda->createView()
        ]);
    }

    /**
     * @Route("/buscar/{slug}", name="app_articulo_search", methods={"GET","POST"})
     */
    public function searchArticle(ArticuloRepository $articuloRepository, String $slug, Request $request, PaginatorInterface $paginator): Response
    {
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        $articulos = $articuloRepository->searchByDescription($slug);
        $pagination = $paginator->paginate(
            $articulos,
            $request->query->getInt('pagina', 1), /*page number*/
            12 /*limit per page*/
        );
        foreach ($pagination as $articulo) {
            if ($articulo->getImagen()) {
                $base64Image = base64_encode(stream_get_contents($articulo->getImagen()));
                $articulo->setImagen($base64Image);
            }
        }
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
    public function edit(Request $request,EntityManagerInterface $entityManager, Articulo $articulo, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ArticuloType::class, $articulo);
        $form->handleRequest($request);
        $formBusqueda = $this->createForm(BusquedaType::class);
        $formBusqueda->handleRequest($request);
        if ($formBusqueda->isSubmitted() && $formBusqueda->isValid()) {
            $textABuscar = $formBusqueda->get('buscar')->getData();
            return $this->redirectToRoute('app_articulo_search', ['slug' => $textABuscar]);
        }
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $blobData = $form->get("img")->getData();
        //     if ($blobData) {
        //         $imageContent = file_get_contents($blobData);
        //         $articulo->setImagen($imageContent);
        //     }
        //     $entityManager->flush();
        //     $this->addFlash(
        //         'success',
        //         'Se ha editado el articulo de manera correcta'
        //     );
        //     return $this->redirectToRoute('app_articulo_index', [], Response::HTTP_SEE_OTHER);
        // }
        $arrayFile=[];
        if ($form->isSubmitted() && $form->isValid()) {
            $blobData = $form->get("img")->getData();
            foreach ($blobData as $brochureFile) {
                # code...
                if ($brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $brochureFile->move(
                            $this->getParameter('brochures_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $arrayFile[] = $newFilename;
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                }
            }
        }
        if (count($arrayFile) > 0) {
            $encoders = [new XmlEncoder(), new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];

            $serializer = new Serializer($normalizers, $encoders);
            $jsonContent = $serializer->serialize($arrayFile, 'json');
            $articulo->setImagen($jsonContent);

            // $articuloRepository->add($articulo, true);
            $entityManager->flush();
            $this->addFlash(
               'success',
               'Se ha actualizado de manera satisfactoria este articulo'
            );
            return $this->redirectToRoute('app_articulo_index');
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
