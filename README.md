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
### Prerequisites
- List any dependencies or software (e.g., Node.js, Python).

### Setup
1. Clone the repository.
2. Install dependencies.
3. Run the project.

## API Documentation
https://private-user-images.githubusercontent.com/119109348/413774371-40035d64-ef2f-43dd-9cef-30931cbeeecd.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3Mzk3ODEzMTAsIm5iZiI6MTczOTc4MTAxMCwicGF0aCI6Ii8xMTkxMDkzNDgvNDEzNzc0MzcxLTQwMDM1ZDY0LWVmMmYtNDNkZC05Y2VmLTMwOTMxY2JlZWVjZC5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjUwMjE3JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI1MDIxN1QwODMwMTBaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT1lYThjNmU1NTUwYWMyMjVmZmQzYjYwMzZlOWFiYjgzYjMyYmFkMjg2YjNlZjM1Y2ZhNzdkOTRkOGY1MzczNGI3JlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCJ9.-5Eb0Z64q1HMYaW4wwkfePrzc2A1KlD6D6CtQ1B10Pg

- **GET /api/leads**: Fetches the list of leads available.
- **POST /api/register**: Creates a new user. Admin or counselor.



## Usage
- Example of how to use the project.

