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
// Assuming the JSON data contains an array of objects with a "value" fieldff
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
// Assuming the JSON data contains an array of objects with a "value" fieldff
// Example JSON data: [{"value": "A"}, {"value": "B"}, {"value": "A"}, ...]
$valueCountsever = array();

foreach ($dataArray['result'] as $item) {
    $value = $item['countEver'];
    
    // If the value already exists in the $valueCounts array, increment its count
    if (isset($valueCountsever[$value])) {
        $valueCountsever[$value]++;
    } else {
        // If the value does not exist in the $valueCounts array, initialize its count to 1
        $valueCountsever[$value] = 1;
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

// chart bar average จากตอนที่ 2 
$fieldMappings = array(
    's_smile' => '1.ให้การต้อนรับด้วยอัธยาศัยที่ดี สุภาพยิ้มแย้มแจ่มใส',
    's_willing' => '2.ให้บริการด้วยความเต็มใจ ยินดี กระตือรือร้น',
    's_solve' => '3.เจ้าหน้าที่ให้ความสนใจและเต็มใจช่วย แก้ปัญหาต่างๆให้กับท่าน',
    's_respon' => '4.เจ้าหน้าที่ของรพ.สต.มีความรับผิดชอบ และความมุ่งมั่นในการปฏิบัติงาน',
    's_term' => '5.เจ้าหน้าที่ได้แจ้งขั้นตอนและเงื่อนไขการบริการ ให้ผู้มาติดต่อ ทราบอย่างชัดเจน',
    's_staff' => '6.ระดับความพอใจในการให้บริการของเจ้าหน้าที่',
    's_law' => '7.การบริการเป็นไปตามระเบียบปฏิบัติของทางราชการ และระบียบอื่นๆ ที่ประกาศ',
    's_time' => '8.การบริการเป็นไปตามกำหนดเวลาราชการ และ/หรือเวลาที่ประกาศ',
    's_fast' => '9.ให้บริการด้วยความสะดวกรวดเร็ว',
    's_help' => '10.ความเร็วในการให้ความช่วยเหลือ เมื่อท่านขอความช่วยเหลือ',
    's_easy' => '11.ผู้รับบริการสามารถติดต่อสื่อสารกับรพ.สต.ได้ สะดวก',
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
// Sort the averages in descending order
arsort($ratingAverages);
// Select the top 5 rated fields
$top5Ratings = array_slice($ratingAverages, 0, 5);

// Convert the data for use in JavaScript
// $top5Data = json_encode($top5Ratings);
?>

<!-- table ค่าเฉลี่ย และ ส่วนเบี่ยงเบนมาตรฐาน -->

<?php
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
$stdDeviationsLessThan5 = array(); // Initialize an array to store the count for each field

foreach ($valueCountspop as $field => $counts) {
    $mean = $ratingAverages2[$field];
    $stdDeviation = calculateStandardDeviation($counts, $mean);

    $ratingStandardDeviations[$field] = $stdDeviation;

    // Check if the standard deviation is less than 5 and store the count for each field
    if ($stdDeviation < 5) {
        $stdDeviationsLessThan5[$field] = $stdDeviation;
    }
}

arsort($ratingAverages2);
asort($stdDeviationsLessThan5);

// Select the top 5 rated fields
$top5Ratingst = array_slice($ratingAverages2, 0, 5);

$topl = array_slice($stdDeviationsLessThan5, 0, 5);
?>

<?php
// Define the field mappings for the ratings
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

$valueCountspop = array(); // Initialize an array to store counts for each field
$ratingTotalsform = array(); // Initialize an array to store totals for each field

// Loop through the JSON data
foreach ($dataArray['result'] as $itempop) {
    foreach ($fieldMappings as $field => $mappedField) {
        $rating = $itempop[$mappedField];

        // Ensure that the rating is between 1 and 5
        if ($rating >= 1 && $rating <= 5) {
            // If the rating already exists in the $valueCountspop array, increment its count and total
            if (isset($valueCountspop[$field][$rating])) {
                $valueCountspop[$field][$rating]++;
                $ratingTotalsform[$field] += $rating;
            } else {
                // If the rating does not exist in the $valueCountspop array, initialize its count to 1 and total to rating
                $valueCountspop[$field][$rating] = 1;
                $ratingTotalsform[$field] = $rating;
            }
        }
    }
}

// Calculate the average for each field
$ratingAverages = array();
foreach ($ratingTotalsform as $field => $total) {
    $ratingAverages[$field] = number_format($total / array_sum($valueCountspop[$field]), 2);
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

// ด้านเจ้าหน้าที่ผู้ให้บริการ		
$sevice_officer = $s_ssmile + $s_swilling + $s_ssolve + $s_srespon + $s_sterm + $s_staffAverage;
$average_sevice_officer = number_format($sevice_officer / 6, 2);

$officer_std = $s_smileStdDeviation + $s_willingStdDeviation + $s_ssolveStdDeviation + $s_sresponStdDeviation + $s_stermStdDeviation + $s_staffAverageStdDeviation;
$sevice_officer_std = number_format($officer_std / 6, 2);

// ด้านคุณภาพการให้บริการ	
$sevice_ser = $s_slaw + $s_stime + $s_sfast + $s_shelp + $s_seasy + $s_sappoint;
$service_ser = number_format($sevice_ser / 6, 2);

$service_std = $s_slawStdDeviation + $s_stimeStdDeviation + $s_sfastStdDeviation + $s_shelpStdDeviation + $s_seasyStdDeviation + $s_sappointStdDeviation;
$sevice_quality_std = number_format($service_std / 6, 2);

// ด้านสถานที่		
$location_point = $s_sclean + $s_sfacility + $s_soverall;
$average_location_point = number_format($location_point / 3, 2);

$location_std = $s_scleanStdDeviation + $s_sfacilityStdDeviation + $s_soverallStdDeviation;
$ser_location_std = number_format($location_std / 3, 2);
?> 
