<?php

namespace App\Form;

use App\Entity\Note;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class NoteType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
        ->add('title', TextType::class, [
            'constraints' => [
                new NotNull([
                    'message' => 'Empty values not allowed'
                ])
            ]
        ])
        ->add('text', TextType::class, [
            'constraints' => [
                new NotNull([
                    'message' => 'Text can not be empty'
                ])
            ]
        ])
        ->add('created_time', DateTimeType::class, [
                'widget' => 'single_text',
            ]
        );
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
        'data_class' => Note::class,
        'csrf_protection' => false
    ]);
  }
}
