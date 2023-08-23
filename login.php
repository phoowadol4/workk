<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    $curl = curl_init();

    $data = array(
        "username" => $username,
        "password" => $password
    );


    $jsonPayload = json_encode($data);

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.healthserv.gistnu.nu.ac.th/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonPayload,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ), // Removed the hardcoded Bearer token
    ));

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); // Get the HTTP status code

    curl_close($curl);

    if ($httpCode === 200) {
        // Successful login
        header("Location: test.php");
        exit();
    } else {
        // Failed login
        // You can display an error message or redirect back to the login page
       
        header("Location: login_form.php?error=1");
        exit();
        
    }
}
?>
<!-- Your HTML form goes here -->

xxx