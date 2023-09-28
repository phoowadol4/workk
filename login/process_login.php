<?php
    session_start(); // เริ่มเซสชัน

    // ฟังก์ชันในการตรวจสอบสถานะการเข้าสู่ระบบ
    function checkLoginStatus()
    {
        if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $url = 'https://api.healthserv.gistnu.nu.ac.th/auth/login';
            
            // กำหนดข้อมูลสำหรับการส่งคำขอ POST ไปยัง API
            $data = [
                'username' => $username,
                'password' => $password,
            ];
            $jsonData = json_encode($data);

            $ch = curl_init();

            // กำหนดค่าให้กับการส่งคำขอ HTTP POST
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $jsonData,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                ],
            ));

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // ตรวจสอบการตอบกลับจาก API
            if ($httpCode === 200) {
                $responseData = json_decode($response, true);
                if (isset($responseData['result']['token'])) {
                    $_SESSION['token'] = $responseData['result']['token'];
                    $_SESSION['token_timestamp'] = time(); // เก็บเวลาที่เรียก API สำเร็จ
                    return true;
                }
            }
        }
        return false;
    }
?>