<?php

namespace NRTest\PetClinicBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * NRTest\PetClinicBundle\Entity\Owner
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NRTest\PetClinicBundle\Entity\OwnerRepository")
 */
class Owner
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
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string $telephone
     *
     * @ORM\Column(name="telephone", type="string", length=50)
     */
    private $telephone;
    
    /**
     * 
     * @var ArrayCollection $pets
     * 
     * @ORM\OneToMany(targetEntity="Pet", mappedBy="owner")
     * @ORM\OrderBy({"name" = "DESC"})
     */
    private $pets;

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
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
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
    	$this->updatedAt = new \DateTime();
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
    
    public function __toString()
    {
    	return $this->lastName;
    }
}