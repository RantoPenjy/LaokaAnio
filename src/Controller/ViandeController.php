<?php

namespace App\Controller;

use App\Entity\Viande;
use App\Form\ViandeType;
use App\Repository\ViandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/viande')]
class ViandeController extends AbstractController
{
    #[Route('/', name: 'app_viande_index', methods: ['GET'])]
    public function index(ViandeRepository $viandeRepository): Response
    {
        return $this->render('viande/index.html.twig', [
            'viandes' => $viandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_viande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $viande = new Viande();
        $form = $this->createForm(ViandeType::class, $viande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($viande);
            $entityManager->flush();

            return $this->redirectToRoute('app_viande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('viande/new.html.twig', [
            'viande' => $viande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_viande_show', methods: ['GET'])]
    public function show(Viande $viande): Response
    {
        return $this->render('viande/show.html.twig', [
            'viande' => $viande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_viande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Viande $viande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ViandeType::class, $viande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_viande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('viande/edit.html.twig', [
            'viande' => $viande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_viande_delete', methods: ['POST'])]
    public function delete(Request $request, Viande $viande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$viande->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($viande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_viande_index', [], Response::HTTP_SEE_OTHER);
    }
}
