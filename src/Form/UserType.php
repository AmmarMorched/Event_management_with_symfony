<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userFirstname')
            ->add('userLastname')
            ->add('userMail')
            ->add('userPhone')
            ->add('username')
            ->add('password')
            ->add('role')
            ->add('lang1')
            ->add('lang2')
            ->add('lang3')
            ->add('cityname')
            ->add('nationality')
            ->add('langue')
            ->add('datebeg')
            ->add('dateend')
            ->add('disponibility')
            ->add('idRelation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
