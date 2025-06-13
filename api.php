<?php
header('Content-Type: application/json');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hotel_management_system');

// Connect to database
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Handle requests
$action = $_GET['action'] ?? '';
$table = $_GET['table'] ?? '';

switch ($action) {
    case 'fetch':
        try {
            $stmt = $pdo->query("SELECT * FROM $table");
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Failed to fetch data: ' . $e->getMessage()]);
        }
        break;
        
    case 'add':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Invalid input data']);
            break;
        }
        
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        
        try {
            // Check if table exists
            $stmt = $pdo->prepare("SHOW TABLES LIKE :table");
            $stmt->execute([':table' => $table]);
            if ($stmt->rowCount() == 0) {
                throw new PDOException("Table $table does not exist");
            }
            
            $stmt = $pdo->prepare("INSERT INTO $table ($columns) VALUES ($values)");
            $stmt->execute($data);
            echo json_encode(['success' => true, 'message' => 'Record added successfully']);
        } catch (PDOException $e) {
            // More detailed error message
            $errorInfo = $stmt->errorInfo();
            echo json_encode([
                'success' => false, 
                'message' => 'Failed to add record: ' . $e->getMessage(),
                'sql_error' => $errorInfo[2] ?? null
            ]);
        }
        break;
        
    // Add cases for update and delete operations
    
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

// For customer table
$sql = "INSERT INTO customer (fullname, phone, email, address) VALUES (:fullname, :phone, :email, :address)";