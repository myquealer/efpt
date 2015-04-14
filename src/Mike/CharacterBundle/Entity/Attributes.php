<?php

namespace Mike\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Attributes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mike\CharacterBundle\Entity\AttributesRepository")
 */
class Attributes
{
    /**
	 * @var Type
	 *
	 * @ORM\ManyToOne(targetEntity="Types", inversedBy="Attributes");
	 * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
	 */
    private $type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CharacterAttributes", mappedBy="attribute")
     */
    private $characterAttributes;

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
     * @ORM\Column(name="unit", type="string", length=255, nullable=true)
     */
    private $unit;

    /**
     * @var integer
     *
     * @ORM\Column(name="min", type="smallint", nullable=true)
     */
    private $min;

    /**
     * @var integer
     *
     * @ORM\Column(name="max", type="smallint", nullable=true)
     */
    private $max;

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
     * @return Attributes
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
     * Set unit
     *
     * @param string $unit
     * @return Attributes
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set min
     *
     * @param integer $min
     * @return Attributes
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get min
     *
     * @return integer 
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set max
     *
     * @param integer $max
     * @return Attributes
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get max
     *
     * @return integer 
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Add characterAttributes
     *
     * @param \Mike\CharacterBundle\Entity\CharacterAttributes $characterAttributes
     * @return Attributes
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
     * Set type
     *
     * @param \Mike\CharacterBundle\Entity\Types $type
     * @return Attributes
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
	 * Return type as a string
	 *
	 * @return string
	 */
    public function __toString(){
	    return $this->getName();
    }

}
