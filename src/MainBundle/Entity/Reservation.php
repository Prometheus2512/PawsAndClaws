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

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User", cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */

    private $participantid;


    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Event", cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */

    private $eventid;


    /**
     * @var float
     *
     * @ORM\Column(name="rating", type="float",nullable=true)
     */
    private $rating;

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

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

}

