CREATE DATABASE CRS; -- classroom reservation system 

USE CRS;

CREATE TABLE Users(
    fname VARCHAR(256) NOT NULL,
    lname VARCHAR(256) NOT NULL,
    user_id VARCHAR(256) UNSIGNED NOT NULL, -- student_id 
    phone VARCHAR(22),
    PRIMARY KEY (user_id)
);

CREATE TABLE Rooms(
    room_id INT UNSIGNED NOT NULL,
    capacity INT UNSIGNED NOT NULL,
    PRIMARY KEY (room_id)
);

CREATE TABLE Reservations(
    res_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    timestamp TIMESTAMP, -- record the entry is created 
    room_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL, 
    start_time DATETIME,
    end_time DATETIME,
    approved BOOLEAN,
    message TEXT,
    PRIMARY KEY (res_id),
    FOREIGN KEY (room_id) REFERENCES Rooms(room_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- CREATE TABLE Class();