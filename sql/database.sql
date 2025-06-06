-- sql/database.sql

-- Veritabanı oluştur
CREATE DATABASE IF NOT EXISTS sql_injection_demo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sql_injection_demo;

-- users tablosu
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Test kullanıcıları
INSERT INTO users (username, password) VALUES
('admin', 'admin123'),
('zeynep', 'zeynep123'),
('guest', 'guest123');
