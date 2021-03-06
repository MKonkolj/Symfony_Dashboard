<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, ['required' => true, 'constraints' => [
                new NotBlank([
                    'message' => 'Please enter your firstname'
                ])
            ]])
            ->add('last_name', TextType::class, ['required' => true, 'constraints' => [
                new NotBlank([
                    'message' => 'Please enter your lastname'
                ])
            ]])
            ->add('email', EmailType::class, ['required' => true, 'constraints' => [
                new NotBlank([
                    'message' => 'Please enter your email'
                ]),
                new UniqueEntity([
                    'fields' => 'email',
                    'message' => 'You already have an account with this email.'
                ])
            ]])
            ->add('street', TextType::class, ['required' => true, 'constraints' => [
                new NotBlank([
                    'message' => 'Please enter street'
                ])
            ]])
            ->add('city', TextType::class, ['required' => true, 'constraints' => [
                new NotBlank([
                    'message' => 'Please enter city'
                ])
            ]])
            ->add('country', TextType::class, ['required' => true, 'constraints' => [
                new NotBlank([
                    'message' => 'Please enter country'
                ])
            ]])
            ->add('bank_acc', TextType::class, ['required' => true, 'constraints' => [
                new NotBlank([
                    'message' => 'Please enter your bank account'
                ]),
                new Length([
                    'min' => 16,
                    'max' => 16,
                    'exactMessage' => 'The account number must be 16 digits long.'
                ])
            ]])
            ->add('status', CheckboxType::class, [
                'data' => true,
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'choices' => [
                    'Developer' => "ROLE_DEV",
                    'Admin' => "ROLE_ADMIN",
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'required' => false,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
