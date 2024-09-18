# Automated PHP Script with Cron Job: Updating `search_key` in MySQL Table

## Overview
This repository contains a PHP script that automates the updating of the `search_key` field in the `dim_loan` table by generating `UPDATE` queries based on user data from the `dim_user` table. Additionally, a cron job is set up to automatically run the script daily at midnight to keep the database updated.

## How It Works
1. **Database Connection**: The PHP script connects to the MySQL database using the provided credentials.
2. **Data Selection**: It selects records from the `dim_loan` table where the `search_key` is `NULL` or empty.
3. **Query Generation**: For each record, it generates an `UPDATE` query that sets the `search_key` field to a combination of the user's first name, last name, email, and mobile number.
4. **Transaction Safety**: The script executes these `UPDATE` queries within a transaction to ensure that all changes are either applied or rolled back if something goes wrong.
5. **Automated Execution**: The script is scheduled to run daily at midnight via a cron job.

## Requirements
- **PHP**: Version 5.6 or later
- **PDO Extension**: Enabled
- **MySQL Database**: With the following tables:
  - `dim_loan`: Contains loan records with a `search_key` field.
  - `dim_user`: Contains user details such as first name, last name, email, and mobile number.
- **Unix-like System**: For setting up cron jobs (Linux, macOS, etc.).

## Setup

### Step 1: Configure the PHP Script
1. Clone this repository:
   ```bash
   git clone https://github.com/yourusername/loan-search-key-updater.git
2. Update the database connection details in the update_search_key.php file:
   ```bash
  $host = 'your_host';
  $dbname = 'your_database';
  $username = 'your_username';
  $password = 'your_password';
3. Upload the script to your server, e.g., /var/www/html/scripts/update_search_key.php.

### Step 2: Set Up the Cron Job
To schedule the script to run daily at midnight, follow these steps:
1. Open the crontab editor:
   ```bash
crontab -e
