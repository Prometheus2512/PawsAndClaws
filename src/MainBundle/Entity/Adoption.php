<?php
/**
 * Created by PhpStorm.
 * User: aymen
 * Date: 2/21/18
 * Time: 3:54 AM
 */

namespace MainBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Adoption
 *
 * @ORM\Table(name="Adoption")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\AdoptionRepository")
 */
class Adoption
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $adoptionDate;

    /**
     * @ORM\ManyToOne(targetEntity="Animal", inversedBy="adoption")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id", nullable=false)
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="adoption")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adoptionDate.
     *
     * @param \DateTime|null $adoptionDate
     *
     * @return Adoption
     */
    public function setAdoptionDate($adoptionDate = null)
    {
        $this->adoptionDate = $adoptionDate;

        return $this;
    }

    /**
     * Get adoptionDate.
     *
     * @return \DateTime|null
     */
    public function getAdoptionDate()
    {
        return $this->adoptionDate;
    }

    /**
     * Set animal.
     *
     * @param \MainBundle\Entity\Animal $animal
     *
     * @return Adoption
     */
    public function setAnimal(\MainBundle\Entity\Animal $animal)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal.
     *
     * @return \MainBundle\Entity\Animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Set user.
     *
     * @param \MainBundle\Entity\User|null $user
     *
     * @return Adoption
     */
    public function setUser(\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \MainBundle\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
