📁 Laravel Expense Tracker - Folder Structure & Feature Overview

🐳 Docker-Ready Setup with Laravel Sail

🔧 Installation via Sail

# 1. Clone the repository
git clone <your-repo-url>
cd expense-tracker

# 2. Copy the example env file
cp .env.example .env

# 3. Start Laravel Sail and install dependencies
./vendor/bin/sail up -d
./vendor/bin/sail composer install

# 4. Generate application key
./vendor/bin/sail artisan key:generate

# 5. Run migrations
./vendor/bin/sail artisan migrate

**phpMyAdmin URL** -> http://localhost:8081/
**Application URL ->** http://localhost/

**🧩 Folder Structure**

app/
├── DTOs/
│   ├── CategoryDTO.php
│   ├── BudgetDTO.php
│   ├── ExpenseDTO.php
├── Exceptions/
│   └── CustomExceptionHandler.php
├── Helpers/
│   └── ApiResponse.php
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       ├── AuthController.php
│   │       ├── CategoryController.php
│   │       ├── BudgetController.php
│   │       ├── ExpenseController.php
│   │       └── ReportController.php
│   └── Requests/
│       ├── CategoryRequest.php
│       ├── BudgetRequest.php
│       └── ExpenseRequest.php
├── Models/
│   ├── User.php
│   ├── Category.php
│   ├── Budget.php
│   └── Expense.php
├── Repositories/
│   ├── CategoryRepository.php
│   ├── BudgetRepository.php
│   ├── ExpenseRepository.php
│   └── ReportsRepository.php
├── Services/
│   ├── CategoryService.php
│   ├── BudgetService.php
│   ├── ExpenseService.php
│   └── ReportService.php
├── ServiceImpl/
│   ├── CategoryServiceImpl.php
│   ├── BudgetServiceImpl.php
│   ├── ExpenseServiceImpl.php
│   └── ReportServiceImpl.php
├── Traits/
│   └── TracksUserActivity.php

**✅ Features Implemented**

**👤 Auth Module (Sanctum)**

        POST /register
        
        POST /login
        
        GET /profile
        
        POST /logout

**📂 Categories**

        GET /categories
        
        POST /categories
        
        GET /categories/{id}
        
        PUT /categories/{id}
        
        DELETE /categories/{id}

**💰 Budgets**

        GET /budgets
        
        POST /budgets
        
        GET /budgets/{id}
        
        PUT /budgets/{id}
        
        DELETE /budgets/{id}

**🧾 Expenses**

        **GET /expenses
        
        POST /expenses
        
        GET /expenses/{id}
        
        PUT /expenses/{id}
        
        DELETE /expenses/{id}**

**📊 Reports**

        GET /reports/monthly-summary
        
        GET /reports/category-wise
        
        GET /reports/budget-vs-actual
        
        GET /reports/historical-trends
        
        GET /reports/top-days
        
        GET /reports/most-frequent-category

**💡 Tech & Design Principles**

    -> Laravel 12
    
    -> Sanctum Authentication
    
    -> Eloquent ORM

    -> **Clean Architecture:**

            DTOs for response formatting
            
            Services + Implementations
            
            Repositories for DB logic
            
            Custom Exception Handling
            
            Unified Validation Requests
            
            Reusable ApiResponse helper

    -> Centralized user tracking with TracksUserActivity
