# myNews-laravel10

A simple and powerful blog application built with Laravel 10, featuring user authentication, CRUD operations for blog posts, responsive design, rich text editing, and image uploads.

Welcome to the Blog Laravel 10 project! This repository contains a simple blog application built with Laravel 10. The application allows users to create, edit, and delete blog posts, as well as view a list of all posts.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Running Tests](#running-tests)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgments](#acknowledgments)

## Features

- User authentication and authorization
- Create, read, update, and delete (CRUD) operations for blog posts
- Responsive design with Bootstrap
- Pagination for blog posts
- Rich text editor for creating posts
- Image upload functionality

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.0
- Composer
- MySQL or another supported database
- Node.js and npm

## Installation
First register on https://mailtrap.io/ for testing mail
Then go to MyInbox and copy your username and password in credentials for testing email

paste in .env file your copied data to username and password

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=	
	
Follow these steps to set up the project locally:

1. **Clone the repository:**

    ```bash
    git clone https://github.com/mrxkhan57/myNews.git
    cd myNews
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    ```

3. **Set up the environment variables:**

    Copy the `.env.example` file to `.env` and update the database credentials and other necessary configuration.

    ```bash
    cp .env.example .env
    ```

4. **Generate application key:**

    ```bash
    php artisan key:generate
    ```

5. **Run migrations and seed the database:**

    ```bash
    php artisan migrate --seed
    ```

6. **Build front-end assets:**

    ```bash
    npm run dev
    ```

7. **Start the development server:**

    ```bash
    php artisan serve
    ```

    The application will be available at `http://localhost:8000`.

## Usage

Once the server is running, you can register a new user or log in with an existing account. You will be able to create, edit, and delete blog posts. The home page displays a list of all blog posts with pagination.

## Running Tests

To run the tests, use the following command:

```bash
php artisan test
```

## Contributing

Contributions are welcome! Please follow these steps to contribute:

1. **Fork the repository**
2. Create a new branch (`git checkout -b feature-branch`)
3. Make your changes
4. Commit your changes (`git commit -m 'Add some feature'`)
5. Push to the branch (`git push origin feature-branch`)
6. Open a pull request

Please make sure to update tests as appropriate.


## Acknowledgments

- [Laravel](https://laravel.com/)
- [Mailtrap](https://mailtrap.io/)
- [Bootstrap](https://getbootstrap.com/)
- [TinyMCE](https://www.tiny.cloud/)
- [FontAwesome](https://fontawesome.com/)
- All contributors and supporters of this project


## API Usage

API Endpoints

Blog#

GET /api/v1/blogs - Get all blog posts
POST /api/v1/blogs - Create a new blog post
GET /api/v1/blogs/{id} - Get a single blog post
PUT /api/v1/blogs/{id} - Update a blog post
DELETE /api/v1/blogs/{id} - Delete a blog post

Category#

GET /api/v1/categories - Get all categories
POST /api/v1/categories - Create a new category
GET /api/v1/categories/{id} - Get a single category
PUT /api/v1/categories/{id} - Update a category
DELETE /api/v1/categories/{id} - Delete a category

User#

GET /api/v1/users - Get all users
POST /api/v1/users - Create a new user
GET /api/v1/users/{id} - Get a single user
PUT /api/v1/users/{id} - Update a user
DELETE /api/v1/users/{id} - Delete a user