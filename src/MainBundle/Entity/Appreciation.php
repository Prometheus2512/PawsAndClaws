<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appreciation
 *
 * @ORM\Table(name="appreciation")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\AppreciationRepository")
 */
class Appreciation
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
     * @var int
     *
     * @ORM\Column(name="type", type="integer",nullable=true)
     */
    private $type;

    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User", cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */

    protected $appreciator;


    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Article", cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */

    protected $eventappreciated;

    /**
     * @return mixed
     */
    public function getAppreciator()
    {
        return $this->appreciator;
    }

    /**
     * @param mixed $appreciator
     */
    public function setAppreciator($appreciator)
    {
        $this->appreciator = $appreciator;
    }

    /**
     * @return mixed
     */
    public function getEventappreciated()
    {
        return $this->eventappreciated;
    }

    /**
     * @param mixed $eventappreciated
     */
    public function setEventappreciated($eventappreciated)
    {
        $this->eventappreciated = $eventappreciated;
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
     * Set type
     *
     * @param integer $type
     *
     * @return Appreciation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
}

