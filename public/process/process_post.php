<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
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


    $url = 'https://api.healthserv.gistnu.nu.ac.th/surveys/submit-survey';

    $dateTime = new DateTime($date);
        $formattedDateTime = $dateTime ->format('Y-m-d\TH:i:s.000\Z');
// $_SESSION['comments'],
    $data = [
        'sex' => $gender,
        'answerer' =>  $people,
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

    $jsonData = json_encode($data);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Error: ' . curl_error($ch);
    } else {

      echo $response. "<br>";

    
  }
     
curl_close($ch);
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_SESSION['gender'],  $_SESSION['age'], $_SESSION['date'], $_SESSION['ever'])) {

    $url = 'https://api.healthserv.gistnu.nu.ac.th/surveys/submit-survey';

    $dateTime = new DateTime($_SESSION['date']);
        $formattedDateTime = $dateTime ->format('Y-m-d\TH:i:s.000\Z');
// $_SESSION['comments'],
    $data = [
        'sex' => $_SESSION['gender'],
        'answerer' => $_SESSION['people'],
        'age' => (int)$_SESSION['age'],
        'date_time' => $formattedDateTime,
        'countEver' => $_SESSION['ever']
    ];

    $jsonData = json_encode($data);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Error: ' . curl_error($ch);
    } else {

      echo $response. "<br>";

    
  }
    

    // $_SESSION['gender'] = $_POST['gender'];
    // $_SESSION['date'] = $_POST['date'];
    // $_SESSION['age'] = $_POST['age'];
    // $_SESSION['ever'] = $_POST['ever']; 

    // $curl = curl_init();
    // curl_setopt_array($curl, array(
    //   CURLOPT_URL => 'https://api.healthserv.gistnu.nu.ac.th/surveys/submit-survey',
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_ENCODING => '',
    //   CURLOPT_MAXREDIRS => 10,
    //   CURLOPT_TIMEOUT => 0,
    //   CURLOPT_FOLLOWLOCATION => true,
    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //   CURLOPT_CUSTOMREQUEST => 'POST',
    //   CURLOPT_POSTFIELDS =>'{
    //   "sex": "'.$_POST["gender"].'",
    //   "answerer": "I am",
    //   "age": '.$_POST["age"].',
    //   "date_time": "'.$_POST["date"].'",
    //   "countEver": "'.$_POST["ever"].'"
    // }',
    //   CURLOPT_HTTPHEADER => array(
    //     'Content-Type: application/json'
    //   ),
    // ));
    
    // $response = curl_exec($curl);
    // curl_close($curl);
    // // echo $response;
    //     }
      

    // header("Location: form2.php");
    // exit();

//rd 2 form 2 radio button 
    // }elseif (isset($_POST['rd_1']) && isset($_POST['rd_2'])&& isset($_POST['rd_3'])&& isset($_POST['rd_4'])&& isset($_POST['rd_5'])&& isset($_POST['rd_6'])&& isset($_POST['rd_7'])) {
    // $_SESSION['rd_1'] = $_POST['rd_1'];
    // $_SESSION['rd_2'] = $_POST['rd_2'];
    // $_SESSION['rd_3'] = $_POST['rd_3'];
    // $_SESSION['rd_4'] = $_POST['rd_4'];
    // $_SESSION['rd_5'] = $_POST['rd_5'];
    // $_SESSION['rd_6'] = $_POST['rd_6'];
    // $_SESSION['rd_7'] = $_POST['rd_7'];
    
    // header("Location: form3.php");
    // exit();


    //rd 3 form 3 radio button
// } elseif (isset($_POST['rd_8']) && isset($_POST['rd_9'])&& isset($_POST['rd_10'])&& isset($_POST['rd_11'])&& isset($_POST['rd_12'])&& isset($_POST['rd_13'])&& isset($_POST['rd_14'])&& isset($_POST['rd_15'])) {
//     $_SESSION['rd_8'] = $_POST['rd_8'];
//     $_SESSION['rd_9'] = $_POST['rd_9'];
//     $_SESSION['rd_10'] = $_POST['rd_10'];
//     $_SESSION['rd_11'] = $_POST['rd_11'];
//     $_SESSION['rd_12'] = $_POST['rd_12'];
//     $_SESSION['rd_13'] = $_POST['rd_13'];
//     $_SESSION['rd_14'] = $_POST['rd_14'];
//     $_SESSION['rd_15'] = $_POST['rd_15'];


//comment orther ข้อเสนอแนะ


    // header("Location: orther.php");
    // exit();
    // }elseif (isset($_POST['comments'])) {
    // $_SESSION['comments']=$_POST['comments'];

    // header("Location: success.php");
    // exit();

curl_close($ch);

    // Clear session data after processing
    
     } else {
    echo "Data is missing. Please go back and fill in all required fields.";
}
    session_unset();
    session_destroy();
?>
<!-- ?> -->