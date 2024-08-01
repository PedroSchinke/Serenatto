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

    public function formObject($productData)
    {
        return new Product(
            $productData['id'],
            $productData['type'],
            $productData['name'],
            $productData['description'],
            $productData['price'],
            $productData['image']
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

    public function getProduct(int $id)
    {
        $sql = "SELECT * FROM produtos WHERE id = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
        $productData = $statement->fetch(PDO::FETCH_ASSOC);

        $productAsObject = $this->formObject($productData);

        return $productAsObject;
    }

    public function getAllProducts(): array
    {
        $sql = "SELECT * FROM produtos ORDER BY price;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = array_map(function($product) {
            return $this->formObject($product);
        }, $products);

        return $productsArray;
    }

    public function deleteProduct(int $id): void
    {
        $sql = "DELETE FROM produtos WHERE id = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
    }

    public function editProduct(Product $product)
    {
        $sql = "UPDATE produtos
                SET name = ?, type = ?, description = ?, price = ?, image = ?
                WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $product->getName()); 
        $statement->bindValue(2, $product->getType()); 
        $statement->bindValue(3, $product->getDescription()); 
        $statement->bindValue(4, $product->getPrice()); 
        $statement->bindValue(5, $product->getImage()); 
        $statement->bindValue(6, $product->getId()); 
        $statement->execute();
    }

    public function save(Product $product)
    {
        $sql = "INSERT INTO produtos (type, name, description, image, price) 
                VALUES (?, ?, ?, ?, ?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $product->getType());
        $statement->bindValue(2, $product->getName());
        $statement->bindValue(3, $product->getDescription());
        $statement->bindValue(4, $product->getImage());
        $statement->bindValue(5, $product->getPrice());
        $statement->execute();
    }
}