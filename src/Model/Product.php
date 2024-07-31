<?php

namespace Dbseller\ProjetoInicial\Model;

class Product 
{
    private int $id;
    private string $type;
    private string $name; 
    private string $description;
    private string $image;
    private float $price;

    public function __construct(int $id, string $type, string $name, string $description, string $image, float $price)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getImageDirectory(): string
    {
        return "img/" . $this->image;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getFormattedPrice(): string
    {
        return "R$ " . number_format($this->price, 2);
    }
}