<?php

class Table{
    // properties for database stuff
    private $conn;
    private $table = 'tables';

    // properties of Tabel
    public $tableId;
    public $capacity;
    public $isOccupied;

    // Constructor
    public function __construct($conn){
        $this->conn = $conn;
    }

    // Getting Tables from db
    public function read(){
        // Read Query
        $query = 'SELECT *
                    FROM '.$this->table.' u
                    ORDER BY u.tableId;';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Execute Query
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM '.$this->table.' u WHERE u.tableId = ? LIMIT 1;';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->tableId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->capacity = $row['capacity'];
        $this->isOccupied = $row['isOccupied'];

        return $stmt;
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.'
            SET capacity = :capacity,
                isOccupied = :isOccupied';
        
        $stmt = $this->conn->prepare($query);

        // bind parameters to request
        $stmt->bindParam(':capacity', $this->capacity);
        $stmt->bindParam(':isOccupied', $this->isOccupied);

        if ($stmt->execute ()){
            return true;
        }
        
        printf('Error %s. \n', $stmt->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE ' .$this->table.'
                    SET capacity = :capacity,
                    isOccupied = :isOccupied,
                    WHERE tableId = :tableId;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':tableId', $this->tableId);
        $stmt->bindParam(':capacity', $this->capacity);
        $stmt->bindParam(':isOccupied', $this->isOccupied);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }


    public function updateCapacity(){
        $query = 'UPDATE ' .$this->table.'
                    SET capacity = :capacity
                    WHERE tableId = :tableId;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->capacity = htmlspecialchars(strip_tags($this->capacity));

        $stmt->bindParam(':tableId', $this->tableId);
        $stmt->bindParam(':capacity', $this->capacity);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function updateIsOccupied(){
        $query = 'UPDATE ' .$this->table.'
                    SET isOccupied = :isOccupied
                    WHERE tableId = :tableId;';

        $stmt = $this->conn->prepare($query);

        $this->tableId = htmlspecialchars(strip_tags($this->tableId));

        $stmt->bindParam(':tableId', $this->tableId);
        $stmt->bindParam(':isOccupied', $this->isOccupied);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function delete(){
        $query = 'DELETE FROM '.$this->table.' WHERE tableId = :tableId';

        $stmt = $this->conn->prepare($query);

        $this->tableId = htmlspecialchars(strip_tags($this->tableId));

        $stmt->bindParam(':tableId', $this->tableId);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }
}