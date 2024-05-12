<?php

namespace App\Controller;

use App\Entity\NonViande;
use App\Form\NonViandeType;
use App\Repository\NonViandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/non_viande')]
class NonViandeController extends AbstractController
{
    #[Route('/', name: 'app_non_viande_index', methods: ['GET'])]
    public function index(NonViandeRepository $nonViandeRepository): Response
    {
        return $this->render('non_viande/index.html.twig', [
            'non_viandes' => $nonViandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_non_viande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nonViande = new NonViande();
        $form = $this->createForm(NonViandeType::class, $nonViande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($nonViande);
            $entityManager->flush();

            return $this->redirectToRoute('app_non_viande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('non_viande/new.html.twig', [
            'non_viande' => $nonViande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_non_viande_show', methods: ['GET'])]
    public function show(NonViande $nonViande): Response
    {
        return $this->render('non_viande/show.html.twig', [
            'non_viande' => $nonViande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_non_viande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NonViande $nonViande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NonViandeType::class, $nonViande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_non_viande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('non_viande/edit.html.twig', [
            'non_viande' => $nonViande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_non_viande_delete', methods: ['POST'])]
    public function delete(Request $request, NonViande $nonViande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nonViande->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($nonViande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_non_viande_index', [], Response::HTTP_SEE_OTHER);
    }
}
