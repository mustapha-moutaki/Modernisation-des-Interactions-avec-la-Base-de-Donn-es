
<?php
class Database {
    private $pdo;

    public function __construct() {
        $host = "localhost";         
        $username = "root";          
        $password = "";              
        $dbname = "players_new_db";  

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // dipaly methode
    public function read($table, $conditions = []) {
        $sql = "SELECT * FROM $table";
        if (!empty($conditions)) {
            $placeholders = [];
            foreach ($conditions as $column => $value) {
                $placeholders[] = "$column = :$column";
            }
            $sql .= " WHERE " . implode(" AND ", $placeholders);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create methode
    public function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute($data)) {
            echo " created successfully.";
        } else {
            echo "Error creating .";
        }
    }
    
    // Update methode
    public function update($table, $column, $value, $idColumn, $idValue) {
        $sql = "UPDATE $table SET $column = :value WHERE $idColumn = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $idValue);

        if ($stmt->execute()) {
            echo "Updated successfully.";
        } else {
            echo "Error updating.";
        }
    }

    // Delete methode
    public function delete($table, $idColumn, $idValue) {
        $sql = "DELETE FROM $table WHERE $idColumn = :id";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute(['id' => $idValue])) {
            echo " deleted successfully.";
        } else {
            echo "Error deleting .";
        }
    }


}
?>
