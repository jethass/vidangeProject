<?php

namespace main\AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Marque
 *
 * @ORM\Table(name="marque")
 * @ORM\Entity(repositoryClass="main\AppBundle\Repository\MarqueRepository")
 */
class Marque
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="main\AppBundle\Entity\Model", mappedBy="marque")
     */
    private $models;

    /**
     * @ORM\OneToMany(targetEntity="main\AppBundle\Entity\Car", mappedBy="marque")
     */
    private $cars;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->models = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cars = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Marque
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add model
     *
     * @param \main\AppBundle\Entity\Model $model
     *
     * @return Marque
     */
    public function addModel(\main\AppBundle\Entity\Model $model)
    {
        $this->models[] = $model;

        return $this;
    }

    /**
     * Remove model
     *
     * @param \main\AppBundle\Entity\Model $model
     */
    public function removeModel(\main\AppBundle\Entity\Model $model)
    {
        $this->models->removeElement($model);
    }

    /**
     * Get models
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * Add car
     *
     * @param \main\AppBundle\Entity\Car $car
     *
     * @return Marque
     */
    public function addCar(\main\AppBundle\Entity\Car $car)
    {
        $this->cars[] = $car;

        return $this;
    }

    /**
     * Remove car
     *
     * @param \main\AppBundle\Entity\Car $car
     */
    public function removeCar(\main\AppBundle\Entity\Car $car)
    {
        $this->cars->removeElement($car);
    }

    /**
     * Get cars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCars()
    {
        return $this->cars;
    }
}
