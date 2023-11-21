<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\GptMessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GptMessageRepository::class)]
class GptMessage
{
    #[ORM\Id]
    #[ORM\Column(Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $input = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $output = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getInput(): ?string
    {
        return $this->input;
    }

    public function setInput(string $input): static
    {
        $this->input = $input;

        return $this;
    }

    public function getOutput(): ?string
    {
        return $this->output;
    }

    public function setOutput(?string $output): static
    {
        $this->output = $output;

        return $this;
    }
}
