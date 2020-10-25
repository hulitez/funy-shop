<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @param Request $request
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function list(Request $request, ProductRepository $productRepository)
    {
        $page = $request->query->getInt('page', 1);
        $offset = $page > 0 ? ($page -1) * ProductRepository::PAGINATOR_PER_PAGE : 0;
        $paginator = $productRepository->getPaginator($offset);

        return $this->render('product/index.html.twig', [
            'products' => $paginator,
            'previous' => $page > 1 ? $page -1 : null,
            'next' => round(count($paginator) / ProductRepository::PAGINATOR_PER_PAGE) > $page
                ? $page + 1
                : null
            ,
        ]);
    }
}
