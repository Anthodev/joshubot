<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\GptResponseDto;
use App\Enum\GptRoleEnum;
use App\Repository\GptMessageRepository;
use Exception;
use OpenAI;
use OpenAI\Client;

readonly class OpenApiClient
{
    public function __construct(
        private GptMessageRepository $gptMessageRepository,
        private string $openApiKey,
        private ?string $openApiOrganization = null,
    ) {
    }

    private function createClient(): Client
    {
        return OpenAI::client(
            $this->openApiKey,
            $this->openApiOrganization,
        );
    }

    /**
     * @throws Exception
     */
    public function ask(GptResponseDto $prompt): GptResponseDto
    {
        $messages = $this->buildGptMessagesHistory();
        $messages[] = [
            'role' => GptRoleEnum::USER->value,
            'content' => $prompt->input,
        ];

        $client = $this->createClient();

        try {
            $response = $client->chat()->create([
                'model' => 'gpt-4-1106-preview',
                'messages' => $messages,
            ]);
        } catch (Exception) {
            $prompt->id = random_int(100, 1000);
            $prompt->output = "Une erreur est survenue.";
        }

        if (isset($response->choices[0]->message->content)) {
            $prompt->id = $response->created;
            $prompt->output = $response->choices[0]->message->content;
            $prompt->output = preg_replace( "/\r|\n/", "<br/>", $prompt->output);
        }

        return $prompt;
    }

    /**
     * @return string[]
     */
    private function buildGptMessagesHistory(): array
    {
        $gptMessages = $this->gptMessageRepository->findAll();
        $gptMessagesHistory = [];

        foreach ($gptMessages as $gptMessage) {
            $gptMessagesHistory[] = [
                'role' => GptRoleEnum::USER->value,
                'content' => $gptMessage->getInput(),
            ];
            $gptMessagesHistory[] = [
                'role' => GptRoleEnum::ASSISTANT->value,
                'content' => $gptMessage->getOutput(),
            ];
        }

        return $gptMessagesHistory;
    }
}
