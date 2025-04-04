# Payments App 💼

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)](https://paymentsapp.free.nf/package/)
![PhonePe](https://img.shields.io/badge/PhonePe-5F259F?style=flat&logo=phonepe&logoColor=white)
[![Project Status: Active](https://www.repostatus.org/badges/latest/active.svg)](https://www.repostatus.org/#active)
![uptime](https://img.shields.io/badge/uptime-100%25-brightgreen)
[![Made With Love](https://img.shields.io/badge/Made%20With-Love-orange.svg)](https://github.com/kunal9960)

This project is a simple and secure **Database PHP-based payments app** integrating **PhonePe** for seamless transactions. Users can make payments, check status, and view transaction history.  

<img src="https://raw.githubusercontent.com/kunal9960/payments_app/refs/heads/master/Source/Home%20page.png" width="800">
<img src="https://raw.githubusercontent.com/kunal9960/payments_app/refs/heads/master/Source/PhonePe%20Page.png" width="800">
<img src="https://raw.githubusercontent.com/kunal9960/payments_app/refs/heads/master/Source/Payment%20Status.png" width="800">
<img src="https://raw.githubusercontent.com/kunal9960/payments_app/refs/heads/master/Source/Transaction%20Page.png" width="800">

---

## Features

- Accepts payments via PhonePe.
- Generates unique Order IDs for each transaction.
- Stores transaction details securely in a MySQL database.
- Provides real-time transaction status updates.
- Displays a transaction history table with payment details.

---

## Requirements

- PHP 7.4+
- MySQL Database
- Composer (for dependencies)
- Apache/Nginx Server

---

## Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/kunal9960/payments_app.git
   cd payments_app
   ```
   
2. **Install dependencies:**
    ```bash
    composer install
    ```

3. **Set up your database:**

- Create a MySQL database.
- Import the transactions.sql file to set up the required tables.
- Configure your credentials in config.php:

```php
define('API_MERCHANT_ID', 'your_merchant_id');
define('API_KEY', 'your_api_key');
define('API_KEY_INDEX', 'your_key_index');
define('APP_URL', 'https://yourdomain.com');
define('WEBHOOK_PATH', APP_URL . '/webhook.php');
define('RESPONSE_PATH', APP_URL . '/response.php');
```

4. **Run the application:**

- Deploy on a PHP-supported server (XAMPP, Apache, or cloud hosting).
- Open index.php in the browser to start making payments.

---

## Usage

1. **Make a Payment:**
Enter your name, mobile number, and amount.
Click Make Payment → Redirects to PhonePe.

2. **Check Payment Status:**
After payment, it redirects to a status page.
Displays order ID, transaction ID, status, and amount.

3. **View Transaction History:**
Click on Transaction History to see all past payments.

---

## Contributing

Contributions are welcome! If you have any ideas for improvements or new features, feel free to fork the repository and submit a pull request. You can also open an issue to report bugs or suggest enhancements.

---

## Acknowledgments

Feel free to contact me if you need help with any of the projects :)
