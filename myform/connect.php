
<?php

// Database configuration

$host = 'localhost'; // Database host

$dbname = 'sample'; // Database name

$username = 'root'; // Database username

$password = ''; // Database password


try {

    // Create a new PDO instance

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // Check if the form is submitted

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Get the form data

        $username = $_POST['username'];

        $email = $_POST['email'];

        $password = $_POST['password'];


        // Hash the password

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        // Prepare the SQL statement

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");


        // Bind parameters

        $stmt->bindParam(':username', $username);

        $stmt->bindParam(':email', $email);

        $stmt->bindParam(':password', $hashedPassword);


        // Execute the statement

        if ($stmt->execute()) {

            echo "User  registered successfully!";
            echo "<h1>Thank's register<h1>";

        } else {

            echo "Error registering user.";

        }

    }

} catch (PDOException $e) {

    echo "Connection failed: " . $e->getMessage();

}

?>
