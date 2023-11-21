<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\GptResponseDto;
use App\Enum\GptRoleEnum;
use Exception;
use OpenAI;
use OpenAI\Client;

readonly class OpenApiClient
{
    public function __construct(
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
        $client = $this->createClient();
        $response = $client->chat()->create([
            'model' => 'gpt-4-1106-preview',
            'messages' => [
                [
                    'role' => GptRoleEnum::USER->value,
                    'content' => $prompt->input,
                ],
            ],
        ]);

        $prompt->id = random_int(100, 1000);
        $prompt->output = "Une erreur est survenue.";

        if (isset($response->choices[0]->message->content)) {
            $prompt->id = $response->created;
            $prompt->output = $response->choices[0]->message->content;
            $prompt->output = preg_replace( "/\r|\n/", "<br/>", $prompt->output);
        }

        return $prompt;
    }
}
