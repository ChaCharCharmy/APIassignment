<?php

class Status{
    // properties for database stuff
    private $conn;
    private $table = 'status';

    // properties
    public $id;
    public $statustype;

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

        $this->statustype = $row['statustype'];

        return $stmt;
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.'
            SET statustype = :statustype';
        
        $stmt = $this->conn->prepare($query);

        // bind parameters to request
        $stmt->bindParam(':statustype', $this->statustype);
        
        if ($stmt->execute ()){
            return true;
        }
        
        printf('Error %s. \n', $stmt->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE ' .$this->table.'
                    SET statustype = :statustype
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->statustype = htmlspecialchars(strip_tags($this->statustype));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':statustype', $this->statustype);

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