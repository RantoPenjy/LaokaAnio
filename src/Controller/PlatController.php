<?php

namespace App\Controller;

use App\Constant\DateConstant;
use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\PlatRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PlatController extends AbstractController
{
    public function __invoke(PlatRepository $platRepository, SerializerInterface $serializer): Response
    {
        setlocale(LC_TIME, NULL);
        $day = date('l');
        $date_now = (new DateTime('now'))
            ->setTimezone(new \DateTimeZone('Africa/Nairobi'))
            ->format('Y-m-d');

        $holidays = DateConstant::holidays();
        $holiday = in_array($date_now, $holidays);

        $id_day = $holiday ? 3 : ($day != 'Sunday' ? 1 : 2);

        $plat = $platRepository->findBy(['day_type' => $id_day]);

        if (!$plat) {
            return new Response($serializer->serialize([
                'status' => 'Error',
                'message' => 'There is no data for this day'
            ],
                'jsonld'),
                Response::HTTP_INTERNAL_SERVER_ERROR, ['Content-Type' => 'application/ld+json']);
        }

        # get a random number for the index
        $random_index = array_rand($plat);
        $plat_randomized = $plat[$random_index];

        $data = $serializer->serialize($plat_randomized, 'jsonld', ['groups' => ['read:plat']]);

        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/ld+json']);
    }

    #[Route('/plats/', name: 'app_plat_index', methods: ['GET'])]
    public function index(PlatRepository $platRepository): Response
    {
        return $this->render('plat/index.html.twig', [
            'plats' => $platRepository->findAll(),
        ]);
    }

    #[Route('/plats/new', name: 'app_plat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plat/new.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/plats/{id}', name: 'app_plat_show', methods: ['GET'])]
    public function show(Plat $plat): Response
    {
        return $this->render('plat/show.html.twig', [
            'plat' => $plat,
        ]);
    }

    #[Route('/plats/{id}/edit', name: 'app_plat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plat $plat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plat/edit.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/plats/{id}', name: 'app_plat_delete', methods: ['POST'])]
    public function delete(Request $request, Plat $plat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plat->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($plat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
    }
}
