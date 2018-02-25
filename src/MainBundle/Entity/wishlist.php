<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * wishlist
 *
 * @ORM\Table(name="wishlist")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\wishlistRepository")
 */
class wishlist
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User")

     * @ORM\JoinColumn(nullable=false)

     */
    private $user;
    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Product")

     * @ORM\JoinColumn(nullable=false)

     */
    private $product;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

}

