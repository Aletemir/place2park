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
     * @var Parking
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


    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getNotePark(): int
    {
        return $this->notePark;
    }

    public function setNotePark(int $notePark): self
    {
        $this->notePark = $notePark;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function setCreationDate(string $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNoteAccess(): ?int
    {
        return $this->noteAccess;
    }

    public function setNoteAccess(?int $noteAccess): self
    {
        $this->noteAccess = $noteAccess;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNoteCleaning(): ?int
    {
        return $this->noteCleaning;
    }

    public function setNoteCleaning(?int $noteCleaning): self
    {
        $this->noteCleaning = $noteCleaning;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNotePrice(): ?int
    {
        return $this->notePrice;
    }

    public function setNotePrice(?int $notePrice): self
    {
        $this->notePrice = $notePrice;

        return $this;
    }

    /**
     * @return Parking
     */
    public function getParking(): Parking
    {
        return $this->parking;
    }

    public function setParking(Parking $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
