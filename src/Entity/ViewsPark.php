<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ViewsPark
 *
 * @ORM\Table(name="views_park", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_views_park_parking1_idx", columns={"parking_id"}), @ORM\Index(name="fk_views_park_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class ViewsPark
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
     * @ORM\Column(name="note_park", type="integer", nullable=false)
     */
    private $notePark;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="creation_date", type="string", length=255, nullable=false)
     */
    private $creationDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="note_access", type="integer", nullable=true)
     */
    private $noteAccess;

    /**
     * @var int|null
     *
     * @ORM\Column(name="note_cleaning", type="integer", nullable=true)
     */
    private $noteCleaning;

    /**
     * @var int|null
     *
     * @ORM\Column(name="note_price", type="integer", nullable=true)
     */
    private $notePrice;

    /**
     * @var \Parking
     *
     * @ORM\ManyToOne(targetEntity="Parking")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parking_id", referencedColumnName="id")
     * })
     */
    private $parking;

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
    public function getNotePark(): int
    {
        return $this->notePark;
    }

    /**
     * @param int $notePark
     */
    public function setNotePark(int $notePark): void
    {
        $this->notePark = $notePark;
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
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate(string $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return int|null
     */
    public function getNoteAccess(): ?int
    {
        return $this->noteAccess;
    }

    /**
     * @param int|null $noteAccess
     */
    public function setNoteAccess(?int $noteAccess): void
    {
        $this->noteAccess = $noteAccess;
    }

    /**
     * @return int|null
     */
    public function getNoteCleaning(): ?int
    {
        return $this->noteCleaning;
    }

    /**
     * @param int|null $noteCleaning
     */
    public function setNoteCleaning(?int $noteCleaning): void
    {
        $this->noteCleaning = $noteCleaning;
    }

    /**
     * @return int|null
     */
    public function getNotePrice(): ?int
    {
        return $this->notePrice;
    }

    /**
     * @param int|null $notePrice
     */
    public function setNotePrice(?int $notePrice): void
    {
        $this->notePrice = $notePrice;
    }

    /**
     * @return \Parking
     */
    public function getParking(): \Parking
    {
        return $this->parking;
    }

    /**
     * @param \Parking $parking
     */
    public function setParking(\Parking $parking): void
    {
        $this->parking = $parking;
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



}
