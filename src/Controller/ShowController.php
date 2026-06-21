<?php

namespace App\Controller;

use App\Entity\Show;
use App\Form\ShowType;
use App\Repository\ShowRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/')]
final class ShowController extends AbstractController
{

    #[Route(name: 'app_show_search', methods: ['GET', 'POST'])]
    public function search(ShowRepository $showRepository, Request $request): Response
    {
        $trie = '';
        $submittedToken = $request->getPayload()->get('token');
        if ($this->isCsrfTokenValid('recherche', $submittedToken)) {

            if (!empty($request->request->get('Trie'))) {
                if ($request->request->get('Trie')) {
                    $trie = $request->request->get('Trie');
                }
                // $showRepository->findShowByDateASC();
            }
            $date = new DateTime();

            $tab = [];
            //Recherche par nom
            if (!empty($request->request->get('search'))) {
                $mot = $request->request->get('search');
                foreach ($showRepository->findAll() as $show) {
                    if (str_contains(strtolower($show->getTitle()), strtolower($mot))) {
                        $tab[] = $show;
                    }
                }
            }
            // dd($tab);
        }
        if (empty($request->request->get('search'))) {
            $tab = $showRepository->findAll();
        }
        $filtred = [];
        //Filtre par Date
        if (!empty($request->request->get('date'))) {
            $choiced = $request->request->get('date');
            foreach ($tab as $show) {
                switch ($choiced) {
                    case '1':
                        foreach ($show->getRepresentations() as $representation) {
                            if (
                                $representation->getSchedule()->format('Y-m-d')
                                === $date->format('Y-m-d')
                            ) {
                                $filtred[] = $show;
                                break;
                            }
                        }
                        break;
                    case '2':
                        foreach ($show->getRepresentations() as $representation) {
                            if (
                                $representation->getSchedule()->format('o-W')
                                === $date->format('o-W')
                            ) {
                                $filtred[] = $show;
                                break;
                            }
                        }

                        break;
                    case '3':
                        foreach ($show->getRepresentations() as $representation) {
                            if (
                                $representation->getSchedule()->format('m')
                                === $date->format('m')
                            ) {
                                $filtred[] = $show;
                                break;
                            }
                        }

                        break;
                    case '4':
                        foreach ($show->getRepresentations() as $representation) {
                            if (
                                $representation->getSchedule()->format('Y')
                                === $date->format('Y')
                            ) {
                                $filtred[] = $show;
                                break;
                            }
                        }

                        break;
                }
            }
            $tab = $filtred;
            $filtred = [];
        }
        //Filtre par localitté
        if (!empty($request->request->get('locality'))) {

            $locality = $request->request->get('locality');
            // dd($locality,$tab,$request->request->get('date'));
            foreach ($tab as $show) {
                foreach ($show->getRepresentations() as $representation) {

                    if (
                        $representation->getLocation()
                        ->getLocality()
                        ->getLocality()
                        === $locality
                    ) {
                        $filtred[] = $show;
                        break;
                    }
                }
            }
            $tab = $filtred;
        }

        if ($trie) {
            usort($tab, function ($a, $b) use ($trie) {

                switch ($trie) {

                    case 'dureINC':
                        return $a->getDuration() <=> $b->getDuration();

                    case 'dureDESC':
                        return $b->getDuration() <=> $a->getDuration();

                    case 'Date':
                        return $a->getCreatedIn() <=> $b->getCreatedIn();

                    default:
                        return 0;
                }
            });
        }


        return $this->render('show/index.html.twig', [
            'shows' => $tab,
        ]);
    }


    #[Route(name: 'app_show_index', methods: ['GET'])]
    public function index(ShowRepository $showRepository): Response
    {
        return $this->render('show/index.html.twig', [
            'shows' => $showRepository->findAll(),
        ]);
    }
    #[IsGranted('ROLE_PRODUCTEUR')]
    #[Route('new', name: 'app_show_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $show = new Show();
        $form = $this->createForm(ShowType::class, $show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($show);
            $entityManager->flush();

            return $this->redirectToRoute('app_show_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('show/new.html.twig', [
            'show' => $show,
            'form' => $form,
        ]);
    }

    // ici on precise que l'id doit etre obligatoirement un entier
    #[Route('/{id<\d+>}', name: 'app_show_show', methods: ['GET'])]
    public function show(Show $show): Response
    {
        return $this->render('show/show.html.twig', [
            'show' => $show,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id<\d+>}/edit', name: 'app_show_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Show $show, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShowType::class, $show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_show_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('show/edit.html.twig', [
            'show' => $show,
            'form' => $form,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id<\d+>}', name: 'app_show_delete', methods: ['POST'])]
    public function delete(Request $request, Show $show, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $show->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($show);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_show_index', [], Response::HTTP_SEE_OTHER);
    }
}
