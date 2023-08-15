<?php
// API URL
$api_url1 = 'https://api.healthserv.gistnu.nu.ac.th/persons';
$api_url2 = 'https://api.healthserv.gistnu.nu.ac.th/houses';
// Bearer token
$bearer_token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImJvb256YTY2IiwiaWF0IjoxNjkyMDY2OTE4LCJleHAiOjE2OTIwNzA1MTh9.UsFqY3NNSe6Y4DyXt6ww-kMC1EU1kdJyYtuStpOaWt0';

// Initialize cURL session
$ch1 = curl_init($api_url1);
$ch2 = curl_init($api_url2);
// Set cURL options
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $bearer_token,
));
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $bearer_token,
));

// Execute cURL session and get the JSON response
$response1 = curl_exec($ch1);
$response2 = curl_exec($ch2);
// Check for cURL errors
if (curl_errno($ch1)) {
    echo "cURL Error: " . curl_error($ch1);
}
if (curl_errno($ch2)) {
    echo "cURL Error: " . curl_error($ch2);
}

// Close cURL session
curl_close($ch1);
curl_close($ch2);

// Parse JSON response
$data1 = json_decode($response1, true);
$data2 = json_decode($response2, true);

// Check if decoding was successful

// ... (previous code)

// Check if decoding was successful
if ($data1=== null) {
    echo "Error decoding JSON response.";
} else {
    // Start HTML table
    echo "<table border='1'>
                <th>cid</th>
                <th>pname</th>
                <th>fname</th>
                <th>lname</th>
                <th>pcode</th>
                <th>sex</th>
                <th>nationality</th>
                <th>citizenship</th>
                <th>education</th>
                <th>occupation</th>
                <th>religion</th>
                <th>marrystatus</th>
                <th>house_regist_type_id</th>
                <th>birthdate</th>
                <th>has_house_regist</th>
                <th>chronic_disease_list</th>
                <th>club_list</th>
                <th>village_id</th>
                <th>blood_group</th>
                <th>current_age</th>
                <th>death_date</th>
                <th>hos_guid</th>
                <th>income_per_year</th>
                <th>home_position_id</th>
                <th>family_position_id</th>
                <th>drug_allergy</th>
                <th>last_update</th>
                <th>death</th>
                <th>pttype</th>
                <th>pttype_begin_date</th>
                <th>pttype_expire_date</th>
                <th>pttype_hospmain</th>
                <th>pttype_hospsub</th>
                <th>father_person_id</th>
                <th>mother_person_id</th>
                <th>pttype_no</th>
                <th>sps_person_id</th>
                <th>birthtime</th>
                <th>age_y</th>
                <th>age_m</th>
                <th>age_d</th>
                <th>family_id</th>
                <th>person_house_position_id</th>
                <th>couple_person_id</th>
                <th>person_guid</th>
                <th>house_guid</th>
                <th>last_update_pttype</th>
                <th>patient_link</th>
                <th>patient_hn</th>
                <th>found_dw_emr</th>
                <th>person_discharge_id</th>
                <th>movein_date</th>
                <th>discharge_date</th>
                <th>person_labor_type_id</th>
                <th>father_name</th>
                <th>mother_name</th>
                <th>sps_name</th>
                <th>father_cid</th>
                <th>mother_cid</th>
                <th>sps_cid</th>
                <th>bloodgroup_rh</th>
                <th>home_phone</th>
                <th>old_code</th>
                <th>deformed_status</th>
                <th>ncd_dm_history_type_id</th>
                <th>ncd_ht_history_type_id</th>
                <th>agriculture_member_type_id</th>
                <th>senile</th>
                <th>in_region</th>
                <th>body_weight_kg</th>
                <th>height_cm</th>
                <th>nutrition_level</th>
                <th>height_nutrition_level</th>
                <th>bw_ht_nutrition_level</th>
                <th>hometel</th>
                <th>worktel</th>
                <th>register_conflict</th>
                <th>care_person_name</th>
                <th>work_addr</th>
                <th>person_dm_screen_status_id</th>
                <th>person_ht_screen_status_id</th>
                <th>person_stroke_screen_status_id</th>
                <th>person_obesity_screen_status_id</th>
                <th>person_dmht_manage_type_id</th>
                <th>last_screen_dmht_bdg_year</th>
                <th>dw_chronic_register</th>
                <th>mobile_phone</th>
                <th>pttype_nhso_valid</th>
                <th>pttype_nhso_valid_datetime</th>
                <th>id</th>
                <tr>
                <!-- ... (header columns) ... -->
                </tr>";

            
            

    // Loop through data and populate table rows
    foreach ($data1['result'] as $entry) {
        echo "<tr>
                <td>" . $entry['cid'] . "</td>
                <td>" . $entry['pname'] . "</td>
                <td>" . $entry['fname'] . "</td>
                <td>" . $entry['lname'] . "</td>
                <td>" . $entry['pcode'] . "</td>
                <td>" . $entry['sex'] . "</td>
                <td>" . $entry['nationality'] . "</td>
                <td>" . $entry['citizenship'] . "</td>
                <td>" . $entry['education'] . "</td>
                <td>" . $entry['occupation'] . "</td>
                <td>" . $entry['religion'] . "</td>
                <td>" . $entry['marrystatus'] . "</td>
                <td>" . $entry['house_regist_type_id'] . "</td>
                <td>" . $entry['birthdate'] . "</td>
                <td>" . $entry['has_house_regist'] . "</td>
                <td>" . $entry['chronic_disease_list'] . "</td>
                <td>" . $entry['club_list'] . "</td>
                <td>" . $entry['village_id'] . "</td>
                <td>" . $entry['blood_group'] . "</td>
                <td>" . $entry['current_age'] . "</td>
                <td>" . $entry['death_date'] . "</td>
                <td>" . $entry['hos_guid'] . "</td>
                <td>" . $entry['income_per_year'] . "</td>
                <td>" . $entry['home_position_id'] . "</td>
                <td>" . $entry['family_position_id'] . "</td>
                <td>" . $entry['drug_allergy'] . "</td>
                <td>" . $entry['last_update'] . "</td>
                <td>" . $entry['death'] . "</td>
                <td>" . $entry['pttype'] . "</td>
                <td>" . $entry['pttype_begin_date'] . "</td>
                <td>" . $entry['pttype_expire_date'] . "</td>
                <td>" . $entry['pttype_hospmain'] . "</td>
                <td>" . $entry['pttype_hospsub'] . "</td>
                <td>" . $entry['father_person_id'] . "</td>
                <td>" . $entry['mother_person_id'] . "</td>
                <td>" . $entry['pttype_no'] . "</td>
                <td>" . $entry['sps_person_id'] . "</td>
                <td>" . $entry['birthtime'] . "</td>
                <td>" . $entry['age_y'] . "</td>
                <td>" . $entry['age_m'] . "</td>
                <td>" . $entry['age_d'] . "</td>
                <td>" . $entry['family_id'] . "</td>
                <td>" . $entry['person_house_position_id'] . "</td>
                <td>" . $entry['couple_person_id'] . "</td>
                <td>" . $entry['person_guid'] . "</td>
                <td>" . $entry['house_guid'] . "</td>
                <td>" . $entry['last_update_pttype'] . "</td>
                <td>" . $entry['patient_link'] . "</td>
                <td>" . $entry['patient_hn'] . "</td>
                <td>" . $entry['found_dw_emr'] . "</td>
                <td>" . $entry['person_discharge_id'] . "</td>
                <td>" . $entry['movein_date'] . "</td>
                <td>" . $entry['discharge_date'] . "</td>
                <td>" . $entry['person_labor_type_id'] . "</td>
                <td>" . $entry['father_name'] . "</td>
                <td>" . $entry['mother_name'] . "</td>
                <td>" . $entry['sps_name'] . "</td>
                <td>" . $entry['father_cid'] . "</td>
                <td>" . $entry['mother_cid'] . "</td>
                <td>" . $entry['sps_cid'] . "</td>
                <td>" . $entry['bloodgroup_rh'] . "</td>
                <td>" . $entry['home_phone'] . "</td>
                <td>" . $entry['old_code'] . "</td>
                <td>" . $entry['deformed_status'] . "</td>
                <td>" . $entry['ncd_dm_history_type_id'] . "</td>
                <td>" . $entry['ncd_ht_history_type_id'] . "</td>
                <td>" . $entry['agriculture_member_type_id'] . "</td>
                <td>" . $entry['senile'] . "</td>
                <td>" . $entry['in_region'] . "</td>
                <td>" . $entry['body_weight_kg'] . "</td>
                <td>" . $entry['height_cm'] . "</td>
                <td>" . $entry['nutrition_level'] . "</td>
                <td>" . $entry['height_nutrition_level'] . "</td>
                <td>" . $entry['bw_ht_nutrition_level'] . "</td>
                <td>" . $entry['hometel'] . "</td>
                <td>" . $entry['worktel'] . "</td>
                <td>" . $entry['register_conflict'] . "</td>
                <td>" . $entry['care_person_name'] . "</td>
                <td>" . $entry['work_addr'] . "</td>
                <td>" . $entry['person_dm_screen_status_id'] . "</td>
                <td>" . $entry['person_ht_screen_status_id'] . "</td>
                <td>" . $entry['person_stroke_screen_status_id'] . "</td>
                <td>" . $entry['person_obesity_screen_status_id'] . "</td>
                <td>" . $entry['person_dmht_manage_type_id'] . "</td>
                <td>" . $entry['last_screen_dmht_bdg_year'] . "</td>
                <td>" . $entry['dw_chronic_register'] . "</td>
                <td>" . $entry['mobile_phone'] . "</td>
                <td>" . $entry['pttype_nhso_valid'] . "</td>
                <td>" . $entry['pttype_nhso_valid_datetime'] . "</td>
                <td>" . $entry['id'] . "</td>
              </tr>";
    }
              echo "</table>";
    }

              if ($data2=== null) {
                echo "Error decoding JSON response.";
            } else {
                // Start HTML table
                echo "<table border='1'>
                            <th>id</th>
                            <th>house_id</th>
                            <th>village_id</th>
                            <th>address</th>
                            <th>road</th>
                            <th>census_id</th>
                            <th>hos_guid</th>
                            <th>location_area_id</th>
                            <th>latitude</th>
                            <th>longitude</th>
                            <th>family_count</th>
                            <th>last_update</th>
                            <th>house_type_id</th>
                            <th>house_guid</th>
                            <th>village_guid</th>
                            <th>doctor_code</th>
                            <th>head_person_id</th>
                            <th>utm_lat</th>
                            <th>utm_long</th>
                            <th>house_social_survey_staff</th>
                            <th>house_subtype_id</th>
                            <th>house_condo_roomno</th>
                            <th>house_condo_name</th>
                            <th>house_housing_development_name</th>
                            <th>doctor_code2</th>
                            <th>vms_person_id</th>
                            <th>person_count</th>
                            <th>address_int</th>
                            <th>id</th>
                            <tr>
                            <!-- ... (table data columns) ... -->
                        </tr>";


    foreach ($data2['result'] as $entry) {
        echo "<tr>
                <td>" . $entry['id'] . "</td>
                <td>" . $entry['house_id'] . "</td>
                <td>" . $entry['village_id'] . "</td>
                <td>" . $entry['address'] . "</td>
                <td>" . $entry['road'] . "</td>
                <td>" . $entry['census_id'] . "</td>
                <td>" . $entry['hos_guid'] . "</td>
                <td>" . $entry['location_area_id'] . "</td>
                <td>" . $entry['latitude'] . "</td>
                <td>" . $entry['longitude'] . "</td>
                <td>" . $entry['family_count'] . "</td>
                <td>" . $entry['last_update'] . "</td>
                <td>" . $entry['house_type_id'] . "</td>
                <td>" . $entry['house_guid'] . "</td>
                <td>" . $entry['village_guid'] . "</td>
                <td>" . $entry['doctor_code'] . "</td>
                <td>" . $entry['head_person_id'] . "</td>
                <td>" . $entry['utm_lat'] . "</td>
                <td>" . $entry['utm_long'] . "</td>
                <td>" . $entry['house_social_survey_staff'] . "</td>
                <td>" . $entry['house_subtype_id'] . "</td>
                <td>" . $entry['house_condo_roomno'] . "</td>
                <td>" . $entry['house_condo_name'] . "</td>
                <td>" . $entry['house_housing_development_name'] . "</td>
                <td>" . $entry['doctor_code2'] . "</td>
                <td>" . $entry['vms_person_id'] . "</td>
                <td>" . $entry['person_count'] . "</td>
                <td>" . $entry['address_int'] . "</td>
               
              </tr>";
    }
              echo "</table>";
                    
    }
            
    echo "</table>";

?>
