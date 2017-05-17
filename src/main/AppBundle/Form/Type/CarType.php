<?php

namespace main\AppBundle\Form\Type;

use main\AppBundle\Entity\Marque;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use main\AppBundle\Form\EventListener\CarFieldListener;
use main\AppBundle\Form\DataTransformer\stringToModelTransformer;
use Doctrine\Common\Persistence\ObjectManager;

class CarType extends AbstractType
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('marque', EntityType::class, array(       'attr'=>array('class'=>'marques'),
                                                                'class'         => 'mainAppBundle:Marque',                                                                'choice_label'    => 'name',
                                                                'choice_label' => 'name',
                                                                'multiple' => false,
                                                                'expanded' => false,
                                                            )
                )
                ->add('model', EntityType::class, array(
                                                            'attr'=>array('class'=>'models'),
                                                            'class'         => 'mainAppBundle:Model',
                                                            'choice_label' => 'name',
                                                            'multiple' => false,
                                                            'expanded' => false
                                                       )
                )
                ->add('boiteVitesse', ChoiceType::class, array(
                                                            'choices'  => array(
                                                                'Manuelle' => 'Manuelle',
                                                                'Auto' => 'Auto',
                                                            )
                                                        )
                )
                ->add('carburant', ChoiceType::class, array(
                                                            'choices'  => array(
                                                                'Essence' => 'Essence',
                                                                'Diesel' => 'Diesel',
                                                            )
                                                           )
                )
                ->add('dateMec')
                ->add('save',SubmitType::class);

                 $builder->get('marque')->addEventSubscriber(new CarFieldListener($this->manager));
                
               //$builder->get('model')->addModelTransformer(new stringToModelTransformer($this->manager));
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
