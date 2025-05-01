# 🎬 Cinema API

A RESTful API built with Laravel for managing movies, categories, and cinema-related content. Includes authentication, admin-only controls, and structured data handling for cinema applications.

## 🚀 Key Features

1. **JWT Authentication**  
   Secure login and token-based session handling using `tymon/jwt-auth`.

2. **Movie & Category Management**  
   Full CRUD support for movies and categories with admin access.

3. **Public Access & Admin Control**  
   Non-authenticated users can view movies; only admins can manage content.

---

## 📌 Requirements

Before installation, make sure the following are installed on your system:

-   PHP >= 8.0
-   Composer
-   MySQL or MariaDB
-   Laravel CLI
-   Postman (optional, for API testing)

---

## 📥 Installation & Setup

Follow these steps to set up the project locally:

### 1️⃣ Clone the Project

```bash
git clone https://github.com/izetizeti2/CinemaApi.git
cd CinemaApi
cp .env.example .env
```

### 2️⃣ Install Dependencies

```bash
composer install
```

### 3️⃣ Configure Environment

Update the `.env` file with your local database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cinema_api
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4️⃣ Run Migrations

```bash
php artisan migrate
```

### 5️⃣ Generate JWT Secret

```bash
php artisan jwt:secret
```

### 6️⃣ Start the Laravel Development Server

```bash
php artisan serve
```

Access the API at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔐 Authentication Endpoints

| Method | Endpoint      | Description         |
| ------ | ------------- | ------------------- |
| POST   | /api/register | Register a new user |
| POST   | /api/login    | Login and get token |

---

## 🎬 Movie Endpoints

| Method | Endpoint         | Description       | Access     |
| ------ | ---------------- | ----------------- | ---------- |
| GET    | /api/movies      | List all movies   | Public     |
| GET    | /api/movies/{id} | Get movie details | Public     |
| POST   | /api/movies      | Add a new movie   | Admin Only |
| PUT    | /api/movies/{id} | Update movie info | Admin Only |
| DELETE | /api/movies/{id} | Delete a movie    | Admin Only |

---

## 🗂️ Category Endpoints

| Method | Endpoint             | Description           | Access     |
| ------ | -------------------- | --------------------- | ---------- |
| GET    | /api/categories      | List all categories   | Public     |
| POST   | /api/categories      | Create a new category | Admin Only |
| PUT    | /api/categories/{id} | Update category info  | Admin Only |
| DELETE | /api/categories/{id} | Delete a category     | Admin Only |

---

## 🧪 Running Tests

Use Laravel's built-in test runner:

```bash
php artisan test
```

You can also test manually using Postman or cURL to hit API endpoints.

---

## ✅ Best Practices

-   Keep sensitive keys safe by not pushing the `.env` file.
-   Use middleware like `auth:api` and custom roles for route protection.
-   Refresh JWT tokens on the frontend when expired.
-   Use Laravel Form Requests for validating incoming data.

---

## 🆘 Support

If you face any issues or want to suggest features, open an issue at the [GitHub Repository](https://github.com/izetizeti2/CinemaApi/issues).

---

Thanks for using Cinema API! 🍿
