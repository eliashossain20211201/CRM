# Project MINI CRM System

## Overview
A mini CRM system where:  
- Leads are received and assigned to Counselors by an Admin. Let's say there will be four counsellors and one admin in this system.
- When assigned counsellors start contacting leads, they would be able to change the lead status according to their conversation like "In progress", "Bad Timing", "Not Interested", and "Not Qualified".
- If any lead is interested and move forward with their application, Our counsellor would have the ability to move them to application section.
- In application section, assigned counsellor will select application status like "In Progress", "Approved", and "Rejection" according to the situation.

### Requirements:
Backend (Laravel, MySQL):
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
### Prerequisites
- List any dependencies or software (e.g., Node.js, Python).

### Setup
1. Clone the repository.
2. Install dependencies.
3. Run the project.

## API Documentation
- **GET /api/users**: Fetches the list of users.
- **POST /api/users**: Creates a new user.

## Usage
- Example of how to use the project.

