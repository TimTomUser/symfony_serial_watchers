<?php

namespace App\Form;

use App\Entity\Director;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('synopsis')
            ->add('releaseYear')
            ->add('genre')
            ->add('director', EntityType::class, [
                'class' => Director::class,
                'choice_label' => function(Director $director) {
                        return $director->getFirstName() . ' ' . $director->getLastName();
                    },
                'placeholder' => 'Choisissez un réalisateur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
