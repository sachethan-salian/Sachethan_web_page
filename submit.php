<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract the form data
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    // Hash the password securely
    $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);

    // Prepare the data to be saved
    $data = "Username: $username, Email: $email, Password: $password\n";

    // Specify the absolute file path where data will be saved
    $filename = "d:\\data.txt"; // Ensure this path is correct and accessible

    // Check if the script can write to the specified path
    if (!is_writable($filename) && !file_exists($filename)) {
        // Attempt to check if the directory is writable if the file doesn't exist
        if (!is_writable(dirname($filename))) {
            echo "Error: The file or directory is not writable.";
            exit; // Stop the script
        }
    }

    // Attempt to write the data to the file
    if (file_put_contents($filename, $data, FILE_APPEND)) {
    // Signup was successful
    echo "<script>alert('Signup successful!'); window.location = 'login.html';</script>";
} else {
    echo "Error: Could not save the data.";
}

} else {
    // Not a POST request, redirect to the form or handle accordingly
    header('Location: index.html');
    exit; // Ensure no further execution for redirect
}
?>
