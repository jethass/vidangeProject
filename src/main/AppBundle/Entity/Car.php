<?php

namespace main\AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use main\AppBundle\Entity\Image;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="main\AppBundle\Repository\CarRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\ManyToMany(targetEntity="main\AppBundle\Entity\Tag", cascade={"persist"})
     */
    private $tags;

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
     * @ORM\OneToMany(targetEntity="main\AppBundle\Entity\Image", mappedBy="car", cascade={"persist","remove"})
     */
    private $images;

    /**
     * @ORM\OneToOne(targetEntity="main\AppBundle\Entity\Image", cascade={"persist","remove"})
     */
    private $imagePrincipale;

    // files des images
    private $files;
  

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->files = array();
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

    /**
     * Add tag
     *
     * @param \main\AppBundle\Entity\Tag $tag
     *
     * @return Car
     */
    public function addTag(\main\AppBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \main\AppBundle\Entity\Tag $tag
     */
    public function removeTag(\main\AppBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add image
     *
     * @param \main\AppBundle\Entity\Image $image
     *
     * @return Car
     */
    public function addImage(\main\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \main\AppBundle\Entity\Image $image
     */
    public function removeImage(\main\AppBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set imagePrincipale
     *
     * @param \main\AppBundle\Entity\Image $imagePrincipale
     *
     * @return Car
     */
    public function setImagePrincipale(\main\AppBundle\Entity\Image $imagePrincipale = null)
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }

    /**
     * Get imagePrincipale
     *
     * @return \main\AppBundle\Entity\Image
     */
    public function getImagePrincipale()
    {
        return $this->imagePrincipale;
    }

    /********personalisé pour l'uplaod***************************/
    public function setFiles(array $files)
    {
        $this->files=$files;
        if($files != null){
            foreach ($this->files as $file){
                $image=new Image();
                $image->setFile($file);
                $this->addImage($image);
            }
        }
        return $this;
    }


    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        foreach ($this->images as $image){
            $image->preUpload();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        foreach ($this->images as $image){
            $image->upload();
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        foreach ($this->images as $image){
            $image->preRemoveUpload();
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        foreach ($this->images as $image){
            $image->removeUpload();
        }
    }

    /*************************************/
}
