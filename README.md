<h1 align="center">Task Manager</h1>

## Introduction
Task Manager is a Laravel application designed to simplify the process of managing project alone with task. 
The task page is designed like clickup or trello board, so developer will get a very flexbility to handle all 
This documentation provides a step-by-step guide on how to set up the project.

### Prerequisites
- PHP 8.1 or higher
- Composer
- Laravel 10 or higher
- MySQL or any other supported database system

## Setup Instructions

### Step 1: Clone the Repository
```
git clone https://github.com/arafat-web/Task-Manager.git
cd Task-Manager
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Configure Environment Variables
Duplicate the `.env.example` file and rename it to `.env`. Update the following variables:


### Step 4: Generate Application Key
```bash
php artisan key:generate
```

### Step 5: Run Migrations and Seed Database
```bash
php artisan migrate --seed
```

### Step 6: Serve the Application
```bash
php artisan serve
```

Access the application in your browser at `http://localhost:8000`.


## How to Use

### 1. Task Management
Task Manager allows users to efficiently manage projects and tasks through a user-friendly interface similar to ClickUp or Trello. Here are the main features:

1. **Login to the admin panel:**
    ```
    Email: admin@example.com
    Password: secret
    ```
	
2. **Registration to the admin panel:**
    - Name, email, and password.

3. **Tasks:**
   - Add, edit, and delete tasks within a project.
   - Filtering and searching task in dashboard
   - Task filtering by priority and due date
   
4. **dashboard:**
   - Add, edit, and delete tasks within a project.
   - Filtering and searching task in dashboard
   - Create a dashboard with task statistics (e.g., tasks completed, overdue tasks).   
   
5. **Frontend:**
	- Use Laravel Blade templating engine for views.
	- Implement a simple, responsive design 
	
6. **Database:**
	- Use MySQL to store user and task data.
	- Create appropriate migrations for the database schema.	








