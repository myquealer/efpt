<?php

namespace Mike\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Characters
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mike\CharacterBundle\Entity\CharactersRepository")
 */
class Characters
{
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CharacterAttributes", mappedBy="character")
     */
    private $characterAttributes;

    /**
	 * @var Type
	 *
	 * @ORM\ManyToOne(targetEntity="Types", inversedBy="Characters");
	 * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
	 */
    private $type;

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

    public function __construct(){
        $this->characterAttributes = new ArrayCollection();
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
     * @return Characters
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
     * Set type
     *
     * @param \Mike\CharacterBundle\Entity\Types $type
     * @return Characters
     */
    public function setType(\Mike\CharacterBundle\Entity\Types $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Mike\CharacterBundle\Entity\Types 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add characterAttributes
     *
     * @param \Mike\CharacterBundle\Entity\CharacterAttributes $characterAttributes
     * @return Characters
     */
    public function addCharacterAttribute(\Mike\CharacterBundle\Entity\CharacterAttributes $characterAttributes)
    {
        $this->characterAttributes[] = $characterAttributes;

        return $this;
    }

    /**
     * Remove characterAttributes
     *
     * @param \Mike\CharacterBundle\Entity\CharacterAttributes $characterAttributes
     */
    public function removeCharacterAttribute(\Mike\CharacterBundle\Entity\CharacterAttributes $characterAttributes)
    {
        $this->characterAttributes->removeElement($characterAttributes);
    }

    /**
     * Get characterAttributes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCharacterAttributes()
    {
        return $this->characterAttributes;
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
