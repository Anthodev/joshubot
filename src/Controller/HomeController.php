<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\GptMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/delete-history', name: 'delete_history')]
    public function deleteHistory(GptMessageRepository $gptMessageRepository): Response
    {
        $gptMessageRepository->deleteAll();

        return $this->redirectToRoute('home');
    }
}
