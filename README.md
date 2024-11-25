
# Marker Maps

Welcome! This document provides step-by-step instructions to set up and run this Laravel project on your local machine.

## **Prerequisites**
Before starting, ensure you have the following installed:
- [PHP](https://www.php.net/) (version 8.1 or higher)
- [Composer](https://getcomposer.org/)
- [Node.js and NPM](https://nodejs.org/)
- A web server (e.g., Apache or Nginx) or use Laravel's built-in server
- A database system (e.g., MySQL, PostgreSQL)

---

![](https://i.ibb.co.com/QnfkZCs/screencapture-127-0-0-1-8000-dashboard-2024-11-25-18-10-24.png)


## Run Locally

Clone the project

```bash
  git clone https://link-to-project](https://github.com/luthfi55/Marker-Maps.git
```

Go to the project directory

```bash
  cd Marker-Maps
```
Copy .env

```bash
  cp .env.example .env
```
Add Mapbox Token in .env

![](https://i.ibb.co.com/9wW6yZq/Screenshot-2024-11-25-at-18-57-56.png)

Install dependencies

```bash
  composer install
```

```bash
  npm install
```

```bash
  npm run build
```

Database Migration

```bash
  php artisan migrate
```

Start Server

```bash
  php artisan serve
```


## Feature

Marker Detail:

![](https://i.ibb.co.com/s5rTxqH/Screenshot-2024-11-25-at-18-52-06.png)

Filtering Data by Category:

![](https://i.ibb.co.com/vQfWvbL/screencapture-127-0-0-1-8000-dashboard-2024-11-25-18-11-47.png)


![](https://i.ibb.co.com/3c5NsH0/screencapture-127-0-0-1-8000-dashboard-2024-11-25-18-13-57.png)

Thank you for using this project! ☺️☺️
