# Slim Starter

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Usage](#usage)
- [License](#license)

## Overview
Slim Starter is a lightweight blog system built with PHP and the Slim framework. It enables users to browse blog posts, view detailed post information, and manage comments. Designed for simplicity and flexibility, the system uses the Blade templating engine and adheres to an MVC architecture, making it easy to extend and customize.

### Features
- **Blog Post Management**: View, create, edit, update, and delete blog posts.
- **Comment Management**: Add, edit, update, and delete comments on blog posts.
- **User Authentication**: Supports registration, login, and session-based authentication.
- **Authorization Middleware**: Restricts post and comment management to authenticated users.
- **Blade Templating Engine**: Utilizes Blade for dynamic and clean views.
- **MVC Architecture**: Implements the Model-View-Controller pattern for organized code.

## Usage
1. **Setup and Deployment**:
    - Clone the repository locally.
    - Ensure PHP 8.3+ is installed.
    - Run `composer install` to set up dependencies.
    - Configure your database (e.g., MySQL or PostgreSQL) for posts and comments.
    - Adjust environment variables and database settings in the configuration files.
    - Launch the app using your web server (e.g., Apache, Nginx, or PHP's built-in server).

2. **Access the Application**:
    - Access the app at `http://localhost:8000` or your configured local URL.

3. **Interacting with the Application**:
    - **GET** `/`: View all blog posts on the homepage.
    - **GET** `/posts/{id}`: View a blog post's details.
    - **GET** `/posts/create`: Access the form to create a new blog post.
    - **POST** `/posts`: Save a new blog post.
    - **GET** `/posts/{id}/edit`: Access the form to edit an existing blog post.
    - **PUT** `/posts/{id}`: Update a blog post.
    - **DELETE** `/posts/{id}`: Remove a blog post.
    - **POST** `/comments`: Add a comment to a blog post.
    - **GET** `/comments/{id}/edit`: Access the form to edit a comment.
    - **PUT** `/comments/{id}`: Update a comment.
    - **DELETE** `/comments/{id}`: Remove a comment.
    - **GET** `/login`: Display the login form.
    - **POST** `/login`: Log in to the system.
    - **GET** `/register`: Access the registration form.
    - **POST** `/register`: Register a new account.
    - **GET** `/logout`: Log out of the system.

## License
This project is licensed under the MIT License. For more details, see the [LICENSE](LICENSE) file.