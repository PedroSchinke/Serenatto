<?php

namespace Dbseller\ProjetoInicial\Repository;

use PDO;
use Dbseller\ProjetoInicial\Model\Product;

class ProductRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function formObject($product)
    {
        return new Product(
            $product['id'],
            $product['type'],
            $product['name'],
            $product['description'],
            $product['image'],
            $product['price']
        );
    }

    public function coffeeOptions(): array
    {
        $sql = "SELECT * FROM produtos WHERE type = ? ORDER BY price";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, "Café");
        $statement->execute();
        $coffeeProducts = $statement->fetchAll(PDO::FETCH_ASSOC);

        $coffeeData = array_map(function($coffee) {
            return $this->formObject($coffee);
        }, $coffeeProducts);

        return $coffeeData;
    }

    public function lunchOptions(): array
    {
        $sql = "SELECT * FROM produtos WHERE type = ? ORDER BY price";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, "Almoço");
        $statement->execute();
        $lunchProducts = $statement->fetchAll(PDO::FETCH_ASSOC);

        $lunchArray = array_map(function($lunch) {
            return $this->formObject($lunch);
        }, $lunchProducts);

        return $lunchArray;
    }

    public function getAllProducts(): array
    {
        $sql = "SELECT * FROM produtos;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = array_map(function($product) {
            return $this->formObject($product);
        }, $products);

        return $productsArray;
    }
}