<?php
session_start();
if (isset($_SESSION['token']) && isset($_SESSION['token_timestamp'])) {
    // Check if the token has expired (1 minute in this case)
    $tokenExpiration = $_SESSION['token_timestamp'] + 3600; // 1 minute
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
$valueCountsage = array();

foreach ($dataArray['result'] as $itemage) {
    $valueage = $itemage['age'];
    
    // If the value already exists in the $valueCounts array, increment its count
    if (isset($valueCountsage[$valueage])) {
        $valueCountsage[$valueage]++;
    } else {
        // If the value does not exist in the $valueCounts array, initialize its count to 1
        $valueCountsage[$valueage] = 1;
    }
}
ksort($valueCountsage);

?>
<?php
// Assuming the JSON data contains an array of objects with various rating fields
// Example JSON data: [{"s_smile": 5, "s_willing": 4, ...}, {"s_smile": 4, "s_willing": 5, ...}, ...]
$valueCountspop = array();
$ratingTotals = array();

foreach ($dataArray['result'] as $itempop) {
    $fields = array(
        's_smile', 's_willing', 's_law', 's_time',
        's_fast', 's_help', 's_solve', 's_respon',
        's_easy', 's_appoint', 's_clean', 's_term',
        's_facility', 's_staff', 's_overall'
    );

    foreach ($fields as $field) {
        $rating = $itempop[$field];

        // Ensure that the rating is between 1 and 5
        if ($rating >= 1 && $rating <= 5) {
            // If the rating already exists in the $valueCountspop array, increment its count and total
            if (isset($valueCountspop[$field][$rating])) {
                $valueCountspop[$field][$rating]++;
                $ratingTotals[$field] += $rating;
            } else {
                // If the rating does not exist in the $valueCountspop array, initialize its count to 1 and total to rating
                $valueCountspop[$field][$rating] = 1;
                $ratingTotals[$field] = $rating;
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

// Select the top 3 rated fields
$top3Ratings = array_slice($ratingAverages, 0, 5);

// Convert the data for use in JavaScript
// $top3Data = json_encode($top3Ratings);
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