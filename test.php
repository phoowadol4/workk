
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
  <title>work</title>
  <style>
    body {
      height: 100vh;
      background-image: linear-gradient(to right bottom, #7bc7e6, #85cbe4, #90cfe2, #9bd3e1, #a6d6e0, #91d1e2, #7acce5, #60c6e9, #00b4f7, #009eff, #0083ff, #435fff);
    }
  </style>
</head>
<body>
  <form method="GET" action="test.php" class="mt-4 flex items-center justify-end">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
      <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
      </div>
      <input type="search" id="default-search" name="result" class="block w-full p-4 pr-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ค้นหา ,รายชื่อ" required>
      <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
  </form>
  <?php

session_start();
if (!isset($_SESSION['token'])) {
  $tokenExpiration = time() + 60; 
  $_SESSION['token'] = $token;
  $_SESSION['token_expiration'] = $tokenExpiration;
  header("Location: login_form.php"); 
  exit();
}
  $token = $_SESSION['token'];


$apiUrl = 'https://api.healthserv.gistnu.nu.ac.th/persons';
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));
    

    $response = curl_exec($curl);

    if ($response === false) {
        echo 'API request failed: ' . curl_error($curl);
    } else {
        $data = json_decode($response, true);
        
        if (isset($_GET['result'])) {
          $searchQuery = $_GET['result'];
      
        
          $hasData = true; 
        }
        if (isset($data['result']) && !empty($data['result'])) {
            echo '<h2>Search Results</h2>';
            echo '<table>';
            echo '<thead><tr>
          
            </tr></thead>';
            echo '<tbody>';
            $searchQuery = "John";
            foreach ($data['result'] as $person) {
                // Check if the ID matches the search query
                if ($person['fname'] == $searchQuery || $person['id'] == $searchQuery ) {
                  echo "<tr>
                  <td>" . $person['cid'] . "</td>
                  <td>" . $person['pname'] . "</td>
                  <td>" . $person['fname'] . "</td>
                  <td>" . $person['lname'] . "</td>
                  <td>" . $person['pcode'] . "</td>
                  <td>" . $person['sex'] . "</td>
                  <td>" . $person['nationality'] . "</td>
                  <td>" . $person['citizenship'] . "</td>
                  <td>" . $person['education'] . "</td>
                  <td>" . $person['occupation'] . "</td>
                  <td>" . $person['religion'] . "</td>
                  <td>" . $person['marrystatus'] . "</td>
                  <td>" . $person['house_regist_type_id'] . "</td>
                  <td>" . $person['birthdate'] . "</td>
                  <td>" . $person['has_house_regist'] . "</td>
                  <td>" . $person['chronic_disease_list'] . "</td>
                  <td>" . $person['club_list'] . "</td>
                  <td>" . $person['village_id'] . "</td>
                  <td>" . $person['blood_group'] . "</td>
                  <td>" . $person['current_age'] . "</td>
                  <td>" . $person['death_date'] . "</td>
                  <td>" . $person['hos_guid'] . "</td>
                  <td>" . $person['income_per_year'] . "</td>
                  <td>" . $person['home_position_id'] . "</td>
                  <td>" . $person['family_position_id'] . "</td>
                  <td>" . $person['drug_allergy'] . "</td>
                  <td>" . $person['last_update'] . "</td>
                  <td>" . $person['death'] . "</td>
                  <td>" . $person['pttype'] . "</td>
                  <td>" . $person['pttype_begin_date'] . "</td>
                  <td>" . $person['pttype_expire_date'] . "</td>
                  <td>" . $person['pttype_hospmain'] . "</td>
                  <td>" . $person['pttype_hospsub'] . "</td>
                  <td>" . $person['father_person_id'] . "</td>
                  <td>" . $person['mother_person_id'] . "</td>
                  <td>" . $person['pttype_no'] . "</td>
                  <td>" . $person['sps_person_id'] . "</td>
                  <td>" . $person['birthtime'] . "</td>
                  <td>" . $person['age_y'] . "</td>
                  <td>" . $person['age_m'] . "</td>
                  <td>" . $person['age_d'] . "</td>
                  <td>" . $person['family_id'] . "</td>
                  <td>" . $person['person_house_position_id'] . "</td>
                  <td>" . $person['couple_person_id'] . "</td>
                  <td>" . $person['person_guid'] . "</td>
                  <td>" . $person['house_guid'] . "</td>
                  <td>" . $person['last_update_pttype'] . "</td>
                  <td>" . $person['patient_link'] . "</td>
                  <td>" . $person['patient_hn'] . "</td>
                  <td>" . $person['found_dw_emr'] . "</td>
                  <td>" . $person['person_discharge_id'] . "</td>
                  <td>" . $person['movein_date'] . "</td>
                  <td>" . $person['discharge_date'] . "</td>
                  <td>" . $person['person_labor_type_id'] . "</td>
                  <td>" . $person['father_name'] . "</td>
                  <td>" . $person['mother_name'] . "</td>
                  <td>" . $person['sps_name'] . "</td>
                  <td>" . $person['father_cid'] . "</td>
                  <td>" . $person['mother_cid'] . "</td>
                  <td>" . $person['sps_cid'] . "</td>
                  <td>" . $person['bloodgroup_rh'] . "</td>
                  <td>" . $person['home_phone'] . "</td>
                  <td>" . $person['old_code'] . "</td>
                  <td>" . $person['deformed_status'] . "</td>
                  <td>" . $person['ncd_dm_history_type_id'] . "</td>
                  <td>" . $person['ncd_ht_history_type_id'] . "</td>
                  <td>" . $person['agriculture_member_type_id'] . "</td>
                  <td>" . $person['senile'] . "</td>
                  <td>" . $person['in_region'] . "</td>
                  <td>" . $person['body_weight_kg'] . "</td>
                  <td>" . $person['height_cm'] . "</td>
                  <td>" . $person['nutrition_level'] . "</td>
                  <td>" . $person['height_nutrition_level'] . "</td>
                  <td>" . $person['bw_ht_nutrition_level'] . "</td>
                  <td>" . $person['hometel'] . "</td>
                  <td>" . $person['worktel'] . "</td>
                  <td>" . $person['register_conflict'] . "</td>
                  <td>" . $person['care_person_name'] . "</td>
                  <td>" . $person['work_addr'] . "</td>
                  <td>" . $person['person_dm_screen_status_id'] . "</td>
                  <td>" . $person['person_ht_screen_status_id'] . "</td>
                  <td>" . $person['person_stroke_screen_status_id'] . "</td>
                  <td>" . $person['person_obesity_screen_status_id'] . "</td>
                  <td>" . $person['person_dmht_manage_type_id'] . "</td>
                  <td>" . $person['last_screen_dmht_bdg_year'] . "</td>
                  <td>" . $person['dw_chronic_register'] . "</td>
                  <td>" . $person['mobile_phone'] . "</td>
                  <td>" . $person['pttype_nhso_valid'] . "</td>
                  <td>" . $person['pttype_nhso_valid_datetime'] . "</td>
                  <td>" . $person['id'] . "</td>
                </tr>";
      }
                echo "</table>";
      }
  
        } else {
            echo 'No data found.';
        }
    }

    curl_close($curl);

?>
<form method="post" action="logout.php">
<button type="submit" class="text-white bg-indigo-700 shadow-lg shadow-indigo-700/50 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="ล็อก">
  </body>
</html>
