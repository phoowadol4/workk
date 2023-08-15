<?php
// API endpoint URL
$url = 'https://api.healthserv.gistnu.nu.ac.th/surveys';

$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImJvb256YTY2IiwiaWF0IjoxNjkyMDc3Mjc2LCJleHAiOjE2OTIwODA4NzZ9.auCOfdCNUjomHv6NmChjKc_Nxs9JdZh9Ks2PZgv5fK0'
  ]);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
    exit();
}

// Close cURL
curl_close($ch);

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
// Assuming the JSON data contains an array of objects with a "value" field
// Example JSON data: [{"value": "A"}, {"value": "B"}, {"value": "A"}, ...]
$valueCountspop = array();

foreach ($dataArray['result'] as $itempop) {
    $fields = array(
        's_smile', 's_willing', 's_law', 's_time',
        's_fast', 's_help', 's_solve', 's_respon',
        's_easy', 's_appoint', 's_clean', 's_term',
        's_facility', 's_staff', 's_overall'
    );

    foreach ($fields as $field) {
        $valuepop = $itempop[$field];

        // If the value already exists in the $valueCountspop array, increment its count
        if (isset($valueCountspop[$valuepop])) {
            $valueCountspop[$valuepop]++;
        } else {
            // If the value does not exist in the $valueCountspop array, initialize its count to 1
            $valueCountspop[$valuepop] = 1;
        }
    }
}

// Sort the data in descending order based on the count
arsort($valueCountspop);

// Select the top 3 most popular data points
$top3Data = array_slice($valueCountspop, 0, 3);
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