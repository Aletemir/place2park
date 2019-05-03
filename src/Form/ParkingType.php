<?php

namespace App\Form;

use App\Entity\Parking;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ParkingType extends AbstractType
{

    // create form for set new parking
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('type', EntityType::class,array(
                'class'=>Type::class,
                'choice_label'=>'label',
                'label' => 'Type de parking'
            ))
            ->add('pictureFile', VichImageType::class, [
                'label' => 'photo'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('district', TextType::class, [
                'label' => 'Quartier'
            ])
            ->add('street', TextType::class, [
                'label' => 'Rue'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Parking::class,]);
    }
}