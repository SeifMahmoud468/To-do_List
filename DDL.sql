CREATE DATABASE `ToDoList`;

USE `ToDoList`;

CREATE TABLE `User`(
    UserID INT AUTO_INCREMENT,
    FirstName VARCHAR(255),
    LastName VARCHAR(255),
    email VARCHAR(255),
    `password` VARCHAR(255),
    PRIMARY KEY(UserID)
);

CREATE TABLE task(
    taskID INT AUTO_INCREMENT,
    UserID INT,
    dueDate DATE DEFAULT CURRENT_TIMESTAMP,
    priority VARCHAR(255),
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    PRIMARY KEY(taskID)
);

CREATE TABLE collaborate_task(
    UserID INT,
    taskID INT,
    PRIMARY KEY(UserID, taskID)
);

ALTER TABLE
    task
ADD
    FOREIGN KEY (UserID) REFERENCES USER(UserID);

ALTER TABLE
    collaborate_task
ADD
    FOREIGN KEY (UserID) REFERENCES user(UserID);

ALTER TABLE
    collaborate_task
ADD
    FOREIGN KEY(taskID) REFERENCES task(taskID) ON DELETE CASCADE;