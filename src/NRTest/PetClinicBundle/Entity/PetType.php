<?php

namespace NRTest\PetClinicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NRTest\PetClinicBundle\Entity\PetType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NRTest\PetClinicBundle\Entity\PetTypeRepository")
 */
class PetType
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
     * .
     * @var ArrayCollection pets
     * 
     * @ORM\OneToMany(targetEntity="Pet", mappedBy="petType")
     * @ORM\OrderBy({"name" = "DESC"})
     */
    protected $pets;

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
    	$this->pets = new ArrayCollection();
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
     * Add pets
     *
     * @param NRTest\PetClinicBundle\Entity\Pet $pets
     */
    public function addPet(\NRTest\PetClinicBundle\Entity\Pet $pets)
    {
        $this->pets[] = $pets;
    }

    /**
     * Get pets
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPets()
    {
        return $this->pets;
    }
}