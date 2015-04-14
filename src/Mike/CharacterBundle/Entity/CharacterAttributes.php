<?php

namespace Mike\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CharacterAttributes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mike\CharacterBundle\Entity\CharacterAttributesRepository")
 */
class CharacterAttributes
{
    /**
	 * @var Character
	 *
	 * @ORM\ManyToOne(targetEntity="Characters", inversedBy="CharacterAttributes");
	 * @ORM\JoinColumn(name="character_id", referencedColumnName="id")
	 */
    private $character;

    /**
	 * @var Attribute
	 *
	 * @ORM\ManyToOne(targetEntity="Attributes", inversedBy="CharacterAttributes");
	 * @ORM\JoinColumn(name="attribute_id", referencedColumnName="id")
	 */
    private $attribute;

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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;


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
     * Set value
     *
     * @param string $value
     * @return CharacterAttributes
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set attribute
     *
     * @param \Mike\CharacterBundle\Entity\Attributes $attribute
     * @return CharacterAttributes
     */
    public function setAttribute(\Mike\CharacterBundle\Entity\Attributes $attribute = null)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return \Mike\CharacterBundle\Entity\Attributes 
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set character
     *
     * @param \Mike\CharacterBundle\Entity\Characters $character
     * @return CharacterAttributes
     */
    public function setCharacter(\Mike\CharacterBundle\Entity\Characters $character = null)
    {
        $this->character = $character;

        return $this;
    }

    /**
     * Get character
     *
     * @return \Mike\CharacterBundle\Entity\Characters 
     */
    public function getCharacter()
    {
        return $this->character;
    }
}
