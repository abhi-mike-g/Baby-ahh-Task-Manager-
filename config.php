<?php
try {
    $pdo = new PDO('sqlite:./taskmanager.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create tables if they don't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS tasks (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        title TEXT NOT NULL,
        due_date DATE NOT NULL,
        status TEXT DEFAULT 'pending',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS audit_log (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        task_id INTEGER,
        action TEXT,
        action_time DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Create trigger if it doesn't exist
    $pdo->exec("CREATE TRIGGER IF NOT EXISTS trg_after_task_insert 
                AFTER INSERT ON tasks
                BEGIN
                    INSERT INTO audit_log(task_id, action)
                    VALUES (NEW.id, 'TASK_CREATED');
                END");

    // Insert sample user if none exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO users (name, email) VALUES ('John Doe', 'john@example.com')");
    }

} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>
