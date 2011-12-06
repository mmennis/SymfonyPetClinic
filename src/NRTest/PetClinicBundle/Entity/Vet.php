<?php

namespace NRTest\PetClinicBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * NRTest\PetClinicBundle\Entity\Vet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NRTest\PetClinicBundle\Entity\VetRepository")
 */
class Vet
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
     * @var string $firstName
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

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
     * @var ArrayCollection specialties
     * 
     * @ORM\ManyToMany(targetEntity="Specialty", inversedBy="vets")
     * @ORM\JoinTable(name="vets_specialties")
     */
    private $specialties;


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
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
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
    	$this->specialties = new ArrayCollection();
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
     * Add specialties
     *
     * @param NRTest\PetClinicBundle\Entity\Specialty $specialties
     */
    public function addSpecialty(\NRTest\PetClinicBundle\Entity\Specialty $specialties)
    {
    	$specialties->AddVet($this);
        $this->specialties[] = $specialties;
    }

    /**
     * Get specialties
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSpecialties()
    {
        return $this->specialties;
    }
}