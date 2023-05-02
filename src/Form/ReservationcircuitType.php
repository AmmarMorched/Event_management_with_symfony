<?php

namespace App\Form;

use App\Entity\Reservationcircuit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationcircuitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idClient')
            ->add('nc')
            ->add('dateDebutCircuit')
            ->add('nbrPlaces')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservationcircuit::class,
        ]);
    }
}
