<?php

declare(strict_types=1);

namespace App\Component;

use App\DTO\GptResponseDto;
use App\Entity\GptMessage;
use App\Form\PromptType;
use App\Service\OpenApiClient;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('prompt_form')]
final class PromptComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentToolsTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?GptResponseDto $gptResponse = null;

    #[LiveProp(writable: true)]
    public bool $isLoading = false;

    public function instantiateForm(): FormInterface
    {
        return $this->createForm(PromptType::class, $this->gptResponse);
    }


    /**
     * @throws Exception
     */
    #[LiveAction]
    public function ask(
        OpenApiClient $openApiClient,
        EntityManagerInterface $entityManager,
    ): void {
        $this->submitForm();
        $this->isLoading = true;

        /** @var GptResponseDto $prompt */
        $prompt = $this->getForm()->getData();

        $gptResponse = $openApiClient->ask($prompt);

        if ($prompt->output !== 'Une erreur est survenue.') {
            $gptMessage = new GptMessage();
            $gptMessage->setId($gptResponse->id);
            $gptMessage->setInput($prompt->input);
            $gptMessage->setOutput($prompt->output);

            $entityManager->persist($gptMessage);
            $entityManager->flush();
        }

        $this->addFlash('error', $prompt->output);

        $this->emit('response_received');
        $this->isLoading = false;

        $this->resetForm();
    }
}
