<?php
include("process_get.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $house_id = $_POST["house_id"];
    $cid = $_POST["cid"];
    $pname = $_POST["pname"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    // Check if the token is available in the session
    if (isset($_SESSION['token'])) {
        $token = $_SESSION['token'];

        $apiUrl1 = 'https://api.healthserv.gistnu.nu.ac.th/persons/create-person';

        // Create JSON data for the first API
        $jsonData1 = [
            'house_id' => $house_id,
            'cid' => $cid,
            'pname' => $pname,
            'fname' => $fname,
            'lname' => $lname,
        ];

        $jsonData_person = json_encode($jsonData1);
        $ch1 = curl_init($apiUrl1);

        curl_setopt($ch1, CURLOPT_POST, 1);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, $jsonData_person);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token, // Add authorization header
        ]);

        $response1 = curl_exec($ch1);

        if ($response1 === false) {
            echo 'Error for API 1: ' . curl_error($ch1);
        } else {
            // Check the response from API 1 for errors
            $responseData1 = json_decode($response1, true);
            if (isset($responseData1['error'])) {
                echo 'Error from API 1: ' . $responseData1['error'];
            } else {
                echo 'Response from API 1:<br>';
                echo $response1 . "<br>";
            }
        }

        // Debugging statement to check if it reaches the second API call
        echo 'Reached the first API call<br>';

        $apiUrl2 = 'https://api.healthserv.gistnu.nu.ac.th/houses/create-house';

        // Create JSON data for the second API
        $jsonData2 = [
            'house_id' => $house_id,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
        $jsonData_house = json_encode($jsonData2);

        $ch2 = curl_init($apiUrl2);

        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $jsonData_house);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token, // Add authorization header
        ]);

        $response2 = curl_exec($ch2);

        if ($response2 === false) {
            echo 'Error for API 2: ' . curl_error($ch2);
        } else {
            // Check the response from API 2 for errors
            $responseData2 = json_decode($response2, true);
            if (isset($responseData2['error'])) {
                echo 'Error from API 2: ' . $responseData2['error'];
            } else {
                echo 'Response from API 2:<br>';
                echo $response2 . "<br>";
            }
        }

        curl_close($ch1);
        curl_close($ch2);
    } else {
        echo 'Token not found in session.';
    }
}
?>
