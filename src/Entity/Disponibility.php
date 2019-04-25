<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Disponibility
 * @ORM\Entity(repositoryClass="App\Repository\DisponibilityRepository")
 * @ORM\Table(name="disponibility", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_disponibility_parking1_idx", columns={"parking_id"}), @ORM\Index(name="fk_disponibility_reservation1_idx", columns={"reservation_id"})})
 */
class Disponibility
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
     * @var DateTime
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
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price;

    /**
     * @var Parking
     *
     * @ORM\ManyToOne(targetEntity="Parking", inversedBy="disponibilities")
     * @ORM\JoinColumn(name="parking_id", referencedColumnName="id")
     */
    private $parking;

    /**
     * @var Reservation
     *
     * @ORM\ManyToOne(targetEntity="Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private $reservation;

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
     * @return int
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }


    public function setPrice(int $price): self
    {
        $this->price = $price;
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
     * @return Reservation
     */
    public function getReservation(): Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }


}
