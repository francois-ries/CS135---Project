INSERT INTO Room (room_id, roomname, capacity, location, computer, blackboard) VALUES (1, "LC 62", 120, 3, TRUE, FALSE);
INSERT INTO Room (room_id, roomname, capacity, location, computer, blackboard) VALUES (2, "Kravis 12", 50, 3, TRUE, FALSE);
INSERT INTO Room (room_id, roomname, capacity, location, computer, blackboard) VALUES (3, "Kravis 321", 20, 3, FALSE, FALSE);
INSERT INTO Room (room_id, roomname, capacity, location, computer, blackboard) VALUES (4, "Bauer 120", 20, 2, FALSE, TRUE);
INSERT INTO Room (room_id, roomname, capacity, location, computer, blackboard) VALUES (5, "Bauer 212", 30, 2, FALSE, TRUE);
INSERT INTO Room (room_id, roomname, capacity, location, computer, blackboard) VALUES (6, "RS 120", 20, 0, FALSE, FALSE);
INSERT INTO Room (room_id, roomname, capacity, location, computer, blackboard) VALUES (7, "RN 100", 25, 1, FALSE, TRUE);

INSERT INTO User (fname, lname, user_id, phone, email, password, admin) VALUES ("Klaudia", "Dziewulski", "30316925", "3126087893", "klaudiad1@hotmail.com", "square", TRUE);
INSERT INTO User (fname, lname, user_id, phone, email, password, admin) VALUES ("Anna", "Lade", "30322200", "7737088989", "anna@gmail.com", "circle", FALSE);
INSERT INTO User (fname, lname, user_id, phone, email, password, admin) VALUES ("Frank", "Luis", "40416925", "9776784563", "fluis@gmail.com", "flower62", FALSE);
INSERT INTO User (fname, lname, user_id, phone, email, password, admin) VALUES ("Claudia", "Zolt", "30316225", "8082645644", "claudiaz@gmail.com", "coffee12", FALSE);

INSERT INTO Reservation (room_id, user_id, start_time, end_time, approved) VALUES (2, "30322200", "2018-04-16 8:00", "2018-04-16 9:00", NULL);
INSERT INTO Reservation (room_id, user_id, start_time, end_time, approved) VALUES (5, "40416925", "2018-04-16 13:00", "2018-04-16 14:30", TRUE);
INSERT INTO Reservation (room_id, user_id, start_time, end_time, approved) VALUES (1, "30316225", "2018-04-16 17:00", "2018-04-16 18:00", FALSE);
INSERT INTO Reservation (room_id, user_id, start_time, end_time, approved) VALUES (6, "30316225", "2018-04-16 12:00", "2018-04-16 13:00", NULL);
INSERT INTO Reservation (room_id, user_id, start_time, end_time, approved) VALUES (3, "40416925", "2018-04-16 10:00", "2018-04-16 11:30", NULL);