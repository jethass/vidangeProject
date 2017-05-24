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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use main\AppBundle\Form\Type\TagType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use main\AppBundle\Form\EventListener\CarFieldListener;
use main\AppBundle\Form\DataTransformer\stringToModelTransformer;
use main\AppBundle\Form\DataTransformer\arrayToFileTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use main\AppBundle\Form\Type\FilesType;
use main\AppBundle\Form\Type\ImageType;

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
                ->add('dateMec', DateType::class, array(
                    'widget' => 'single_text',
                    'html5' => false,
                    'label'=>'date mise en circulation',
                    'attr' => ['class' => 'js-datepicker'],
                    'format' => 'dd/MM/yyyy',
                ))
                /*->add('tags', CollectionType::class, array(
                    'entry_type'   => TagType::class,
                    'allow_add' => true,
                    'prototype' => true,
                    //'attr' => array('class'=>'select2')
                ))*/
                ->add('tags',EntityType::class, array(
                    'attr'=>array('class'=>"tags",),
                    'label'=>'finition',
                    'choices_as_values' => true,                
                    'class' => 'mainAppBundle:Tag',
                    'choice_label' => 'name',
                    'expanded' => false,
                    'multiple'=>true
                ))


                ->add('imagePrincipale', ImageType::class,array('required'=>false, 'label'=>'Image Principale :'))

                ->add('files', FilesType::class, array(
                    'label'    =>    'Photos',
                    'required' =>    true,
                    'compound'=>true,
                    'attr'     =>    array(
                        'accept'  =>  'images/*',
                    )
                ))
                ->add('save',SubmitType::class);

                 $builder->get('marque')->addEventSubscriber(new CarFieldListener($this->manager));
                 $builder->get('files')->addModelTransformer(new arrayToFileTransformer($this->manager));
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
