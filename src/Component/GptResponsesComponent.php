<?php

declare(strict_types=1);

namespace App\Component;

use App\DTO\GptResponseDto;
use App\Repository\GptMessageRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('gpt_responses')]
class GptResponsesComponent
{
    use DefaultActionTrait;

    public function __construct(private readonly GptMessageRepository $gptMessageRepository)
    {
    }

    /** @return GptResponseDto[] */
    #[LiveListener('response_received')]
    public function getGptMessages(): array
    {
        return $this->gptMessageRepository->findAll();
    }
}
