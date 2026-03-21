
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    username VARCHAR(100) ,
    pasword VARCHAR(255) , 
    email VARCHAR(100) ,
);

INSERT INTO users (username, password, email) VALUES
('admin', MD5'admin123', 'admin@lab.local' ),
('user1', MD5'password123', 'user1@lab.local'),
('user2', MD5'password321', 'user2@lab.local'),

CREATE TABLE products(
    id INTO AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(100) ,
    description TEXT ,
    price DECIMAL(10,2) , 

);

INSERT INTO products(name, description, price) VALUES
('Laptop', 'High performance', 999.99),
('Mouse', 'wireless', 29.99),
('Keyboard', 'Mechanical', 89.99)


