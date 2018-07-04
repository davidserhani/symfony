<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Place;
use App\Entity\TableEvent;
use App\Entity\TableUser;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => "enter a name for the event"
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => "enter the description of the event"
                ]
            ])
            ->add('capacity', IntegerType::class, [
                'attr' => [
                    'placeholder' => "enter number max of guest"
                ]
            ])
            ->add('startAt', DateTimeType::class, [
                    'widget' => 'single_text'
            ]
                )
            ->add('endAt', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('price', MoneyType::class)
            ->add('poster', UrlType::class, [
                'attr' => [
                    'placeholder' => "enter an url"
                    ]
            ])
            ->add('owner', EntityType::class, [
                'class' => TableUser::class,
                'choice_label' => 'username',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'attr' => [
                    'placeholder' => "select a category"
                    ],
                'multiple' => true
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'choice_label' => 'name',
                'attr' => [
                    'placeholder' => "select a place"
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TableEvent::class,
        ]);
    }
}
