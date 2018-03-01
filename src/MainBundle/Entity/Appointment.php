<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appointment
 *
 * @ORM\Table(name="appointment")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\AppointmentRepository")
 */
class Appointment
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Office")

     * @ORM\JoinColumn(nullable=false)

     */
    private $office;
    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Pet")

     * @ORM\JoinColumn(nullable=false)

     */
    private $pet;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Appointment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Appointment
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
     * @return mixed
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * @param mixed $office
     */
    public function setOffice($office)
    {
        $this->office = $office;
    }

    /**
     * @return mixed
     */
    public function getPet()
    {
        return $this->pet;
    }

    /**
     * @param mixed $pet
     */
    public function setPet($pet)
    {
        $this->pet = $pet;
    }

    /**
     * @return mixed
     */
    public function getValidated()
    {
        return $this->Validated;
    }

    /**
     * @param mixed $Validated
     */
    public function setValidated($Validated)
    {
        $this->Validated = $Validated;
    }


}

