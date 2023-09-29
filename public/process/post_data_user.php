<?php
// รวมไฟล์ process_get.php เข้ามาใช้งาน
include("process_get.php");

// เริ่มเซสชัน
session_start();

// ตรวจสอบว่าเป็นการร้องขอแบบ POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าข้อมูลจากแบบฟอร์ม
    $house_id = $_POST["house_id"];
    $cid = $_POST["cid"];
    $pname = $_POST["pname"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    // ตรวจสอบว่ามีตัวแปร token ในเซสชันหรือไม่
    if (isset($_SESSION['token'])) {
        $token = $_SESSION['token'];

        // กำหนด URL ของ API เพิ่มข้อมูลผู้มาอยู่ใหม่
        $apiUrl1 = 'https://api.healthserv.gistnu.nu.ac.th/persons/create-person';

        // สร้างข้อมูล JSON สำหรับ API เพิ่มข้อมูลผู้มาอยู่ใหม่
        $jsonData1 = [
            'house_id' => $house_id,
            'cid' => $cid,
            'pname' => $pname,
            'fname' => $fname,
            'lname' => $lname,
        ];

        $jsonData_person = json_encode($jsonData1);

        $ch1 = curl_init($apiUrl1);

        // กำหนดค่าสำหรับการส่งข้อมูลแบบ POST และเพิ่มหัวข้อ 'Authorization' ใน header
        curl_setopt($ch1, CURLOPT_POST, 1);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, $jsonData_person);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token, // เพิ่ม header ในการอนุญาต
        ]);

        $response1 = curl_exec($ch1);

        if ($response1 === false) {
            echo 'ข้อผิดพลาดจาก API 1: ' . curl_error($ch1);
        } else {
            // ตรวจสอบคำตอบจาก API 1 ว่ามีข้อผิดพลาดหรือไม่
            $responseData1 = json_decode($response1, true);
            if (isset($responseData1['error'])) {
                echo 'ข้อผิดพลาดจาก API 1: ' . $responseData1['error'];
            } else {
                echo 'คำตอบจาก API 1:<br>';
                echo $response1 . "<br>";
            }
        }

        // คำสั่งใช้เพื่อตรวจสอบการเรียกใช้งาน API ครั้งที่ 2 (ใช้เพื่อการ Debugging)
        echo 'เข้าสู่การเรียกใช้งาน API ครั้งที่ 1<br>';

        // กำหนด URL ของ API เพิ่มข้อมูลบ้าน
        $apiUrl2 = 'https://api.healthserv.gistnu.nu.ac.th/houses/create-house';

        // สร้างข้อมูล JSON สำหรับ API เพิ่มข้อมูลบ้าน
        $jsonData2 = [
            'house_id' => $house_id,
            'address' => $address,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
        $jsonData_house = json_encode($jsonData2);

        $ch2 = curl_init($apiUrl2);

        // กำหนดค่าสำหรับการส่งข้อมูลแบบ POST และเพิ่มหัวข้อ 'Authorization' ใน header
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $jsonData_house);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token, // เพิ่ม header ในการอนุญาต
        ]);

        $response2 = curl_exec($ch2);

        if ($response2 === false) {
            echo 'ข้อผิดพลาดจาก API 2: ' . curl_error($ch2);
        } else {
            // ตรวจสอบคำตอบจาก API เพิ่มข้อมูลบ้าน ว่ามีข้อผิดพลาดหรือไม่
            $responseData2 = json_decode($response2, true);
            if (isset($responseData2['error'])) {
                echo 'ข้อผิดพลาดจาก API 2: ' . $responseData2['error'];
            } else {
                echo 'คำตอบจาก API 2:<br>';
                echo $response2 . "<br>";
            }
        }
        // ปิดการเรียกใช้งาน cURL
        curl_close($ch1);
        curl_close($ch2);
    } else {
        echo 'ไม่พบ Token ในเซสชัน.';
    }
}
?>
