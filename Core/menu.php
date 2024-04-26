<?php

class Menu{
    // properties for database stuff
    private $conn;
    private $table = 'menu';

    // properties
    public $id;
    public $category;

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
            SET category = :category';
        
        $stmt = $this->conn->prepare($query);

        // bind parameters to request
        $stmt->bindParam(':category', $this->category);
        
        if ($stmt->execute ()){
            return true;
        }
        
        printf('Error %s. \n', $stmt->error);
        return false;
    }

    public function updateCategory(){
        $query = 'UPDATE ' .$this->table.'
                    SET category = :category
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