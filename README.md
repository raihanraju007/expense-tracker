# 📊 Laravel Expense Tracker API

## 🚀 Docker-Ready Laravel 12 Setup (via Sail)

### 🧪 Quick Start

```bash
# 1. Clone the repository
git clone <your-repo-url>
cd expense-tracker

# 2. Copy the env file
cp .env.example .env

# 3. Start Sail and install dependencies
./vendor/bin/sail up -d
./vendor/bin/sail composer install

# 4. Generate application key
./vendor/bin/sail artisan key:generate

# 5. Run database migrations
./vendor/bin/sail artisan migrate


🌐 Access URLs

Application URL: http://localhost

phpMyAdmin URL: http://localhost:8081

app/
├── DTOs/
│   ├── BudgetDTO.php
│   ├── CategoryDTO.php
│   └── ExpenseDTO.php
├── Exceptions/
│   └── CustomExceptionHandler.php
├── Helpers/
│   └── ApiResponse.php
├── Http/
│   ├── Controllers/Api/
│   │   ├── AuthController.php
│   │   ├── BudgetController.php
│   │   ├── CategoryController.php
│   │   ├── ExpenseController.php
│   │   └── ReportController.php
│   └── Requests/
│       ├── BudgetRequest.php
│       ├── CategoryRequest.php
│       └── ExpenseRequest.php
├── Models/
│   ├── Budget.php
│   ├── Category.php
│   ├── Expense.php
│   └── User.php
├── Repositories/
│   ├── BudgetRepository.php
│   ├── CategoryRepository.php
│   ├── ExpenseRepository.php
│   └── ReportsRepository.php
├── Services/
│   ├── BudgetService.php
│   ├── CategoryService.php
│   ├── ExpenseService.php
│   └── ReportService.php
├── ServiceImpl/
│   ├── BudgetServiceImpl.php
│   ├── CategoryServiceImpl.php
│   ├── ExpenseServiceImpl.php
│   └── ReportServiceImpl.php
├── Traits/
│   └── TracksUserActivity.php


✅ Feature Overview
🔐 Auth (via Sanctum)
POST /register

POST /login

GET /profile

POST /logout

📁 Category Module
GET /categories

POST /categories

GET /categories/{id}

PUT /categories/{id}

DELETE /categories/{id}

💸 Budget Module
GET /budgets

POST /budgets

GET /budgets/{id}

PUT /budgets/{id}

DELETE /budgets/{id}

🧾 Expense Module
GET /expenses

POST /expenses

GET /expenses/{id}

PUT /expenses/{id}

DELETE /expenses/{id}

📊 Reports Module
GET /reports/monthly-summary

GET /reports/category-wise

GET /reports/budget-vs-actual

GET /reports/historical-trends

GET /reports/top-days

GET /reports/most-frequent-category

🛠 Architecture Principles
✅ Laravel 12 + Sail (Docker-ready)

✅ Sanctum Authentication

✅ Clean Architecture

DTOs for consistent API output

Services + ServiceImpl

Repositories for DB access

Form Requests for validation

Custom Exception Handling

✅ TracksUserActivity trait to auto-manage created_by and updated_by

✅ Consistent API output with ApiResponse.php




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
