<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateStart', DateType::class, [
            'widget' => 'choice',
            'label' => 'Date début de reservation',
            'constraints' => new GreaterThanOrEqual('today')]
        )->add('dateEnd', DateType::class, [
            'widget' => 'choice',
            'label' => 'Date de fin de reservation ',]);
    }
}
