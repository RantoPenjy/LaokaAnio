<?php

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\PlatInput;
use App\Entity\Plat;
use App\Repository\DayTypeRepository;
use App\Repository\NonViandeRepository;
use App\Repository\ViandeRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlatProcessor implements ProcessorInterface
{
    private $viandeRepository;
    private $nonViandeRepository;
    private $dayTypeRepository;
    private $entityManager;

    public function __construct(
        ViandeRepository $viandeRepository,
        NonViandeRepository $nonViandeRepository,
        DayTypeRepository $dayTypeRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->viandeRepository = $viandeRepository;
        $this->nonViandeRepository = $nonViandeRepository;
        $this->dayTypeRepository = $dayTypeRepository;
        $this->entityManager = $entityManager;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if (!$data instanceof PlatInput) {
            throw new \InvalidArgumentException('Expected PlatInput');
        }

        $plat = new Plat();
        $plat->setName($data->name);
        $minPrice = 0;

        if ($data->viandesIds) {
            foreach ($data->viandesIds as $viandesId) {
                $viande = $this->viandeRepository->find($viandesId);
                if ($viande) {
                    $plat->getViandes()->add($viande);
                    $minPrice += $viande->getMinPricePerPerson();
                }
            }
        }

        if ($data->nonViandeIds) {
            foreach ($data->nonViandeIds as $nonViandeId) {
                $nonViande = $this->nonViandeRepository->find($nonViandeId);
                if ($nonViande) {
                    $plat->getNonViandes()->add($nonViande);
                    $minPrice += $nonViande->getMinPricePerPerson();
                }
            }
        }

        $daytype = $this->dayTypeRepository->find($data->dayTypeId);
        if ($daytype) {
            $plat->setDayType($daytype);
        }

        $plat->setMinPricePerPerson($minPrice);

        $this->entityManager->persist($plat);
        $this->entityManager->flush();

        return $plat;
    }
}