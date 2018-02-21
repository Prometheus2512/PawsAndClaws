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



}
