<?php

namespace App\Form;

use App\Entity\ViewsPark;
use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ViewsParkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('notePark', RatingType::class, [
                'label' => 'Note Globale',
            ])
            ->add('comment', null, [
                'label' => 'Commentaire',
            ])
            ->add('noteAccess', RatingType::class, [
                'label' => 'Note Accès Parking',
            ])
            ->add('noteCleaning', RatingType::class, [
                'label' => 'Note Propreté',
            ])
            ->add('notePrice', RatingType::class, [
                'label' => 'Note Rapport Prestation/Prix',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregisrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ViewsPark::class,
        ]);
    }
}
