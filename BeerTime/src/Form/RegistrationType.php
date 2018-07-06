<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "name"
                ]
            ])
            ->add('email', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "email",
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "password"
                ]
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "confirm password"
                ]
            ])
            ->add('zipCode', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "zipcode"
                ]
            ])
            ->add('birthdate', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => "birthdate"
                ]
            ])
            ->add('country', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "country"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
