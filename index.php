<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelSync - Management Dashboard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0077b6;
            --primary-light: #0096c7;
            --accent: #48cae4;
            --bg: #f6f9fc;
            --card-bg: #ffffff;
            --text-dark: #001219;
            --text-light: #5c677d;
            --radius: 12px;
            --shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            --transition: all 0.2s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--text-dark);
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
        }

        .login-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 40px;
            width: min(400px, 90%);
            box-shadow: var(--shadow);
            text-align: center;
        }

        .login-card h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 16px;
            text-align: left;
        }

        label {
            font-size: 14px;
            margin-bottom: 6px;
            display: block;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: var(--radius);
            transition: var(--transition);
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 119, 182, 0.2);
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 70px;
        }

        .btn {
            background: var(--primary);
            border: none;
            color: #fff;
            padding: 12px 24px;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn.w-full {
            width: 100%;
            justify-content: center;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            padding: 0 24px;
            height: 64px;
            box-shadow: var(--shadow);
        }

        .navbar h1 {
            font-size: 20px;
            font-weight: 600;
            margin-right: 48px;
            white-space: nowrap;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 24px;
            flex: 1;
        }

        .nav-links li {
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 6px;
            opacity: 0.9;
            transition: var(--transition);
        }

        .nav-links li:hover {
            opacity: 1;
            background: var(--primary-light);
        }

        .nav-links li.active {
            opacity: 1;
            background: var(--accent);
            font-weight: 600;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background: var(--primary-light);
        }

        main {
            padding: 32px;
            display: grid;
            gap: 42px;
        }

        section {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 32px;
            box-shadow: var(--shadow);
            display: none;
        }

        section.active {
            display: block;
        }

        section h2 {
            margin-bottom: 24px;
            font-size: 22px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        thead {
            background: var(--primary-light);
            color: #fff;
        }

        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #eaeaea;
        }

        tbody tr:nth-child(even) {
            background: #f1f5f9;
        }

        tbody tr:hover {
            background: #e6f0fa;
        }

        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: var(--transition);
        }

        .modal.active {
            visibility: visible;
            opacity: 1;
        }

        .modal-content {
            background: var(--card-bg);
            width: min(500px, 90%);
            border-radius: var(--radius);
            padding: 32px;
            position: relative;
            box-shadow: var(--shadow);
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-content h3 {
            margin-bottom: 16px;
            font-size: 20px;
            font-weight: 600;
        }

        .close {
            position: absolute;
            top: 16px;
            right: 20px;
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: var(--text-light);
            transition: var(--transition);
        }

        .close:hover {
            color: var(--primary);
        }

        .flex-row {
            display: flex;
            gap: 16px;
        }

        .flex-row .form-group {
            flex: 1;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }
    </style>
</head>
<body>
    <!-- Login Page -->
    <div id="loginPage" class="login-container">
        <div class="login-card">
            <h2>HotelSync Login</h2>
            <form id="loginForm" onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button class="btn w-full" type="submit">Login</button>
            </form>
        </div>
    </div>

    <!-- Admin Panel -->
    <div id="adminPanel" style="display: none;">
        <nav class="navbar">
            <h1>HotelSync Dashboard</h1>
            <ul class="nav-links" id="navbar">
                <li data-target="customers" class="active">Customers</li>
                <li data-target="staff">Staff</li>
                <li data-target="rooms">Rooms</li>
                <li data-target="services">Services</li>
                <li data-target="bookings">Bookings</li>
                <li data-target="checkins">Check-Ins</li>
                <li data-target="checkouts">Check-Outs</li>
                <li data-target="payments">Payments</li>
                <li data-target="maintenance">Maintenance</li>
            </ul>
            <button class="logout-btn" onclick="handleLogout()">Logout</button>
        </nav>

        <main>
            <!-- Customers Section -->
            <section id="customers" class="active">
                <h2>Customer Management</h2>
                <button class="btn" onclick="openModal('customerForm')">Add New Customer</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customersBody"></tbody>
                </table>
            </section>

            <!-- Staff Section -->
            <section id="staff">
                <h2>Staff Management</h2>
                <button class="btn" onclick="openModal('staffForm')">Add Staff Member</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="staffBody"></tbody>
                </table>
            </section>

            <!-- Rooms Section -->
            <section id="rooms">
                <h2>Room Inventory</h2>
                <button class="btn" onclick="openModal('roomForm')">Add New Room</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room Number</th>
                            <th>Type</th>
                            <th>Rate</th>
                            <th>Status</th>
                            <th>Floor</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="roomsBody"></tbody>
                </table>
            </section>

            <!-- Services Section -->
            <section id="services">
                <h2>Service Offerings</h2>
                <button class="btn" onclick="openModal('serviceForm')">Add New Service</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service Name</th>
                            <th>Charge</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="servicesBody"></tbody>
                </table>
            </section>

            <!-- Bookings Section -->
            <section id="bookings">
                <h2>Booking Management</h2>
                <button class="btn" onclick="openModal('bookingForm')">Create Booking</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer ID</th>
                            <th>Room ID</th>
                            <th>Booking Date</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="bookingsBody"></tbody>
                </table>
            </section>

            <!-- Check-In Section -->
            <section id="checkins">
                <h2>Check-In Records</h2>
                <button class="btn" onclick="openModal('checkinForm')">Record Check-In</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Booking ID</th>
                            <th>Staff ID</th>
                            <th>Date & Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="checkinsBody"></tbody>
                </table>
            </section>

            <!-- Check-Out Section -->
            <section id="checkouts">
                <h2>Check-Out Records</h2>
                <button class="btn" onclick="openModal('checkoutForm')">Record Check-Out</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Booking ID</th>
                            <th>Staff ID</th>
                            <th>Date & Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="checkoutsBody"></tbody>
                </table>
            </section>

            <!-- Payments Section -->
            <section id="payments">
                <h2>Payment Transactions</h2>
                <button class="btn" onclick="openModal('paymentForm')">Process Payment</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Booking ID</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="paymentsBody"></tbody>
                </table>
            </section>

            <!-- Maintenance Section -->
            <section id="maintenance">
                <h2>Maintenance Logs</h2>
                <button class="btn" onclick="openModal('maintenanceForm')">Log Maintenance Issue</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room ID</th>
                            <th>Employee ID</th>
                            <th>Issue</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="maintenanceBody"></tbody>
                </table>
            </section>
        </main>

        <!-- Modal -->
        <div class="modal" id="entityModal">
            <div class="modal-content" id="modalContent">
                <button class="close" onclick="closeModal()">×</button>
            </div>
        </div>
    </div>

    <script>
        // State Management
        const store = {
            customers: [],
            staff: [],
            rooms: [],
            services: [],
            bookings: [],
            checkins: [],
            checkouts: [],
            payments: [],
            maintenance: []
        };

        // Login Handling
        function handleLogin(e) {
            e.preventDefault();
            const username = e.target.username.value;
            const password = e.target.password.value;
            
            // Simple authentication (in production, use proper authentication)
            if (username === 'admin' && password === 'admin123') {
                localStorage.setItem('isLoggedIn', 'true');
                document.getElementById('loginPage').style.display = 'none';
                document.getElementById('adminPanel').style.display = 'block';
                loadInitialData();
            } else {
                alert('Invalid credentials. Try admin/admin123');
            }
        }

        // Logout Handling
        function handleLogout() {
            localStorage.removeItem('isLoggedIn');
            document.getElementById('adminPanel').style.display = 'none';
            document.getElementById('loginPage').style.display = 'flex';
        }

      // Check Login Status
window.onload = () => {
    if (localStorage.getItem('isLoggedIn') === 'true') {
        document.getElementById('loginPage').style.display = 'none';
        document.getElementById('adminPanel').style.display = 'block';
        loadInitialData();
    }
};

        // Load initial data from API
        function loadInitialData() {
            const tables = ['customers', 'staff', 'rooms', 'services', 'bookings', 'checkins', 'checkouts', 'payments', 'maintenance'];
            tables.forEach(table => {
                fetchData(table);
            });
        }



        // Fetch data from API
      function fetchData(table) {
    // Map the plural table names to singular for the API
    const tableMap = {
        'customers': 'customer',
        'staff': 'staff',
        'rooms': 'rooms',
        'services': 'services',
        'bookings': 'bookings',
        'checkins': 'checkins',
        'checkouts': 'checkouts',
        'payments': 'payments',
        'maintenance': 'maintenance'
    };
    
    const apiTable = tableMap[table] || table;
    
    fetch(`api.php?action=fetch&table=${apiTable}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            store[table] = data;
            renderTable(table);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert(`Error loading ${table} data. Check console for details.`);
        });
}

        // Navigation Handling
        const navLinks = document.querySelectorAll('.nav-links li');
        const sections = document.querySelectorAll('main > section');

        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navLinks.forEach(l => l.classList.remove('active'));
                sections.forEach(s => s.classList.remove('active'));
                link.classList.add('active');
                const targetId = link.dataset.target;
                document.getElementById(targetId)?.classList.add('active');
            });
        });

        // Modal Handling
        const modal = document.getElementById('entityModal');
        const modalContent = document.getElementById('modalContent');

        function openModal(formId) {
            const forms = {
                customerForm: `
                    <h3>Add New Customer</h3>
                    <form id="customerF" onsubmit="addCustomer(event)">
                        <div class="form-group"><label>Full Name</label><input required name="fullname"></div>
                        <div class="flex-row">
                            <div class="form-group"><label>Phone</label><input required name="phone" type="tel"></div>
                            <div class="form-group"><label>Email</label><input required type="email" name="email"></div>
                        </div>
                        <div class="form-group"><label>Address</label><textarea required name="address"></textarea></div>
                        <button class="btn" type="submit">Save Customer</button>
                    </form>`,
                staffForm: `
                    <h3>Add Staff Member</h3>
                    <form id="staffF" onsubmit="addStaff(event)">
                        <div class="form-group"><label>Full Name</label><input required name="fullname"></div>
                        <div class="flex-row">
                            <div class="form-group"><label>Role</label><input required name="role"></div>
                            <div class="form-group"><label>Phone</label><input required name="phone" type="tel"></div>
                        </div>
                        <div class="form-group"><label>Email</label><input required type="email" name="email"></div>
                        <button class="btn" type="submit">Save Staff</button>
                    </form>`,
                roomForm: `
                    <h3>Add New Room</h3>
                    <form id="roomF" onsubmit="addRoom(event)">
                        <div class="flex-row">
                            <div class="form-group"><label>Room Number</label><input required name="number"></div>
                            <div class="form-group"><label>Type</label><input required name="type"></div>
                        </div>
                        <div class="flex-row">
                            <div class="form-group"><label>Rate ($)</label><input required type="number" name="rate" step="0.01" min="0"></div>
                            <div class="form-group"><label>Floor</label><input required name="floor" type="number"></div>
                        </div>
                        <div class="form-group"><label>Status</label>
                            <select required name="status">
                                <option value="Available">Available</option>
                                <option value="Occupied">Occupied</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                        </div>
                        <button class="btn" type="submit">Save Room</button>
                    </form>`,
                serviceForm: `
                    <h3>Add New Service</h3>
                    <form id="serviceF" onsubmit="addService(event)">
                        <div class="form-group"><label>Service Name</label><input required name="name"></div>
                        <div class="form-group"><label>Charge ($)</label><input required type="number" name="charge" step="0.01" min="0"></div>
                        <button class="btn" type="submit">Save Service</button>
                    </form>`,
                bookingForm: `
                    <h3>Create Booking</h3>
                    <form id="bookingF" onsubmit="addBooking(event)">
                        <div class="flex-row">
                            <div class="form-group"><label>Customer ID</label><input required name="customerId" type="number" min="1"></div>
                            <div class="form-group"><label>Room ID</label><input required name="roomId" type="number" min="1"></div>
                        </div>
                        <div class="flex-row">
                            <div class="form-group"><label>Booking Date</label><input required type="date" name="bookingDate"></div>
                            <div class="form-group"><label>Check-In</label><input required type="date" name="checkin"></div>
                            <div class="form-group"><label>Check-Out</label><input required type="date" name="checkout"></div>
                        </div>
                        <div class="form-group"><label>Status</label>
                            <select required name="status">
                                <option value="Confirmed">Confirmed</option>
                                <option value="Checked-In">Checked-In</option>
                                <option value="Checked-Out">Checked-Out</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <button class="btn" type="submit">Save Booking</button>
                    </form>`,
                checkinForm: `
                    <h3>Record Check-In</h3>
                    <form id="checkinF" onsubmit="addCheckin(event)">
                        <div class="flex-row">
                            <div class="form-group"><label>Booking ID</label><input required name="bookingId" type="number" min="1"></div>
                            <div class="form-group"><label>Staff ID</label><input required name="staffId" type="number" min="1"></div>
                        </div>
                        <div class="form-group"><label>Date & Time</label><input required type="datetime-local" name="datetime"></div>
                        <button class="btn" type="submit">Save Check-In</button>
                    </form>`,
                checkoutForm: `
                    <h3>Record Check-Out</h3>
                    <form id="checkoutF" onsubmit="addCheckout(event)">
                        <div class="flex-row">
                            <div class="form-group"><label>Booking ID</label><input required name="bookingId" type="number" min="1"></div>
                            <div class="form-group"><label>Staff ID</label><input required name="staffId" type="number" min="1"></div>
                        </div>
                        <div class="form-group"><label>Date & Time</label><input required type="datetime-local" name="datetime"></div>
                        <button class="btn" type="submit">Save Check-Out</button>
                    </form>`,
                paymentForm: `
                    <h3>Process Payment</h3>
                    <form id="paymentF" onsubmit="addPayment(event)">
                        <div class="flex-row">
                            <div class="form-group"><label>Booking ID</label><input required name="bookingId" type="number" min="1"></div>
                            <div class="form-group"><label>Amount ($)</label><input required type="number" name="amount" step="0.01" min="0"></div>
                        </div>
                        <div class="flex-row">
                            <div class="form-group"><label>Payment Date</label><input required type="date" name="date"></div>
                            <div class="form-group"><label>Method</label>
                                <select required name="method">
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Debit Card">Debit Card</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label>Status</label>
                            <select required name="status">
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                                <option value="Failed">Failed</option>
                            </select>
                        </div>
                        <button class="btn" type="submit">Save Payment</button>
                    </form>`,
                maintenanceForm: `
                    <h3>Log Maintenance Issue</h3>
                    <form id="maintenanceF" onsubmit="addMaintenance(event)">
                        <div class="flex-row">
                            <div class="form-group"><label>Room ID</label><input required name="roomId" type="number" min="1"></div>
                            <div class="form-group"><label>Employee ID</label><input required name="empId" type="number" min="1"></div>
                        </div>
                        <div class="form-group"><label>Issue Description</label><textarea required name="issue"></textarea></div>
                        <div class="flex-row">
                            <div class="form-group"><label>Start Date</label><input required type="date" name="start"></div>
                            <div class="form-group"><label>End Date</label><input type="date" name="endDate"></div>
                        </div>
                        <div class="form-group"><label>Status</label>
                            <select required name="status">
                                <option value="Open">Open</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <button class="btn" type="submit">Save Maintenance Log</button>
                    </form>`
            };
            
            modalContent.innerHTML = `<button class="close" onclick="closeModal()">×</button>`;
            modalContent.insertAdjacentHTML('beforeend', forms[formId]);
            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        // Table Rendering
        function renderTable(type) {
    const body = document.getElementById(type + 'Body');
    if (!body) return;
    
    body.innerHTML = '';
    
    const idFieldMap = {
        'customers': 'customerid',
        'staff': 'staffid',
        'rooms': 'roomid',
        'services': 'serviceid',
        'bookings': 'bookingid',
        'checkins': 'checkinid',
        'checkouts': 'checkoutid',
        'payments': 'paymentsid',
        'maintenance': 'maintenanceid'
    };
    
    const idField = idFieldMap[type];
    
    store[type].forEach(item => {
        const row = document.createElement('tr');
        const idValue = item[idField];
        
        const cells = Object.entries(item).map(([key, value]) => {
            if (key === idField) return '';
            return `<td>${value ?? ''}</td>`;
        }).join('');
        
        row.innerHTML = `
            <td>${idValue}</td>
            ${cells}
            <td class="action-buttons">
                <button class="btn" onclick="editEntry('${type}', ${idValue})">Edit</button>
                <button class="btn" onclick="deleteEntry('${type}', ${idValue})">Delete</button>
            </td>
        `;
        
        body.appendChild(row);
    });
}

 function addCustomer(e) {
    e.preventDefault();
    const form = e.target;
    const customerData = {
        fullname: form.fullname.value,
        phone: form.phone.value,
        email: form.email.value,
        address: form.address.value
    };
    
    // Validate required fields
    if (!customerData.fullname || !customerData.phone || !customerData.email || !customerData.address) {
        alert('All fields are required');
        return;
    }

// In your addCustomer function, before calling addEntry
customerData.customerid = Math.floor(Math.random() * 1000000); // Generate a random ID

    
    addEntry('customer', customerData); // Changed to singular 'customer'
}


        // CRUD Operations
     function addEntry(type, data) {
    // Map the plural type names to singular for the API
    const tableMap = {
        'customers': 'customer',
        'staff': 'staff',
        'rooms': 'rooms',
        'services': 'services',
        'bookings': 'bookings',
        'checkins': 'checkins',
        'checkouts': 'checkouts',
        'payments': 'payments',
        'maintenance': 'maintenance'
    };
    
    const apiTable = tableMap[type] || type;
    
    fetch(`api.php?action=add&table=${apiTable}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            fetchData(type); // We use the original type here to update the store
            closeModal();
            alert(`${type.slice(0, -1)} added successfully!`);
        } else {
            alert(`Failed to add ${type.slice(0, -1)}: ${result.message || 'Unknown error'}`);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(`Error adding ${type.slice(0, -1)}: ${error.message}`);
    });
}


        

        function editEntry(type, id) {
            // Find the item in the store
            const idField = type === 'payments' ? 'paymentsid' : type.slice(0, -1) + 'id';
            const item = store[type].find(item => item[idField] === id);
            
            if (!item) {
                alert('Item not found');
                return;
            }
            
            // Open modal with edit form (similar to add but with prefilled values)
            const formId = type.slice(0, -1) + 'EditForm';
            const forms = {
                customerEditForm: `
                    <h3>Edit Customer</h3>
                    <form id="customerEditF" onsubmit="updateCustomer(event, ${id})">
                        <div class="form-group"><label>Full Name</label><input required name="fullname" value="${item.fullname || ''}"></div>
                        <div class="flex-row">
                            <div class="form-group"><label>Phone</label><input required name="phone" type="tel" value="${item.phone || ''}"></div>
                            <div class="form-group"><label>Email</label><input required type="email" name="email" value="${item.email || ''}"></div>
                        </div>
                        <div class="form-group"><label>Address</label><textarea required name="address">${item.address || ''}</textarea></div>
                        <button class="btn" type="submit">Update Customer</button>
                    </form>`,
                // Add similar edit forms for other types...

                // Add these to the forms object in the editEntry function
staffEditForm: `
    <h3>Edit Staff Member</h3>
    <form id="staffEditF" onsubmit="updateStaff(event, ${id})">
        <div class="form-group"><label>Full Name</label><input required name="fullname" value="${item.fullname || ''}"></div>
        <div class="flex-row">
            <div class="form-group"><label>Role</label><input required name="role" value="${item.role || ''}"></div>
            <div class="form-group"><label>Phone</label><input required name="phone" type="tel" value="${item.phone || ''}"></div>
        </div>
        <div class="form-group"><label>Email</label><input required type="email" name="email" value="${item.email || ''}"></div>
        <button class="btn" type="submit">Update Staff</button>
    </form>`,
roomEditForm: `
    <h3>Edit Room</h3>
    <form id="roomEditF" onsubmit="updateRoom(event, ${id})">
        <div class="flex-row">
            <div class="form-group"><label>Room Number</label><input required name="number" value="${item.number || ''}"></div>
            <div class="form-group"><label>Type</label><input required name="type" value="${item.type || ''}"></div>
        </div>
        <div class="flex-row">
            <div class="form-group"><label>Rate ($)</label><input required type="number" name="rate" step="0.01" min="0" value="${item.rate || ''}"></div>
            <div class="form-group"><label>Floor</label><input required name="floor" type="number" value="${item.floor || ''}"></div>
        </div>
        <div class="form-group"><label>Status</label>
            <select required name="status">
                <option value="Available" ${item.status === 'Available' ? 'selected' : ''}>Available</option>
                <option value="Occupied" ${item.status === 'Occupied' ? 'selected' : ''}>Occupied</option>
                <option value="Maintenance" ${item.status === 'Maintenance' ? 'selected' : ''}>Maintenance</option>
            </select>
        </div>
        <button class="btn" type="submit">Update Room</button>
    </form>`,
serviceEditForm: `
    <h3>Edit Service</h3>
    <form id="serviceEditF" onsubmit="updateService(event, ${id})">
        <div class="form-group"><label>Service Name</label><input required name="name" value="${item.name || ''}"></div>
        <div class="form-group"><label>Charge ($)</label><input required type="number" name="charge" step="0.01" min="0" value="${item.charge || ''}"></div>
        <button class="btn" type="submit">Update Service</button>
    </form>`,
bookingEditForm: `
    <h3>Edit Booking</h3>
    <form id="bookingEditF" onsubmit="updateBooking(event, ${id})">
        <div class="flex-row">
            <div class="form-group"><label>Customer ID</label><input required name="customerId" type="number" min="1" value="${item.customerid || ''}"></div>
            <div class="form-group"><label>Room ID</label><input required name="roomId" type="number" min="1" value="${item.roomid || ''}"></div>
        </div>
        <div class="flex-row">
            <div class="form-group"><label>Booking Date</label><input required type="date" name="bookingDate" value="${item.bookingdate || ''}"></div>
            <div class="form-group"><label>Check-In</label><input required type="date" name="checkin" value="${item.checkin || ''}"></div>
            <div class="form-group"><label>Check-Out</label><input required type="date" name="checkout" value="${item.checkout || ''}"></div>
        </div>
        <div class="form-group"><label>Status</label>
            <select required name="status">
                <option value="Confirmed" ${item.status === 'Confirmed' ? 'selected' : ''}>Confirmed</option>
                <option value="Checked-In" ${item.status === 'Checked-In' ? 'selected' : ''}>Checked-In</option>
                <option value="Checked-Out" ${item.status === 'Checked-Out' ? 'selected' : ''}>Checked-Out</option>
                <option value="Cancelled" ${item.status === 'Cancelled' ? 'selected' : ''}>Cancelled</option>
            </select>
        </div>
        <button class="btn" type="submit">Update Booking</button>
    </form>`,
checkinEditForm: `
    <h3>Edit Check-In</h3>
    <form id="checkinEditF" onsubmit="updateCheckin(event, ${id})">
        <div class="flex-row">
            <div class="form-group"><label>Booking ID</label><input required name="bookingId" type="number" min="1" value="${item.bookingid || ''}"></div>
            <div class="form-group"><label>Staff ID</label><input required name="staffId" type="number" min="1" value="${item.staffid || ''}"></div>
        </div>
        <div class="form-group"><label>Date & Time</label><input required type="datetime-local" name="datetime" value="${item.dt || ''}"></div>
        <button class="btn" type="submit">Update Check-In</button>
    </form>`,
checkoutEditForm: `
    <h3>Edit Check-Out</h3>
    <form id="checkoutEditF" onsubmit="updateCheckout(event, ${id})">
        <div class="flex-row">
            <div class="form-group"><label>Booking ID</label><input required name="bookingId" type="number" min="1" value="${item.bookingid || ''}"></div>
            <div class="form-group"><label>Staff ID</label><input required name="staffId" type="number" min="1" value="${item.staffid || ''}"></div>
        </div>
        <div class="form-group"><label>Date & Time</label><input required type="datetime-local" name="datetime" value="${item.dt || ''}"></div>
        <button class="btn" type="submit">Update Check-Out</button>
    </form>`,
paymentEditForm: `
    <h3>Edit Payment</h3>
    <form id="paymentEditF" onsubmit="updatePayment(event, ${id})">
        <div class="flex-row">
            <div class="form-group"><label>Booking ID</label><input required name="bookingId" type="number" min="1" value="${item.bookingid || ''}"></div>
            <div class="form-group"><label>Amount ($)</label><input required type="number" name="amount" step="0.01" min="0" value="${item.amount || ''}"></div>
        </div>
        <div class="flex-row">
            <div class="form-group"><label>Payment Date</label><input required type="date" name="date" value="${item.date || ''}"></div>
            <div class="form-group"><label>Method</label>
                <select required name="method">
                    <option value="Cash" ${item.method === 'Cash' ? 'selected' : ''}>Cash</option>
                    <option value="Credit Card" ${item.method === 'Credit Card' ? 'selected' : ''}>Credit Card</option>
                    <option value="Debit Card" ${item.method === 'Debit Card' ? 'selected' : ''}>Debit Card</option>
                    <option value="Bank Transfer" ${item.method === 'Bank Transfer' ? 'selected' : ''}>Bank Transfer</option>
                </select>
            </div>
        </div>
        <div class="form-group"><label>Status</label>
            <select required name="status">
                <option value="Pending" ${item.status === 'Pending' ? 'selected' : ''}>Pending</option>
                <option value="Completed" ${item.status === 'Completed' ? 'selected' : ''}>Completed</option>
                <option value="Failed" ${item.status === 'Failed' ? 'selected' : ''}>Failed</option>
            </select>
        </div>
        <button class="btn" type="submit">Update Payment</button>
    </form>`,
maintenanceEditForm: `
    <h3>Edit Maintenance Log</h3>
    <form id="maintenanceEditF" onsubmit="updateMaintenance(event, ${id})">
        <div class="flex-row">
            <div class="form-group"><label>Room ID</label><input required name="roomId" type="number" min="1" value="${item.roomid || ''}"></div>
            <div class="form-group"><label>Employee ID</label><input required name="empId" type="number" min="1" value="${item.empid || ''}"></div>
        </div>
        <div class="form-group"><label>Issue Description</label><textarea required name="issue">${item.issue || ''}</textarea></div>
        <div class="flex-row">
            <div class="form-group"><label>Start Date</label><input required type="date" name="start" value="${item.start || ''}"></div>
            <div class="form-group"><label>End Date</label><input type="date" name="endDate" value="${item.enddate || ''}"></div>
        </div>
        <div class="form-group"><label>Status</label>
            <select required name="status">
                <option value="Open" ${item.status === 'Open' ? 'selected' : ''}>Open</option>
                <option value="In Progress" ${item.status === 'In Progress' ? 'selected' : ''}>In Progress</option>
                <option value="Completed" ${item.status === 'Completed' ? 'selected' : ''}>Completed</option>
            </select>
        </div>
        <button class="btn" type="submit">Update Maintenance Log</button>
    </form>`
            };
            
            modalContent.innerHTML = `<button class="close" onclick="closeModal()">×</button>`;
            modalContent.insertAdjacentHTML('beforeend', forms[formId]);
            modal.classList.add('active');
        }

       function updateEntry(type, id, data) {
    // Map the plural type names to singular for the API
    const tableMap = {
        'customers': 'customer',
        'staff': 'staff',
        'rooms': 'rooms',
        'services': 'services',
        'bookings': 'bookings',
        'checkins': 'checkins',
        'checkouts': 'checkouts',
        'payments': 'payments',
        'maintenance': 'maintenance'
    };
    
    const apiTable = tableMap[type] || type;
    const idField = type === 'payments' ? 'paymentsid' : apiTable.slice(0, -1) + 'id';
    
    fetch(`api.php?action=update&table=${apiTable}&id=${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            fetchData(type);
            closeModal();
            alert(`${type.slice(0, -1)} updated successfully!`);
        } else {
            alert(`Failed to update ${type.slice(0, -1)}`);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(`Error updating ${type.slice(0, -1)}: ${error.message}`);
    });
}
function deleteEntry(type, id) {
    if (!confirm(`Are you sure you want to delete this ${type.slice(0, -1)}?`)) return;
    
    const tableMap = {
        'customers': 'customer',
        'staff': 'staff',
        'rooms': 'rooms',
        'services': 'services',
        'bookings': 'bookings',
        'checkins': 'checkins',
        'checkouts': 'checkouts',
        'payments': 'payments',
        'maintenance': 'maintenance'
    };
    
    const apiTable = tableMap[type] || type;
    const idField = type === 'payments' ? 'paymentsid' : apiTable.slice(0, -1) + 'id';
    
    fetch(`api.php?action=delete&table=${apiTable}&id=${id}`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            fetchData(type);
            alert(`${type.slice(0, -1)} deleted successfully!`);
        } else {
            alert(`Failed to delete ${type.slice(0, -1)}`);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(`Error deleting ${type.slice(0, -1)}: ${error.message}`);
    });
}

        // Form Handlers
      function addCustomer(e) {
    e.preventDefault();
    const form = e.target;
    const customerData = {
        customerid: Math.floor(Math.random() * 1000000), // Generate random ID
        fullname: form.fullname.value,
        phone: form.phone.value,
        email: form.email.value,
        address: form.address.value
    };
    
    addEntry('customer', customerData);
}

        function updateCustomer(e, id) {
            e.preventDefault();
            const form = e.target;
            updateEntry('customers', id, {
                fullname: form.fullname.value,
                phone: form.phone.value,
                email: form.email.value,
                address: form.address.value
            });
        }

        function addStaff(e) {
            e.preventDefault();
            const form = e.target;
            addEntry('staff', {
                fullname: form.fullname.value,
                role: form.role.value,
                phone: form.phone.value,
                email: form.email.value
            });
        }

        function addRoom(e) {
            e.preventDefault();
            const form = e.target;
            addEntry('rooms', {
                number: form.number.value,
                type: form.type.value,
                rate: parseFloat(form.rate.value).toFixed(2),
                status: form.status.value,
                floor: parseInt(form.floor.value)
            });
        }

        function addService(e) {
            e.preventDefault();
            const form = e.target;
            addEntry('services', {
                name: form.name.value,
                charge: parseFloat(form.charge.value).toFixed(2)
            });
        }

        function addBooking(e) {
            e.preventDefault();
            const form = e.target;
            addEntry('bookings', {
                customerId: parseInt(form.customerId.value),
                roomId: parseInt(form.roomId.value),
                bookingDate: form.bookingDate.value,
                checkin: form.checkin.value,
                checkout: form.checkout.value,
                status: form.status.value
            });
        }

        function addCheckin(e) {
            e.preventDefault();
            const form = e.target;
            addEntry('checkins', {
                bookingId: parseInt(form.bookingId.value),
                staffId: parseInt(form.staffId.value),
                dt: form.datetime.value
            });
        }

        function addCheckout(e) {
            e.preventDefault();
            const form = e.target;
            addEntry('checkouts', {
                bookingId: parseInt(form.bookingId.value),
                staffId: parseInt(form.staffId.value),
                dt: form.datetime.value
            });
        }

        function addPayment(e) {
            e.preventDefault();
            const form = e.target;
            addEntry('payments', {
                bookingId: parseInt(form.bookingId.value),
                amount: parseFloat(form.amount.value).toFixed(2),
                date: form.date.value,
                method: form.method.value,
                status: form.status.value
            });
        }

        function addMaintenance(e) {
            e.preventDefault();
            const form = e.target;
            addEntry('maintenance', {
                roomId: parseInt(form.roomId.value),
                empId: parseInt(form.empId.value),
                issue: form.issue.value,
                start: form.start.value,
                endDate: form.endDate.value || null,
                status: form.status.value
            });
        }
    </script>
</body>
</html>