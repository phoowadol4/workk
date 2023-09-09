<?php
session_start();
if (isset($_SESSION['token']) && isset($_SESSION['token_timestamp'])) {
    // Check if the token has expired (1 minute in this case)
    $tokenExpiration = $_SESSION['token_timestamp'] + 3600; 
    $currentTime = time();

    if ($currentTime > $tokenExpiration) {
        // Token has expired, log the user out and redirect to login
        session_unset();
        session_destroy();
        
        header("Location: /workk/work1/login_form.php?expired=1");
        exit();
    }
} else {
    header("Location:  /workk/work1/login_form.php");
    exit();
}

$token = $_SESSION['token'];

$apiUrl = 'https://api.healthserv.gistnu.nu.ac.th/surveys';
$ch = curl_init();

curl_setopt_array($ch, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));

// Execute the request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
    exit();
}
$apiUrl1 = 'https://api.healthserv.gistnu.nu.ac.th/persons';
$apiUrl2 = 'https://api.healthserv.gistnu.nu.ac.th/houses'; 

$curl1 = curl_init();
$curl2 = curl_init();


curl_setopt_array($curl1, array(
    CURLOPT_URL => $apiUrl1,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));

$response1 = curl_exec($curl1);

if ($response1 === false) {
    echo 'API request failed: ' . curl_error($curl1);
} else {
    $data1 = json_decode($response1, true);
}


curl_setopt_array($curl2, array(
    CURLOPT_URL => $apiUrl2,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));

$response2 = curl_exec($curl2);

if ($response2 === false) {
    echo 'API request failed: ' . curl_error($curl2);
} else {
    $data2 = json_decode($response2, true);
}

// Decode JSON response to an array
$dataArray = json_decode($response, true);

// Check if JSON decoding was successful
if ($dataArray === null) {
    echo 'Error: Unable to parse JSON response.';
    exit();
}
?>
<?php
// Assuming the JSON data contains an array of objects with a "value" field
// Example JSON data: [{"value": "A"}, {"value": "B"}, {"value": "A"}, ...]
$valueCounts = array();

foreach ($dataArray['result'] as $item) {
    $value = $item['sex'];
    
    // If the value already exists in the $valueCounts array, increment its count
    if (isset($valueCounts[$value])) {
        $valueCounts[$value]++;
    } else {
        // If the value does not exist in the $valueCounts array, initialize its count to 1
        $valueCounts[$value] = 1;
    }
}
?>

<?php
// Initialize an array to store age counts
$valueCountsage = array(
    'age20' => 0,
    'age30' => 0,
    'age40' => 0,
    'age50' => 0,
    'age60' => 0,
);

foreach ($dataArray['result'] as $itemage) {
    $valueage = $itemage['age'];
    
    if ($valueage < 20) {
        $valueCountsage['age20']++;
    } else if ($valueage >= 20 && $valueage < 30) {
        $valueCountsage['age30']++;
    } else if ($valueage >= 30 && $valueage < 40) {
        $valueCountsage['age40']++;
    } else if ($valueage >= 40 && $valueage < 50) {
        $valueCountsage['age50']++;
    } else if ($valueage >= 50) {
        $valueCountsage['age60']++;
    }
}ksort($valueCountsage);
?>
<?php
// Assuming the JSON data contains an array of objects with various rating fields
// Example JSON data: [{"s_smile": 5, "s_willing": 4, ...}, {"s_smile": 4, "s_willing": 5, ...}, ...]

// Create a mapping array for the field names
$fieldMappings = array(
    's_smile' => '1.ให้การต้อนรับด้วยอัธยาศัยที่ดี สุภาพยิ้มแย้มแจ่มใส',
    's_willing' => '2.ให้บริการด้วยความเต็มใจ ยินดี กระตือรือร้น',
    's_law' => '3.การบริการเป็นไปตามระเบียบปฏิบัติของทางราชการ และระบียบอื่นๆ ที่ประกาศ',
    's_time' => '4.การบริการเป็นไปตามกำหนดเวลาราชการ และ/หรือเวลาที่ประกาศ',
    's_fast' => '5.ให้บริการด้วยความสะดวก รวดเร็ว',
    's_help' => '6.ความเร็วในการให้ความช่วยเหลือเมื่อท่านขอความช่วยเหลือ',
    's_solve' => '7.เจ้าหน้าที่ให้ความสนใจและเต็มใจช่วย แก้ปัญหาต่างๆให้กับท่าน',
    's_respon' => '8.เจ้าหน้าที่ของ รพ.สต. มีความรับผิดชอบและความมุ่งมั่นในการปฏิบัติงาน',
    's_easy' => '9.ผู้รับบริการสามารถติดต่อสื่อสารกับ รพ.สต. ได้สะดวก',
    's_appoint' => '10.รพ.สต.ให้บริการตรงต่อเวลาที่นัดหมาย',
    's_clean' => '11.ความสะอาดของสถานที่',
    's_term' => '12.เจ้าหน้าที่ได้แจ้งขั้นตอนและเงื่อนไขการบริการให้ผู้มาติดต่อ ทราบอย่างชัดเจน',
    's_facility' => '13.มีสิ่งอำนวยความสะดวกในสถานที่ให้บริการ เช่น ป้ายบอกทาง ที่นั่งรอ',
    's_staff' => '14.ระดับความพอใจในการให้บริการของเจ้าหน้าที่',
    's_overall' => '15.ความพึงพอใจโดยรวมที่ได้รับจากการบริการ จาก รพ.สต.'
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

// Calculate the average for each field
$ratingAverages = array();
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}

// Sort the averages in descending order
arsort($ratingAverages);

// Select the top 5 rated fields
$top5Ratings = array_slice($ratingAverages, 0, 5);

// Convert the data for use in JavaScript
// $top5Data = json_encode($top5Ratings);
?>


<?php
// Assuming the JSON data contains an array of objects with a "value" field
// Example JSON data: [{"value": "A"}, {"value": "B"}, {"value": "A"}, ...]
$valueCountsever = array();

foreach ($dataArray['result'] as $itemever) {
    $valueever = $itemever['countEver'];
    
    // If the value already exists in the $valueCounts array, increment its count
    if (isset($valueCountsever[$valueever])) {
        $valueCountsever[$valueever]++;
    } else {
        // If the value does not exist in the $valueCounts array, initialize its count to 1
        $valueCountsever[$valueever] = 1;
    }
}
?>


<!-- ค่าเฉลี่ยแบบสอบถาม 15 ข้อ -->
<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_ssmile = number_format($ratingAverages['s_smile'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_swilling = number_format($ratingAverages['s_willing'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_slaw = number_format($ratingAverages['s_law'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_stime = number_format($ratingAverages['s_time'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_sfast = number_format($ratingAverages['s_fast'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_shelp = number_format($ratingAverages['s_help'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_ssolve = number_format($ratingAverages['s_solve'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_srespon = number_format($ratingAverages['s_respon'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_seasy = number_format($ratingAverages['s_easy'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
} $s_sappoint = number_format($ratingAverages['s_appoint'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_sclean = number_format($ratingAverages['s_clean'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_sterm = number_format($ratingAverages['s_term'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
} $s_sfacility = number_format($ratingAverages['s_facility'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}
$s_staffAverage = number_format($ratingAverages['s_staff'], 3);
?>

<?php
foreach ($ratingTotals as $field => $total) {
    $ratingAverages[$field] = $total / array_sum($valueCountspop[$field]);
}$s_soverall = number_format($ratingAverages['s_overall'], 3);
?>