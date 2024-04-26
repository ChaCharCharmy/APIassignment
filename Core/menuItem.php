<?php

class MenuItems{
    // properties for database stuff
    private $conn;
    private $table = 'menuItems';

    // properties
    public $id;
    public $category;
    public $items;
    public $ingredient;
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
        $this->items = $row['items'];
        $this->ingredient = $row['ingredient'];
        $this->price = $row['price'];

        return $stmt;
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.'
            SET category = :category,
            items = :items,
            ingredient = :ingredient,
            price = :price';
        
        $stmt = $this->conn->prepare($query);

        // bind parameters to request
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':items', $this->items);
        $stmt->bindParam(':ingredient', $this->ingredient);
        $stmt->bindParam(':price', $this->price);
        
        if ($stmt->execute ()){
            return true;
        }
        
        printf('Error %s. \n', $stmt->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE ' .$this->table.'
                    SET category = :category,
                    items = :items,
                    ingredient = :ingredient,
                    price = :price,
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->items = htmlspecialchars(strip_tags($this->items));
        $this->ingredient = htmlspecialchars(strip_tags($this->ingredient));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':items', $this->items);
        $stmt->bindParam(':ingredient', $this->ingredient);
        $stmt->bindParam(':price', $this->price);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function updateCategory(){
        $query = 'UPDATE ' .$this->table.'
                    SET category = :category,
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function updateItems(){
        $query = 'UPDATE ' .$this->table.'
                    SET items = :items,
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->items = htmlspecialchars(strip_tags($this->items));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':items', $this->items);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    
    public function updateIngredient(){
        $query = 'UPDATE ' .$this->table.'
                    SET ingredient = :ingredient,
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->ingredient = htmlspecialchars(strip_tags($this->ingredient));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':ingredient', $this->ingredient);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }
    
    public function updatePrice(){
        $query = 'UPDATE ' .$this->table.'
                    SET price = :price,
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