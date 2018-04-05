CREATE DATABASE CRS; -- classroom reservation system 

USE CRS;

CREATE TABLE User(
    fname VARCHAR(256) NOT NULL,
    lname VARCHAR(256) NOT NULL,
    user_id VARCHAR(256) UNSIGNED NOT NULL, -- student_id 
    phone VARCHAR(22),
    email VARCHAR(22),
    password VARCHAR(256) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (user_id)
);

CREATE TABLE Room(
    room_id INT UNSIGNED NOT NULL,
    capacity INT UNSIGNED NOT NULL,
    location INT UNSIGNED NOT NULL, -- 0 RS, 1 RN, 2 Bauer, 3 Kravis, 4 others
    computer BOOLEAN NOT NULL DEFAULT 0,
    blackboard BOOLEAN NOT NULL,
    PRIMARY KEY (room_id)
);

CREATE TABLE Reservation(
    res_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    timestamp TIMESTAMP NOT NULL, -- record the entry is created 
    room_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL, 
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    approved BOOLEAN NOT NULL DEFAULT 0, -- FAULT IS FALSE 
    message TEXT,
    PRIMARY KEY (res_id),
    FOREIGN KEY (room_id) REFERENCES Rooms(room_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- CREATE TABLE Class();