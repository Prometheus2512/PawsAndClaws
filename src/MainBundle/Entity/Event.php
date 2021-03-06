<?php

namespace MainBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\EventRepository")
 */
class Event
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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="BeginningDate", type="datetime")
     */
    private $beginningDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EndingDate", type="datetime")
     */
    private $endingDate;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var float
     *
     * @ORM\Column(name="posx", type="float",nullable=true)
     */
    private $posx;

    /**
     * @var float
     *
     * @ORM\Column(name="posy", type="float",nullable=true)
     */
    private $posy;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;
    /**
     * @var int
     *
     * @ORM\Column(name="views", type="integer",options={"default" : 0},nullable=true)
     */
    private $views;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float")
     */
    private $cost;

    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User")

     * @ORM\JoinColumn(nullable=false)

     */
    private $hostid;

    /**
     * @ORM\Column(type="integer",options={"default" : 0},nullable=true)
     */
    protected $Validated    ;


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
     * @return Event
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
     * Set description
     *
     * @param string $description
     *
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set beginningDate
     *
     * @param \DateTime $beginningDate
     *
     * @return Event
     */
    public function setBeginningDate($beginningDate)
    {
        $this->beginningDate = $beginningDate;

        return $this;
    }

    /**
     * Get beginningDate
     *
     * @return \DateTime
     */
    public function getBeginningDate()
    {
        return $this->beginningDate;
    }

    /**
     * Set endingDate
     *
     * @param \DateTime $endingDate
     *
     * @return Event
     */
    public function setEndingDate($endingDate)
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    /**
     * Get endingDate
     *
     * @return \DateTime
     */
    public function getEndingDate()
    {
        return $this->endingDate;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Event
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
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
     * Set posx
     *
     * @param float $posx
     *
     * @return Event
     */
    public function setPosx($posx)
    {
        $this->posx = $posx;

        return $this;
    }

    /**
     * Get posx
     *
     * @return float
     */
    public function getPosx()
    {
        return $this->posx;
    }

    /**
     * Set posy
     *
     * @param float $posy
     *
     * @return Event
     */
    public function setPosy($posy)
    {
        $this->posy = $posy;

        return $this;
    }

    /**
     * Get posy
     *
     * @return float
     */
    public function getPosy()
    {
        return $this->posy;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return Event
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set cost
     *
     * @param float $cost
     *
     * @return Event
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set hostid
     *
     * @param integer $hostid
     *
     * @return Event
     */
    public function setHostid($hostid)
    {
        $this->hostid = $hostid;

        return $this;
    }

    /**
     * Get hostid
     *
     * @return int
     */
    public function getHostid()
    {
        return $this->hostid;
    }
    // ...

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as an IMAGE .")
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
     * Set validated
     *
     * @param integer $validated
     *
     * @return Event
     */
    public function setValidated($validated)
    {
        $this->Validated = $validated;

        return $this;
    }

    /**
     * Get validated
     *
     * @return integer
     */
    public function getValidated()
    {
        return $this->Validated;
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param int $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

}
