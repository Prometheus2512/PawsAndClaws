<?php
/**
 * Created by PhpStorm.
 * User: aymen
 * Date: 2/10/18
 * Time: 10:04 PM
 */

namespace MainBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;

/**
 * @ORM\Entity
 * @ORM\Table(name="Animal")
 */

class Animal
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="animals")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=100)
     */

    private $name;


    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';

    /** @ORM\Column(type="string", length=20) */
    private $gender;

    public function setGender($gender)
    {
        if (!in_array($gender, array(self::GENDER_MALE, self::GENDER_FEMALE))) {
            throw new \InvalidArgumentException("Invalid SEX");
        }
        $this->gender = $gender;
    }


    /** @ORM\Column(type="string", columnDefinition="ENUM('Cats', 'Dogs')") */

    private $species;

    /**
     * @ORM\Column(type="string", length=100)
     */

    private $breed;

    /**
     * @ORM\Column(type="integer")
     */

    private $age;

    /**
     * @ORM\Column(type="float")
     */
    private $size;

    /**
     * @ORM\Column(type="boolean")
     */
    private $spayed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $liveWcats;
    /**
     * @ORM\Column(type="boolean")
     */
    private $homeTest;

    /**
     * @ORM\Column(type="boolean")
     */
    private $childFriend;
    /*private $photo;*/

    const STATUS_ADOPTED = 'Adopted';
    const STATUS_PROCESSING = 'being processed';

    /** @ORM\Column(type="string") */
    private $status;


    public function setStatus($status)
    {
        if (!in_array($status, array(self::STATUS_ADOPTED, self::STATUS_PROCESSING))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        $this->status = $status;
    }




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
     * Set name.
     *
     * @param string $name
     *
     * @return Animal
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get gender.
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set species.
     *
     * @param string $species
     *
     * @return Animal
     */
    public function setSpecies($species)
    {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species.
     *
     * @return string
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Set breed.
     *
     * @param string $breed
     *
     * @return Animal
     */
    public function setBreed($breed)
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * Get breed.
     *
     * @return string
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Set age.
     *
     * @param int $age
     *
     * @return Animal
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age.
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set size.
     *
     * @param float $size
     *
     * @return Animal
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size.
     *
     * @return float
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set spayed.
     *
     * @param bool $spayed
     *
     * @return Animal
     */
    public function setSpayed($spayed)
    {
        $this->spayed = $spayed;

        return $this;
    }

    /**
     * Get spayed.
     *
     * @return bool
     */
    public function getSpayed()
    {
        return $this->spayed;
    }

    /**
     * Set liveWcats.
     *
     * @param bool $liveWcats
     *
     * @return Animal
     */
    public function setLiveWcats($liveWcats)
    {
        $this->liveWcats = $liveWcats;

        return $this;
    }

    /**
     * Get liveWcats.
     *
     * @return bool
     */
    public function getLiveWcats()
    {
        return $this->liveWcats;
    }

    /**
     * Set homeTest.
     *
     * @param bool $homeTest
     *
     * @return Animal
     */
    public function setHomeTest($homeTest)
    {
        $this->homeTest = $homeTest;

        return $this;
    }

    /**
     * Get homeTest.
     *
     * @return bool
     */
    public function getHomeTest()
    {
        return $this->homeTest;
    }

    /**
     * Set childFriend.
     *
     * @param bool $childFriend
     *
     * @return Animal
     */
    public function setChildFriend($childFriend)
    {
        $this->childFriend = $childFriend;

        return $this;
    }

    /**
     * Get childFriend.
     *
     * @return bool
     */
    public function getChildFriend()
    {
        return $this->childFriend;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user.
     *
     * @param \MainBundle\Entity\User|null $user
     *
     * @return Animal
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
