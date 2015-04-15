<?php

namespace Mike\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Types
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mike\CharacterBundle\Entity\TypesRepository")
 */
class Types
{
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Characters", mappedBy="type")
     */
    private $characters;
    
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Attributes", mappedBy="type")
     */
    private $attributes;
    
    /**
     * @var integer
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
     * @var string
     *
     * @ORM\Column(name="specialAbility", type="string", length=255)
     */
    private $specialAbility;

    public function __construct(){
        $this->characters = new ArrayCollection();
        $this->attributes = new ArrayCollection();
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
     * @return Types
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
     * Set specialAbility
     *
     * @param string $specialAbility
     * @return Types
     */
    public function setSpecialAbility($specialAbility)
    {
        $this->specialAbility = $specialAbility;

        return $this;
    }

    /**
     * Get specialAbility
     *
     * @return string 
     */
    public function getSpecialAbility()
    {
        return $this->specialAbility;
    }

    /**
     * Add characters
     *
     * @param \Mike\CharacterBundle\Entity\Characters $characters
     * @return Types
     */
    public function addCharacter(\Mike\CharacterBundle\Entity\Characters $characters)
    {
        $this->characters[] = $characters;

        return $this;
    }

    /**
     * Remove characters
     *
     * @param \Mike\CharacterBundle\Entity\Characters $characters
     */
    public function removeCharacter(\Mike\CharacterBundle\Entity\Characters $characters)
    {
        $this->characters->removeElement($characters);
    }

    /**
     * Get characters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCharacters()
    {
        return $this->characters;
    }

    /**
     * Add attributes
     *
     * @param \Mike\CharacterBundle\Entity\Attributes $attributes
     * @return Types
     */
    public function addAttribute(\Mike\CharacterBundle\Entity\Attributes $attributes)
    {
        $this->attributes[] = $attributes;

        return $this;
    }

    /**
     * Remove attributes
     *
     * @param \Mike\CharacterBundle\Entity\Attributes $attributes
     */
    public function removeAttribute(\Mike\CharacterBundle\Entity\Attributes $attributes)
    {
        $this->attributes->removeElement($attributes);
    }

    /**
     * Get attributes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    /**
	 * Return type as a string
	 *
	 * @return string
	 */
    public function __toString(){
	    return $this->getName();
    }
}
