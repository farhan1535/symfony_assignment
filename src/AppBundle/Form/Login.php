<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class Login extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'user name: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'user name: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('login', SubmitType::class, [
                'attr' => [
                    'label' => 'login',
                    'class' => 'btn btn-info'
                ]
            ]);
    }
}