Inventory Management System

A RESTful API built with PHP and Laravel to manage inventory operations, products, categories, suppliers, and stock movements.

Project Overview

The Inventory Management System helps businesses manage their products and monitor stock quantities efficiently. It provides secure API endpoints for inventory operations, user authentication, and role-based access control.

Features

- Authentication: User registration, login, and logout using Laravel Sanctum.
- Role-Based Access Control: Two roles: Admin and Employee.
- Category Management: Create, view, update, and delete categories.
- Product Management: Manage products, prices, quantities, and SKUs.
- Product Search: Search for products by name or SKU.
- Supplier Management: Manage supplier information.
- Stock Movements: Record incoming and outgoing stock operations.
- Stock Validation: Prevent outgoing movements when available stock is insufficient.
- Inventory Reports: View total products and stock quantities.
- Low Stock Alerts: Identify products with low quantities.
- Supplier Purchases Report: Track incoming stock operations.

Technologies Used

- PHP
- Laravel 12
- MySQL
- Laravel Sanctum
- RESTful API
- Postman
- Git & GitHub

User Roles

Feature| Admin| Employee
View Products| Yes| Yes
Manage Products| Yes| No
View Categories| Yes| Yes
Manage Categories| Yes| No
View Suppliers| Yes| Yes
Manage Suppliers| Yes| No
Stock Movements| Yes| Yes
View Reports| Yes| Yes

API Endpoints

Authentication

Method| Endpoint| Description
POST| "/api/register"| Register a new user
POST| "/api/login"| Login
POST| "/api/logout"| Logout
GET| "/api/user"| Get authenticated user

Categories

Method| Endpoint| Description
GET| "/api/categories"| View categories
POST| "/api/categories"| Create category
PUT| "/api/categories/{id}"| Update category
DELETE| "/api/categories/{id}"| Delete category

Products

Method| Endpoint| Description
GET| "/api/products"| View products
GET| "/api/products/search"| Search products
POST| "/api/products"| Create product
PUT| "/api/products/{id}"| Update product
DELETE| "/api/products/{id}"| Delete product

Suppliers

Method| Endpoint| Description
GET| "/api/suppliers"| View suppliers
POST| "/api/suppliers"| Create supplier
PUT| "/api/suppliers/{id}"| Update supplier
DELETE| "/api/suppliers/{id}"| Delete supplier

Stock Movements

Method| Endpoint| Description
GET| "/api/stock-movements"| View stock movements
POST| "/api/stock-movements"| Record stock movement

Reports

Method| Endpoint| Description
GET| "/api/inventory-report"| Inventory report
GET| "/api/supplier-purchases-report"| Supplier purchases report
GET| "/api/low-stock-alerts"| Low stock alerts

Installation

1. Clone the repository:
   
   git clone YOUR_GITHUB_REPOSITORY_URL

2. Navigate to the project folder:
   
   cd inventory-management

3. Install dependencies:
   
   composer install

4. Create your environment file:
   
   copy .env.example .env

5. Generate the application key:
   
   php artisan key:generate

6. Configure your MySQL database in the ".env" file.

7. Run database migrations:
   
   php artisan migrate

8. Start the development server:
   
   php artisan serve

The API will be available at:

"http://127.0.0.1:8000"

API Testing

All API endpoints were tested using Postman.

Protected endpoints require a valid Laravel Sanctum Bearer Token.

Developer

Developed as a PHP and Laravel Backend project.