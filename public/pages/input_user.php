<?php
// รวมไฟล์ process_get.php เพื่อใช้งานฟังก์ชันและตัวแปรที่อยู่ในไฟล์นี้
include("../process/post_form_and_get_.php");

// ตรวจสอบว่ามีตัวแปร $_SESSION['token'] อยู่หรือไม่
if (isset($_SESSION['token'])) {
    $token = $_SESSION['token'];
}

// เริ่มเซสชันใหม่ (หากยังไม่ได้เริ่ม)
session_start();

// ตรวจสอบว่าเป็นการร้องขอแบบ POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบความถูกต้องของข้อมูลที่รับมา
    if (isset($_POST['house_id']) && isset($_POST['cid']) && isset($_POST['pname']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['address']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
        // กำหนดค่าข้อมูลที่รับมาให้กับตัวแปรในเซสชัน
        $_SESSION['house_id'] = $_POST['house_id'];
        $_SESSION['cid'] = $_POST['cid'];
        $_SESSION['pname'] = $_POST['pname'];
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['latitude'] = $_POST['latitude'];
        $_SESSION['longitude'] = $_POST['longitude'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="apple-touch-icon" type="imfname/png"
        href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">

    <meta name="apple-mobile-web-app-title" content="CodePen">


    <link rel="mask-icon" type="imfname/x-icon"
        href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg"
        color="#111">
    <link rel="shortcut icon" type="image/x-icon" href="../build/images/รพสต.png">

    <script
        src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js">
    </script>
    <title>เพิ่มข้อมูลผู้ย้ายมาอยู่ใหม่</title>
    <link rel="canonical" href="https://codepen.io/designify-me/pen/qrJWpG">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- กำหนดรูปแบบของ form เพิ่มข้อมูล -->
    <style>
    /*custom font*/
    /* เริ่มการกำหนดรูปแบบสำหรับฟอนต์ที่กำหนดเอง */
    @import url(https://fonts.googleapis.com/css?family=Montserrat);

    /*basic reset*/
    /* รีเซ็ตค่าเริ่มต้นของ HTML และ Body ให้ไม่มีการกำหนดค่า margin และ padding */
    * {
        margin: 0;
        padding: 0;
    }

    html {
        height: 100%;
        background: #6441A5;
        /* สีพื้นหลังสำหรับ HTML */
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #6441A5, #2a0845);
        /* สีพื้นหลังสำหรับเบราว์เซอร์เก่า */
        /* Chrome 10-25, Safari 5.1-6 */
    }

    body {
        font-family: montserrat, arial, verdana;
        background: transparent;
        /* กำหนดฟอนต์และสีพื้นหลังสำหรับ Body */
    }

    /*form styles*/
    /* กำหนดรูปแบบสำหรับฟอร์ม */
    #msform {
        text-align: center;
        position: relative;
        margin-top: 30px;
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 20px 30px;
        box-sizing: border-box;
        width: 80%;
        margin: 0 10%;

        /*stacking fieldsets above each other*/
        /* การวางฟิลด์เซ็ตหนึ่งตัวเหนือกัน */
        position: relative;
    }

    /*Hide all except first fieldset*/
    /* ซ่อนฟิลด์เซ็ตทั้งหมดยกเว้นฟิลด์เซ็ตแรก */
    #msform fieldset:not(:first-of-type) {
        display: none;
    }

    /*inputs*/
    /* กำหนดรูปแบบสำหรับอินพุตและเท็กส์เอรียของฟอร์ม */
    #msform input,
    #msform textarea {
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        font-size: 13px;
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #ee0979;
        outline-width: 0;
        transition: All 0.5s ease-in;
        -webkit-transition: All 0.5s ease-in;
        -moz-transition: All 0.5s ease-in;
        -o-transition: All 0.5s ease-in;
    }

    /*buttons*/
    /* กำหนดรูปแบบสำหรับปุ่มในฟอร์ม */
    #msform .action-button {
        width: 100px;
        background: #ee0979;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 25px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #ee0979;
    }

    #msform .action-button-previous {
        width: 100px;
        background: #C5C5F1;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 25px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
    }

    /*headings*/
    /* กำหนดรูปแบบสำหรับหัวเรื่อง */
    .fs-title {
        font-size: 18px;
        text-transform: uppercase;
        color: #2C3E50;
        margin-bottom: 10px;
        letter-spacing: 2px;
        font-weight: bold;
    }

    .fs-subtitle {
        font-weight: normal;
        font-size: 13px;
        color: #666;
        margin-bottom: 20px;
    }

    /*progressbar*/
    /* กำหนดรูปแบบสำหรับแถบความคืบหน้า */
    #progressbar {
        display: flex;
        justify-content: center;
        list-style-type: none;
        padding: 0;
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        /*CSS counters to number the steps*/
        counter-reset: step;
    }

    #progressbar li {
        list-style-type: none;
        color: white;
        text-transform: uppercase;
        font-size: 9px;
        width: 33.33%;
        float: left;
        position: relative;
        letter-spacing: 1px;
    }

    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 24px;
        height: 24px;
        line-height: 26px;
        display: block;
        font-size: 12px;
        color: #333;
        background: white;
        border-radius: 25px;
        margin: 0 auto 10px auto;
    }

    /*progressbar connectors*/
    /* กำหนดรูปแบบสำหรับเส้นต่อขั้นบันไดของแถบความคืบหน้า */
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: white;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: -1;
        /*put it behind the numbers*/
    }

    #progressbar li:first-child:after {
        /*connector not needed before the first step*/
        content: none;
    }

    /*marking active/completed steps green*/
    /* กำหนดสีเขียวสำหรับขั้นบันไดที่กำลังทำงานหรือเสร็จสิ้น */
    /*The number of the step and the connector before it = green*/
    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #ee0979;
        color: white;
    }

    /* Not relevant to this form */
    /* ไม่เกี่ยวข้องกับฟอร์มนี้ */
    .dme_link {
        margin-top: 30px;
        text-align: center;
    }

    .dme_link a {
        background: #FFF;
        font-weight: bold;
        color: #ee0979;
        border: 0 none;
        border-radius: 25px;
        cursor: pointer;
        padding: 5px 25px;
        font-size: 12px;
    }

    .dme_link a:hover,
    .dme_link a:focus {
        background: #C5C5F1;
        text-decoration: none;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }

    /* กำหนดรูปแบบสำหรับอินพุตแบบราดิโอ */
    input[type="radio"]+label span {
        transition: background .2s,
            transform .2s;
    }

    input[type="radio"]+label span:hover,
    input[type="radio"]+label:hover span {
        transform: scale(1.2);
    }

    input[type="radio"]:checked+label span {
        background-color: #3490DC;
        /* สีพื้นหลังเมื่อถูกเลือก */
        box-shadow: 0px 0px 0px 2px white inset;
    }

    input[type="radio"]:checked+label {
        color: #3490DC;
        /* สีข้อความเมื่อถูกเลือก */
    }

    /* สนับสนุนสำหรับการกำหนดรูปแบบสำหรับอินพุตแบบราดิโอ */
    @supports(-webkit-appearance: none) or (-moz-appearance: none) {
        input[type='radio'] {
            --active: #275EFE;
            /* --active-inner: #fff; */
            --focus: 2px rgba(39, 94, 254, .3);
            --border: #BBC1E1;
            --border-hover: #275EFE;
            --background: #fff;
            --disabled: #F6F8FF;
            --disabled-inner: #E1E6F9;
            -webkit-appearance: none;
            -moz-appearance: none;
            height: 21px;
            outline: none;
            display: inline-block;
            vertical-align: top;
            position: relative;
            margin: 0;
            cursor: pointer;
            border: 1px solid var(--bc, var(--border));
            background: var(--b, var(--background));
            transition: background .3s, border-color .3s, box-shadow .2s;

            &:after {
                content: '';
                display: block;
                left: 0;
                top: 0;
                position: absolute;
                transition: transform var(--d-t, .3s) var(--d-t-e, ease), opacity var(--d-o, .2s);
            }

            &:checked {
                --b: var(--active);
                --bc: var(--active);
                --d-o: .3s;
                --d-t: .6s;
                --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
            }

            &:hover {
                &:not(:checked) {
                    &:not(:disabled) {
                        --bc: var(--border-hover);
                    }
                }
            }

            &:focus {
                box-shadow: 0 0 0 var(--focus);
            }

            &:not(.switch) {
                width: 21px;

                &:after {
                    opacity: var(--o, 0);
                }

                &:checked {
                    --o: 1;
                }
            }

            &+label {
                font-size: 14px;
                line-height: 21px;
                display: inline-block;
                vertical-align: top;
                cursor: pointer;
                margin-left: 4px;
            }
        }
    }

    /* กำหนดรูปแบบสำหรับอินพุตแบบราดิโอที่ไม่ใช่สวิตช์ */
    input[type='radio'] {
        border-radius: 50%;

        &:after {
            width: 19px;
            height: 19px;
            border-radius: 50%;
            background: var(--active-inner);
            opacity: 0;
            transform: scale(var(--s, .7));
        }

        &:checked {
            --s: .5;
        }
    }

    /* ส่วนสำหรับกำหนดรูปแบบสำหรับแสดงการแจ้งเตือนแบบกำหนดเอง */
    #custom-alert {
        transition: opacity 0.3s ease;
    }

    #custom-alert:not(.hidden) {
        opacity: 1;
    }
    </style>
    <script>
    window.console = window.console || function(t) {};
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body translate="no">
    <!-- แบบฟอร์มหลายขั้นตอน -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form id="msform" method="POST">
                <!-- แถบความคืบหน้า -->
                <ul id="progressbar">
                    <li class="">ข้อมูลผู้มาใหม่</li>
                    <li class="active">ข้อมูลบ้าน </li>
                </ul>
                <!-- ส่วนของ fieldsets เพิ่มข้อมูลผู้มาใหม่ -->
                <fieldset style="transform: scale(1); position: absolute; opacity: 1; display: block;">
                    <h4 class="fs-title">ข้อมูลผู้มาใหม่</h4>
                    <h3 class="fs-subtitle text-sm">ข้อมูลนี้เป็นส่วนหนึ่งของการจัดทำระบบคุณภาพบริการของ รพ.สต.
                        เพื่อการบริการในชุมชน</h3>

                    <!-- ช่องกรอกรหัสบ้าน -->
                    <div>
                        <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">รหัสบ้าน</h5>
                        <input type="text" id="house_id" name="house_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="รหัสบ้าน">
                    </div>

                    <!-- ช่องกรอกเลขบัตรประจำตัวประชาชน -->
                    <div>
                        <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">เลขบัตรประจำตัวประชาชน
                        </h5>
                        <input type="text" id="cid" name="cid"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="x-xxxxx-xxxxx-xx-x">
                    </div>

                    <!-- เลือกคำนำหน้าชื่อ -->
                    <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">คำนำหน้าชื่อ</h5>
                    <ul class="grid w-full gap-4 md:grid-cols-3">
                        <li>
                            <input type="radio" id="pname1" name="pname" value="นาย" class="hidden peer">
                            <label for="pname1"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="w-full">นาย</div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="pname2" name="pname" value="นาง" class="hidden peer">
                            <label for="pname2"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="w-full">นาง</div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="pname3" name="pname" value="น.ส." class="hidden peer">
                            <label for="pname3"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="w-full">น.ส.</div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="pname4" name="pname" value="ด.ช." class="hidden peer">
                            <label for="pname4"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="w-full">ด.ช.</div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="pname5" name="pname" value="ด.ญ." class="hidden peer">
                            <label for="pname5"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="w-full">ด.ญ.</div>
                            </label>
                        </li>
                    </ul>

                    <!-- ช่องกรอกชื่อ -->
                    <div>
                        <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">ชื่อ</h5>
                        <input type="text" id="fname" name="fname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="ชื่อ">
                    </div>

                    <!-- ช่องกรอกนามสกุล -->
                    <div>
                        <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">นามสกุล</h5>
                        <input type="text" id="lname" name="lname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="นามสกุล">
                    </div>

                    <!-- ปุ่มกลับไปหน้าหลักและปุ่มถัดไป -->
                    <a href="../navigator.php" class="previous action-button-previous">หน้าหลัก</a>
                    <input type="button" name="next" class="next action-button" value="ถัดไป">
                </fieldset>

                <!-- ส่วนของ fieldsets เพิ่มข้อมูลบ้าน -->
                <fieldset style="display: none; left: 50%; opacity: 0;">
                    <h3 class="fs-title">ข้อมูลบ้าน</h3>
                    <h3 class="fs-subtitle text-sm">ในกรณีที่ผู้มาใหม่ มาอยู่บ้านที่มีที่อยู่ในฐานข้อมูลแล้ว
                        ไม่จำเป็นต้องกรอกในส่วนนี้ สามารถส่งเฉพาะข้อมูลผู้ย้ายมาใหม่ได้</h3>
                    <div>
                        <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">บ้านเลขที่</h5>
                        <input type="text" id="address" name="address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="บ้านเลขที่">
                    </div>
                    <div>
                        <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">ละติจูด</h5>
                        <input type="text" id="latitude" name="latitude"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="ละติจูด">
                    </div>
                    <div>
                        <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">ลองจิจูด</h5>
                        <input type="text" id="longitude" name="longitude"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="ลองจิจูด">
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="กลับ">
                    <input type="submit" name="submit" class="submit action-button" value="เพิ่มข้อมูล">
                </fieldset>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <script>
    var current_fs, next_fs, previous_fs;
    var left, opacity, scale; // คุณสมบัติของ fieldset ที่เราจะทำการ animate
    var animating; // สถานะเพื่อป้องกันปัญหาการคลิกซ้ำอย่างรวดเร็ว


    $(".next").click(function() {
        if (animating) return false; // ถ้ากำลัง animate อยู่ กลับมาไม่ทำงาน

        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        // ใช้งานขั้นตอนถัดไปบน progressbar โดยใช้ index ของ next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        // แสดง fieldset ถัดไป
        next_fs.show();
        // ซ่อน fieldset ปัจจุบันด้วยอนิเมชัน
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                scale = 1 - (1 - now) * 0.2;
                left = (now * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({
                    'left': left,
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            easing: 'easeInOutBack'
        });
    });

    // เมื่อคลิกปุ่ม "ก่อนหน้า"
    $(".previous").click(function() {
        if (animating) return false;

        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        // ยกเลิกขั้นตอนปัจจุบันบน progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        // แสดง fieldset ก่อนหน้า
        previous_fs.show();
        // ซ่อน fieldset ปัจจุบันด้วยอนิเมชัน
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                scale = 0.8 + (1 - now) * 0.2;
                left = ((1 - now) * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'left': left
                });
                previous_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            easing: 'easeInOutBack'
        });
    });

    $(document).ready(function() {
        $("#msform").submit(function() {
            // เก็บข้อมูลจากฟอร์มลงในตัวแปร formData
            var formData = {
                house_id: $("#house_id").val(),
                cid: $("#cid").val(),
                pname: $("input[name='pname']:checked").val(),
                fname: $("#fname").val(),
                lname: $("#lname").val(),
                address: $("#address").val(),
                latitude: $("#latitude").val(),
                longitude: $("#longitude").val(),
            };
            //แสดงการแจ้งเตือนเพื่อตรวจสอบข้อมูล
            if (isAnyFieldEmpty(formData)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                });
            } else if (!isValidAge(formData.cid)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'กรุณากรอกเลขบัตรประชาชนให้ถูกต้อง',
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'เพิ่มข้อมูลสำเร็จ',
                    text: '',
                    showConfirmButton: false,
                    timer: 2000,
                }).then(() => {
                    // นำผู้ใช้ไปยังหน้าแรกของ การเพิ่มข้อมูล
                    window.location.href = 'input_user.php';
                });

                // ทำการส่งข้อมูลโดยใช้ Ajax ไปยังไฟล์ post_data_user.php และจัดการกับการตอบกลับจากเซิร์ฟเวอร์
                $.ajax({
                    method: 'POST',
                    url: '../process/post_data_user.php',
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Form submitted successfully!',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Form submission failed. Please try again.',
                        });
                    }
                });
            }
            event.preventDefault();
        });
    });

    function isAnyFieldEmpty(formData) {
        for (var key in formData) {
            if (formData.hasOwnProperty(key) && (formData[key] === null || formData[key] === undefined)) {
                return true; // พบฟิลด์ว่าง
            }
        }
        return false; // ทุกฟิลด์กรอกครบ
    }

    function isValidAge(cid) {
        if (isNaN(cid) || cid.length !== 13) {
            return false; // หมายเลขบัตรประชาชนไม่ถูกต้อง
        }
        return true; // หมายเลขบัตรประชาชนถูกต้อง
    }
    </script>

</body>

</html>