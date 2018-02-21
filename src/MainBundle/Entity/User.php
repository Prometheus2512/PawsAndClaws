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
     * @ORM\Column(type="string", length=100)
     */

    protected $firstname;
    /**
     * @ORM\Column(type="string", length=100)
     */

    protected $lastname;
    /**
     * @ORM\Column(type="string", length=100)
     */

    protected $phonenumber;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $address;

    /**
     * @ORM\Column(type="integer",options={"default" : 0},nullable=true)
     */
    protected $Banned;



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
    private $isVet;

    /**
     * @ORM\Column(type="smallint", length=4, nullable=true)
     */
    private $isOrganization;

    /**
     * @ORM\Column(type="smallint", length=4, nullable=true)
     */
    private $isPetsitter;

    /**
     * @ORM\OneToMany(targetEntity="Animal", mappedBy="user")
     */
    private $animal;

    /**
     * @ORM\OneToMany(targetEntity="Adoption", mappedBy="user")
     */
    private $adoption;




    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set phonenumber.
     *
     * @param string $phonenumber
     *
     * @return User
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get phonenumber.
     *
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Set address.
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set banned.
     *
     * @param int|null $banned
     *
     * @return User
     */
    public function setBanned($banned = null)
    {
        $this->Banned = $banned;

        return $this;
    }

    /**
     * Get banned.
     *
     * @return int|null
     */
    public function getBanned()
    {
        return $this->Banned;
    }

    /**
     * Set isOrganization.
     *
     * @param int|null $isOrganization
     *
     * @return User
     */
    public function setIsOrganization($isOrganization = null)
    {
        $this->isOrganization = $isOrganization;

        return $this;
    }

    /**
     * Get isOrganization.
     *
     * @return int|null
     */
    public function getIsOrganization()
    {
        return $this->isOrganization;
    }

    /**
     * Set isPetsitter.
     *
     * @param int|null $isPetsitter
     *
     * @return User
     */
    public function setIsPetsitter($isPetsitter = null)
    {
        $this->isPetsitter = $isPetsitter;

        return $this;
    }

    /**
     * Get isPetsitter.
     *
     * @return int|null
     */
    public function getIsPetsitter()
    {
        return $this->isPetsitter;
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
        $this->animal[] = $animal;

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
        return $this->animal->removeElement($animal);
    }

    /**
     * Get animal.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Add adoption.
     *
     * @param \MainBundle\Entity\Adoption $adoption
     *
     * @return User
     */
    public function addAdoption(\MainBundle\Entity\Adoption $adoption)
    {
        $this->adoption[] = $adoption;

        return $this;
    }

    /**
     * Remove adoption.
     *
     * @param \MainBundle\Entity\Adoption $adoption
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAdoption(\MainBundle\Entity\Adoption $adoption)
    {
        return $this->adoption->removeElement($adoption);
    }

    /**
     * Get adoption.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdoption()
    {
        return $this->adoption;
    }
}
