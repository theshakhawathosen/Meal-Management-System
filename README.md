# 🍽️ Meal Management System

## Complete Documentation, User Manual & Credits

---

## 📌 Introduction

The **Meal Management System** is a comprehensive web-based application developed to simplify and automate the management of meals, expenses, and member contributions in shared living environments such as messes, hostels, dormitories, and bachelor accommodations.

This document contains:

* Full project overview
* Technical details
* Complete user manual
* Admin guide
* Installation guide
* Calculation logic
* Credits & acknowledgements

---

## 🎯 Purpose of the System

Managing meals manually often results in calculation errors, disputes, and lack of transparency. The purpose of this system is to:

* Automate meal counting
* Track daily and monthly expenses
* Calculate accurate meal rates
* Maintain deposit records
* Provide clear monthly summaries

---

## 🧰 Technology Stack

* **Backend:** PHP (Laravel Framework)
* **Frontend:** Blade Templates, HTML5, CSS3, JavaScript
* **Database:** MySQL
* **Authentication:** Laravel Authentication
* **Dependency Management:** Composer, NPM
* **Web Server:** Apache / Nginx

---

## ✨ System Features

### 👤 Member Management

* Add, edit, and delete members
* Activate or deactivate members
* Track member participation

### 🍚 Meal Management

* Daily meal entry per member
* Automatic total meal calculation
* Monthly meal summary

### 💰 Expense Management

* Add daily or monthly expenses
* Categorize expenses
* Automatic total expense calculation

### 💳 Deposit Management

* Record member deposits
* View total deposits
* Track due and balance per member

### 📊 Automatic Calculations

**Meal Rate Formula:**

```
Meal Rate = Total Expenses / Total Meals
```

**Individual Cost:**

```
Member Cost = Member Meals × Meal Rate
```

### 📑 Reports

* Monthly summary report
* Individual member report
* Printable financial summaries

### 🔐 Security

* Secure login system
* Admin-only access
* CSRF protection
* Input validation

---

## ⚙️ Installation Manual

### Step 1: System Requirements

* PHP >= 8.0
* Composer
* MySQL
* Node.js & NPM
* Git

### Step 2: Clone Repository

```
git clone https://github.com/theshakhawathosen/Meal-Management-System.git
cd Meal-Management-System
```

### Step 3: Install Dependencies

```
composer install
npm install
npm run build
```

### Step 4: Database Setup

1. Create database:

```
CREATE DATABASE meal_management;
```

2. Import SQL file:

```
mysql -u username -p meal_management < mealmanager.sql
```

### Step 5: Environment Configuration

```
cp .env.example .env
php artisan key:generate
```

Update database credentials in `.env` file.

### Step 6: Run Application

```
php artisan serve
```

Access the system at:

```
http://127.0.0.1:8000
```

---

## 📖 User Manual

### 🔑 Login

* Login using admin credentials
* Only authorized users can access the system

### 👥 Managing Members

1. Go to Members section
2. Add new member
3. Edit or remove members as needed

### 🍽️ Adding Daily Meals

1. Select date
2. Enter meals for each member
3. Save data

### 💸 Adding Expenses

1. Go to Expenses
2. Enter expense details
3. Save expense

### 💵 Recording Deposits

1. Select member
2. Enter deposit amount
3. Save

### 📊 Viewing Reports

* Monthly summary
* Individual member breakdown
* Total meal rate calculation

---

## 🧮 Calculation Logic Explained

* System sums all expenses
* System sums all meals
* Calculates meal rate automatically
* Calculates individual payable amount

This ensures fair and transparent cost sharing.

---

## 🧩 Project Structure Overview

```
Meal-Management-System/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── mealmanager.sql
├── .env.example
├── composer.json
└── README.md
```

---

## 🚀 Future Enhancements

* Role-based access control
* Mobile responsive dashboard
* Monthly PDF export
* Notifications
* Charts and analytics
* Multi-mess support

---

## 🧾 Credits & Acknowledgements

### 👨‍💻 Developer

**Shakhawat Hosen**

GitHub: [https://github.com/theshakhawathosen](https://github.com/theshakhawathosen)

Website: [shakhawatdev.com](https://shakhawatdev.com)

### 📚 Framework & Tools

* Laravel Framework
* PHP Community
* MySQL
* Composer
* Node.js

### 💡 Inspiration

Developed to help bachelor and mess management communities maintain transparent and fair meal systems.

---

## 📜 License

This project is open-source and licensed under the **MIT License**.

---

⭐ If you find this project useful, please give it a star on GitHub.
