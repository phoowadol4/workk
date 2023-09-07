<!DOCTYPE html>
<html>
<head>
    <title>work</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <style>
        #body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(to right bottom, #7bc7e6, #85cbe4, #90cfe2, #9bd3e1, #a6d6e0, #91d1e2, #7acce5, #60c6e9, #00b4f7, #009eff, #0083ff, #435fff);
        }
        #map {
            height: 500px;
        }
    </style>
</head>
<body>
    <form method="GET" action="new.php" class="mt-4 flex items-center justify-end">
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
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
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
    $apiUrl2 = 'https://api.healthserv.gistnu.nu.ac.th/houses'; 
    $curl2 = curl_init();
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
    
            
            if (isset($_GET['result'])) {
              $searchQuery = $_GET['result'];
          
            
              $hasData = true; 
            }
            $searchQuery = isset($_GET['result']) ? $_GET['result'] : '';
    

    if (isset($data2['result']) && !empty($data2['result'])) {
      echo '<h2> </h2>';
      echo '<thead><td>   
      </td></thead>';

        foreach ($data2['result'] as $item) {
            if ($item['house_id'] == $searchQuery) {
                echo '<script>';
                echo 'var map = L.map(\'map\').setView([' . $item['latitude'] . ', ' . $item['longitude'] . '], 15);';
                echo 'L.tileLayer(\'https://tile.openstreetmap.org/{z}/{x}/{y}.png\', {
                    attribution: \'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors\'
                }).addTo(map);';
                echo 'L.marker([' . $item['latitude'] . ', ' . $item['longitude'] . ']).addTo(map)';
                echo '.bindPopup(\'A pretty CSS popup.<br> Easily customizable.<a href="visit.php" class="text-white bg-red-600 ">เยี่ยมบ้าน</a>\').openPopup();';
                echo '</script>';
            }
        }

        echo '</table>';
    }
    curl_close($curl2);
    ?>
    
   
    
    <a href="logout.php" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-800">Logout</a>
</body>
</html>
