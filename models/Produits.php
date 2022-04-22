<?php
    class Produits {
        //DB stuff
        private $conn;
        private $table = 'produits';

        //produits Properties
        public $id;
        public $produits_id;
        public $nom;
        public $description;
        public $prix;
        public $stock;
        public $reference;
        public $created_at;
        public $update_at;

        public function __construct($db) {
            $this->conn = $db;
        }

        //Get Produits
        public function read() {
            //Create query
            $query = 'SELECT 
                    p.id, 
                    p.nom, 
                    p.description, 
                    p.prix, 
                    p.stock, 
                    p.reference
                    p.created_at, 
                    p.update_at
                FROM 
                    '.$this->table .'
                    ORDER BY
                    created_at DESC';
                    ;

            $stmt = $this -> conn -> prepare($query);

            $stmt -> execute();
            return $stmt;
            
        }


        // Create Produits
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' .
            $this->table . '
            SET
            nom = :nom
            description = :description
            prix = :prix
            stock = :stock
            reference = :reference
            created_at = :created_at
            update_at = :update_at';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->prix = htmlspecialchars(strip_tags($this->prix));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->reference = htmlspecialchars(strip_tags($this->reference));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->update_at = htmlspecialchars(strip_tags($this->update_at));

        // Bind data
        $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':description', $this->description);
        $stmt-> bindParam(':prix', $this->prix);
        $stmt-> bindParam(':stock', $this->stock);
        $stmt-> bindParam(':reference', $this->reference);
        $stmt-> bindParam(':created_at', $this->created_at);
        $stmt-> bindParam(':update_at', $this->update_at);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

        return false;
        }

        // Update Category
        public function update() {
            // Create Query
            $query = 'UPDATE ' .
            $this->table . '
            SET
            name = :name
            description = :description
            prix = :prix
            stock = :stock
            reference = :reference
            created_at = :created_at
            update_at = :update_at
            WHERE
            id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->prix = htmlspecialchars(strip_tags($this->prix));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->reference = htmlspecialchars(strip_tags($this->reference));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->update_at = htmlspecialchars(strip_tags($this->update_at));

        // Bind data
        $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':id', $this->id);
        $stmt-> bindParam(':description', $this->description);
        $stmt-> bindParam(':prix', $this->prix);
        $stmt-> bindParam(':stock', $this->stock);
        $stmt-> bindParam(':reference', $this->reference);
        $stmt-> bindParam(':created_at', $this->created_at);
        $stmt-> bindParam(':update_at', $this->update_at);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        return false;
        }

        // Delete Category
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Data
            $stmt-> bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
             printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }