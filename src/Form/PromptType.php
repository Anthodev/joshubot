<?php

namespace App\Form;

use App\DTO\GptResponseDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('input', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Type your prompt here',
                    'rows' => 1,
                    'class' => 'flex h-auto min-h-[40px] grow px-3 py-2 mr-1 text-sm border rounded-lg ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GptResponseDto::class,
        ]);
    }
}
