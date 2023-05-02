<?php

namespace App\Form;

use App\Entity\PlaceReviews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceReviewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reviewId')
            ->add('placeName')
            ->add('rating')
            ->add('reviewTxt')
            ->add('reviewDate')
            ->add('idUser')
            ->add('place')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlaceReviews::class,
        ]);
    }
}
