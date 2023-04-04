<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $photo_name = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $caption = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Photograph $photograph = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoName(): ?string
    {
        return $this->photo_name;
    }

    public function setPhotoName(string $photo_name): self
    {
        $this->photo_name = $photo_name;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getPhotograph(): ?Photograph
    {
        return $this->photograph;
    }

    public function setPhotograph(?Photograph $photograph): self
    {
        $this->photograph = $photograph;

        return $this;
    }
}
