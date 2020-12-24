<?php

namespace App\Form;


use App\Entity\Shop;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Route;
use Symfony\Component\Validator\Constraints\File;

class PostProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter the product name',
                    'class' => 'custom_class form-control',
                    'style' => 'margin-bottom:10px;',
                    'required' => true
                ]
            ])
            ->add('producttype',ChoiceType::class, [
                'label' => 'Type',
                'choices'  => [
                    'Food' => 'Food',
                    'Clothes' => 'Clothes',
                    'Electronics' => 'Electronics',
                    'Housing' => 'Housing',
                ],
                'attr' => [
                    'placeholder' => 'Enter the product type',
                    'class' => 'form-control',
                    'style' => 'margin-bottom:10px;'
                ]
            ])
            ->add('price',TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter the price in euros',
                    'class' => 'form-control',
                    'style' => 'margin-bottom:10px;'
                ]
            ])
            ->add('description',TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter the description',
                    'class' => 'custom_class form-control',
                    'style' => 'margin-bottom:10px;'
                ]
            ])
            ->add('country',TextType::class, [
                'attr' => [
                    'placeholder' => 'Country of origin',
                    'class' => 'custom_class form-control',
                    'style' => 'margin-bottom:10px;'
                ]
            ])
            ->add('brand',TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter the brand name',
                    'class' => 'custom_class form-control',
                    'style' => 'margin-bottom:10px;'
                ]
            ])
            ->add('attachment',FileType::class, [
                'label' => 'Add an image ',
                'mapped' => false,
                'attr' => [
                    'class' => 'custom_class form-control',
                    'id' => 'customFile',
                    'style' => 'padding: 3px 3px 3px 3px;'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shop::class,
        ]);
    }
}
