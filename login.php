<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $isValid = false;

    // Read the data.txt file line by line
    $handle = fopen("d:\\data.txt", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            // Split the line into parts
            list($savedUsername, $savedEmail, $savedPasswordHash) = explode(", ", $line);
            // Remove the prefix and trim whitespace
            $savedUsername = trim(substr($savedUsername, strpos($savedUsername, ":") + 1));
            $savedPasswordHash = trim(substr($savedPasswordHash, strpos($savedPasswordHash, ":") + 1));

            // Check if the submitted username matches and verify the password
            if ($username === $savedUsername && password_verify($password, $savedPasswordHash)) {
                $isValid = true;
                break;
            }
        }
        fclose($handle);
    }

    if ($isValid) {
    // Redirect to main page
    header('Location: main.html');
    exit; // Ensure no further script execution after redirection
} else {
    header('Location: faild.html');
}

} else {
    // Redirect back to login form or handle accordingly
    header('Location: login.html');
    exit;
}
?>
