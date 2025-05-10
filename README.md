# Laravel Project Setup Guide

This guide provides step-by-step instructions to set up the Laravel project, configure the database, and get everything running smoothly.

---

## **Prerequisites**
Ensure you have the following installed on your system:

- **PHP (>=8.1)**
- **Composer** (https://getcomposer.org/download/)
- **Laravel Installer** (`composer global require laravel/installer`)
- **MySQL or MariaDB** (for database management)
- **Node.js & npm** (for frontend assets, if needed)
- **Git** (optional, but recommended)

---

## **Step 1: Clone the Project**

If the project is hosted on GitHub, clone it using:
```sh
git clone https://github.com/your-repo/laravel-project.git
cd laravel-project
```

If you don’t have Git, download the ZIP file and extract it.

---

## **Step 2: Install Dependencies**
Run the following command to install the PHP dependencies:
```sh
composer install
```

---

## **Step 3: Set Up Environment File**

1. Copy the `.env.example` file and rename it to `.env`:
   ```sh
   cp .env.example .env
   ```

2. Open the `.env` file and update the database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   ```

---

## **Step 4: Set Up Database**

1. Create a new database in MySQL:
   ```sql
   CREATE DATABASE your_database_name;
   ```

2. Run Laravel migrations to create tables:
   ```sh
   php artisan migrate
   ```

3. (Optional) Seed the database with test data:
   ```sh
   php artisan db:seed
   ```

---

## **Step 5: Generate Application Key**

Run the following command to generate the application key:
```sh
php artisan key:generate
```

This updates the `APP_KEY` in your `.env` file.

---

## **Step 6: Serve the Application**

Start the Laravel development server:
```sh
php artisan serve
```

Your project will be accessible at **http://127.0.0.1:8000**

---

## **Step 7: Configure File Permissions**

If running on a Linux/macOS system, ensure the `storage` and `bootstrap/cache` directories are writable:
```sh
chmod -R 777 storage bootstrap/cache
```

---

---

## **Step 8: Setup Email (Optional)**

If your application sends emails, configure the `.env` file:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="YourApp Name"
```

Test the email setup:
```sh
php artisan tinker
>>> Mail::raw('Test email', function($msg) { $msg->to('your-email@example.com')->subject('Test'); });
```

---

## **Step 9: Deploying to Production**

When deploying, run:
```sh
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

If using Laravel Queues, start the supervisor:
```sh
sudo supervisorctl restart all
```

---

## **Troubleshooting**
- If migrations fail, check your `.env` file for correct database credentials.
- If `.env` changes are not applying, clear config cache:
  ```sh
  php artisan config:clear
  ```
- If assets are not loading, try:
  ```sh
  php artisan storage:link
  npm run dev
  ```
- If permissions errors occur, set correct permissions:
  ```sh
  chmod -R 777 storage bootstrap/cache
  ```

---

This completes the Laravel project setup. 🚀 Happy coding!
# DigitalMarketing-PushDynamics
# DigitalMarketing-PushDynamics
