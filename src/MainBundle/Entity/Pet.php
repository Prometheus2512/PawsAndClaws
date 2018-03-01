<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pet
 *
 * @ORM\Table(name="pet")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\PetRepository")
 */
class Pet
{
    /**
     * @var int
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
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;
    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="breed", type="string", length=255)
     */
    private $breed;

    /**
     * @var bool
     *
     * @ORM\Column(name="childfriendly", type="boolean")
     */
    private $childfriendly;

    /**
     * @var bool
     *
     * @ORM\Column(name="in_or_out", type="boolean")
     */
    private $inOrOut;

    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User")

     * @ORM\JoinColumn(nullable=false)

     */
    private $owner;
    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User")

     * @ORM\JoinColumn(nullable=true)

     */
    private $newowner;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the image.")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $brochure;

    public function getBrochure()
    {
        return $this->brochure;
    }

    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Pet
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
     * Set gender
     *
     * @param string $gender
     *
     * @return Pet
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Pet
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Pet
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set breed
     *
     * @param string $breed
     *
     * @return Pet
     */
    public function setBreed($breed)
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * Get breed
     *
     * @return string
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Set childfriendly
     *
     * @param boolean $childfriendly
     *
     * @return Pet
     */
    public function setChildfriendly($childfriendly)
    {
        $this->childfriendly = $childfriendly;

        return $this;
    }

    /**
     * Get childfriendly
     *
     * @return bool
     */
    public function getChildfriendly()
    {
        return $this->childfriendly;
    }

    /**
     * Set inOrOut
     *
     * @param boolean $inOrOut
     *
     * @return Pet
     */
    public function setInOrOut($inOrOut)
    {
        $this->inOrOut = $inOrOut;

        return $this;
    }

    /**
     * Get inOrOut
     *
     * @return bool
     */
    public function getInOrOut()
    {
        return $this->inOrOut;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getNewowner()
    {
        return $this->newowner;
    }

    /**
     * @param mixed $newowner
     */
    public function setNewowner($newowner)
    {
        $this->newowner = $newowner;
    }


}

