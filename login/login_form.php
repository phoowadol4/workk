<?php
// เริ่มต้น session เพื่อให้ระบบเก็บข้อมูลเซสชัน
session_start();

// เรียกใช้ไฟล์ process_login.php ตรวจสอบการเข้าสู่ระบบ
include("process_login.php");

// จัดการเมื่อมีการส่งข้อมูลจากฟอร์มการเข้าสู่ระบบผ่านวิธี POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่ามีการส่งข้อมูลชื่อผู้ใช้และรหัสผ่านมาหรือไม่
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // เก็บข้อมูลชื่อผู้ใช้และรหัสผ่านในตัวแปรเซสชัน
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        
        // ตรวจสอบสถานะการเข้าสู่ระบบหลังจากการส่งฟอร์ม
        if (checkLoginStatus()) {
            // ส่งผู้ใช้ไปยังหน้าสำเร็จหรือทำอย่างอื่นๆ หลังจากการเข้าสู่ระบบสำเร็จ
            // คุณสามารถเพิ่มตรรกะของคุณเองที่นี่
            header("Location: ../public/index2.php");
            exit();
        } else {
            // กำหนดข้อความข้อผิดพลาดหากชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง
            $_SESSION['login_error'] = 'ชื่อ หรือ รหัสผ่านไม่ถูกต้อง';
            // ส่งผู้ใช้กลับไปยังหน้าเข้าสู่ระบบพร้อมข้อความข้อผิดพลาด
            header("Location: login_form.php");
            exit();
        }
    }
}
?>

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
        height: 100vh;
        /* ความสูงเต็มหน้าจอ */
        /* สร้างพื้นหลังเป็นลายเส้นสีไปสีมาด้านขวาล่าง */
        background-image: linear-gradient(to right bottom, #7bc7e6, #85cbe4, #90cfe2, #9bd3e1, #a6d6e0, #91d1e2, #7acce5, #60c6e9, #00b4f7, #009eff, #0083ff, #435fff);
        background-color: #90cfe2;
        /* สีพื้นหลังหลัก */
    }

    /* กำหนดรูปแบบสำหรับคอนเทนเนอร์แบบฟอร์ม */
    .form-container {
        display: flex;
        /* แสดงเป็น Flexbox เพื่อจัดหน้าให้อยู่กึ่งกลาง */
        justify-content: center;
        /* จัดตำแหน่งแนวนอนกึ่งกลาง */
        align-items: center;
        /* จัดตำแหน่งแนวตั้งกึ่งกลาง */
        position: fixed;
        /* กำหนดให้อยู่ในตำแหน่งที่แน่นอนบนหน้าจอ */
        top: 50%;
        /* จัดให้อยู่ที่ครึ่งสูงสุดของหน้าจอ */
        left: 50%;
        /* จัดให้อยู่ที่ครึ่งกว้างสุดของหน้าจอ */
        transform: translate(-50%, -50%);
        /* จัดให้อยู่กึ่งกลางทั้งแนวนอนและแนวตั้ง */
        background-color: white;
        /* สีพื้นหลังของคอนเทนเนอร์ */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        /* เพิ่มเงาให้คอนเทนเนอร์ */
        padding: 20px;
        /* ระยะห่างขอบภายในคอนเทนเนอร์ */
        border-radius: 10px;
        /* กำหนดรูปร่างมุมของคอนเทนเนอร์ */
        max-width: 100%;
        /* ความกว้างสูงสุด */
        width: 500px;
        /* ความกว้างของคอนเทนเนอร์ */
    }
    </style>
</head>

<body>
    <div class="form-container">
        <!-- แบบฟอร์มเข้าสู่ระบบ -->
        <div class="flex justify-center items-center flex-col">
            <img class="h-20" src="../รูป/รพสต.png" alt="รพสต">

            <h2 class="text-2xl text-center mb-6">เข้าสู่ระบบ</h2>
            <!-- เริ่มแบบฟอร์ม -->
            <form method="POST" action="login_form.php">

                <!-- ช่องกรอกชื่อผู้ใช้ -->
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">ชื่อผู้ใช้:</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-20 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" name="username" id="username" placeholder="@ชื่อผู้ใช้" required><br><br>

                <!-- ช่องกรอกรหัสผ่าน -->
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">รหัสผ่าน:</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-20 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="password" name="password" id="password" placeholder="@รหัสผ่าน" required><br><br>

                <!-- ปุ่มสำหรับสมัครสมาชิก -->
                <a href="../register/register.php"
                    class="text-white bg-indigo-700 shadow-lg shadow-indigo-700/50 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">สมัครสมาชิก</a>
                <!-- ปุ่มสำหรับล็อกอินเข้าสู่ระบบ -->
                <input type="submit"
                    class="text-white bg-indigo-700 shadow-lg shadow-indigo-700/50 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    value="ล็อกอิน">
            </form>
            <!-- สิ้นสุดแบบฟอร์ม -->
        </div>
    </div>

    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
    // ฟังก์ชันสำหรับตรวจสอบสถานะการเข้าสู่ระบบ
    function checkLoginStatus() {
        $.ajax({
            type: "POST",
            url: "process_login.php", // สร้างไฟล์ PHP แยกเพื่อตรวจสอบสถานะการเข้าสู่ระบบ
            dataType: "json",
            encode: true,
            success: function(response) {
                if (response.loggedIn) {
                    // $("#login-status").html("สถานะ: เข้าสู่ระบบแล้ว");
                } else {
                    // $("#login-status").html("สถานะ: ยังไม่ได้เข้าสู่ระบบ");
                }
            },
            error: function() {
                // $("#login-status").html("สถานะ: เกิดข้อผิดพลาดในการตรวจสอบสถานะ");
            }
        });
    }

    // ตรวจสอบสถานะการเข้าสู่ระบบเริ่มต้นและทุก 10 วินาที
    checkLoginStatus();
    setInterval(checkLoginStatus, 10000); // ตรวจสอบทุก 10 วินาที

    // แสดง SweetAlert สำหรับข้อผิดพลาดในการเข้าสู่ระบบ (ถ้ามี)
    <?php if (isset($_SESSION['login_error'])) : ?>
    Swal.fire({
        icon: 'error',
        title: 'เข้าสู่ระบบล้มเหลว',
        text: '<?= $_SESSION['login_error']; ?>',
    });
    <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>
    </script>
</body>

</html>