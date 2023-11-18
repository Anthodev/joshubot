<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\GptResponseDto;
use App\Enum\RequestMethodEnum;
use App\Service\OpenApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/chat', name: 'send_question', methods: [RequestMethodEnum::POST->value])]
    public function chat(
        Request $request,
        OpenApiClient $openApiClient,
    ): Response {
        $input = $request->request->get('prompt');

        $gptResponse = $openApiClient->ask($input);

        $response = new GptResponseDto($input, $gptResponse);

        return $this->forward('App\Controller\HomeController::index', [
            'response' => $response,
        ]);
    }
}
