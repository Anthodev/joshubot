<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\GptRoleEnum;
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

    public function ask(string $input): string
    {
        $client = $this->createClient();
        $response = $client->chat()->create([
            'model' => 'gpt-4-1106-preview',
            'messages' => [
                [
                    'role' => GptRoleEnum::USER->value,
                    'content' => $input,
                ],
            ],
        ]);

        return $response->choices[0]->message->content;
    }
}
