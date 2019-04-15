<?php


namespace App\Form;


use App\Entity\Disponibility;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class DisponibilityType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('date_start', DateType::class, [
            'widget' => 'choice',
            'label' => 'Début'
        ])
            ->add('date_end', DateType::class, [
                'widget' => 'choice',
                'label' => 'Fin'
            ])
            ->add('price', IntegerType::class, ['label'=>'Prix'])
            ->add('termsAccepted', CheckboxType::class, array(
                'mapped' => false,
                'constraints' => new IsTrue(),
                'label' => ' '
            ))
        ;
    }
}