# Todo Planning Web Application

This repository contains two main projects: a **Laravel Backend** for the API and a **Next.js Frontend** for the user interface. Together, they form the Todo Planning Web Application, where users can manage their tasks and plan them over a weekly timeline.

## Project Structure

project-root/ │ ├── laravel-backend/ # Backend API built with Laravel 11 │ └── nextjs-frontend/ # Frontend built with Next.js

### Technologies Used

- **Laravel 11** (PHP Framework)
- **Next.js** (React.js Framework)
- **Vue.js** (Frontend Integration with Laravel)
- **MySQL** (Database for Laravel)
- **Node.js** (For the Next.js project)
- **Tailwind CSS** (For styling in the Next.js project)

---

## How to Setup the Project

### Prerequisites

Make sure you have the following installed on your machine:

- [Node.js](https://nodejs.org/) (for Next.js)
- [Composer](https://getcomposer.org/) (for Laravel)
- [PHP 8.x](https://www.php.net/) (for Laravel)
- [MySQL](https://www.mysql.com/) or any other database
- [Git](https://git-scm.com/)

### 1. Clone the repository

```bash
git clone https://github.com/your-username/repo-name.git
cd repo-name

2. Setting up the Backend (Laravel)
Navigate to the laravel-backend directory:

bash
Kodu kopyala
cd laravel-backend
Install PHP dependencies using Composer:

bash
Kodu kopyala
composer install
Create a .env file by copying .env.example:

bash
Kodu kopyala
cp .env.example .env
Generate the application key:

bash
Kodu kopyala
php artisan key:generate
Configure your database in the .env file and run migrations:

bash
Kodu kopyala
php artisan migrate
Start the Laravel development server:

bash
Kodu kopyala
php artisan serve
3. Setting up the Frontend (Next.js)
Navigate to the nextjs-frontend directory:

bash
Kodu kopyala
cd ../nextjs-frontend
Install Node.js dependencies:

bash
Kodu kopyala
npm install
Create an .env.local file for the Next.js project by copying .env.example:

bash
Kodu kopyala
cp .env.example .env.local
Start the Next.js development server:

bash
Kodu kopyala
npm run dev
The Next.js frontend will be available at http://localhost:3000, and the Laravel backend will be running at http://localhost:8000.

Additional Commands
Laravel Commands
Running Migrations:

bash
Kodu kopyala
php artisan migrate
Seeding the Database:

bash
Kodu kopyala
php artisan db:seed
Running Tests:

bash
Kodu kopyala
php artisan test
Next.js Commands
Build the Project for Production:

bash
Kodu kopyala
npm run build
Run in Production Mode:

bash
Kodu kopyala
npm run start
Lint the Code:

bash
Kodu kopyala
npm run lint

