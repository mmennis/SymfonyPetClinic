<?php

namespace NRTest\PetClinicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NRTest\PetClinicBundle\Entity\Visit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NRTest\PetClinicBundle\Entity\VisitRepository")
 */
class Visit
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
     * @var datetime $visitDate
     *
     * @ORM\Column(name="visitDate", type="datetime")
     */
    private $visitDate;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * 
     * @var Pet $pet
     * 
     * @ORM\ManyToOne(targetEntity="Pet")
     * @ORM\JoinColumn(name="pet_id", referencedColumnName="id")
     */
    private $pet;

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
     * Set visitDate
     *
     * @param datetime $visitDate
     */
    public function setVisitDate($visitDate)
    {
        $this->visitDate = $visitDate;
    }

    /**
     * Get visitDate
     *
     * @return datetime 
     */
    public function getVisitDate()
    {
        return $this->visitDate;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
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
    	setCreatedAt(new \DateTime());
    }
    
    /**
     * Invoked before the entity is updated.
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
    	setUpdatedAt(new \DateTime());
    }

    /**
     * Set pet
     *
     * @param NRTest\PetClinicBundle\Entity\Pet $pet
     */
    public function setPet(\NRTest\PetClinicBundle\Entity\Pet $pet)
    {
        $this->pet = $pet;
    }

    /**
     * Get pet
     *
     * @return NRTest\PetClinicBundle\Entity\Pet 
     */
    public function getPet()
    {
        return $this->pet;
    }
}