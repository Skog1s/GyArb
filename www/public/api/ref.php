<?php

class Note {
    private $conn;
    private $table_name = "notes";

    public $id;
    public $title;
    public $content;
    public $labels;
    public $created_at;
    public $updated_at;
    public $reminder;
    public $archived;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new note
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET title = :title, content = :content, labels = :labels, reminder = :reminder, archived = :archived";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":labels", $this->labels);
        $stmt->bindParam(":reminder", $this->reminder);
        $stmt->bindParam(":archived", $this->archived);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Get all notes
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Get a note by ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt;
    }

    // Update a note by ID
    public function update($id) {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, content = :content, labels = :labels, reminder = :reminder, archived = :archived 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":labels", $this->labels);
        $stmt->bindParam(":reminder", $this->reminder);
        $stmt->bindParam(":archived", $this->archived);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a note by ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
Step 4: Create the Controller (api/NotesController.php)
This file handles the API routes and calls the Note model methods.

php
Copy
<?php

require_once 'Note.php';

class NotesController {
    private $note;

    public function __construct($db) {
        $this->note = new Note($db);
    }

    // Create a new note
    public function createNote() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->title) && !empty($data->content)) {
            $this->note->title = $data->title;
            $this->note->content = $data->content;
            $this->note->labels = $data->labels ?? '';
            $this->note->reminder = $data->reminder ?? null;
            $this->note->archived = $data->archived ?? false;

            if ($this->note->create()) {
                echo json_encode(["message" => "Note created successfully."]);
            } else {
                echo json_encode(["message" => "Failed to create note."]);
            }
        } else {
            echo json_encode(["message" => "Invalid input data."]);
        }
    }

    // Get all notes
    public function getAllNotes() {
        $stmt = $this->note->getAll();
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($notes);
    }

    // Get a note by ID
    public function getNoteById($id) {
        $stmt = $this->note->getById($id);
        $note = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($note) {
            echo json_encode($note);
        } else {
            echo json_encode(["message" => "Note not found."]);
        }
    }

    // Update a note by ID
    public function updateNoteById($id) {
        $data = json_decode(file_get_contents("php://input"));

        $this->note->title = $data->title ?? '';
        $this->note->content = $data->content ?? '';
        $this->note->labels = $data->labels ?? '';
        $this->note->reminder = $data->reminder ?? null;
        $this->note->archived = $data->archived ?? false;

        if ($this->note->update($id)) {
            echo json_encode(["message" => "Note updated successfully."]);
        } else {
            echo json_encode(["message" => "Failed to update note."]);
        }
    }

    // Delete a note by ID
    public function deleteNoteById($id) {
        if ($this->note->delete($id)) {
            echo json_encode(["message" => "Note deleted successfully."]);
        } else {
            echo json_encode(["message" => "Failed to delete note."]);
        }
    }
}
?>
Step 5: Set Up the Routes and Entry Point (index.php)
This is the entry point for your API. It handles routing and invokes the appropriate methods from the controller.

php
Copy
<?php
require_once 'config/Database.php';
require_once 'api/NotesController.php';

header("Content-Type: application/json");

$database = new Database();
$db = $database->getConnection();

$controller = new NotesController($db);

// Handling routing
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Example API Routes
if ($method === 'GET') {
    if (isset($uri[2])) {
        // Get a single note by ID
        $controller->getNoteById($uri[2]);
    } else {
        // Get all notes
        $controller->getAllNotes();
    }
} elseif ($method === 'POST') {
    // Create a new note
    $controller->createNote();
} elseif ($method === 'PUT') {
    // Update a note by ID
    $controller->updateNoteById($uri[2]);
} elseif ($method === 'DELETE') {
    // Delete a note by ID
    $controller->deleteNoteById($uri[2]);
} else {
    echo json_encode(["message" => "Invalid method."]);
}
?>
Step 6: Set Up the Database
Create the database and the notes table:
sql
Copy
CREATE DATABASE keep_clone;

USE keep_clone;

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    labels VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    reminder DATETIME,
    archived BOOLEAN DEFAULT 0
);