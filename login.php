<?php
session_start(); // Start the session

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $url = 'https://api.healthserv.gistnu.nu.ac.th/auth/login';
    $data = [
        'username' => $username,
        'password' => $password,
    ];
    $jsonData = json_encode($data);

    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
    ));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode === 200) {
        $responseData = json_decode($response, true);
        if (isset($responseData['result']['token'])) {
            
            $_SESSION['token'] = $responseData['result']['token'];
          
            header("Location: new.php"); // Redirect to dashboard page
            exit();
        } else {
            // Display an error message if token is missing
            echo "Login failed. Token missing in API response.";
        }
    } else if ($httpCode === 401) {
        // Display an error message for unauthorized access (invalid username/password)
        echo "Login failed. Invalid username or password.";
    } else {
        // Display a general error message with HTTP status code
        echo "Login failed. HTTP Status Code: $httpCode";
    }
}
?>