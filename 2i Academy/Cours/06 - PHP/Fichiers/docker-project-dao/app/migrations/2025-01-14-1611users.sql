CREATE TABLE users(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(20) NOT NULL,
    password_hash VARCHAR(128) NOT NULL,
    login_name VARCHAR(20) NOT NULL UNIQUE
);