<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ViewsUser
 *
 * @ORM\Table(name="views_user", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_views_user_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_views_user_user2_idx", columns={"receiver_id"})})
 * @ORM\Entity
 */
class ViewsUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="note_user", type="integer", nullable=false)
     */
    private $noteUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="date", nullable=false)
     */
    private $creationDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="note_amability", type="integer", nullable=true)
     */
    private $noteAmability;

    /**
     * @var int|null
     *
     * @ORM\Column(name="note_well_being", type="integer", nullable=true)
     */
    private $noteWellBeing;

    /**
     * @var int|null
     *
     * @ORM\Column(name="note_payment", type="integer", nullable=true)
     */
    private $notePayment;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="receiver_id", referencedColumnName="id")
     * })
     */
    private $receiver;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getNoteUser(): int
    {
        return $this->noteUser;
    }

    /**
     * @param int $noteUser
     */
    public function setNoteUser(int $noteUser): void
    {
        $this->noteUser = $noteUser;
    }

    /**
     * @return null|string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param null|string $comment
     */
    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return int|null
     */
    public function getNoteAmability(): ?int
    {
        return $this->noteAmability;
    }

    /**
     * @param int|null $noteAmability
     */
    public function setNoteAmability(?int $noteAmability): void
    {
        $this->noteAmability = $noteAmability;
    }

    /**
     * @return int|null
     */
    public function getNoteWellBeing(): ?int
    {
        return $this->noteWellBeing;
    }

    /**
     * @param int|null $noteWellBeing
     */
    public function setNoteWellBeing(?int $noteWellBeing): void
    {
        $this->noteWellBeing = $noteWellBeing;
    }

    /**
     * @return int|null
     */
    public function getNotePayment(): ?int
    {
        return $this->notePayment;
    }

    /**
     * @param int|null $notePayment
     */
    public function setNotePayment(?int $notePayment): void
    {
        $this->notePayment = $notePayment;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getReceiver(): User
    {
        return $this->receiver;
    }

    /**
     * @param User $receiver
     */
    public function setReceiver(User $receiver): void
    {
        $this->receiver = $receiver;
    }



}
