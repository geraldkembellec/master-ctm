CREATE TABLE Event (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATETIME NOT NULL,
    end_date DATETIME,
    location_name VARCHAR(255),
    location_city VARCHAR(100),
    location_country VARCHAR(100),
    organizer VARCHAR(255),
    event_status VARCHAR(100),
    event_mode VARCHAR(100),
    url VARCHAR(255),
    image_filename VARCHAR(255)
);
