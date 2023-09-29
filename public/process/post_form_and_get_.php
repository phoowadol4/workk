<?php
// เริ่มต้นการเซสชัน (Session)
session_start();

// ตรวจสอบว่ามีตัวแปรเซสชัน 'token' และ 'token_timestamp' ถูกตั้งค่าหรือไม่
if (isset($_SESSION['token']) && isset($_SESSION['token_timestamp'])) {
    // ตรวจสอบว่าโทเค็น (token) หมดอายุหรือไม่
    $token = $_SESSION['token'];
    $tokenExpiration = $_SESSION['token_timestamp'] + 3600; // 1 ชั่วโมง
    
    // $tokenExpiration = $_SESSION['token_timestamp'] + (3600 * 24); // 1 วัน

    $currentTime = time();

    if ($currentTime > $tokenExpiration) {
        // โทเค็นหมดอายุแล้ว ลบข้อมูลเซสชันและเรียก redirect ไปยังหน้าเข้าสู่ระบบ
        session_unset();
        session_destroy();
        
        header("Location: /workk/work_phoowadol/login/login_form.php?expired=1");
        exit();
    }

} else {
     $token = null;
}

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
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token // เพิ่ม header สำหรับการตรวจสอบ Token
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

} else {

// กำหนด URL ของ API สำหรับการเรียกข้อมูล
$apiUrl = 'https://api.healthserv.gistnu.nu.ac.th/surveys';
$ch = curl_init();

curl_setopt_array($ch, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));

// ส่งคำขอ API
$response = curl_exec($ch);

// ตรวจสอบข้อผิดพลาด
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
    exit();
}

// กำหนด URL สำหรับ API ข้อมูลบุคคล และ ข้อมูลบ้าน
$apiUrl1 = 'https://api.healthserv.gistnu.nu.ac.th/persons';
$apiUrl2 = 'https://api.healthserv.gistnu.nu.ac.th/houses'; 

$curl1 = curl_init();
$curl2 = curl_init();

// ตั้งค่าสำหรับการเรียก API ข้อมูลบุคคล (persons)
curl_setopt_array($curl1, array(
    CURLOPT_URL => $apiUrl1,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));

// ส่งคำขอ API ข้อมูลบุคคล
$response1 = curl_exec($curl1);

// ตรวจสอบข้อผิดพลาดในการเรียก API ข้อมูลบุคคล
if ($response1 === false) {
    echo 'API request failed: ' . curl_error($curl1);
} else {
    $data1 = json_decode($response1, true);
}

// ตั้งค่าสำหรับการเรียก API ข้อมูลบ้าน (houses)
curl_setopt_array($curl2, array(
    CURLOPT_URL => $apiUrl2,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));

// ส่งคำขอ API ข้อมูลบ้าน
$response2 = curl_exec($curl2);

// ตรวจสอบข้อผิดพลาดในการเรียก API ข้อมูลบ้าน
if ($response2 === false) {
    echo 'API request failed: ' . curl_error($curl2);
} else {
    $data2 = json_decode($response2, true);
}

// แปลง JSON response เป็น array
$dataArray = json_decode($response, true);

// ตรวจสอบว่าการแปลง JSON สำเร็จหรือไม่
if ($dataArray === null) {
    echo 'Error: Unable to parse JSON response.';
    exit();
}
}
?>
<?php
// จำนวนผู้ตอบแบบสอบถามทั้งหมด
$monthlyCounts = array(
    'เลือกเพื่อดูข้อมูลในแต่ละเดือน' => 0,
    '1' => 0,  // มกราคม
    '2' => 0,  // กุมภาพันธ์
    '3' => 0,  // มีนาคม
    '4' => 0,  // เมษายน
    '5' => 0,  // พฤษภาคม
    '6' => 0,  // มิถุนายน
    '7' => 0,  // กรกฎาคม
    '8' => 0,  // สิงหาคม
    '9' => 0,  // กันยายน
    '10' => 0, // ตุลาคม
    '11' => 0, // พฤศจิกายน
    '12' => 0  // ธันวาคม
);

foreach ($dataArray['result'] as $survey) {
    $answer = $survey['id'];
    $people_date = $survey['date_time'];
    $surveyMonth = date('n', strtotime($people_date));

    $people_all = $answer++;

    if ($answer > 0) {
        $monthlyCounts[$surveyMonth]++;
    }
    $monthlyCounts['เลือกเพื่อดูข้อมูลในแต่ละเดือน'] = $people_all;
}
?>

<?php
$fImproveCount = array(
    'เลือกเพื่อดูข้อมูลในแต่ละเดือน' => 0,
    '1' => 0, // มกราคม
    '2' => 0, // กุมภาพันธ์
    '3' => 0, // มีนาคม
    '4' => 0, // เมษายน
    '5' => 0, // พฤษภาคม
    '6' => 0, // มิถุนายน
    '7' => 0, // กรกฎาคม
    '8' => 0, // สิงหาคม
    '9' => 0, // กันยายน
    '10' => 0, // ตุลาคม
    '11' => 0, // พฤศจิกายน
    '12' => 0, // ธันวาคม

);
$fImproveCount_all= 0;

$fOtherCount = array(
    'เลือกเพื่อดูข้อมูลในแต่ละเดือน' => 0,
    '1' => 0, // มกราคม
    '2' => 0, // กุมภาพันธ์
    '3' => 0, // มีนาคม
    '4' => 0, // เมษายน
    '5' => 0, // พฤษภาคม
    '6' => 0, // มิถุนายน
    '7' => 0, // กรกฎาคม
    '8' => 0, // สิงหาคม
    '9' => 0, // กันยายน
    '10' => 0, // ตุลาคม
    '11' => 0, // พฤศจิกายน
    '12' => 0, // ธันวาคม
   
);
$fOtherCount_all =0;

foreach ($dataArray['result'] as $comment) {
    // เช็คเดือนของการสำรวจ
    $comment_date = $comment['date_time'];
    $surveyMonth = date('n', strtotime($comment_date));

    // ตรวจสอบว่าคอลัมน์ 'f_improve' ไม่ว่างเปล่าหรือไม่เท่ากับ 'none' หรือ null
    if (!empty($comment['f_improve']) && $comment['f_improve'] !== 'none' && $comment['f_improve'] !== null) {
        $fImproveCount[$surveyMonth]++;
        $fImproveCount_all++;
    }
    
    // ตรวจสอบว่าคอลัมน์ 'f_other' ไม่ว่างเปล่าหรือไม่เท่ากับ 'none' หรือ null
    else if (!empty($comment['f_other']) && $comment['f_other'] !== 'none' && $comment['f_other'] !== null) {
        $fOtherCount[$surveyMonth]++;
        $fOtherCount_all++;
    }
}

// นับจำนวนความคิดเห็น f_improve + 'f_other'
$fImproveCountAll = array_sum($fImproveCount);
$fOtherCountAll = array_sum($fOtherCount);
$countAll = $fImproveCountAll + $fOtherCountAll;

// Set the total count for 'เลือกเพื่อดูข้อมูลในแต่ละเดือน'
$fImproveCount['เลือกเพื่อดูข้อมูลในแต่ละเดือน'] = $fImproveCountAll;
$fOtherCount['เลือกเพื่อดูข้อมูลในแต่ละเดือน'] = $fOtherCountAll;

// Store the total counts separately for future use
$countAll1 = $fImproveCountAll;
$countAll2 = $fOtherCountAll;

// Combine counts into $countf
$countf = $fImproveCount + $fOtherCount;
?>


<?php
// สร้างอาร์เรย์เพื่อเก็บจำนวน 'ญาติ' และ 'ผู้ป่วย' ตามเดือน
$valueCountsRelativeByMonth = array(
    'เลือกเพื่อดูข้อมูลในแต่ละเดือน' => 0,
    '1' => 0, // มกราคม
    '2' => 0, // กุมภาพันธ์
    '3' => 0, // มีนาคม
    '4' => 0, // เมษายน
    '5' => 0, // พฤษภาคม
    '6' => 0, // มิถุนายน
    '7' => 0, // กรกฎาคม
    '8' => 0, // สิงหาคม
    '9' => 0, // กันยายน
    '10' => 0, // ตุลาคม
    '11' => 0, // พฤศจิกายน
    '12' => 0, // ธันวาคม
);
$countRelative=0;
$valueCountsPatientByMonth = array(
    'เลือกเพื่อดูข้อมูลในแต่ละเดือน' => 0,
    '1' => 0, // มกราคม
    '2' => 0, // กุมภาพันธ์
    '3' => 0, // มีนาคม
    '4' => 0, // เมษายน
    '5' => 0, // พฤษภาคม
    '6' => 0, // มิถุนายน
    '7' => 0, // กรกฎาคม
    '8' => 0, // สิงหาคม
    '9' => 0, // กันยายน
    '10' => 0, // ตุลาคม
    '11' => 0, // พฤศจิกายน
    '12' => 0, // ธันวาคม
);
$countPatient=0;
foreach ($dataArray['result'] as $people) {
    $answerer = $people['answerer'];
    $surveyMonth = date('n', strtotime($people['date_time'])); // ดึงเดือนจากวันที่

    if ($answerer == 'ญาติ') {
        $valueCountsRelativeByMonth[$surveyMonth]++;
        $countRelative++;
    } elseif ($answerer == 'ผู้ป่วย') {
        $valueCountsPatientByMonth[$surveyMonth]++;
        $countPatient++;
    }

    $valueCountsRelativeByMonth['เลือกเพื่อดูข้อมูลในแต่ละเดือน'] = $countRelative;
    $valueCountsPatientByMonth['เลือกเพื่อดูข้อมูลในแต่ละเดือน'] = $countPatient;

}
?>

<?php
$sexByMonth = array();
$sex_all= array();
foreach ($dataArray['result'] as $item) {
    $value = $item['sex']; // ดึงค่าเพศจากข้อมูล
    $surveyMonth = date('n', strtotime($item['date_time'])); // ดึงเดือนจากวันที่ในข้อมูล

    // ตรวจสอบว่ายังไม่มีข้อมูลสำหรับเดือนนี้หรือไม่
    if (!isset($sexByMonth[$surveyMonth])) {
        $sexByMonth[$surveyMonth] = array(
            // 'เลือกเพื่อดูข้อมูลในแต่ละเดือน' => 0,
            'ชาย' => 0, // กำหนดค่าเริ่มต้นของจำนวนเพศชายในเดือนนี้เป็น 0
            'หญิง' => 0, // กำหนดค่าเริ่มต้นของจำนวนเพศหญิงในเดือนนี้เป็น 0
        );
    }

    if (!isset($sex_all['ชาย'])) {
        $sex_all['ชาย'] = 0;
    }
    
    if (!isset($sex_all['หญิง'])) {
        $sex_all['หญิง'] = 0;
    }
    
    // อัปเดตข้อมูลสำหรับเดือนที่เกี่ยวข้อง
    if ($value == 'ชาย' && isset($sexByMonth[$surveyMonth]['ชาย'])) {
        $sexByMonth[$surveyMonth]['ชาย']++; // เพิ่มจำนวนเพศชายในเดือนนี้
        $sex_all['ชาย']++; // เพิ่มจำนวนเพศชายทั้งหมด
    } else if ($value == 'หญิง' && isset($sexByMonth[$surveyMonth]['หญิง'])) {
        $sexByMonth[$surveyMonth]['หญิง']++; // เพิ่มจำนวนเพศหญิงในเดือนนี้
        $sex_all['หญิง']++; // เพิ่มจำนวนเพศหญิงทั้งหมด
    }
    
}
    $sexByMonth['เลือกเพื่อดูข้อมูลในแต่ละเดือน'] = $sex_all;


?>

<?php
// ความบ่อยครั้งการมาใช้บริการ
$everByMonth = array();
$ever_all = array();
foreach ($dataArray['result'] as $item) {
    $value = $item['countEver']; // ดึงค่าความบ่อยครั้งในการมาใช้บริการจากข้อมูล
    $surveyMonth = date('n', strtotime($item['date_time'])); // ดึงเดือนจากวันที่ในข้อมูล

    // ตรวจสอบว่ายังไม่มีข้อมูลสำหรับเดือนนี้หรือไม่
    if (!isset($everByMonth[$surveyMonth])) {
        $everByMonth[$surveyMonth] = array(
            'เลือกเพื่อดูข้อมูลในแต่ละเดือน' => 0,
            'ใช่' => 0, // กำหนดค่าเริ่มต้นของจำนวนการมาใช้บริการที่เป็น "ใช่" ในเดือนนี้เป็น 0
            'ไม่' => 0, // กำหนดค่าเริ่มต้นของจำนวนการมาใช้บริการที่เป็น "ไม่" ในเดือนนี้เป็น 0
        );
    }

    if (!isset($ever_all['ใช่'])) {
        $ever_all['ใช่'] = 0;
    }
    
    if (!isset($ever_all['ไม่'])) {
        $ever_all['ไม่'] = 0;
    }
    
    // อัปเดตข้อมูลสำหรับเดือนที่เกี่ยวข้อง
    if ($value == 'ใช่' && isset($everByMonth[$surveyMonth]['ใช่'])) {
        $everByMonth[$surveyMonth]['ใช่']++; // เพิ่มจำนวนเพศชายในเดือนนี้
        $ever_all['ใช่']++; // เพิ่มจำนวนเพศชายทั้งหมด
    } else if ($value == 'ไม่' && isset($everByMonth[$surveyMonth]['ไม่'])) {
        $everByMonth[$surveyMonth]['ไม่']++; // เพิ่มจำนวนเพศหญิงในเดือนนี้
        $ever_all['ไม่']++; // เพิ่มจำนวนเพศหญิงทั้งหมด
    }
}$everByMonth['เลือกเพื่อดูข้อมูลในแต่ละเดือน'] = $ever_all;
    ?>

<?php
$valueCountsage = array(
    'age20' => 0, // นับจำนวนอายุกลุ่มน้อยกว่า 20 ปี
    'age30' => 0, // นับจำนวนอายุกลุ่ม 30 ขึ้นไป
    'age40' => 0, // นับจำนวนอายุกลุ่ม 40 ขึ้นไป
    'age50' => 0, // นับจำนวนอายุกลุ่ม 50 ขึ้นไป
    'age51' => 0, // นับจำนวนอายุกลุ่ม 51 ขึ้นไป
);

foreach ($dataArray['result'] as $itemage) {
    $valueage = $itemage['age'];
    
    if ($valueage <= 20) {
        $valueCountsage['age20']++;
    } else if ($valueage >= 20 && $valueage < 30) {
        $valueCountsage['age30']++;
    } else if ($valueage >= 30 && $valueage < 40) {
        $valueCountsage['age40']++;
    } else if ($valueage >= 40 && $valueage < 50) {
        $valueCountsage['age50']++;
    } else if ($valueage >= 51) {
        $valueCountsage['age51']++;
    }
}$valueCountsage;

$dataByMonth = array(); // สร้างอาร์เรย์เพื่อเก็บข้อมูลตามเดือน

foreach ($dataArray['result'] as $itemage) {
    $valueage = $itemage['age'];
    $valueadate = $itemage['date_time'];
    $surveyMonth = date('n', strtotime($valueadate)); // รับเดือนจากข้อมูล

    // กำหนดอาร์เรย์สำหรับแต่ละเดือนหากยังไม่มี
    if (!isset($dataByMonth[$surveyMonth])) {
        $dataByMonth[$surveyMonth] = array(
            'age20' => 0, // นับจำนวนอายุกลุ่มน้อยกว่า 20 ปี
            'age30' => 0, // นับจำนวนอายุกลุ่ม 30 ขึ้นไป
            'age40' => 0, // นับจำนวนอายุกลุ่ม 40 ขึ้นไป
            'age50' => 0, // นับจำนวนอายุกลุ่ม 50 ขึ้นไป
            'age51' => 0, // นับจำนวนอายุกลุ่ม 51 ขึ้นไป
        );
    }
    
    // อัปเดตข้อมูลสำหรับเดือนที่เกี่ยวข้อง
    if ($valueage <= 20) {
        $dataByMonth[$surveyMonth]['age20']++;
    } else if ($valueage > 20 && $valueage <= 30) {
        $dataByMonth[$surveyMonth]['age30']++;
    } else if ($valueage > 30 && $valueage <= 40) {
        $dataByMonth[$surveyMonth]['age40']++;
    } else if ($valueage > 40 && $valueage <= 50) {
        $dataByMonth[$surveyMonth]['age50']++;
    } else if ($valueage >= 51) {
        $dataByMonth[$surveyMonth]['age51']++;
    }
}
$dataByMonth['เลือกเพื่อดูข้อมูลในแต่ละเดือน'] = $valueCountsage;


ksort($dataByMonth); // เรียงลำดับจากน้อยไปมากตาม key ช่วงอายุ
?>

<?php

// chart bar ค่าเฉลี่ย จากตอนที่ 2 ของแบบสอบถาม
$fieldMappings = array(
    's_smile' => '1.ให้การต้อนรับด้วยอัธยาศัยดี สุภาพยิ้มแย้มแจ่มใส',
    's_willing' => '2.ให้บริการด้วยความเต็มใจ ยินดี กระตือรือร้น',
    's_solve' => '3.เจ้าหน้าที่ให้ความสนใจและเต็มใจช่วย แก้ปัญหาต่างๆให้กับท่าน',
    's_respon' => '4.เจ้าหน้าที่มีความรับผิดชอบ และความมุ่งมั่นในการปฏิบัติงาน',
    's_term' => '5.เจ้าหน้าที่ได้แจ้งขั้นตอนการบริการ ให้ผู้มาติดต่อ ทราบอย่างชัดเจน',
    's_staff' => '6.ระดับความพอใจในการให้บริการของเจ้าหน้าที่',
    's_law' => '7.การบริการเป็นไปตามระเบียบปฏิบัติของทางราชการ และระบียบอื่นๆ ที่ประกาศ',
    's_time' => '8.การบริการเป็นไปตามกำหนดเวลาราชการ และ/หรือเวลาที่ประกาศ',
    's_fast' => '9.ให้บริการด้วยความสะดวกรวดเร็ว',
    's_help' => '10.ความเร็วในการให้ความช่วยเหลือ เมื่อท่านขอความช่วยเหลือ',
    's_easy' => '11.สามารถติดต่อสื่อสารกับรพ.สต.ได้สะดวก',
    's_appoint' => '12.รพ.สต.ให้บริการตรงต่อเวลาที่นัดหมาย',
    's_clean' => '13.ความสะอาดของสถานที่',
    's_facility' => '14.มีสิ่งอำนวยความสะดวกในสถานที่ให้บริการ เช่น ป้ายบอกทาง ที่นั่งรอ',
    's_overall' => '15.ความพึงพอใจโดยรวม ที่ได้รับจากการบริการ จาก รพ.สต.'
);

$valueCountspop = array();
$ratingTotals = array();

foreach ($dataArray['result'] as $itempop) {
    $fields = array_keys($fieldMappings);

    foreach ($fields as $field) {
        $rating = $itempop[$field];

        // Ensure that the rating is between 1 and 5
        if ($rating >= 1 && $rating <= 5) {
            // If the rating already exists in the $valueCountspop array, increment its count and total
            if (isset($valueCountspop[$fieldMappings[$field]][$rating])) {
                $valueCountspop[$fieldMappings[$field]][$rating]++;
                $ratingTotals[$fieldMappings[$field]] += $rating;
            } else {
                // If the rating does not exist in the $valueCountspop array, initialize its count to 1 and total to rating
                $valueCountspop[$fieldMappings[$field]][$rating] = 1;
                $ratingTotals[$fieldMappings[$field]] = $rating;
            }
        }
    }
}

// Calculate the average for each fieldff
$ratingAverages = array();
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = round($total / array_sum($valueCountspop[$field]), 2);
}
$ratingStandardDeviations = array();
foreach ($valueCountspop as $field => $counts) {
    $n = array_sum($counts);
    $mean = $ratingAverages[$field];

    $sumSquaredDifferences = 0;
    foreach ($counts as $rating => $count) {
        $sumSquaredDifferences += $count * pow($rating - $mean, 2);
    }

    $variance = $sumSquaredDifferences / ($n - 1);
    $stdDeviation = sqrt($variance);

    $ratingStandardDeviations[$field] = number_format($stdDeviation, 2);
}
// เรียงลำดับข้อมูลมากจากไปน้อยตาม value 
arsort($ratingAverages);
// Select the top 5 rated fields
$top5Ratings = array_slice($ratingAverages, 0, 5);

?>



<!-- table ค่าเฉลี่ย และ ส่วนเบี่ยงเบนมาตรฐาน หน้า dashboard -->
<?php
// แม็ปชื่อฟิลด์กับคำอธิบายเป็นภาษาไทย
$fieldMappings = array(
    's_smile' => '1.ให้การต้อนรับด้วยอัธยาศัยที่ดี สุภาพยิ้มแย้มแจ่มใส',
    's_willing' => '2.ให้บริการด้วยความเต็มใจ ยินดี กระตือรือร้น',
    's_solve' => '3.เจ้าหน้าที่ให้ความสนใจและเต็มใจช่วย แก้ปัญหาต่างๆให้กับท่าน',
    's_respon' => '4.เจ้าหน้าที่ของ รพ.สต. มีความรับผิดชอบและความมุ่งมั่นในการปฏิบัติงาน',
    's_term' => '5.เจ้าหน้าที่ได้แจ้งขั้นตอนและเงื่อนไขการบริการให้ผู้มาติดต่อ ทราบอย่างชัดเจน',
    's_staff' => '6.ระดับความพอใจในการให้บริการของเจ้าหน้าที่',
    's_law' => '7.การบริการเป็นไปตามระเบียบปฏิบัติของทางราชการ และระบียบอื่นๆ ที่ประกาศ',
    's_time' => '8.การบริการเป็นไปตามกำหนดเวลาราชการ และ/หรือเวลาที่ประกาศ',
    's_fast' => '9.ให้บริการด้วยความสะดวก รวดเร็ว',
    's_help' => '10.ความเร็วในการให้ความช่วยเหลือเมื่อท่านขอความช่วยเหลือ',
    's_easy' => '11.ผู้รับบริการสามารถติดต่อสื่อสารกับ รพ.สต. ได้สะดวก',
    's_appoint' => '12.รพ.สต.ให้บริการตรงต่อเวลาที่นัดหมาย',
    's_clean' => '13.ความสะอาดของสถานที่',
    's_facility' => '14.มีสิ่งอำนวยความสะดวกในสถานที่ให้บริการ เช่น ป้ายบอกทาง ที่นั่งรอ',
    's_overall' => '15.ความพึงพอใจโดยรวมที่ได้รับจากการบริการ จาก รพ.สต.'
);

$valueCountspop = array();
$ratingTotals = array();

foreach ($dataArray['result'] as $itempop) {
    $fields = array_keys($fieldMappings);

    foreach ($fields as $field) {
        $rating = $itempop[$field];

        // ตรวจสอบว่าคะแนนอยู่ระหว่าง 1 ถึง 5
        if ($rating >= 1 && $rating <= 5) {
            // หากคะแนนมีอยู่ใน $valueCountspop แล้ว ให้เพิ่มจำนวนและคะแนนรวม
            if (isset($valueCountspop[$fieldMappings[$field]][$rating])) {
                $valueCountspop[$fieldMappings[$field]][$rating]++;
                $ratingTotals[$fieldMappings[$field]] += $rating;
            } else {
                // หากคะแนนยังไม่มีใน $valueCountspop ให้กำหนดจำนวนเป็น 1 และคะแนนรวมเป็นคะแนน
                $valueCountspop[$fieldMappings[$field]][$rating] = 1;
                $ratingTotals[$fieldMappings[$field]] = $rating;
            }
        }
    }
}

// คำนวณค่าเฉลี่ยสำหรับแต่ละฟิลด์
$ratingAverages2 = array();
foreach ($ratingTotals as $field => $total) {
    $ratingAverages2[$field] = round($total / array_sum($valueCountspop[$field]), 2);
}

function calculateStandardDeviation($counts, $mean) {
    $n = array_sum($counts);
    $sumSquaredDifferences = 0;

    foreach ($counts as $rating => $count) {
        $sumSquaredDifferences += $count * pow($rating - $mean, 2);
    }

    $variance = $sumSquaredDifferences / ($n - 1);
    $stdDeviation = sqrt($variance);

    return number_format($stdDeviation, 2);
}

$ratingStandardDeviations = array();
$stdDeviationsLessThan5 = array(); // กำหนดอาร์เรย์เพื่อเก็บจำนวนสำหรับแต่ละฟิลด์

foreach ($valueCountspop as $field => $counts) {
    $mean = $ratingAverages2[$field];
    $stdDeviation = calculateStandardDeviation($counts, $mean);

    $ratingStandardDeviations[$field] = $stdDeviation;

    // ตรวจสอบว่าค่าส่วนเบี่ยงเบนมาตรฐานน้อยกว่า 5 และเก็บจำนวนสำหรับแต่ละฟิลด์
    if ($stdDeviation < 5) {
        $stdDeviationsLessThan5[$field] = $stdDeviation;
    }
}

// เรียงลำดับค่าเฉลี่ย
arsort($ratingAverages2);
asort($stdDeviationsLessThan5);

// เลือกฟิลด์ 5 อันดับแรกที่มีคะแนนเฉลี่ยสูงสุด
$top5Ratingst = array_slice($ratingAverages2, 0, 5);

$topl = array_slice($stdDeviationsLessThan5, 0, 5);
?>

<?php
// ตาราง แสดงค่าเฉลี่ยส่วนเบี่ยงเบนมาตรฐาน ในเมนู ข้อมูลแบบสอบถาม ความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่ 
$fieldMappings = array(
    's_smile' => 's_smile',
    's_willing' => 's_willing',
    's_solve' => 's_solve',
    's_respon' => 's_respon',
    's_term' => 's_term',
    's_staff' => 's_staff',
    's_law' => 's_law',
    's_time' => 's_time',
    's_fast' => 's_fast',
    's_help' => 's_help',
    's_easy' => 's_easy',
    's_appoint' => 's_appoint',
    's_clean' => 's_clean',
    's_facility' => 's_facility',
    's_overall' => 's_overall'
);

$valueCountspop = array(); // สร้างอาร์เรย์เพื่อเก็บจำนวนคะแนนสำหรับแต่ละฟิลด์
$ratingTotalsform = array(); // สร้างอาร์เรย์เพื่อเก็บผลรวมของคะแนนสำหรับแต่ละฟิลด์

// วนลูปผ่านข้อมูล JSON
foreach ($dataArray['result'] as $itempop) {
    foreach ($fieldMappings as $field => $mappedField) {
        $rating = $itempop[$mappedField];

        // ตรวจสอบว่าคะแนนอยู่ระหว่าง 1 ถึง 5
        if ($rating >= 1 && $rating <= 5) {
            // หากคะแนนมีอยู่ในอาร์เรย์ $valueCountspop อยู่แล้ว ให้เพิ่มจำนวนและผลรวม
            if (isset($valueCountspop[$field][$rating])) {
                $valueCountspop[$field][$rating]++;
                $ratingTotalsform[$field] += $rating;
            } else {
                // หากคะแนนไม่มีอยู่ในอาร์เรย์ $valueCountspop ให้กำหนดจำนวนเป็น 1 และผลรวมเป็นคะแนน
                $valueCountspop[$field][$rating] = 1;
                $ratingTotalsform[$field] = $rating;
            }
        }
    }
}

// คำนวณค่าเฉลี่ยสำหรับแต่ละฟิลด์
$ratingAverages = array();
foreach ($ratingTotalsform as $field => $total) {
    $ratingAverages[$field] = number_format($total / array_sum($valueCountspop[$field]), 2);
}

// คำนวณส่วนเบี่ยงเบนมาตรฐานสำหรับแต่ละฟิลด์
$ratingStandardDeviations = array();
foreach ($valueCountspop as $field => $counts) {
    $n = array_sum($counts);
    $mean = $ratingAverages[$field];

    $sumSquaredDifferences = 0;
    foreach ($counts as $rating => $count) {
        $sumSquaredDifferences += $count * pow($rating - $mean, 2);
    }

    $variance = $sumSquaredDifferences / ($n - 1);
    $stdDeviation = sqrt($variance);

    $ratingStandardDeviations[$field] = number_format($stdDeviation, 2);
}

// กำหนดค่าส่วนเบี่ยงเบนมาตรฐานและค่าเฉลี่ยให้กับตัวแปรสำหรับแต่ละฟิลด์
$s_smileStdDeviation = $ratingStandardDeviations['s_smile'];
$s_willingStdDeviation = $ratingStandardDeviations['s_willing'];
$s_slawStdDeviation = $ratingStandardDeviations['s_law'];
$s_stimeStdDeviation = $ratingStandardDeviations['s_time'];
$s_sfastStdDeviation = $ratingStandardDeviations['s_fast'];
$s_shelpStdDeviation = $ratingStandardDeviations['s_help'];
$s_ssolveStdDeviation = $ratingStandardDeviations['s_solve'];
$s_sresponStdDeviation = $ratingStandardDeviations['s_respon'];
$s_seasyStdDeviation = $ratingStandardDeviations['s_easy'];
$s_sappointStdDeviation = $ratingStandardDeviations['s_appoint'];
$s_scleanStdDeviation = $ratingStandardDeviations['s_clean'];
$s_stermStdDeviation = $ratingStandardDeviations['s_term'];
$s_sfacilityStdDeviation = $ratingStandardDeviations['s_facility'];
$s_staffAverageStdDeviation = $ratingStandardDeviations['s_staff'];
$s_soverallStdDeviation = $ratingStandardDeviations['s_overall'];

// กำหนดค่าเฉลี่ยให้กับตัวแปรสำหรับแต่ละฟิลด์
$s_ssmile = $ratingAverages['s_smile'];
$s_swilling = $ratingAverages['s_willing'];
$s_slaw = $ratingAverages['s_law'];
$s_stime = $ratingAverages['s_time'];
$s_sfast = $ratingAverages['s_fast'];
$s_shelp = $ratingAverages['s_help'];
$s_ssolve = $ratingAverages['s_solve'];
$s_srespon = $ratingAverages['s_respon'];
$s_seasy = $ratingAverages['s_easy'];
$s_sappoint = $ratingAverages['s_appoint'];
$s_sclean = $ratingAverages['s_clean'];
$s_sterm = $ratingAverages['s_term'];
$s_sfacility = $ratingAverages['s_facility'];
$s_staffAverage = $ratingAverages['s_staff'];
$s_soverall = $ratingAverages['s_overall'];

// ด้านเจ้าหน้าที่ผู้ให้บริการ		ค่าเฉลี่ย
$sevice_officer = $s_ssmile + $s_swilling + $s_ssolve + $s_srespon + $s_sterm + $s_staffAverage;
$average_sevice_officer = number_format($sevice_officer / 6, 2);

// ส่วนเบี่ยงเบนมาตรฐาน
$officer_std = $s_smileStdDeviation + $s_willingStdDeviation + $s_ssolveStdDeviation + $s_sresponStdDeviation + $s_stermStdDeviation + $s_staffAverageStdDeviation;
$sevice_officer_std = number_format($officer_std / 6, 2);

// ด้านคุณภาพการให้บริการ	ค่าเฉลี่ย
$sevice_ser = $s_slaw + $s_stime + $s_sfast + $s_shelp + $s_seasy + $s_sappoint;
$service_ser = number_format($sevice_ser / 6, 2);

// ส่วนเบี่ยงเบนมาตรฐาน
$service_std = $s_slawStdDeviation + $s_stimeStdDeviation + $s_sfastStdDeviation + $s_shelpStdDeviation + $s_seasyStdDeviation + $s_sappointStdDeviation;
$sevice_quality_std = number_format($service_std / 6, 2);

// ด้านสถานที่		ค่าเฉลี่ย
$location_point = $s_sclean + $s_sfacility + $s_soverall;
$average_location_point = number_format($location_point / 3, 2);

// ส่วนเบี่ยงเบนมาตรฐาน
$location_std = $s_scleanStdDeviation + $s_sfacilityStdDeviation + $s_soverallStdDeviation;
$ser_location_std = number_format($location_std / 3, 2);
?>