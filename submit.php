<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract the form data
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    // Hash the password securely
    $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);

    // Specify the absolute file path where data will be saved
    $filename = "data.txt"; // Adjust this path as necessary

    $userExists = false;

    // Check if the file exists and is readable
    if (file_exists($filename) && is_readable($filename)) {
        // Read file line by line to check for existing user
        $file = fopen($filename, "r");
        while (($line = fgets($file)) !== false) {
            if (strpos($line, "Username: $username") !== false) {
                $userExists = true;
                break; // User found, no need to continue checking
            }
        }
        fclose($file);
    }

    if ($userExists) {
        // Inform the user that the username already exists
        echo "<script>alert('User already exists!'); window.location = 'login.html';</script>";
    } else {
        // User doesn't exist, proceed with saving the new user data
        $data = "Username: $username, Email: $email, Password: $password\n";
        if (file_put_contents($filename, $data, FILE_APPEND | LOCK_EX)) {
            // Signup was successful
            echo "<script>alert('Signup successful!'); window.location = 'login.html';</script>";
        } else {
            echo "Error: Could not save the data.";
        }
    }
} else {
    // Not a POST request, redirect to the form or handle accordingly
    header('Location: index.html');
    exit; // Ensure no further execution for redirect
}
?>
