<div align="center">
  <h1>🏢 Paramitra ERP System</h1>
  <p>An Integrated, Automated, and User-Friendly Enterprise Resource Planning System</p>
  
  <p>
    <img src="https://img.shields.io/badge/Status-Production%20Ready-brightgreen?style=for-the-badge" alt="Status" />
    <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="License" />
    <img src="https://img.shields.io/badge/Language-PHP_Laravel-orange?style=for-the-badge" alt="Language" />
  </p>
</div>

<br>

## 📑 Table of Contents
- [👋 About The Project](#-about-the-project)
- [✨ Key Features](#-key-features)
- [🚀 Quick Start (Installation)](#-quick-start-installation)
- [🔑 Test Credentials](#-test-credentials)
- [📂 Detailed Documentation](#-detailed-documentation)

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
- **Online Catalog for Customers**: Customers can browse product availability in real-time, view pricing, and seamlessly checkout via the built-in cart system.
- **Dynamic Fast-Form for Staff**: For offline or phone orders, staff can utilize a dynamic Javascript-powered form to add dozens of product rows instantly without page reloads.

### 🧾 2. Smart Logistics (QR Code) & Automated Invoicing
- **One-Click Invoicing**: Approving a customer's payment automatically generates an industry-standard PDF Invoice.
- **QR Code Delivery Validation**: Generated Delivery Orders (Surat Jalan) contain a unique QR Code. Upon physical delivery, customers simply scan the QR code using their smartphone camera. The system validates the delivery in real-time and automatically syncs the stock and financial ledger. No physical signatures required!

### 🏭 3. Warehouse & Supply Chain Management
- **Purchase Orders**: Staff can draft official purchase orders to external factory suppliers.
- **Multi-Warehouse Tracking**: Supports robust inventory movement across Central, Regional, and Distribution warehouses.
- **Automated Stock Ingestion**: When supplier shipments arrive, a Goods Receipt form validates the physical count. Approving this form instantly increments warehouse stock and securely logs the expenditure to the financial ledger.

### 📊 4. Executive Analytics Dashboard
- **Real-Time Financial Charts**: A visually stunning Chart.js dashboard provides management with instant comparisons between revenue and expenditures.
- **Automated Net Profit Calculation**: The system automatically subtracts operational costs from gross sales, presenting an accurate Net Profit metric in real-time.
- **Print-Friendly CSS**: Pressing `Ctrl + P` strips the UI of colors and sidebars, rendering a crisp, black-and-white financial report optimized for office printers.

---

## 🚀 Quick Start (Installation)

Getting the system up and running on a local environment is straightforward:

1. Ensure a local web server environment like **Laragon** or **XAMPP** is installed.
2. Clone or extract this repository into your `www` (Laragon) or `htdocs` (XAMPP) directory.
3. Start the Apache and MySQL services.
4. Navigate to the application via your web browser:
   ```text
   http://localhost/paramitra-app/public
   ```
*(Note: The system features intelligent routing that automatically detects sub-folder installations, preventing 404 routing errors without manual .htaccess configuration).*

---

## 🔑 Test Credentials
You can explore the system's role-based access control using the following test accounts (Password for all accounts is: **password**):

- **Operational Staff (Admin)**: `admin@paramitra.com`
- **Management (Executive)**: `management@paramitra.com`
- **Customer**: `customer@paramitra.com`

---

## 📂 Detailed Documentation
For detailed operational workflows, technical instructions, and migration guides, please refer to the supplementary documentation file:
- 📖 [Detailed Explanations & Instructions (SYSTEM_DOCUMENTATION.txt)](SYSTEM_DOCUMENTATION.txt)

---
*Developed with a commitment to the digital advancement of PT Paramitra Praya Prawatya.* 🚀
