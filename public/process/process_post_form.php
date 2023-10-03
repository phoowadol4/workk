<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากแบบฟอร์ม
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $date = $_POST["date"];
    $ever = $_POST["ever"];
    $people = $_POST["people"];
    $rd_1 = $_POST["rd_1"];
    $rd_2 = $_POST["rd_2"];
    $rd_3 = $_POST["rd_3"];
    $rd_4 = $_POST["rd_4"];
    $rd_5 = $_POST["rd_5"];
    $rd_6 = $_POST["rd_6"];
    $rd_7 = $_POST["rd_7"];
    $rd_8 = $_POST["rd_8"];
    $rd_9 = $_POST["rd_9"];
    $rd_10 = $_POST["rd_10"];
    $rd_11 = $_POST["rd_11"];
    $rd_12 = $_POST["rd_12"];
    $rd_13 = $_POST["rd_13"];
    $rd_14 = $_POST["rd_14"];
    $rd_15 = $_POST["rd_15"];
    $comments16 = $_POST["comments16"];
    $comments17 = $_POST["comments17"];

    // URL ของเว็บที่จะส่งข้อมูลไป
    $url = 'https://api.healthserv.gistnu.nu.ac.th/surveys/submit-survey';

    // กำหนดรูปแบบของวันและเวลา
    $dateTime = new DateTime($date);
    $formattedDateTime = $dateTime->format('Y-m-d\TH:i:s.000\Z');

    // สร้างข้อมูลเป็นรูปแบบ JSON
    $data = [
        'sex' => $gender,
        'answerer' => $people,
        'age' => (int)$age,
        'date_time' => $formattedDateTime,
        'countEver' => $ever,
        's_smile' => (int)$rd_1,
        's_willing' => (int)$rd_2,
        's_law' => (int)$rd_3,
        's_time' => (int)$rd_4,
        's_fast' => (int)$rd_5,
        's_help' => (int)$rd_6,
        's_solve' => (int)$rd_7,
        's_respon' => (int)$rd_8,
        's_easy' => (int)$rd_9,
        's_appoint' => (int)$rd_10,
        's_clean' => (int)$rd_11,
        's_term' => (int)$rd_12,
        's_facility' => (int)$rd_13,
        's_staff' => (int)$rd_14,
        's_overall' => (int)$rd_15,
        'f_improve' => $comments16,
        'f_other' => $comments17,
    ];

    // แปลงข้อมูลเป็นรูปแบบ JSON
    $jsonData = json_encode($data);

    // เริ่มเชื่อมต่อกับเว็บเซอร์วิส
    $ch = curl_init();

    // กำหนด URL
    curl_setopt($ch, CURLOPT_URL, $url);

    // กำหนดเป็นการส่งข้อมูลแบบ POST
    curl_setopt($ch, CURLOPT_POST, 1);

    // กำหนดข้อมูลที่จะส่ง
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // กำหนดให้รับข้อมูลคำตอบกลับ
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // กำหนดหัวเรื่องของ HTTP เป็น JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    // ส่งคำร้องขอและรับข้อมูลคำตอบ
    $response = curl_exec($ch);

    // ตรวจสอบว่าส่งข้อมูลสำเร็จหรือไม่
    if ($response === false) {
        echo 'เกิดข้อผิดพลาด: ' . curl_error($ch);
    } else {
        echo $response . "<br>";
    }

    // ปิดการเชื่อมต่อ
    curl_close($ch);
}
    session_unset();
    session_destroy();
?>
