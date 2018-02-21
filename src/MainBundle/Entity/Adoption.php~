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
}