<?php 
  class Users {
    // DB stuff
    private $conn;
    private $table = 'users';

    // Users Properties
    public $id;
    public $prenom;
    public $role;
    public $created_at;
    public $update_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Users
    public function read() {
      // Create query
      $query = 'SELECT u.id, u.prenom, u.role, u.created_at, u.update_at
                                FROM ' . $this->table;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create Users
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET prenom = :prenom, role = :role, created_at = :created_at, update_at = :update_at';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->prenom = htmlspecialchars(strip_tags($this->prenom));
          $this->role = htmlspecialchars(strip_tags($this->role));
          $this->created_at = htmlspecialchars(strip_tags($this->created));
          $this->update_at = htmlspecialchars(strip_tags($this->update_at));

          // Bind data
          $stmt->bindParam(':prenom', $this->prenom);
          $stmt->bindParam(':role', $this->role);
          $stmt->bindParam(':created_at', $this->created_at);
          $stmt->bindParam(':update_at', $this->update_at);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Users
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET prenom = :prenom, role = :role, created_at = :created_at, update_at = :update_at
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':prenom', $this->prenom);
          $stmt->bindParam(':role', $this->role);
          $stmt->bindParam(':created_at', $this->created_at);
          $stmt->bindParam(':update_at', $this->update_at);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
}