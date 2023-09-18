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
            $_SESSION['token_timestamp'] = time(); // Store the token timestamp
            header("Location: ../public/index2.php"); // Redirect to dashboard page
            exit();
        } else {
            // Token is missing, redirect with a SweetAlert message
            $errorMessage = 'Token is missing. Please try again.';
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>";
            echo "<script>";
            echo "window.onload = function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '$errorMessage',
                    }).then(function() {
                        window.location.href = 'login_form.php'; // Redirect to login page
                    });
                }";
            echo "</script>";
        }
    } else if ($httpCode === 401 || $httpCode === 404) {
        // Display an error message for unauthorized access (invalid username/password) using SweetAlert
        $errorMessage = 'Login failed. Invalid username or password.';
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>";
        echo "<script>";
        echo "window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '$errorMessage',
                });
            }";
        echo "</script>";
    } else {
        // Display a general error message with HTTP status code using SweetAlert
        $errorMessage = 'Login failed. HTTP Status Code: ' . $httpCode;
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>";
        echo "<script>";
        echo "window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '$errorMessage',
                });
            }";
        echo "</script>";
    }
}
?>
