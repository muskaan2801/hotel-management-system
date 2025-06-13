# hotel-management-system
# HotelSync - Hotel Management System

HotelSync is a comprehensive web-based hotel management system designed to streamline operations for small to medium-sized hotels. This PHP/MySQL application provides a user-friendly interface for managing all aspects of hotel operations including customer reservations, room inventory, staff management, services, check-ins/check-outs, payments, and maintenance requests.

## Key Features

- **Customer Management**: Track guest information including contact details and addresses
- **Room Inventory**: Manage room types, rates, availability, and floor assignments
- **Booking System**: Handle reservations with check-in/check-out dates and status tracking
- **Staff Management**: Maintain employee records with roles and contact information
- **Service Offerings**: Manage additional hotel services with pricing
- **Payment Processing**: Record and track payment transactions with various methods
- **Maintenance Logs**: Document and track room maintenance issues
- **Check-in/Check-out**: Streamline guest arrival and departure processes

## Technical Implementation

The system is built with:
- Frontend: HTML5, CSS3, JavaScript
- Backend: PHP with MySQL database
- Architecture: Client-server model with RESTful API endpoints
- Security: Basic authentication system (for demonstration purposes)

## Setup Instructions

1. Import the provided SQL file (`HMS MYSQL updated.sql`) to create the database structure and sample data
2. Configure database connection in `config.php` with your MySQL credentials
3. Deploy files to a PHP-enabled web server (Apache recommended)
4. Access the application through your web browser

## Usage

- Login with default credentials: admin/admin123
- Navigate through different sections using the top menu
- Add, edit, or delete records as needed
- Use the modal forms for data entry

## Project Structure

- `index.php` - Main application interface
- `api.php` - Backend API for data operations
- `config.php` - Database configuration
- `process_checkin.php` - Specialized check-in processing
- `process_payment.php` - Payment transaction handler
- `HMS MYSQL updated.sql` - Database schema and sample data

This project demonstrates full-stack development skills including database design, server-side programming, and responsive frontend implementation. The system is ready for deployment or can serve as a foundation for further customization.
