# 🚗 Vehicle Service Management Application

A modern Laravel CRUD web application designed to manage vehicle service records, track service details, and handle service search/listing functionalities. Built on Laravel 13, Tailwind CSS 4, and MySQL.

---

## 🛠️ Tech Stack Requirements

Ensure you have the following prerequisites installed on your local environment:

| Technology | Minimum Version | Recommended Version |
| :--- | :--- | :--- |
| **PHP** | `^8.3` | `8.3.x` |
| **MySQL** | `5.7` | `8.0+` |
| **Composer** | `2.x` | Latest |
| **Node.js & NPM** | `18.x` | Latest LTS |
| **Laravel** | `^13.17` | `13.17+` |

---

## 🚀 Step-by-Step Installation Guide

Follow these steps to set up the project on your local system:

### 1. Copy Environment Configuration
Create a `.env` file from the example configuration:
```bash
cp env_example .env
```
Ensure you open the `.env` file and configure your database settings (specifically `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`). The default settings are:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=VServiceDB
DB_USERNAME=root
DB_PASSWORD=root
```

### 2. Install PHP Dependencies
Use Composer to install the application's PHP dependencies:
```bash
composer install
```

### 3. Generate Application Key
Generate the secure application key for encryption:
```bash
php artisan key:generate
```

---

## 💾 Database Setup & Migration (Choose One Method)

You can set up the database using either the command line migrations OR by importing the provided SQL backup dump file.

### ⚠️ Pre-requisite for both methods:
Create the database in your local MySQL instance. You can do this by running this query inside your MySQL client:
```sql
CREATE DATABASE VServiceDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### Method A: Command Line Setup (Laravel Migrations & Seeds)
This is the recommended method for standard Laravel development. It runs the built-in migrations and seeds the database with sample vehicle service data.

1. **Run Database Migrations:**
   ```bash
   php artisan migrate
   ```
2. **Seed Sample Data (Optional but Recommended):**
   ```bash
   php artisan db:seed
   ```

*(Alternatively, run both in a single command)*:
```bash
php artisan migrate:fresh --seed
```

---

### Method B: Manual MySQL Database File Import (SQL Dump)
If you prefer to load the pre-built schema and sample data directly from the SQL database file, import [vservice_db.sql](file:///home/shayan/Desktop/php-dev/vehicle-service/database/vservice_db.sql).

#### Option 1: Via Command Line
Open your terminal and run the following command (substitute your database username and provide your password when prompted):
```bash
mysql -u root -p VServiceDB < database/vservice_db.sql
```

#### Option 2: Via MySQL Desktop Tools (phpMyAdmin, TablePlus, DBeaver)
1. Open your database management client.
2. Select your newly created `VServiceDB` database.
3. Click on **Import** or **Execute SQL Script**.
4. Browse to select [database/vservice_db.sql](file:///home/shayan/Desktop/php-dev/vehicle-service/database/vservice_db.sql) and run/execute it.

---

## 🎨 Asset Compilation & Running the App

### 1. Install & Build Front-end Assets
This project uses Vite with Tailwind CSS. Install the Node packages and build the assets:
```bash
# Install dependencies
npm install

# Compile assets for production
npm run build
```

### 2. Start the Application Server
Run the local development server:
```bash
php artisan serve
```
Your application will be live at: [http://localhost:8000](http://localhost:8000)

---

## 📂 Project Structure Highlights

- **Migrations:** Define the database schema. Located in [database/migrations/](file:///home/shayan/Desktop/php-dev/vehicle-service/database/migrations/).
- **Models:** Contains [VehicleService.php](file:///home/shayan/Desktop/php-dev/vehicle-service/app/Models/VehicleService.php).
- **Controllers:** Handles request logic in [VehicleServiceController.php](file:///home/shayan/Desktop/php-dev/vehicle-service/app/Http/Controllers/VehicleServiceController.php).
- **Routes:** Core web routes defined in [routes/web.php](file:///home/shayan/Desktop/php-dev/vehicle-service/routes/web.php).
- **SQL Import Script:** Located at [database/vservice_db.sql](file:///home/shayan/Desktop/php-dev/vehicle-service/database/vservice_db.sql).
