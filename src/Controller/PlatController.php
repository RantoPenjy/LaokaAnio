<?php

namespace App\Controller;

use App\Constant\DateConstant;
use DateTime;
use App\Entity\Plat;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Date;

class PlatController extends AbstractController
{
    #[Route('/plat/random', name: 'random_plat')]
    public function randomPlat(PlatRepository $platRepository): Response
    {
        setlocale(LC_TIME, NULL);
        $day = date('l');
        $date_now = new DateTime('now');
        $date_now->setTimezone(new \DateTimeZone('Africa/Nairobi'));

        $holidays = DateConstant::holidays();
        $holiday = in_array($date_now, $holidays);

        $id_day = $holiday ? 3 : ($day != 'Sunday' ? 1 : 2);

        $plat = $platRepository->findBy(['day_type' => $id_day]);
        # shuffle all data
        # shuffle($plat);

        # get a random number for the index
        $random_index = rand(0, count($plat)-1);
        $plat_randomized = $plat[$random_index];

        return $this->json($plat_randomized->getName());
    }

}
