<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ClientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('client_name', TextType::class, ["required" => true])
            ->add('email', EmailType::class, ["required" => true])
            ->add('manager', TextType::class, ["required" => true])
            ->add('payment_method', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Bitcoin' => "Bitcoin",
                    'PayPal' => "PayPal",
                    'Wire transfer' => "wireTransfer",
                ]
            ])
            ->add('avatar', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => 
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid JPEG or PNG image',
                    ])
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'client_item'
        ]);
    }
}
