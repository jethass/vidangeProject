<?php
namespace main\AppBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use main\AppBundle\Entity\Model;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CarFieldListener implements EventSubscriberInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::POST_SUBMIT   => 'onPostSubmit',
        );
    }

    public function onPreSetData(FormEvent $event)
    {
        $form=$event->getForm()->getParent();
        $models=$this->manager->getRepository('mainAppBundle:Model')->findBy(array('marque' => 1));
        $form ->add('model', EntityType::class, array(
                'attr'=>array('class'=>'models'),
                'class'         => 'mainAppBundle:Model',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'choices'  => $models,
            )
        );

    }

    public function onPostSubmit(FormEvent $event)
    {
         $form=$event->getForm()->getParent();
        $marque=$event->getForm()->getData();
        $models=$this->manager->getRepository('mainAppBundle:Model')->findBy(array('marque' => $marque->getId()));
        $form ->add('model', EntityType::class, array(
                'attr'=>array('class'=>'models'),
                'class'         => 'mainAppBundle:Model',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'choices'  => $models,
            )
        );
    }
}