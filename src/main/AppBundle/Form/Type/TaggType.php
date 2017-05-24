<?php
namespace main\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use main\AppBundle\Form\DataTransformer\TaggModelTransformer;
use main\AppBundle\Form\DataTransformer\TaggViewTransformer;

class TaggType extends AbstractType
{
    private $taggModelTransformer;
    private $taggViewTransformer;
   
    public function __construct(TaggModelTransformer $taggModelTransformer,TaggViewTransformer $taggViewTransformer)
    {
        $this->taggModelTransformer = $taggModelTransformer;
        $this->taggViewTransformer = $taggViewTransformer;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')->addViewTransformer($this->taggViewTransformer)
                              ->addModelTransformer($this->taggModelTransformer);
                              
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'main\AppBundle\Entity\Tagg'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'main_appbundle_tagg';
    }


}
