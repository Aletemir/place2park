<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parking
 *
 * @ORM\Table(name="parking", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_parking_type_idx", columns={"type_id"}), @ORM\Index(name="fk_parking_user1_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ParkingRepository")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Parking
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     *  @var string|null
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     *
     */
    private $picture;

    /**
     * @var File
     * @Vich\UploadableField(mapping="parking_pictures", fileNameProperty="picture")
     */
    private $pictureFile;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

//     TODO : include the postal code

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=255, nullable=false)
     */
    private $district;

    /**
     * @var string|null
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="decimal", precision=10, scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", precision=11, scale=8, nullable=true)
     */
    private $longitude;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", length=255, nullable=false)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="update_at", type="datetime", length=255, nullable=true)
     */
    private $updateAt;

    /**
     * @var Type
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="parking")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Disponibility", mappedBy="parking")
     */
    private $disponibilities;

    public function __construct()
    {
        $this->disponibilities = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

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
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param null|string $picture
     * @return Parking
     */
    public function setPicture(?string $picture): Parking
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return null|File
     */
    public function getpictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * @param File|null $picture
     */
    public function setpictureFile(File $picture = null)
    {
        $this->pictureFile = $picture;

        if ($picture) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(string $district): self
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return Type
     */
    public function getType(): ?Type
    {
        return $this->type;
    }


    public function setType(Type $type): self
    {
        $this->type = $type;
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
     * @return DateTime
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }


    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdateAt(): ?DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDisponibilities(): ?Disponibility
    {
        return $this->disponibilities;
    }


    public function setDisponibilities($disponibilities): self
    {
        $this->disponibilities = $disponibilities;
        return $this;
    }

    public function getPrice() {
        $price = null;
        foreach ($this->getDisponibilities() as $disponibility) {
            if (!$price || $disponibility->getPrice() < $price) {
                $price = $disponibility->getPrice();
            }
        }


        return $price;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->setUpdateAt(new DateTime());
    }

}

