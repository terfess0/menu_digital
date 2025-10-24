# Restaurant Order Management System

This project is a simple web application designed to manage restaurant orders. It follows the MVC architecture and is built using PHP, HTML, JavaScript, and MySQL. The application allows clients to register, log in, view the menu, create orders, and check the status of their orders. Administrators can manage the menu and handle orders.

## Features

### Client Side
- **User Registration**: Clients can create an account by providing their details.
- **User Login**: Clients can log in to their accounts.
- **Menu Viewing**: Clients can view available dishes from the menu.
- **Order Creation**: Clients can add items to their cart and place orders.
- **Order Status Checking**: Clients can view their past orders and their current status.

### Admin Side
- **Admin Dashboard**: A central place for administrators to manage the system.
- **Menu Management**: Administrators can add, edit, and delete menu items.
- **Order Management**: Administrators can view and manage customer orders.

## Project Structure

```
restaurant-system
├── index.php
├── config.php
├── assets
│   ├── css
│   │   └── style.css
│   └── js
│       ├── cart.js
│       └── orders.js
├── auth
│   ├── login.php
│   ├── register.php
│   └── logout.php
├── client
│   ├── menu.php
│   ├── cart.php
│   ├── orders.php
│   └── profile.php
├── admin
│   ├── dashboard.php
│   ├── menu_management.php
│   └── order_management.php
├── includes
│   ├── header.php
│   ├── footer.php
│   ├── db.php
│   └── functions.php
└── README.md
```

## Installation

1. Clone the repository to your local machine.
2. Import the provided SQL scripts to set up the database.
3. Update the `config.php` file with your database connection details.
4. Access the application via your web server.

## Usage

- Navigate to `auth/register.php` to create a new account.
- Use `auth/login.php` to log in.
- Access the menu at `client/menu.php` to start ordering.
- Administrators can log in and manage the system from the `admin/dashboard.php`.

## License

This project is open-source and available for modification and distribution.