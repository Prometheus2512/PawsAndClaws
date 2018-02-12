<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\OneToOne(targetEntity="MainBundle\Entity\User", cascade={"persist"})
     */
    private $participantid;

    /**
     * @ORM\OneToOne(targetEntity="MainBundle\Entity\Event", cascade={"persist"})
     */
    private $eventid;


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
     * Set participantid
     *
     * @param integer $participantid
     *
     * @return Reservation
     */
    public function setParticipantid($participantid)
    {
        $this->participantid = $participantid;

        return $this;
    }

    /**
     * Get participantid
     *
     * @return int
     */
    public function getParticipantid()
    {
        return $this->participantid;
    }

    /**
     * Set eventid
     *
     * @param integer $eventid
     *
     * @return Reservation
     */
    public function setEventid($eventid)
    {
        $this->eventid = $eventid;

        return $this;
    }

    /**
     * Get eventid
     *
     * @return int
     */
    public function getEventid()
    {
        return $this->eventid;
    }
}
