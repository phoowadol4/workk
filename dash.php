<?php
session_start(); // Start the session

if (!isset($_SESSION['token'])) {
    // Redirect to login if token is not present
    header("Location: login_form.php");
    exit();
}

$token = $_SESSION['token'];

$apiUrl = 'https://api.healthserv.gistnu.nu.ac.th/persons';
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));

$response = curl_exec($curl);

if ($response === false) {
    echo "Error: " . curl_error($curl);
} else {
    $responseData = json_decode($response, true);
    // Process $responseData as needed
    print_r($responseData);
}

curl_close($curl);
?>