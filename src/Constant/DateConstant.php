<?php

namespace App\Constant;

class DateConstant
{
    public const MALAGASY_DAY = array(
        array(
            'name' => 'Monday',
            'traduction' => 'Alatsinainy'
        ),
        array(
            'name' => 'Tuesday',
            'traduction' => 'Talata'
        ),
        array(
            'name' => 'Wednesday',
            'traduction' => 'Alarobia'
        ),
        array(
            'name' => 'Thursday',
            'traduction' => 'Alakamisy'
        ),
        array(
            'name' => 'Friday',
            'traduction' => 'Zoma'
        ),
        array(
            'name' => 'Saturday',
            'traduction' => 'Sabotsy'
        ),
        array(
            'name' => 'Sunday',
            'traduction' => 'Alahady'
        )
    );

    public const MALAGASY_MONTH = array(
        array(
            'name' => 'January',
            'traduction' => 'Janoary'
        ),
        array(
            'name' => 'February',
            'traduction' => 'Febroary'
        ),
        array(
            'name' => 'March',
            'traduction' => 'Martsa'
        ),
        array(
            'name' => 'April',
            'traduction' => 'Aprily'
        ),
        array(
            'name' => 'May',
            'traduction' => 'May'
        ),
        array(
            'name' => 'June',
            'traduction' => 'Jona'
        ),
        array(
            'name' => 'July',
            'traduction' => 'Jolay'
        ),
        array(
            'name' => 'August',
            'traduction' => 'Aogositra'
        ),
        array(
            'name' => 'September',
            'traduction' => 'Septambra'
        ),
        array(
            'name' => 'October',
            'traduction' => 'Oktobra'
        ),
        array(
            'name' => 'November',
            'traduction' => 'Novambra'
        ),
        array(
            'name' => 'December',
            'traduction' => 'Desambra'
        ),
    );

    public const MALAGASY_HOLIDAYS = [
        [
            'name' => 'Easter',
            'traduction' => 'Paska'
        ],
        [
            'name' => 'Pentecost',
            'traduction' => 'Pentekosta'
        ],
        [
            'name' => 'Ascension',
            'traduction' => 'andro niakarana (Ascension)'
        ],
        [
            'name' => 'Assomption',
            'traduction' => 'Assomption'
        ],
        [
            'name' => 'Christmas',
            'traduction' => 'Krisimasy'
        ],
        [
            'name' => 'NewYear',
            'traduction' => 'taom-baovao'
        ],
        [
            'name' => 'MalagasyMartyr',
            'traduction' => 'fetin\'ny mahery fo'
        ],
        [
            'name' => 'MalagasyIndependenceDay',
            'traduction' => 'fahaleovantena'
        ],
        [
            'name' => 'Toussaint',
            'traduction' => 'fetin\'ny maty'
        ],

    ];

    private static function getEasterDate(): \DateTime
    {
        return (new \DateTime('@' . easter_date(date('Y'))))
            ->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    }

    private static function getPentecostDate(): \DateTime
    {
        return (clone(self::getEasterDate()))
            ->add(new \DateInterval('P49D'));
    }

    private static function getAscensionDate(): \DateTime
    {
        return (clone(self::getEasterDate()))
            ->add(new \DateInterval('P39D'));
    }

    private static function getChristmasDate(): \DateTime
    {
        return (new \DateTime(date('Y') . "-12-25"))
            ->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    }

    private static function getNewYearDate(): \DateTime
    {
        return (new \DateTime(date('Y') . "-01-01"))
            ->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    }

    private static function getToussaintDate(): \DateTime
    {
        return (new \DateTime(date('Y') . "-11-01"))
            ->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    }

    private static function getAssomptionDate(): \DateTime
    {
        return (new \DateTime(date('Y') . "-08-15"))
            ->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    }

    private static function getMalagasyMartyrDate(): \DateTime
    {
        return (new \DateTime(date('Y') . "-03-29"))
            ->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    }

    private static function getMalagasyIndependenceDate(): \DateTime
    {
        return (new \DateTime(date('Y') . "-06-26"))
            ->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    }

    public static function holidays(): array
    {
        return [
            'Easter' => self::getEasterDate(),
            'Pentecost' => self::getPentecostDate(),
            'Ascension' => self::getAscensionDate(),
            'Assomption' => self::getAssomptionDate(),
            'Christmas' => self::getChristmasDate(),
            'NewYear' => self::getNewYearDate(),
            'MalagasyMartyr' => self::getMalagasyMartyrDate(),
            'MalagasyIndependenceDay' => self::getMalagasyIndependenceDate(),
            'Toussaint' => self::getToussaintDate()
        ];
    }
}
