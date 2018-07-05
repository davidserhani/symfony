<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Place;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "enter a name for the event",
                ]
            ])
            ->add('description', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "enter the description of the event"
                ]
            ])
            ->add('capacity', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "enter number max of guest",
                    'min' => 0
                ]
            ])
            ->add('startAt', null, [
                    'widget' => 'single_text',
                    'label' => false,
                    'attr' => [
                        'min' => (new \DateTime())->format('Y-m-d\TH:i')
                    ]
            ]
                )
            ->add('endAt', null, [
                'widget' => 'single_text',
                'label' => false,
                'attr' => [
                    'min' => (new \DateTime())->format('Y-m-d\TH:i')
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "price",
                    'min' => 0
                ]
            ])
            ->add('posterFile', FileType::class, [
                'attr' => [
                    'placeholder' => "select a picture",
                    'accept' => 'image/*'
                    ]
            ])
            ->add('posterUrl', UrlType::class, [
                'attr' => [
                    'placeholder' => "put an url",
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'choice_label' => 'name',
                'placeholder' => "select a place"

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
