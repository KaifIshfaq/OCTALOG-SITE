CREATE TABLE IF NOT EXISTS contact_queries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    services TEXT, -- Stores JSON or comma-separated list of selected services
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);