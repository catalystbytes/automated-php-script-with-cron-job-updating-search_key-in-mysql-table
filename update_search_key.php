<?php
// Database connection details (update with your actual values)
$host = '';
$dbname = '';
$username = '';
$password = '';

try {
    // Connect to the database using PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define the SQL query that generates the UPDATE statements
    $selectQuery = "
        SELECT CONCAT('UPDATE dim_loan SET search_key = ''', 
                      CONCAT(user.first_name, ' ', user.last_name, ' ', user.email, ' ', user.mobile), 
                      ''' WHERE id = ', loan.id, ';') AS QUERY
        FROM dim_loan loan
        INNER JOIN dim_user user ON loan.created_by = user.id
        WHERE (search_key IS NULL OR search_key = '');
    ";

    // Execute the SELECT query to fetch the generated UPDATE queries
    $result = $db->query($selectQuery);

    // Fetch all the rows
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    // Begin a transaction
    $db->beginTransaction();

    // Loop through each generated UPDATE query and execute it
    foreach ($rows as $row) {
        $updateQuery = $row['QUERY'];
        $db->exec($updateQuery);
        echo "Executed: " . $updateQuery . "<br>";
    }

    // Commit the transaction
    $db->commit();
    echo "All updates executed successfully.<br>";

} catch (PDOException $e) {
    // Rollback the transaction if something fails
    $db->rollBack();
    echo "Error: " . $e->getMessage();
    error_log("Database Error: " . $e->getMessage());
} finally {
    // Close the database connection
    $db = null;
}
?>
