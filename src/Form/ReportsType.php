<?php

namespace App\Form;

use App\Entity\Reports;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;




class ReportsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       
        $builder
            //->add('reportId')
            ->add('reportSubject')
            ->add('reportDescription')
            ->add('involvment')
            ->add('incidentType',ChoiceType::class, [ 'choices' => [
                'Select a Type'=>'-------',
                'Guide' => 'guide',
                'Platform' => 'platform',
                'Field' => 'field',
            ],
            ])
            ->add('incidentDate',DateType::class,[
                'widget'=>'single_text',
            ])
            ->add('incidentLocation')
            ->add('idUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reports::class,
        ]);
    }
}
