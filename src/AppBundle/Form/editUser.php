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

class editUser extends AbstractType
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
            ->add('plainPassword', PasswordType::class, [
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
            ->add('save', SubmitType::class, [
                'attr' => [
                    'label' => 'save',
                    'class' => 'btn btn-success'
                ]
            ]);
    }
}