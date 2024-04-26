<?php

class Ingredients{
    // properties for database stuff
    private $conn;
    private $table = 'ingredients';

    // properties
    public $id;
    public $ingredients;
    public $price;

    // Constructor
    public function __construct($conn){
        $this->conn = $conn;
    }

    // Getting Tables from db
    public function read(){
        // Read Query
        $query = 'SELECT *
                    FROM '.$this->table.' u
                    ORDER BY u.id;';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Execute Query
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM '.$this->table.' u WHERE u.id = ? LIMIT 1;';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->category = $row['category'];

        return $stmt;
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.'
            SET ingredients = :ingredients';
        
        $stmt = $this->conn->prepare($query);

        // bind parameters to request
        $stmt->bindParam(':ingredients', $this->ingredients);
        
        if ($stmt->execute ()){
            return true;
        }
        
        printf('Error %s. \n', $stmt->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE ' .$this->table.'
                    SET ingredients = :ingredients,
                    price = :price,
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':ingredients', $this->ingredients);
        $stmt->bindParam(':price', $this->price);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function updateIngredients(){
        $query = 'UPDATE ' .$this->table.'
                    SET ingredients = :ingredients
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':ingredients', $this->ingredients);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function updatePrice(){
        $query = 'UPDATE ' .$this->table.'
                    SET ingredients = :ingredients
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':price', $this->price);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function delete(){
        $query = 'DELETE FROM '.$this->table.' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }
}