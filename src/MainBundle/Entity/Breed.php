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
     * Set breedName.
     *
     * @param string $breedName
     *
     * @return Breed
     */
    public function setBreedName($breedName)
    {
        $this->breedName = $breedName;

        return $this;
    }

    /**
     * Get breedName.
     *
     * @return string
     */
    public function getBreedName()
    {
        return $this->breedName;
    }

    /**
     * Set breedDescription.
     *
     * @param string|null $breedDescription
     *
     * @return Breed
     */
    public function setBreedDescription($breedDescription = null)
    {
        $this->breedDescription = $breedDescription;

        return $this;
    }

    /**
     * Get breedDescription.
     *
     * @return string|null
     */
    public function getBreedDescription()
    {
        return $this->breedDescription;
    }

    /**
     * Set animal.
     *
     * @param \MainBundle\Entity\Animal|null $animal
     *
     * @return Breed
     */
    public function setAnimal(\MainBundle\Entity\Animal $animal = null)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal.
     *
     * @return \MainBundle\Entity\Animal|null
     */
    public function getAnimal()
    {
        return $this->animal;
    }
}
