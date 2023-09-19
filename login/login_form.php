<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <title>เข้าสู่ระบบ</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(to right bottom, #7bc7e6, #85cbe4, #90cfe2, #9bd3e1, #a6d6e0, #91d1e2, #7acce5, #60c6e9, #00b4f7, #009eff, #0083ff, #435fff);
        }
    </style>
</head>
<body>
  
    <div class="w-full max-w-md bg-white shadow-md rounded px-8 pt-6 pb-8">
        <div class="flex justify-center items-center flex-col">
            <img class="h-20" src="../รูป/รพสต.png" alt="รพสต">
            <h2 class="text-2xl text-center mb-6">เข้าสู่ระบบ</h2>
            <form method="POST" action="login_form.php">
                <label class="block text-gray-700 text-sm font-bold mb-2 " for="username">ชื่อผู้ใช้:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-20 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" id="username" placeholder="@ชื่อผู้ใช้" required><br><br>

                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">รหัสผ่าน:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-20 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" id="password" placeholder="@รหัสผ่าน" required><br><br>

                <input type="submit" class="text-white bg-indigo-700 shadow-lg shadow-indigo-700/50 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="ล็อกอิน">
            </form>
        </div>
    </div>

    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    document.addEventListener("submit", function() {
        <?php
        session_start(); // Start the session

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
                header('Location: login_form.php'); // Redirect to retrieve_token.php
                exit();
            }
        }

        if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $url = 'https://api.healthserv.gistnu.nu.ac.th/auth/login';
            $data = [
                'username' => $username,
                'password' => $password,
            ];
            $jsonData = json_encode($data);

            $ch = curl_init();

            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $jsonData,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                ],
            ));

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            $errorMessage = '';

            if ($httpCode === 200) {
                $responseData = json_decode($response, true);
                if (isset($responseData['result']['token'])) {
                    $_SESSION['token'] = $responseData['result']['token'];
                    $_SESSION['token_timestamp'] = time(); // Store the token timestamp
                    header("Location: ../public/index2.php");
                    exit();
                } else {
                    $errorMessage = 'Token is missing. Please try again.';
                }
            } else if ($httpCode === 401 || $httpCode === 404) {
                $errorMessage = 'Login failed. Invalid username or password.';
            } else {
                $errorMessage = 'Login failed. HTTP Status Code: ' . $httpCode;
            }
            // if ($httpCode !== 200) {
            //   echo "Swal.fire({
            //       icon: 'error',
            //       title: 'Oops...',
            //       text: '$errorMessage',
            //   }).then(function() {
            //       setTimeout(function() {
            //           window.location.href = 'login_form.php'; // Redirect to login page
            //       }, 4000); // Delay in milliseconds (e.g., 4000ms = 4 seconds)
            //   });";
            // }
        }
        ?>
    });
</script>
</body>
</html>
