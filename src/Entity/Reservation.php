<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_reservation_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_start", type="date", nullable=false)
     */
    private $dateStart;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=false)
     */
    private $dateEnd;


    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reservations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;
    /**
     * @ORM\OneToMany(targetEntity="Disponibility", mappedBy="reservation")
     */
    private $disponibilities;


    public function __construct()
    {
        $this->disponibilities = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

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
     * @return DateTime
     */
    public function getDateStart(): ?DateTime
    {
        return $this->dateStart;
    }

    public function setDateStart(DateTime $dateStart): self
    {
        $this->dateStart = $dateStart;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd(): ?DateTime
    {
        return $this->dateEnd;
    }

    public function setDateEnd(DateTime $dateEnd): self
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDisponibilities()
    {
        return $this->disponibilities;
    }

    /**
     * @param mixed $disponibilities
     * @return Reservation
     */
    public function setDisponibilities($disponibilities): self
    {
        $this->disponibilities = $disponibilities;
        return $this;
    }

    public function getDateEndDisponibility()
    {
        $dateEndDispo = null;
        foreach ($this->getDisponibilities() as $disponibility) {
            if (!$dateEndDispo || $disponibility->getDateEnd() < $dateEndDispo) {
                $dateEndDispo = $disponibility->getDateEnd();
            }
        }
    }


}
