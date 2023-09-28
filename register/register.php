<!DOCTYPE html>
<html lang="en">

<head>
    <!-- กำหนดเพื่อทำให้เว็บไซต์เป็น responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ลิงก์สำหรับ SweetAlert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <!-- ลิงก์สำหรับ Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">

    <!-- ลิงก์สำหรับ animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- กำหนดหัวเรื่องของหน้าเว็บ -->
    <title>สมัครสมาชิก</title>

    <!-- ลิงก์ JavaScript สำหรับ jQuery -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

    <!-- รูปแบบของหน้าเว็บ -->
    <style>
    body {
        height: 100vh;
        background-image: linear-gradient(to right bottom, #7bc7e6, #85cbe4, #90cfe2, #9bd3e1, #a6d6e0, #91d1e2, #7acce5, #60c6e9, #00b4f7, #009eff, #0083ff, #435fff);
        background-color: #90cfe2;
    }

    .form-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 10px;
        max-width: 100%;
        width: 530px;
    }

    .center-button {
        display: flex;
        justify-content: center;
        gap: 10px;
        /* ระยะห่างระหว่างปุ่ม */
    }
    </style>
</head>

<body>
    <div class="form-container">
        <!-- แบบฟอร์มสำหรับการสมัครสมาชิก -->
        <form action="register.php" method="post">
            <h2 class="text-2xl text-center mb-6">สมัครสมาชิก</h2>

            <!-- ช่องกรอก Username -->
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">ชื่อผู้ใช้:</label>
            <input type="text" name="username" required
                class="appearance-none border rounded w-full py-2 px-20 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><br><br>

            <!-- ช่องกรอก Password -->
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">รหัสผ่าน:</label>
            <input type="password" name="password" required
                class="appearance-none border rounded w-full py-2 px-20 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><br><br>

            <!-- ช่องกรอก Email -->
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">อีเมล:</label>
            <input type="email" name="email" required
                class="appearance-none border rounded w-full py-2 px-20 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><br><br>

            <!-- ช่องกรอก ชื่อ-นาสกุล -->
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">ชื่อ-นาสกุล:</label>
            <input type="text" name="name" required
                class="appearance-none border rounded w-full py-2 px-20 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><br><br>

            <!-- ช่องใส่ secret password ซึ่งถูกสร้างโดย JavaScript -->
            <input type="hidden" name="secret_password" id="secret_password">

            <div class="center-button">

                <!-- ลิงก์สำหรับย้อนกลับไปหน้า login_form.php -->
                <a href="../login/login_form.php"
                    class="text-white bg-indigo-700 shadow-lg shadow-indigo-700/50 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ย้อนกลับ</a>

                <!-- ปุ่มสมัครสมาชิก -->
                <input type="submit" value="สมัครสมาชิก"
                    class="text-white bg-indigo-700 shadow-lg shadow-indigo-700/50 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">


            </div>
        </form>

        <!-- สคริปต์ JavaScript สำหรับการใช้ SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>

        <script>
        // สร้างตัวแปรเพื่อเก็บ secret password
        let secretPassword = '';

        // ฟังก์ชันสำหรับการส่งข้อมูลแบบฟอร์ม
        async function submitForm() {
            const {
                value: secret_pass
            } = await Swal.fire({
                title: 'Secret Password',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                input: 'password',
                inputLabel: 'ใส่รหัส',
                inputPlaceholder: 'ใส่ secret password',
                inputAttributes: {
                    maxlength: 10,
                    autocapitalize: 'off',
                    autocorrect: 'off',
                },
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
            })

            if (secret_pass) {
                secretPassword = secret_pass;
                Swal.fire(`Entered password: ${secret_pass}`)

                // กำหนดค่า secret_password ในแบบฟอร์ม
                document.getElementById('secret_password').value = secretPassword;

                // ส่งแบบฟอร์ม
                document.querySelector('form').submit();
            }
        }

        // รอการส่งแบบฟอร์มเมื่อกดปุ่ม Submit
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            submitForm();
        });
        </script>

        <!-- ส่วน PHP สำหรับการตรวจสอบและส่งข้อมูล -->
        <?php
    // ตรวจสอบว่ามีการส่งข้อมูลผ่านแบบฟอร์ม POST หรือไม่
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // รับค่าข้อมูลจากแบบฟอร์ม
        $username = isset($_POST['username']) ? $_POST['username'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";
        $secret_pass = isset($_POST['secret_password']) ? $_POST['secret_password'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $name = isset($_POST['name']) ? $_POST['name'] : "";

        // บันทึกข้อมูลในตัวแปร session
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['secret_password'] = $secret_pass;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;

        // URL สำหรับส่งข้อมูลไปยังเซิร์ฟเวอร์ผ่าน API
        $url = 'https://api.healthserv.gistnu.nu.ac.th/auth/register';

        // กำหนดข้อมูลที่จะส่งให้กับเซิร์ฟเวอร์
        $data = [
            'username' => $username,
            'password' => $password,
            'secret_pass' => $secret_pass,
            'email' => $email,
            'name' => $name,
        ];

        // แปลงข้อมูลเป็น JSON
        $jsonData = json_encode($data);

        // สร้างเซ็ตติ้งสำหรับการเรียกใช้ cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // ส่งคำร้องข้อมูลไปยังเซิร์ฟเวอร์และรับผลลัพธ์
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // ตรวจสอบสถานะการส่งข้อมูลและแสดงผล
        if ($httpCode === 200) {
            $responseData = json_decode($response, true);
            if (isset($responseData['result'])) {
                $_SESSION['success_message'] = "สมัครสมาชิกสำเร็จ";
            } else {
                $_SESSION['error_message'] = "สมัครล้มเหลวกรุณาลองใหม่.";
            }
        } elseif ($httpCode === 409) {
            $_SESSION['error_message'] = "มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว";
        } elseif ($httpCode === 500) {
            $_SESSION['error_message'] = "มีอีเมลนี้อยู่ในระบบแล้ว";
        } else {
            $_SESSION['error_message'] = "secret password ไม่ถูกต้อง ";
        }

        // แสดงผลลัพธ์ด้วย SweetAlert
        if (isset($_SESSION['success_message'])) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "สำเร็จ",
                    showClass: {
                        popup: "animate__animated animate__fadeInDown"
                    },
                    hideClass: {
                        popup: "animate__animated animate__fadeOutUp"
                    },
                    text: "' . $_SESSION['success_message'] . '",
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = "../login/login_form.php";
                });
            </script>';
            unset($_SESSION['success_message']);
        } elseif (isset($_SESSION['error_message'])) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "พบข้อผิดพลาด",
                    showClass: {
                        popup: "animate__animated animate__fadeInDown"
                    },
                    hideClass: {
                        popup: "animate__animated animate__fadeOutUp"
                    },
                    text: "' . $_SESSION['error_message'] . '",
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = "register.php";
                });
            </script>';
            unset($_SESSION['error_message']);
        } else {
            // ในกรณีที่ไม่มีข้อความผลลัพธ์ใด ๆ
            header("Location: register.php");
            exit();
        }
    }
    ?>
    </div>
</body>

</html>