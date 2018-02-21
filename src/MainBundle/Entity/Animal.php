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
 * Animal
 *
 * @ORM\Table(name="Animal")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\AnimalRepository")
 */

class Animal
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint", length=4, nullable=false)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", length=11, nullable=false)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $size;

    /**
     * @ORM\Column(type="smallint", length=4, nullable=true)
     */
    private $spayed;

    /**
     * @ORM\Column(type="smallint", length=4, nullable=true)
     */
    private $liveWcats;

    /**
     * @ORM\Column(type="smallint", length=4, nullable=true)
     */
    private $homeTest;

    /**
     * @ORM\Column(type="smallint", length=4, nullable=true)
     */
    private $childFriend;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="Breed", inversedBy="animal")
     * @ORM\JoinColumn(name="breed_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $breed;

    /**
     * @ORM\OneToMany(targetEntity="Adoption", mappedBy="animal")
     */
    private $adoption;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="animal")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;


}
