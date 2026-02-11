CREATE DATABASE ctm_visualartwork CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ctm_visualartwork;

CREATE TABLE visual_artwork (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    creator VARCHAR(255),
    creation_date VARCHAR(50),
    art_medium VARCHAR(255),
    artform VARCHAR(255),
    location VARCHAR(255),
    same_as VARCHAR(255),
    image_filename VARCHAR(255)
);
