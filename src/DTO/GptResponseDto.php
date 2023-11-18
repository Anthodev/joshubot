<?php

declare(strict_types=1);

namespace App\DTO;

readonly class GptResponseDto
{
    public function __construct(
        public string $input,
        public string $output,
    ) {
    }
}
