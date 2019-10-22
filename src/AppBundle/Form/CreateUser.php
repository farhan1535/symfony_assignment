<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateUser extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('age', NumberType::class, [
                'label' => 'Age: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('phone_no', TextType::class, [
                'label' => 'Phone Number: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('dob', TextType::class, [
                'mapped' => false,
                'attr' => [
                    'id' => 'some_id',
                    'class' => 'asd'
                ]
            ])
            ->add('Gender', ChoiceType::class, [
                'choices' => [
                    'Male' => 1,
                    'Female' => 0,
                ],
            ])
            ->add('Married', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Married: ',
                'required' => false,
                'attr' => [
                    'id' => 'checkMarried'
                ]
            ])
            ->add('create', SubmitType::class, [
                'attr' => [
                    'label' => 'create',
                    'class' => 'btn btn-success'
                ]
            ]);
    }
}