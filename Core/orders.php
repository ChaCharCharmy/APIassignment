<?php

class Orders{
    // properties for database stuff
    private $conn;
    private $table = 'orders';

    // properties
    public $id;
    public $items;
    public $status;
    public $datetime;
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

        $this->items = $row['items'];
        $this->status = $row['status'];
        $this->datetime = $row['datetime'];
        $this->price = $row['price'];

        return $stmt;
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.'
            SET items = :items,
            status = :status,
            datetime = :datetime,
            price = :price';
        
        $stmt = $this->conn->prepare($query);

        // bind parameters to request
        $stmt->bindParam(':items', $this->items);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':datetime', $this->datetime);
        $stmt->bindParam(':price', $this->price);
        
        if ($stmt->execute ()){
            return true;
        }
        
        printf('Error %s. \n', $stmt->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE ' .$this->table.'
                    SET items = :items,
                    status = :status,
                    datetime = :datetime,
                    price = :price,
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->items = htmlspecialchars(strip_tags($this->items));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->datetime = htmlspecialchars(strip_tags($this->datetime));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bindParam(':items', $this->items);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':datetime', $this->datetime);
        $stmt->bindParam(':price', $this->price);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function updateItems(){
        $query = 'UPDATE ' .$this->table.'
                    SET items = :items
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

    public function updateStatus(){
        $query = 'UPDATE ' .$this->table.'
                    SET status = :status
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':status', $this->status);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function updatePrice(){
        $query = 'UPDATE ' .$this->table.'
                    SET price = :price
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