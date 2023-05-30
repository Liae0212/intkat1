<?php

/**
 * Song controller.
 */

namespace App\Controller;

use App\Entity\Song;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SongController.
 */
#[Route('/song')]
class SongController extends AbstractController
{
    /**
     * Index action.
     *
     * @param Request            $request           HTTP Request
     * @param SongRepository     $songRepository   Song repository
     * @param PaginatorInterface $paginator        Paginator
     *
     * @return Response HTTP response
     */
    #[Route('/', name: 'song_index', methods: ['GET'])]
    public function index(Request $request, SongRepository $songRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $songRepository->queryAll(),
            $request->query->getInt('page', 1),
            SongRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render(
            'songs/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * Show action.
     *
     * @param Song $song Song entity
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'song_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: ['GET']
    )]
    public function show(Song $song): Response
    {
        return $this->render(
            'songs/show.html.twig',
            ['song' => $song]
        );
    }
}
