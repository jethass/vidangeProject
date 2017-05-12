<?php

namespace main\AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="main\AppBundle\Repository\CarRepository")
 */
class Car
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
     * @ORM\ManyToOne(targetEntity="main\AppBundle\Entity\Marque", inversedBy="cars",cascade={"persist"})
     * @ORM\JoinColumn(name="marque_id", referencedColumnName="id")
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity="main\AppBundle\Entity\Model", cascade={"persist"})
     * @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     */
    private $model;
    

    /**
     * @var string
     *
     * @ORM\Column(name="boite_vitesse", type="string", length=255)
     */
    private $boiteVitesse;

    /**
     * @var string
     *
     * @ORM\Column(name="carburant", type="string", length=255)
     */
    private $carburant;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_mec", type="date")
     */
    private $dateMec;



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
     * Set boiteVitesse
     *
     * @param string $boiteVitesse
     *
     * @return Car
     */
    public function setBoiteVitesse($boiteVitesse)
    {
        $this->boiteVitesse = $boiteVitesse;

        return $this;
    }

    /**
     * Get boiteVitesse
     *
     * @return string
     */
    public function getBoiteVitesse()
    {
        return $this->boiteVitesse;
    }

    /**
     * Set carburant
     *
     * @param string $carburant
     *
     * @return Car
     */
    public function setCarburant($carburant)
    {
        $this->carburant = $carburant;

        return $this;
    }

    /**
     * Get carburant
     *
     * @return string
     */
    public function getCarburant()
    {
        return $this->carburant;
    }

    /**
     * Set dateMec
     *
     * @param \DateTime $dateMec
     *
     * @return Car
     */
    public function setDateMec($dateMec)
    {
        $this->dateMec = $dateMec;

        return $this;
    }

    /**
     * Get dateMec
     *
     * @return \DateTime
     */
    public function getDateMec()
    {
        return $this->dateMec;
    }

    /**
     * Set marque
     *
     * @param \main\AppBundle\Entity\Marque $marque
     *
     * @return Car
     */
    public function setMarque(\main\AppBundle\Entity\Marque $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \main\AppBundle\Entity\Marque
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set model
     *
     * @param \main\AppBundle\Entity\Model $model
     *
     * @return Car
     */
    public function setModel(\main\AppBundle\Entity\Model $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \main\AppBundle\Entity\Model
     */
    public function getModel()
    {
        return $this->model;
    }
}
