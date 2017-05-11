<?php

namespace main\AppBundle\Form;

use main\AppBundle\Entity\Marque;
use main\AppBundle\mainAppBundle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('marque', EntityType::class, array(
                                                                'class'         => 'mainAppBundle:Marque',                                                                'choice_label'    => 'name',
                                                                'choice_label' => 'name',
                                                                'multiple' => false,
                                                                'expanded' => false,
                                                            )
                )
                ->add('boiteVitesse')
                ->add('carburant', ChoiceType::class, array(
                                                            'choices'  => array(
                                                                'Essence' => 'Essence',
                                                                'Diesel' => 'Diesel',
                                                            )
                                                           )
                )
                ->add('dateMec')
                ->add('save',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'main\AppBundle\Entity\Car'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'main_appbundle_car';
    }


}
