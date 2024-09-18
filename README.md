Automated PHP Script with Cron Job: Updating search_key in MySQL Table
Overview
This repository contains a PHP script that updates the search_key field in the dim_loan MySQL table by generating UPDATE statements based on the user's first name, last name, email, and mobile number from the dim_user table. The script is set up to run automatically using a cron job.

How It Works
The PHP script connects to the MySQL database using provided credentials.
It fetches records from the dim_loan table where the search_key field is either NULL or empty.
For each record, it generates a dynamic UPDATE query that populates the search_key field with the user's name and contact information.
The queries are executed within a transaction, ensuring safety with rollback on failure.
The script is scheduled to run daily at midnight via a cron job.
Requirements
PHP 5.6 or later
PDO extension enabled
MySQL database with the following tables:
dim_loan: Contains loan records.
dim_user: Contains user details like first name, last name, email, and mobile.
Access to a Unix-like system for setting up cron jobs (Linux, macOS, etc.).
Setup
Step 1: Configure the PHP Script
Clone this repository:

bash
Copy code
git clone https://github.com/yourusername/loan-search-key-updater.git
Update the following database connection details in the update_search_key.php file:

php
Copy code
$host = 'your_host';
$dbname = 'your_database';
$username = 'your_username';
$password = 'your_password';
Upload the script to your server, for example, in /var/www/html/scripts/update_search_key.php.

Step 2: Set Up the Cron Job
To automate the execution of the PHP script daily at midnight:

Open the crontab by running the following command:

bash
Copy code
crontab -e
Add this line to schedule the script:

bash
Copy code
0 0 * * * /usr/bin/php /var/www/html/scripts/update_search_key.php >/dev/null 2>&1
0 0 * * *: Runs the script at midnight every day.
/usr/bin/php: The path to the PHP executable (use which php to confirm).
/var/www/html/scripts/update_search_key.php: The path to your PHP script.
>/dev/null 2>&1: Discards output and errors, preventing log file clutter.
Save and exit the crontab editor.

To verify the cron job:

bash
Copy code
crontab -l
Optional: Log Output
If you want to log the output and errors, modify the cron job to:

bash
Copy code
0 0 * * * /usr/bin/php /var/www/html/scripts/update_search_key.php >> /var/log/cron_update.log 2>&1
Error Handling
The script will roll back all changes if an error occurs during the execution of any UPDATE query.
Any errors are logged using error_log() for troubleshooting.
