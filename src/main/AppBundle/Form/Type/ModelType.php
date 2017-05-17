<?php

namespace main\AppBundle\Form\Type;

use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ModelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('marque', EntityType::class, array(
                        'class'         => 'mainAppBundle:Marque',                                                                'choice_label'    => 'name',
                        'choice_label' => 'name',
                        'multiple' => false,
                        'expanded' => false,
                    )
                )
                ->add('name',TextType::class,array('label'=>'Model'))
                ->add('save',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'main\AppBundle\Entity\Model'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'main_appbundle_model';
    }


}
