<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentary
 *
 * @ORM\Table(name="commentary")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\CommentaryRepository")
 */
class Commentary
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
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreationDate", type="datetime")
     */
    private $creationDate;
    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User", cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */

   protected $commentator;


    /**

     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Event", cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */

    protected $commentedevent;

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
     * Set content
     *
     * @param string $content
     *
     * @return Commentary
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Commentary
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set commentator
     *
     * @param \MainBundle\Entity\User $commentator
     *
     * @return Commentary
     */
    public function setCommentator(\MainBundle\Entity\User $commentator)
    {
        $this->commentator = $commentator;

        return $this;
    }

    /**
     * Get commentator
     *
     * @return \MainBundle\Entity\User
     */
    public function getCommentator()
    {
        return $this->commentator;
    }

    /**
     * Set commentedevent
     *
     * @param \MainBundle\Entity\Event $commentedevent
     *
     * @return Commentary
     */
    public function setCommentedevent(\MainBundle\Entity\Event $commentedevent)
    {
        $this->commentedevent = $commentedevent;

        return $this;
    }

    /**
     * Get commentedevent
     *
     * @return \MainBundle\Entity\Event
     */
    public function getCommentedevent()
    {
        return $this->commentedevent;
    }
}
