<div align="center">
  <h1>🏢 Paramitra ERP System</h1>
  <p>An Integrated, Automated, and User-Friendly Enterprise Resource Planning System</p>
  
  <p>
    <img src="https://img.shields.io/badge/Status-Production%20Ready-brightgreen?style=for-the-badge" alt="Status" />
    <img src="https://img.shields.io/badge/Framework-Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
    <img src="https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
    <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="License" />
  </p>
</div>

<br>

## 📑 Table of Contents
- [👋 About The Project](#-about-the-project)
- [✨ Key Features](#-key-features)
- [🛠️ Built With](#-built-with)
- [🚀 Getting Started (Installation)](#-getting-started-installation)
- [🔑 Test Credentials](#-test-credentials)
- [📂 Detailed Documentation](#-detailed-documentation)
- [📜 License](#-license)

<br>

---

## 👋 About The Project
Welcome to the official repository of the **PT Paramitra Praya Prawatya ERP System**. 
This application is purposefully built to digitally transform and automate company operations. From customer sales orders and logistics tracking to supply chain management and automated monthly financial reporting, this system handles the complete business lifecycle.

Despite its enterprise-grade capabilities, the system is designed with a **highly intuitive user interface (UI)**, ensuring a zero learning curve even for non-technical staff.

---

## ✨ Key Features

This system caters to 3 primary user roles: **Management**, **Operational Staff (Admin)**, and **Customers**.

### 🛒 1. Frictionless Ordering & E-Commerce
- **Online Catalog**: Customers can browse product availability, view pricing, and seamlessly checkout.
- **Dynamic Fast-Form**: For offline orders, staff can utilize a dynamic Javascript-powered form to add dozens of product rows instantly without page reloads.

### 🧾 2. Smart Logistics (QR Code) & Automated Invoicing
- **One-Click Invoicing**: Approving a customer's payment automatically generates an industry-standard PDF Invoice.
- **QR Code Delivery Validation**: Generated Delivery Orders (Surat Jalan) contain a unique QR Code. Upon physical delivery, customers simply scan the QR code using their smartphone camera to validate the delivery in real-time.

### 🏭 3. Warehouse & Supply Chain Management
- **Purchase Orders**: Staff can draft official purchase orders to external factory suppliers.
- **Automated Stock Ingestion**: When supplier shipments arrive, a Goods Receipt form validates the physical count. Approving this form instantly increments warehouse stock and securely logs the expenditure to the financial ledger.

### 📊 4. Executive Analytics Dashboard
- **Real-Time Financial Charts**: A visually stunning Chart.js dashboard provides management with instant comparisons between revenue and expenditures.
- **Print-Friendly CSS**: Pressing `Ctrl + P` strips the UI of colors and sidebars, rendering a crisp, black-and-white financial report optimized for office printers.

---

## 🛠️ Built With
This project leverages modern web technologies to ensure performance, security, and scalability:
- **[Laravel](https://laravel.com/)** - The PHP framework for web artisans.
- **[MySQL](https://www.mysql.com/)** - Relational database management system.
- **[Chart.js](https://www.chartjs.org/)** - For dynamic data visualization.
- **[SimpleSoftwareIO/QrCode](https://www.simplesoftware.io/#/docs/qrcode)** - For QR code generation in PDF documents.

---

## 🚀 Getting Started (Installation)

Since this repository will ignore dependencies (like `vendor/` and `.env`), follow these standard Laravel installation steps to run the project locally.

### Prerequisites
Make sure you have the following installed on your machine:
- **PHP** >= 8.1
- **Composer**
- **Node.js** & **NPM**
- **MySQL** (via XAMPP/Laragon)

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/paramitra-app.git
   cd paramitra-app
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install NPM Dependencies & Compile Assets**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**
   Copy the example environment file and set up your database credentials inside `.env`:
   ```bash
   cp .env.example .env
   ```
   *(Make sure to create an empty database named `paramitra_app` in your MySQL server before proceeding).*

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations and Seeders**
   This command will build the database tables and populate them with dummy data (including the test accounts).
   ```bash
   php artisan migrate --seed
   ```

7. **Serve the Application**
   ```bash
   php artisan serve
   ```
   Open your browser and visit `http://localhost:8000`.

---

## 🔑 Test Credentials
Explore the system's role-based access control using the following seeded accounts (Password for all accounts is: **password**):

- **Operational Staff (Admin)**: `admin@paramitra.com`
- **Management (Executive)**: `management@paramitra.com`
- **Customer**: `customer@paramitra.com`

---

## 📂 Detailed Documentation
For detailed operational workflows, technical instructions, and migration guides, please refer to the supplementary documentation file:
- 📖 [SYSTEM_DOCUMENTATION.txt](SYSTEM_DOCUMENTATION.txt)

---

## 📜 License
Distributed under the MIT License. See `LICENSE` for more information.

---
*Developed with a commitment to the digital advancement of PT Paramitra Praya Prawatya.* 🚀
