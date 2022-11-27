<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => "Car brand",
            ])
            ->add('nbreSeats', NumberType::class,[
                'label' => "Number of seats",
                'attr' => array(
                    'min' => 5,
                    'max' => 7,
                ),
                'html5' => true,
                ])
            ->add('nbreDoors', NumberType::class,[
                'label' => "Number of doors",
                'attr' => array(
                    'min' => 3,
                    'max' => 5,
                ),
                'html5' => true,
                ])
            ->add('cost', MoneyType::class,[
                'label' => "Price",
                'scale'=> 2,
                'attr' => array(
                    'min' => 1500,
                    'max' => 3000,
                ),
                'html5' => true
                ])
            ->add('category' , EntityType::class, [
                'label' => 'Category',
                'choice_label' => 'name', // valeur de la prop à afficher dans les balises options
                'class' => Category::class,
                'multiple' => false,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
            'attr' => [
                'novalidate' => 'novalidate',
        ]
        ]);
    }
}