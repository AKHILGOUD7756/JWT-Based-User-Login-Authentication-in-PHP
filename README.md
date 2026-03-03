# Coder Login - JWT Authentication System

A secure PHP-based login and authentication system using JWT (JSON Web Tokens) and MySQL database.

## 📋 Features

- User login/authentication system
- JWT token-based session management
- Secure password hashing with bcrypt
- Protected dashboard page
- Logout functionality
- Bootstrap 5 UI
- PDO database connection with error handling

## 🛠️ Requirements

- PHP 7.4 or higher
- MySQL/MariaDB
- Composer
- Apache/Nginx web server
- OpenSSL (for JWT support)

## 📦 Installation

### 1. Clone/Pull the Project

```bash
git clone <repository-url>
cd coder_login
```

Or if you already have the project:
```bash
cd coder_login
```

### 2. Install Vendor Dependencies

Install all required dependencies using Composer:

```bash
composer install
```

This will download and install the required packages (Firebase PHP-JWT library) into the `vendor/` directory.

If you don't have Composer installed, download it from [getcomposer.org](https://getcomposer.org)

### 3. Database Configuration

Create a MySQL database named `coder_login`:

```sql
CREATE DATABASE coder_login;
USE coder_login;

CREATE TABLE users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  user_name VARCHAR(100) NOT NULL,
  user_email VARCHAR(100) NOT NULL UNIQUE,
  user_password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 4. Configure Database Connection

Update the database credentials in `index.php` and `welcome.php` (lines with `new PDO`):

```php
$connect = new PDO("mysql:host=localhost;dbname=coder_login", "root", "");
```

Change `root` and empty password to your actual MySQL username and password.

### 5. Configure JWT Secret Key

⚠️ **Important**: Replace the placeholder secret key in `index.php` and `welcome.php`:

```php
// Change from:
$key = 'your-secret-key-123456';

// To a strong random key:
$key = 'your-super-secret-and-very-long-random-key-here';
```

Use a strong, randomly generated secret key for production.

### 6. Set Up Web Server

- **Apache**: Place the project in your `htdocs` directory
- **Nginx**: Configure the document root to point to the project directory
- **PHP Built-in Server** (for testing):
  ```bash
  php -S localhost:8000
  ```

## 🚀 Usage

1. **Access the login page**: Navigate to `http://localhost/coder_login/index.php`
2. **Create a test user** (insert into database manually if needed)
3. **Login** with your credentials
4. **JWT token** is automatically generated and stored in a secure cookie
5. **Access welcome page** after successful authentication
6. **Logout** to clear the session

## 📁 Project Structure

```
coder_login/
├── composer.json          # Project dependencies
├── index.php              # Login page & authentication
├── welcome.php            # Protected dashboard
├── logout.php             # Logout handler
├── vendor/                # Composer dependencies
└── README.md              # This file
```

## 📚 Dependencies

- **firebase/php-jwt** (^6.11) - JWT token encoding/decoding

## 🔒 Security Notes

- Change the default JWT secret key
- Use HTTPS in production
- Validate and sanitize all user inputs
- Keep Composer dependencies updated: `composer update`
- Store sensitive configuration in environment variables (recommended)

## 🔧 Troubleshooting

### "Class not found" error
- Ensure `composer install` was run successfully
- Check that `vendor/autoload.php` exists

### Database connection error
- Verify MySQL is running
- Check database credentials in the PHP files
- Ensure the `coder_login` database exists

### Token error
- Verify JWT secret key matches between pages
- Check that cookies are enabled in browser
- Ensure PHP's cookie settings are correct

## 📝 License

This project is open source and available under the MIT License.

## 👨‍💻 Author

Created for secure authentication implementations in PHP applications.
