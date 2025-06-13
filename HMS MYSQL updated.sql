-- Create database
CREATE DATABASE IF NOT EXISTS hotel_management_system;
USE hotel_management_system;

-- Drop tables if they exist
DROP TABLE IF EXISTS maintenance;
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS checkouts;
DROP TABLE IF EXISTS checkins;
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS staff;
DROP TABLE IF EXISTS customer;

-- Create tables
CREATE TABLE customer (
    customerid INT PRIMARY KEY,
    fullname VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT
);

CREATE TABLE staff (
    staffid INT PRIMARY KEY,
    fullname VARCHAR(100),
    role VARCHAR(50),
    phone VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE rooms (
    roomid INT PRIMARY KEY,
    number VARCHAR(10),
    type VARCHAR(50),
    rate DECIMAL(10,2),
    status VARCHAR(20),
    floor INT
);

CREATE TABLE services (
    serviceid INT PRIMARY KEY,
    name VARCHAR(100),
    charge DECIMAL(10,2)
);

CREATE TABLE bookings (
    bookingid INT PRIMARY KEY,
    customerId INT,
    roomId INT,
    bookingDate DATE,
    checkin DATE,
    checkout DATE,
    status VARCHAR(50),
    FOREIGN KEY (customerId) REFERENCES customer(customerid),
    FOREIGN KEY (roomId) REFERENCES rooms(roomid)
);

CREATE TABLE checkins (
    checkinid INT PRIMARY KEY,
    bookingId INT,
    staffId INT,
    dt DATETIME,
    FOREIGN KEY (bookingId) REFERENCES bookings(bookingid),
    FOREIGN KEY (staffId) REFERENCES staff(staffid)
);

CREATE TABLE checkouts (
    checkoutid INT PRIMARY KEY,
    bookingId INT,
    staffId INT,
    dt DATETIME,
    FOREIGN KEY (bookingId) REFERENCES bookings(bookingid),
    FOREIGN KEY (staffId) REFERENCES staff(staffid)
);

CREATE TABLE payments (
    paymentsid INT PRIMARY KEY,
    bookingId INT,
    amount DECIMAL(10,2),
    date DATE,
    method VARCHAR(50),
    status VARCHAR(20),
    FOREIGN KEY (bookingId) REFERENCES bookings(bookingid)
);

CREATE TABLE maintenance (
    maintenanceid INT PRIMARY KEY,
    roomId INT,
    empId INT,
    issue TEXT,
    start DATE,
    endDate DATE,
    status VARCHAR(20),
    FOREIGN KEY (roomId) REFERENCES rooms(roomid),
    FOREIGN KEY (empId) REFERENCES staff(staffid)
);
----------------------------------------------------------------------------- 2nd execution
-- Insert statements go here (no change needed)
-- Copy and paste your full insert block here (already valid for MySQL)

INSERT INTO customer ( customerid, fullname, phone, email, address) VALUES
(1, 'Ahmed Khan', '+92-300-1234561', 'ahmed.khan@email.com', 'House 123, Gulberg, Lahore'),
(2, 'Fatima Ali', '+92-300-1234562', 'fatima.ali@email.com', 'Flat 456, Clifton, Karachi'),
(3, 'Hassan Raza', '+92-300-1234563', 'hassan.r@email.com', 'Plot 789, F-11, Islamabad'),
(4, 'Ayesha Siddiqui', '+92-300-1234564', 'ayesha.s@email.com', 'Street 321, Model Town, Lahore'),
(5, 'Bilal Ahmed', '+92-300-1234565', 'bilal.a@email.com', 'House 654, DHA, Karachi'),
(6, 'Sana Malik', '+92-300-1234566', 'sana.m@email.com', 'Villa 987, Bahria Town, Islamabad'),
(7, 'Umar Farooq', '+92-300-1234567', 'umar.f@email.com', 'Apartment 147, Johar Town, Lahore'),
(8, 'Zainab Butt', '+92-300-1234568', 'zainab.b@zemail.com', 'House 258, Gulshan, Karachi'),
(9, 'Imran Shah', '+92-300-1234569', 'imran.s@email.com', 'Plot 369, G-13, Islamabad'),
(10, 'Maryam Nawaz', '+92-300-1234570', 'maryam.n@email.com', 'Street 741, Cantt, Lahore');
SELECT * FROM customer;

-- Insert 10 records into staff with Pakistani names
INSERT INTO staff (staffid, fullname, role, phone, email) VALUES
(1, 'Asif Mehmood', 'Manager', '+92-300-2234561', 'asif.m@email.com'),
(2, 'Nida Yasir', 'Receptionist', '+92-300-2234562', 'nida.y@email.com'),
(3, 'Khalid Hussain', 'Housekeeping', '+92-300-2234563', 'khalid.h@email.com'),
(4, 'Sajid Iqbal', 'Maintenance', '+92-300-2234564', 'sajid.i@email.com'),
(5, 'Hina Rizvi', 'Concierge', '+92-300-2234565', 'hina.r@email.com'),
(6, 'Faisal Qureshi', 'Security', '+92-300-2234566', 'faisal.q@email.com'),
(7, 'Amna Sheikh', 'Receptionist', '+92-300-2234567', 'amna.s@email.com'),
(8, 'Waseem Akram', 'Housekeeping', '+92-300-2234568', 'waseem.a@email.com'),
(9, 'Rabia Anum', 'Manager', '+92-300-2234569', 'rabia.a@email.com'),
(10, 'Tariq Jamil', 'Maintenance', '+92-300-2234570', 'tariq.j@email.com');
SELECT * FROM staff;

-- Insert 10 records into rooms
INSERT INTO rooms (roomid, number, type, rate, status, floor) VALUES
(1, '101', 'Single', 7500.00, 'Available', 1),
(2, '102', 'Double', 12000.00, 'Occupied', 1),
(3, '201', 'Suite', 20000.00, 'Available', 2),
(4, '202', 'Single', 8000.00, 'Maintenance', 2),
(5, '301', 'Double', 13000.00, 'Available', 3),
(6, '302', 'Suite', 21000.00, 'Occupied', 3),
(7, '401', 'Single', 7000.00, 'Available', 4),
(8, '402', 'Double', 12500.00, 'Available', 4),
(9, '501', 'Suite', 22000.00, 'Occupied', 5),
(10, '502', 'Single', 8500.00, 'Available', 5);
SELECT * FROM rooms;

-- Insert 10 records into services
INSERT INTO services (serviceid, name, charge) VALUES
(1, 'Room Service', 1500.00),
(2, 'Laundry', 1000.00),
(3, 'Spa', 5000.00),
(4, 'Wi-Fi', 500.00),
(5, 'Minibar', 2000.00),
(6, 'Breakfast Buffet', 1200.00),
(7, 'Airport Shuttle', 2500.00),
(8, 'Gym Access', 800.00),
(9, 'Late Checkout', 3000.00),
(10, 'Parking', 1000.00);
SELECT * FROM services;


-- Insert 10 records into bookings
INSERT INTO bookings (bookingid, customerId, roomId, bookingDate, checkin, checkout, status) VALUES
(1, 1, 1, '2025-06-01', '2025-06-10', '2025-06-12', 'Confirmed'),
(2, 2, 2, '2025-06-02', '2025-06-11', '2025-06-14', 'Checked-in'),
(3, 3, 3, '2025-06-03', '2025-06-15', '2025-06-18', 'Confirmed'),
(4, 4, 5, '2025-06-04', '2025-06-12', '2025-06-15', 'Confirmed'),
(5, 5, 6, '2025-06-05', '2025-06-10', '2025-06-13', 'Checked-in'),
(6, 6, 7, '2025-06-06', '2025-06-16', '2025-06-19', 'Confirmed'),
(7, 7, 8, '2025-06-07', '2025-06-11', '2025-06-14', 'Confirmed'),
(8, 8, 9, '2025-06-08', '2025-06-13', '2025-06-16', 'Checked-in'),
(9, 9, 10, '2025-06-09', '2025-06-17', '2025-06-20', 'Confirmed'),
(10, 10, 1, '2025-06-10', '2025-06-18', '2025-06-21', 'Confirmed');
SELECT * FROM bookings;


-- Insert 10 records into checkins
INSERT INTO checkins (checkinid, bookingId, staffId, dt) VALUES
(1, 2, 2, '2025-06-11 14:00:00'),
(2, 5, 7, '2025-06-10 15:30:00'),
(3, 8, 2, '2025-06-13 13:45:00'),
(4, 2, 5, '2025-06-11 14:05:00'),
(5, 5, 1, '2025-06-10 15:35:00'),
(6, 8, 9, '2025-06-13 13:50:00'),
(7, 2, 7, '2025-06-11 14:10:00'),
(8, 5, 2, '2025-06-10 15:40:00'),
(9, 8, 5, '2025-06-13 13:55:00'),
(10, 2, 1, '2025-06-11 14:15:00');
SELECT * FROM checkins;

-- Insert 10 records into checkouts
INSERT INTO checkouts (checkoutid, bookingId, staffId, dt) VALUES
(1, 2, 2, '2025-06-14 11:00:00'),
(2, 5, 7, '2025-06-13 10:30:00'),
(3, 8, 2, '2025-06-16 12:00:00'),
(4, 2, 5, '2025-06-14 11:05:00'),
(5, 5, 1, '2025-06-13 10:35:00'),
(6, 8, 9, '2025-06-16 12:05:00'),
(7, 2, 7, '2025-06-14 11:10:00'),
(8, 5, 2, '2025-06-13 10:40:00'),
(9, 8, 5, '2025-06-16 12:10:00'),
(10, 2, 1, '2025-06-14 11:15:00');
SELECT * FROM checkouts;

-- Insert 10 records into payments
INSERT INTO payments (paymentsid, bookingId, amount, date, method, status) VALUES
(1, 1, 15000.00, '2025-06-01', 'Credit Card', 'Completed'),
(2, 2, 36000.00, '2025-06-02', 'Easypaisa', 'Completed'),
(3, 3, 60000.00, '2025-06-03', 'Credit Card', 'Pending'),
(4, 4, 39000.00, '2025-06-04', 'Cash', 'Completed'),
(5, 5, 63000.00, '2025-06-05', 'JazzCash', 'Completed'),
(6, 6, 21000.00, '2025-06-06', 'Debit Card', 'Pending'),
(7, 7, 37500.00, '2025-06-07', 'Credit Card', 'Completed'),
(8, 8, 66000.00, '2025-06-08', 'Cash', 'Completed'),
(9, 9, 25500.00, '2025-06-09', 'Easypaisa', 'Pending'),
(10, 10, 22500.00, '2025-06-10', 'JazzCash', 'Completed');
SELECT * FROM payments;

-- Insert 10 records into maintenance
INSERT INTO maintenance (maintenanceid, roomId, empId, issue, start, endDate, status) VALUES
(1, 4, 4, 'Leaky faucet', '2025-06-01', '2025-06-02', 'Completed'),
(2, 2, 10, 'Broken AC', '2025-06-03', '2025-06-04', 'In Progress'),
(3, 6, 4, 'Faulty light', '2025-06-05', '2025-06-06', 'Completed'),
(4, 9, 10, 'Clogged drain', '2025-06-07', '2025-06-08', 'Completed'),
(5, 1, 4, 'Window repair', '2025-06-09', '2025-06-10', 'In Progress'),
(6, 3, 10, 'Carpet stain', '2025-06-11', '2025-06-12', 'Scheduled'),
(7, 5, 4, 'Door lock issue', '2025-06-13', '2025-06-14', 'Completed'),
(8, 7, 10, 'TV not working', '2025-06-15', '2025-06-16', 'In Progress'),
(9, 8, 4, 'Heater malfunction', '2025-06-17', '2025-06-18', 'Scheduled'),
(10, 10, 10, 'Wall paint touch-up', '2025-06-19', '2025-06-20', 'Scheduled');
SELECT * FROM maintenance;




------------------------------------------------------------------------------ 3rd execution
-- DML Queries and Fixes

-- Get all customers from Lahore
SELECT * FROM customer WHERE address LIKE '%Lahore%';

-- List all available rooms
SELECT number, type, rate FROM rooms WHERE status = 'Available';

-- Show all staff with manager role
SELECT staffid, fullname, phone FROM staff WHERE role = 'Manager';

-- Find bookings with pending payments
SELECT b.bookingid, c.fullname, p.amount 
FROM bookings b
JOIN customer c ON b.customerId = c.customerid
JOIN payments p ON b.bookingid = p.bookingId
WHERE p.status = 'Pending';

-- Maintenance requests completed last week
SELECT * FROM maintenance 
WHERE status = 'Completed' 
AND endDate BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE();

-- Find VIP customers (more than 3 bookings)
SELECT c.customerid, c.fullname, COUNT(b.bookingid) AS booking_count
FROM customer c
JOIN bookings b ON c.customerid = b.customerId
GROUP BY c.customerid, c.fullname
HAVING COUNT(b.bookingid) > 3;

-- Update room rates (10% increase for suites)
UPDATE rooms 
SET rate = rate * 1.1 
WHERE type = 'Suite';

-- Change booking status to cancelled
UPDATE bookings 
SET status = 'Cancelled' 
WHERE bookingid = 5;

-- Update customer contact
UPDATE customer 
SET phone = '+92-300-7654321', email = 'updated.email@example.com'
WHERE customerid = 3;

-- Delete old maintenance records (older than 1 year)
DELETE FROM maintenance 
WHERE status = 'Completed' 
AND endDate < CURDATE() - INTERVAL 1 YEAR;
