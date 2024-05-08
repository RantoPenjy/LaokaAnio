<?php

namespace App\Controller;

use App\Constant\DateConstant;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        setlocale(LC_TIME, NULL);
        $dateNow = new DateTime('now');
        $timestamp = $dateNow->getTimestamp();
//        $formattedDate = date('l d F Y', $timestamp);
        $day = date("l", $timestamp);
        $date = date("d", $timestamp);
        $month = date("F", $timestamp);
        $year = date("Y", $timestamp);
        $malagasy_day = DateConstant::MALAGASY_DAY;
        $malagasy_month = DateConstant::MALAGASY_MONTH;
        $malagasy_holidays = DateConstant::MALAGASY_HOLIDAYS;
        $holidays = DateConstant::holidays();

        $holiday_greeting = '';

        foreach ($holidays as $key => $holiday) {
            if ($holiday == $dateNow) {
                foreach ($malagasy_holidays as $value_malagasy_holiday) {
                    if ($key == $value_malagasy_holiday['name']) {
                        $malagasy_holiday = $value_malagasy_holiday['traduction'];
                        $holiday_greeting = '🎊 Tratrin\'ny ' . $malagasy_holiday . ' 🎊';
                    }
                }
            }
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
//            'date'=>$formattedDate,
            'day' => $day,
            'date' => $date,
            'year' => $year,
            'month' => $month,
            'malagasy_day' => $malagasy_day,
            'malagasy_month' => $malagasy_month,
            'malagasy_holidays' => $malagasy_holidays,
            'holiday_greeting' => $holiday_greeting
        ]);
    }
}
