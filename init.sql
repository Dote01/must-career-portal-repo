CREATE TABLE careers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course VARCHAR(100),
    suggested_careers TEXT
);

CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    company VARCHAR(255),
    description TEXT,
    deadline DATE
);

INSERT INTO careers (course, suggested_careers) VALUES
('Computer Engineering', 'Software Developer\nNetwork Engineer\nSystem Analyst'),
('Electrical Engineering', 'Electrical Technician\nPower Engineer\nControl Systems Specialist');

INSERT INTO jobs (title, company, description, deadline) VALUES
('Junior Software Developer', 'TechTanzania Ltd', 'Develop and maintain PHP-based web apps.', '2025-06-01'),
('Field Technician', 'PowerCorp Tanzania', 'Assist in field installation and maintenance.', '2025-05-20');


-- Users table for authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE,
    email VARCHAR(150),
    password VARCHAR(255),
    role ENUM('student', 'admin', 'company') DEFAULT 'student'
);

-- Insert default admin
INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@must.ac.tz', '$2y$10$O.5wR9JcQKN4XLKGeDgNUuJXhQXUQmMZ5Rk4BaGixFo5tHAsDdfj6', 'admin'); -- password: admin123
