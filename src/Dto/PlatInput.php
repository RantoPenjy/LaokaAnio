<?php

namespace App\Dto;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class PlatInput
{
    #[ApiProperty(required: true)]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat'])]
    public ?string $name;

    #[ApiProperty(
        required: false,
        example: [0]
    )]
    #[Assert\All(new Assert\Type('integer'))]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat'])]
    public ?array $viandesIds;

    #[ApiProperty(
        required: false,
        example: [0]
    )]
    #[Assert\All(new Assert\Type('integer'))]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat'])]
    public ?array $nonViandeIds;

    #[ApiProperty(required: true)]
    #[Groups(['read_collection:plat', 'post:plat', 'read:plat'])]
    public int $dayTypeId;
}