# Restaurant Order Management System

## Overview
This project is a simple web application designed to manage orders in a restaurant. It follows the MVC (Model-View-Controller) architecture and is built using PHP, HTML, JavaScript, and MySQL. The application provides functionalities for both clients and administrators.

## Features
- **Client Features:**
  - User registration and authentication
  - View available menu items
  - Add items to a shopping cart
  - Place orders and view order history

- **Admin Features:**
  - Admin login
  - Manage menu items (CRUD operations)
  - View and manage customer orders

## Project Structure
```
restaurant-system
├── app
│   ├── config
│   │   ├── config.php
│   │   └── database.php
│   ├── controllers
│   │   ├── AuthController.php
│   │   ├── MenuController.php
│   │   ├── OrderController.php
│   │   └── UserController.php
│   ├── models
│   │   ├── Connection.php
│   │   ├── Menu.php
│   │   ├── Order.php
│   │   ├── OrderDetail.php
│   │   ├── OrderStatus.php
│   │   └── User.php
│   └── views
│       ├── admin
│       │   ├── dashboard.php
│       │   ├── manage-menu.php
│       │   └── manage-orders.php
│       ├── client
│       │   ├── cart.php
│       │   ├── menu.php
│       │   ├── my-orders.php
│       │   └── register.php
│       ├── auth
│       │   └── login.php
│       └── templates
│           ├── footer.php
│           └── header.php
├── assets
│   ├── css
│   │   └── styles.css
│   └── js
│       └── main.js
├── index.php
├── .htaccess
└── README.md
```

## Installation
1. Clone the repository to your local machine.
2. Create a MySQL database and import the necessary tables.
3. Update the database connection settings in `app/config/database.php`.
4. Access the application through your web server.

## Technologies Used
- PHP
- MySQL
- HTML/CSS
- JavaScript

## License
This project is licensed under the MIT License.