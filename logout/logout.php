<?php
// เริ่มต้นเซสชัน
session_start();

// ลบตัวแปรเซสชันที่เกี่ยวข้องกับการเข้าสู่ระบบ
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['token']);
unset($_SESSION['token_expiration']);

// ล้างตัวแปรเซสชันทั้งหมด
session_unset();

// ทำลายเซสชัน
session_destroy();

// ส่งผู้ใช้ไปยังหน้าเข้าสู่ระบบ
header("Location: ../login/login_form.php");
exit();

// กำหนดค่า HTTP headers เพื่อป้องกันการแคชข้อมูล
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>