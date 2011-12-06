<?php

namespace NRTest\PetClinicBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * NRTest\PetClinicBundle\Entity\Specialty
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NRTest\PetClinicBundle\Entity\SpecialtyRepository")
 */
class Specialty
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;
    
    /**
     * 
     * @var ArrayCollection vets
     * @ORM\ManyToMany(targetEntity="Vet", mappedBy="specialties")
     */
    private $vets;


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
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
    * Constructs a new instance of owner
    */
    public function __construct()
    {
    	$this->vets = new ArrayCollection();
    	$this->createdAt = new \DateTime();
    }
    
    /**
     * Invoked before the entity is updated.
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
    	$this->updatedAt = new \DateTime();
    }
    

    /**
     * Add vets
     *
     * @param NRTest\PetClinicBundle\Entity\Vet $vets
     */
    public function addVet(\NRTest\PetClinicBundle\Entity\Vet $vets)
    {
        $this->vets[] = $vets;
    }

    /**
     * Get vets
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVets()
    {
        return $this->vets;
    }
}