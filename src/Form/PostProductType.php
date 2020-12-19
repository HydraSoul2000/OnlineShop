<?php

namespace App\Form;


use App\Entity\Shop;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
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
                    'placeholder' => 'Enter the title',
                    'class' => 'custom_class form-control',
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
            ->add('price',TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter the price',
                    'class' => 'form-control',
                    'style' => 'margin-bottom:10px;'
                ]
            ])
            ->add('attachment',FileType::class, [
            'label' => 'add an image ',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
            ])
            // ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shop::class,
        ]);
    }
}
