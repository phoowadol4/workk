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
  <form method="GET" action="search.php" class="mt-4 flex items-center justify-end">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
      <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
      </div>
      <input type="search" id="default-search" name="query" class="block w-full p-4 pr-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ค้นหา ,รายชื่อ" required>
      <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
  </form>
  <?php
if (isset($_GET['query'])) {
  $searchQuery = $_GET['query'];

  // Check if there is data in the database
  $hasData = true; // Assuming there is data

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pokeapi.co/api/v2/pokemon/' . $searchQuery,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $responseData = json_decode($response, true);

  if (isset($responseData['name'])) {
    echo "<style>
            .pokemon-info {
              background-color: #f1f1f1;
              padding: 10px;
              margin-bottom: 10px;
              border-radius: 5px;
            }
            .pokemon-info h2 {
              color: #333;
              font-size: 18px;
              margin-bottom: 5px;
            }
            .pokemon-info p {
              color: #666;
              margin-bottom: 0;
            }
          </style>";

  //  echo "<h1>ชื่อ: " . $searchQuery . "</h1>";

    // Display search results from the database
    echo "<div class='pokemon-info'>";
    echo "<h2>Name: " . $responseData['name'] . "</h2>";
    echo "<p>Height: " . $responseData['height'] . "</p>";
    echo "<p>Weight: " . $responseData['weight'] . "</p>";
    echo "<img src='" . $responseData['sprites']['front_default'] . "' alt='Pokemon Image' width='500' height='500'>";
    // Add more data as needed
    echo "</div>";
  } else {
    echo "<h1>ไม่มีข้อมูล: " . $searchQuery . "</h1>";
  }
}
?>

  </body>
</html>
