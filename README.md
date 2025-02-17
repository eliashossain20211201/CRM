# Project mini CRM System

## Overview
A mini CRM system where:  
- Leads are received and assigned to Counselors by an Admin. Let's say there will be four counsellors and one admin in this system.
- When assigned counsellors start contacting leads, they would be able to change the lead status according to their conversation like "In progress", "Bad Timing", "Not Interested", and "Not Qualified".
- If any lead is interested and move forward with their application, Our counsellor would have the ability to move them to application section.
- In application section, assigned counsellor will select application status like "In Progress", "Approved", and "Rejection" according to the situation.

## Requirements:
### Backend (Laravel, MySQL):
- Implement JWT-based authentication with role-based access (Admin, Counselor).  
- Develop API endpoints for managing Leads, Assignments, and Applications.  
 
### An SQL query to find:  
- Total leads assigned to each counselor.  
- Counselors with the highest lead conversion rates.  

### Frontend (Vue.js, ES6, Axios) 
- Create a dashboard to manage leads and applications.  
- Implement drag-and-drop Kanban Board for tracking lead progress.  
 Use Vuex for state management.  

### DSA Task (PHP)
A function to find the most active counselor who has processed the most applications in the last 30 days.  


## Installation

### **Prerequisites**  
Ensure your system meets the following requirements before installation:  
- **PHP 8.1+**  
- **Composer** (PHP dependency manager)  
- **Laravel 10+**  
- **MySQL 8+** or **MariaDB 10.6+**  
- **Apache**

### **Setup Steps**
**Step 1: Clone the Repository**  
```sh
git clone https://github.com/eliashossain20211201/CRM.git
cd CRM
```
**Step 2: Install PHP Dependencies**  
```sh
composer install
```
**Step 3: Set Up Environment Variables**  
```sh
cp .env.example .env
```
**Step 4: Generate App Key**  
```sh
php artisan key:generate
```

**Step 5: Run Migrations & Seed Database**  
```sh
php artisan migrate --seed

```

**Step 6: Install JWT Authentication**  
```sh
composer require php-open-source-saver/jwt-auth
php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret

```

**Step 7: Start the Development Server**  
```sh
php artisan serve
```


## API Documentation

### **User Authentication**

#### **Register a New User**
- **Endpoint:** `POST /api/register`
- **Description:** Creates a new user (Admin or Counselor).

##### **Request Body (JSON)**
```json
{
  "name": "counselor E",
  "email": "E@example.com",
  "password": "hashed_password",
  "role": "counselor"
}
```

##### **Response(JSON)**
```json
{
    "status": "success",
    "message": "User created successfully",
    "user": {
        "name": "counselor E",
        "email": "E@example.com",
        "role": "counselor",
        "updated_at": "2025-02-17T08:18:05.000000Z",
        "created_at": "2025-02-17T08:18:05.000000Z",
        "id": 6
    },
    "authorisation": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNzM5NzgwMjg3LCJleHAiOjE3Mzk3ODM4ODcsIm5iZiI6MTczOTc4MDI4NywianRpIjoiT1laYTRyYVhYQ3BQcEN6diIsInN1YiI6IjYiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.0cCcgezb0uVJh8OyJyysD5P_wZRDztUh7Sltwq_zzUg",
        "type": "bearer"
    }
}
```

#### **Login**
- **Endpoint:** `POST /api/login`
- **Description:** Logs in the user and returns a JWT token.

##### **Request Body (JSON)**
```json
{
  "email": "admin@example.com",
  "password": "hashed_password"
}
```

##### **Response(JSON)**
```json
{
    "status": "success",
    "user": {
        "id": 1,
        "name": "elias hossain",
        "email": "admin@example.com",
        "role": "admin",
        "created_at": "2025-02-16T13:23:16.000000Z",
        "updated_at": "2025-02-16T13:23:16.000000Z"
    },
    "authorisation": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzM5NzgwNDcxLCJleHAiOjE3Mzk3ODQwNzEsIm5iZiI6MTczOTc4MDQ3MSwianRpIjoicGg4Q0xWbmZYcmdUR3ZwSyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.i6T8g2AzN5AvLbC7n0maWCkMfD9z8Ovo4hWOBEikIr8",
        "type": "bearer"
    }
}

```

### **Lead Management**
#### **Lead Creation**
- **Endpoint:** `POST /api/store`
- **Description:** Inserts new lead based on JWT and role based authentication

##### **Request Body (JSON)**
```json
{
  "name": "Lead 3",
  "contact_number": "01973111113",
  "email": "lead3@example.com",
  "status": "new",
  "assigned_to": "1"
}
```

##### **Response(JSON)**
```json
{
    "status": "success",
    "message": "Lead created successfully",
    "lead": {
        "name": "Lead 3",
        "contact_number": "01973111113",
        "email": "lead3@example.com",
        "status": "new",
        "assigned_to": "1",
        "updated_at": "2025-02-17T12:39:33.000000Z",
        "created_at": "2025-02-17T12:39:33.000000Z",
        "id": 6
    }
}

```

## ✅ Total Leads Assigned to Each Counselor
```sql
SELECT u.id AS counselor_id, 
       u.name AS counselor_name, 
       COUNT(l.id) AS total_leads
FROM users u
LEFT JOIN leads l ON u.id = l.assigned_to
WHERE u.role = 'counselor'
GROUP BY u.id, u.name
ORDER BY total_leads DESC;
```



## ✅ Counselors with the Highest Lead Conversion Rates

Assuming status = 'converted' means a lead was successfully closed.

```sql
SELECT u.id AS counselor_id, 
       u.name AS counselor_name, 
       COUNT(CASE WHEN l.status = 'converted' THEN 1 END) AS converted_leads,
       COUNT(l.id) AS total_leads,
       ROUND(
           (COUNT(CASE WHEN l.status = 'converted' THEN 1 END) / COUNT(l.id)) * 100, 
           2
       ) AS conversion_rate
FROM users u
LEFT JOIN leads l ON u.id = l.assigned_to
WHERE u.role = 'counselor'
GROUP BY u.id, u.name
HAVING total_leads > 0
ORDER BY conversion_rate DESC;
```






