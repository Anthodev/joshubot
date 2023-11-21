<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class GptResponseDto
{
    public ?int $id = null;
    #[Assert\NotBlank]
    public ?string $input = null;
    public ?string $output = null;
}
