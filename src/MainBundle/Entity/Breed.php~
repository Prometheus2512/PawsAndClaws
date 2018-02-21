<?php
/**
 * Created by PhpStorm.
 * User: aymen
 * Date: 2/21/18
 * Time: 3:57 AM
 */

namespace MainBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;

/**
 * Breed
 *
 * @ORM\Table(name="Breed")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\BreedRepository")
 */

class Breed
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(length=255, nullable=false)
     */
    private $breedName;

    /**
     * @ORM\Column(length=255, nullable=true)
     */
    private $breedDescription;

    /**
     * @ORM\OneToOne(targetEntity="Animal", mappedBy="breed")
     */
    private $animal;
}