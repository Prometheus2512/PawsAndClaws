<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /*changement à partir d'ici'*/

    /**
     * @ORM\OneToMany(targetEntity="Animal",mappedBy="user")
     */
    private $animals;
    public function __construct()
    {
        $this->animals = new \Doctrine\Common\Collections\ArrayCollection();
    }





    /**
     * Add animal.
     *
     * @param \MainBundle\Entity\Animal $animal
     *
     * @return User
     */
    public function addAnimal(\MainBundle\Entity\Animal $animal)
    {
        $this->animals[] = $animal;

        return $this;
    }

    /**
     * Remove animal.
     *
     * @param \MainBundle\Entity\Animal $animal
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAnimal(\MainBundle\Entity\Animal $animal)
    {
        return $this->animals->removeElement($animal);
    }

    /**
     * Get animals.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnimals()
    {
        return $this->animals;
    }
}
