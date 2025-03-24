Blood Donation API

A RESTful API built with Laravel for managing blood donations, featuring secure authentication, role-based access control (RBAC), and efficient data management.

🚀 Key Features

JWT Authentication: Secure login & registration.

Role-Based Access Control (RBAC): Admins manage users, cities, and roles.

Blood Donation Management: CRUD operations for donations.

Centralized Database Seeder: Pre-populated data setup.

RESTful API: Easy frontend & mobile integration.

📌 Requirements

Ensure the following are installed:

PHP >= 8.0

Composer (PHP dependency manager)

MySQL (or any Laravel-supported database)

Postman (Optional for API testing)

📥 Installation & Setup

1️⃣ Clone & Setup Project

git clone <repo-url>
cd blood-donation-api
cp .env.example .env

2️⃣ Install Dependencies

composer install

3️⃣ Configure Environment Variables

Edit .env with your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blood_donation
DB_USERNAME=root
DB_PASSWORD=your_password

4️⃣ Run Migrations & Seed Data

php artisan migrate --seed

5️⃣ Generate JWT Secret & Start Server

php artisan jwt:secret
php artisan serve

The API is now available at: http://127.0.0.1:8000

🔗 API Endpoints

🔑 Authentication

Method

Endpoint

Description

POST

/api/register

Register a new user

POST

/api/login

Authenticate & get JWT token

POST

/api/logout

Logout user

Example Request:

curl -X POST http://127.0.0.1:8000/api/register \
 -d "name=John Doe&email=john@example.com&password=secret"

🩸 Blood Groups & Cities (Authenticated Users)

Method

Endpoint

Description

GET

/api/blood-groups

List all blood groups

GET

/api/cities

List all cities

👤 User Management (Admin Only)

Method

Endpoint

Description

GET

/api/users

List users

POST

/api/users

Create user

PUT

/api/users/{id}

Update user

DELETE

/api/users/{id}

Delete user

🎭 Role Management (Admin Only)

Method

Endpoint

Description

GET

/api/roles

List roles

POST

/api/roles

Create role

PUT

/api/roles/{id}

Update role

DELETE

/api/roles/{id}

Delete role

⚡ Best Practices

Environment Security: Keep .env secrets safe.

JWT Token Handling: Always refresh expired tokens.

Error Handling: Use Laravel's built-in exception handling.

🧪 Testing

Run tests using PHPUnit:

php artisan test

Use Postman or cURL for manual API testing.

🆘 Support

For issues or feature requests, open an issue in the repository.

Thank you for using the Blood Donation API! 🚀
