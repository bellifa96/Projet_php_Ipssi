CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL
);
CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    imagePath VARCHAR(255),
    title VARCHAR(255) NOT NULL ,
    content TEXT NOT NULL,
    idCategory INT,
    idUser INT,
    FOREIGN KEY (idCategory) REFERENCES categories(id),
    FOREIGN KEY (idUser) REFERENCES users(id)
); 
CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    content TEXT,
    idPost INT,
    idCUser int,
    FOREIGN KEY (idCUser) REFERENCES users(id),
    FOREIGN KEY (idPost) REFERENCES posts(id)
); 
