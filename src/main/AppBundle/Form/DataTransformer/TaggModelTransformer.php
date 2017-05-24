<?php
namespace main\AppBundle\Form\DataTransformer;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\DataTransformerInterface;
use main\AppBundle\Repository\TaggRepository;
use main\AppBundle\Entity\Tagg;

class TaggModelTransformer implements DataTransformerInterface
{

    private $tagg_repository;

    public function __construct(TaggRepository $taggRepository)
    {
        $this->tagg_repository = $taggRepository;
    }
    /**
     * Transforms an object arraycollection to array.
     *
     */
    public function transform($tags)
    {
       return  $tags->toArray();
    }

    /**
     * Transforms array to arraycollection
     *
     */
    public function reverseTransform($tags)
    {
        $tagcollection = new \Doctrine\Common\Collections\ArrayCollection();
        if (null === $tags) {
            return $tagcollection;
        }
        foreach ($tags as $tag){
            if($tag==null){
                $tag=new Tagg();
                $this->tagg_repository->persistAndFlush($tag);
            }
            $tagcollection->add($tag);
        }

    }
}