<?php

function connectDatabase() {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'players_new_db';

    // Create a new PDO instance
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    return $pdo;
}
//////////////////////////////////////////////////////////
function connectDatabase() {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'task_db';

    $mysqli = mysqli_connect($servername, $username, $password, $dbname);

    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Set charset to UTF-8 for proper handling of international characters
    mysqli_set_charset($mysqli, 'utf8mb4');

    return $mysqli;
}

=========================================================================================
function insertRecord($pdo, $table, $data) {
    // Use prepared statements to prevent SQL injection
    $columns = implode(',', array_keys($data));
    $values = implode(',', array_fill(0, count($data), '?'));

    $sql = "INSERT INTO $table($columns) VALUES($values)";

    $stmt = $pdo->prepare($sql);

    // Execute the prepared statement
    return $stmt->execute(array_values($data));
}

function updateRecord($pdo, $table, $data, $id) {
    // Use prepared statements to prevent SQL injection
    $args = array();

    foreach ($data as $key => $value) {
        $args[] = "$key = ?";
    }

    $sql = "UPDATE $table SET " . implode(',', $args) . " WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    // Execute the prepared statement
    return $stmt->execute(array_merge(array_values($data), [$id]));
}

function deleteRecord($pdo, $table, $id) {
    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM $table WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    // Execute the prepared statement
    return $stmt->execute([$id]);
}

function selectRecords($pdo, $table, $columns = "*", $where = null) {
    // Use prepared statements to prevent SQL injection
    $sql = "SELECT $columns FROM $table";

    if ($where !== null) {
        $sql .= " WHERE $where";
    }

    $stmt = $pdo->prepare($sql);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Usage example:

$pdo = connectDatabase();

// Insert example
$insertData = array('column1' => 'value1', 'column2' => 'value2');
insertRecord($pdo, 'your_table', $insertData);

// Update example
$updateData = array('column1' => 'new_value1', 'column2' => 'new_value2');
updateRecord($pdo, 'your_table', $updateData, 1);

// Delete example
deleteRecord($pdo, 'your_table', 1);

// Select example
$selectResult = selectRecords($pdo, 'your_table', 'column1, column2', 'column1 = "value1"');

// Process select result if needed
foreach ($selectResult as $row) {
    // Process each row
}

// No need to manually close connection as PDO automatically closes when the script ends
