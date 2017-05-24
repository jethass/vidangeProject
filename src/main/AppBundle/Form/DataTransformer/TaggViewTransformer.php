<?php
namespace main\AppBundle\Form\DataTransformer;
use Symfony\Component\Form\DataTransformerInterface;

class TaggViewTransformer implements DataTransformerInterface
{
    /**
     * Transforms an array to string.
     *
     */
    public function transform($tags)
    {
         $string=implode(' ',$tags);
         return  $string;
    }

    /**
     * Transforms string to array
     *
     */
    public function reverseTransform($string)
    {
        $tags=explode(' ', $string);
        return $tags;

    }
}