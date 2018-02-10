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


    const SEX_MALE = 'Male';
    const SEX_FEMALE = 'Female';

    /** @ORM\Column(type="string") */
    private $sex;

    public function setSex($sex)
    {
        if (!in_array($sex, array(self::SEX_MALE, self::SEX_FEMALE))) {
            throw new \InvalidArgumentException("Invalid SEX");
        }
        $this->sex = $sex;
    }


    /** @ORM\Column(type="string", columnDefinition="ENUM('Cats', 'Dogs')") */

    private $species;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="float")
     */
    private $size;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

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
     * Get sex.
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
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
     * Set weight.
     *
     * @param float $weight
     *
     * @return Animal
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight.
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
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
