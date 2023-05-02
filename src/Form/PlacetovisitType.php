<?php

namespace App\Form;

use App\Entity\Placetovisit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlacetovisitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('placeName')
            ->add('cityname')
            ->add('placeType')
            ->add('placeDescription')
            ->add('placeAddress')
            ->add('ticketsPrice')
            ->add('placeImg')
            ->add('placeImg2')
            ->add('placeImg3')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Placetovisit::class,
        ]);
    }
}
