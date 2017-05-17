<?php
/**
 * Created by IntelliJ IDEA.
 * User: HLATAOUI
 * Date: 17/05/2017
 * Time: 14:49
 */

namespace main\AppBundle\Form\DataTransformer;
use main\AppBundle\Entity\Model;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class stringToModelTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (Model) to a string (name model).
     *
     */
    public function transform($model)
    {
        if (null === $model) {
            return '';
        }
        return $model->getName();
    }

    /**
     * Transforms a model_id to an object (Model).
     *
    */
    public function reverseTransform($model_id)
    {
        if (!$model_id) {
            return;
        }
        $model = $this->manager
            ->getRepository('mainAppBundle:Model')
            ->find($model_id)
        ;
        if (null === $model) {
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $model_id
            ));
        }
        return $model;
    }
}