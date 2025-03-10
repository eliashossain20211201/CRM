# Project mini CRM System

## Installation

### Backend (Laravel, MySQL):

**Prerequisites**  
Ensure your system meets the following requirements before installation:  
- **PHP 8.1+**  
- **Composer** (PHP dependency manager)  
- **Laravel 10+**  
- **MySQL 8+** or **MariaDB 10.6+**  
- **Apache**

#### **Setup Steps**
**Step 1: Clone the Repository**  
```sh
git clone https://github.com/eliashossain20211201/CRM.git
cd CRM\crmbhe
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

## DSA Task (PHP)

### SQL Query:

```sql
SELECT processed_by AS counselor_id, 
       COUNT(id) AS total_applications 
FROM applications 
WHERE processed_at >= NOW() - INTERVAL 30 DAY
GROUP BY processed_by 
ORDER BY total_applications DESC 
LIMIT 1;

```


### PHP Function:

```php
function getMostActiveCounselor() {
    // Database connection
    $pdo = new PDO("mysql:host=localhost;dbname=crmbhe", "root", "");

    // SQL Query
    $sql = "SELECT processed_by AS counselor_id, 
                   COUNT(id) AS total_applications 
            FROM applications 
            WHERE processed_at >= NOW() - INTERVAL 30 DAY
            GROUP BY processed_by 
            ORDER BY total_applications DESC 
            LIMIT 1";

    // Execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return "Most Active Counselor: ID " . $result['counselor_id'] . " with " . $result['total_applications'] . " applications processed.";
    } else {
        return "No applications processed in the last 30 days.";
    }
}

// Example usage
echo getMostActiveCounselor();
```


## Vue.js Frontend - CRM System

### **Prerequisites**

Ensure you have the following installed before proceeding:
- Node.js (v16 or later)
- npm (comes with Node.js)
- Vue CLI (Globally installed)

### **Setup Steps**

**Clone the Repository**

```sh
git clone https://github.com/eliashossain20211201/CRM.git
cd CRM\crmfrontend
```

**Install Vue CLI globally (if not installed)**

	npm install -g @vue/cli

**Install dependencies**

	npm install axios vuex vue-router vue-draggable-next

**Laravel Backend Integration**

- Modify axios.js and Adjust this URL for your backend:

axios.defaults.baseURL = 'http://localhost:8000/api';  

- Modify index.js inside store directory with the following:

```js
  actions: {
    fetchLeads({ commit }) {
      axios.get('http://localhost:8000/api/leads') // Change this to your backend endpoint
        .then(response => {
          commit('setLeads', response.data);
        });
    },
    fetchApplications({ commit }) {
      axios.get('http://localhost:8000/api/applications') // Change this to your backend endpoint
        .then(response => {
          commit('setApplications', response.data);
        });
    },
    fetchCounselors({ commit }) {
      axios.get('http://localhost:8000/api/counselors') // Change this to your backend endpoint
        .then(response => {
          commit('setCounselors', response.data);
        });
    },
    fetchCurrentUser({ commit }) {
      axios.get('http://localhost:8000/api/user') // Change this to your backend endpoint
        .then(response => {
          commit('setCurrentUser', response.data);
        });
    },
  },
```
#### **Run the development server**
	npm run serve

