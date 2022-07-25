<?php

namespace App\Dto;

class SectorDto
{
    private int $id;
    private string $name;
    private ?SectorDTO $parent;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getParent(): ?SectorDto
    {
        return $this->parent;
    }

    public function setParent(?SectorDto $parent): void
    {
        $this->parent = $parent;
    }
}