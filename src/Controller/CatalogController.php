<?php

/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Catalog;
use App\Repository\CatalogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CatalogController.
 */
#[Route('/catalog')]
class CatalogController extends AbstractController
{
    /**
     * Index action.
     *
     * @param Request            $request            HTTP Request
     * @param CatalogRepository  $catalogRepository  Catalog repository
     * @param PaginatorInterface $paginator          Paginator
     *
     * @return Response HTTP response
     */
    #[Route('/', name: 'catalog_index', methods: ['GET'])]
    public function index(Request $request, CatalogRepository $catalogRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $catalogRepository->queryAll(),
            $request->query->getInt('page', 1),
            CatalogRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render(
            'catalogs/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * Show action.
     *
     * @param Catalog $catalog Catalog entity
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'catalog_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: ['GET']
    )]
    public function show(Catalog $catalog): Response
    {
        return $this->render(
            'catalogs/show.html.twig',
            ['catalog' => $catalog]
        );
    }
}

