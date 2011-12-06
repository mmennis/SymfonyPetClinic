<?php

namespace NRTest\PetClinicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * NRTest\PetClinicBundle\Entity\Pet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NRTest\PetClinicBundle\Entity\PetRepository")
 */
class Pet
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
     * @var datetime $birthDate
     *
     * @ORM\Column(name="birthDate", type="datetime")
     */
    private $birthDate;
    
    /**
     * The pet-type for this pet.
     * @var PetType $petType
     * 
     * @ORM\ManyToOne(targetEntity="PetType")
     * @ORM\JoinColumn(name="pet_type_id", referencedColumnName="id")
     */
    private $petType;
    
    /**
     * 
     * The owner of this pet
     * @var Owner $owner
     * 
     * @ORM\ManyToOne(targetEntity="Owner")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;
    
    /**
     * 
     * @var ArrayCollection visits
     * 
     * @ORM\OneToMany(targetEntity="Visit", mappedBy="pet")
     * @ORM\OrderBy({"visitDate" = "DESC"})
     */
    private $visits;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


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
     * Set birthDate
     *
     * @param datetime $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * Get birthDate
     *
     * @return datetime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
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
     * Set petType
     *
     * @param NRTest\PetClinicBundle\Entity\PetType $petType
     */
    public function setPetType(\NRTest\PetClinicBundle\Entity\PetType $petType)
    {
        $this->petType = $petType;
    }

    /**
     * Get petType
     *
     * @return NRTest\PetClinicBundle\Entity\PetType 
     */
    public function getPetType()
    {
        return $this->petType;
    }

    /**
     * Set owner
     *
     * @param NRTest\PetClinicBundle\Entity\Owner $owner
     */
    public function setOwner(\NRTest\PetClinicBundle\Entity\Owner $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get owner
     *
     * @return NRTest\PetClinicBundle\Entity\Owner 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add visits
     *
     * @param NRTest\PetClinicBundle\Entity\Visit $visits
     */
    public function addVisit(\NRTest\PetClinicBundle\Entity\Visit $visits)
    {
        $this->visits[] = $visits;
    }

    /**
     * Get visits
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVisits()
    {
        return $this->visits;
    }
}