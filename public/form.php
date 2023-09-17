<?php
session_start();
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['gender']) && isset($_POST['people'])&& isset($_POST['age'])&& isset($_POST['date'])&& isset($_POST['ever'])&& isset($_POST['rd_1']) && isset($_POST['rd_2'])&& isset($_POST['rd_3'])&& isset($_POST['rd_4'])&& isset($_POST['rd_5'])&& isset($_POST['rd_6'])&& isset($_POST['rd_7']) &&isset($_POST['rd_8']) && isset($_POST['rd_9'])&& isset($_POST['rd_10'])&& isset($_POST['rd_11'])&& isset($_POST['rd_12'])&& isset($_POST['rd_13'])&& isset($_POST['rd_14'])&& isset($_POST['rd_15']) &&isset($_POST['comments16']) &&isset($_POST['comments17'])) {
        $_SESSION['gender']=$_POST['gender'];
        $_SESSION['people']=$_POST['people'];
        $_SESSION['age']=$_POST['age'];
        $_SESSION['date']=$_POST['date'];
        $_SESSION['ever']=$_POST['ever'];
        $_SESSION['rd_1'] = $_POST['rd_1'];
        $_SESSION['rd_2'] = $_POST['rd_2'];
        $_SESSION['rd_3'] = $_POST['rd_3'];
        $_SESSION['rd_4'] = $_POST['rd_4'];
        $_SESSION['rd_5'] = $_POST['rd_5'];
        $_SESSION['rd_6'] = $_POST['rd_6'];
        $_SESSION['rd_7'] = $_POST['rd_7'];
        $_SESSION['rd_8'] = $_POST['rd_8'];
        $_SESSION['rd_9'] = $_POST['rd_9'];
        $_SESSION['rd_10'] = $_POST['rd_10'];
        $_SESSION['rd_11'] = $_POST['rd_11'];
        $_SESSION['rd_12'] = $_POST['rd_12'];
        $_SESSION['rd_13'] = $_POST['rd_13'];
        $_SESSION['rd_14'] = $_POST['rd_14'];
        $_SESSION['rd_15'] = $_POST['rd_15'];
        $_SESSION['comments16'] = $_POST['comments16'];
        $_SESSION['comments17'] = $_POST['comments17'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="apple-touch-icon" type="image/png"
        href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">

    <meta name="apple-mobile-web-app-title" content="CodePen">

    
    <link rel="mask-icon" type="image/x-icon"
        href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg"
        color="#111">
    <script
        src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js">
    </script>
    <title>แบบสอบถามความพึงพอใจ</title>
    <link rel="canonical" href="https://codepen.io/designify-me/pen/qrJWpG">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
    /*custom font*/
    @import url(https://fonts.googleapis.com/css?family=Montserrat);

    /*basic reset*/
    * {
        margin: 0;
        padding: 0;
    }

    html {
        height: 100%;
        background: #6441A5;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #6441A5, #2a0845);
        /* Chrome 10-25, Safari 5.1-6 */
    }

    body {
        font-family: montserrat, arial, verdana;
        background: transparent;
    }

    /*form styles*/
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
        position: relative;
    }

    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
        display: none;
    }

    /*inputs*/
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
    /*The number of the step and the connector before it = green*/
    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #ee0979;
        color: white;
    }


    /* Not relevant to this form */
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

    input[type="radio"]+label span {
        transition: background .2s,
            transform .2s;
    }

    input[type="radio"]+label span:hover,
    input[type="radio"]+label:hover span {
        transform: scale(1.2);
    }

    input[type="radio"]:checked+label span {
        background-color: #3490DC; //bg-blue
        box-shadow: 0px 0px 0px 2px white inset;
    }


    input[type="radio"]:checked+label {
        color: #3490DC; //text-blue
    }

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
    <!-- MultiStep Form -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form id="msform" method="post">
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active">ตอนที่ 1 ข้อมูลทั่วไป</li>
                    <li class="">ตอนที่ 2 ความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่</li>
                    <li class="">ความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่</li>
                    <li class="">ตอนที่ 3 ความคิดเห็นของผู้รับบริการ</li>
                </ul>
                <!-- fieldsets -->
                <fieldset style="transform: scale(1); position: absolute; opacity: 1; display: block;">
                    <h4 class="fs-title">แบบสอบถามความพึงพอใจของผู้รับบริการใน รพ.สต.</h4>
                    <h3 class="fs-subtitle text-sm">ข้อมูลนี้เป็นส่วนหนึ่งของการจัดทำระบบคุณภาพบริการของ รพ.สต.
                        โปรดแสดงความคิดเห็นเกี่ยวกับการปฎิบัติงานของเจ้าหน้าที่ใน รพ.สต.
                        เพื่อนำข้อมูลไปพัฒนางานกรุณาตอบแบบประเมิน 3 ตอน</h3>
                    <h5 class="fs-header font-semibold text-left">ตอนที่ 1 ข้อมูลทั่วไป</h5>
                    <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">
                        ผู้ตอบแบบสอบถาม</h5>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input type="radio" id="people1" name="people" value="ผู้ป่วย"
                                <?php echo ($_SESSION['people'] ?? '') === 'ผู้ป่วย' ? 'checked' : ''; ?>
                                class="hidden peer">
                            <label for="people1"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">

                                <div class="w-full">ผู้ป่วย</div>

                            </label>
                        </li>
                        <li>
                            <input type="radio" id="people2" name="people" value="ญาติ"
                                <?php echo ($_SESSION['people'] ?? '') === 'ญาติ' ? 'checked' : ''; ?>
                                class="hidden peer">
                            <label for="people2"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full">ญาติ</div>
                                </div>
                            </label>
                        </li>
                    </ul>
                    <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">
                        เพศ</h5>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input type="radio" id="gen1" name="gen" value="ชาย"
                                <?php echo ($_SESSION['gender'] ?? '') === 'ชาย' ? 'checked' : ''; ?>
                                class="hidden peer">
                            <label for="gen1"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">

                                <div class="w-full">ชาย</div>

                            </label>
                        </li>
                        <li>
                            <input type="radio" id="gen2" name="gen" value="หญิง"
                                <?php echo ($_SESSION['gender'] ?? '') === 'หญิง' ? 'checked' : ''; ?>
                                class="hidden peer">
                            <label for="gen2"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full">หญิง</div>
                                </div>
                            </label>
                        </li>
                    </ul>
                    <!-- </li> -->
                    <div>
                        <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">อายุ</h5>
                        <input type="number" id="age" name="age"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="กรุณากรอกอายุ">
                    </div>
                    <div class="mb-4 font-semibold text-gray-900 dark:text-white text-left">
                        <h5 class="block text-gray-700 font-bold mb-2" for="date">วันที่มาใช้บริการ</h5>
                        <input type="datetime-local" name="date" id="date"
                            class="border border-gray-400 rounded-md px-3 py-2 w-full" />
                    </div>
                    <h5 class="mb-4 font-semibold text-gray-900 dark:text-white text-left">
                        ผู้ป่วยมาใช้บริการที่นี่เป็นครั้งแรก</h5>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input type="radio" id="ev1" name="ev" value="ใช่"
                                <?php echo ($_SESSION['ever'] ?? '') === 'ใช่' ? 'checked' : ''; ?> class="hidden peer">
                            <label for="ev1"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full">ใช่</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="ev2" name="ev" value="ไม่"
                                <?php echo ($_SESSION['ever'] ?? '') === 'ไม่' ? 'checked' : ''; ?> class="hidden peer">
                            <label for="ev2"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full">ไม่</div>
                                </div>
                            </label>
                        </li>
                    </ul>
                    </li>
                    </ul>
                    </li>
                    <input type="button" name="next" class="next action-button" value="ถัดไป">
                </fieldset>
                <fieldset style="display: none; left: 50%; opacity: 0; transform: scale(1); position: absolute;">
                    <h3 class="fs-title">ตอนที่ 2 ความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่</h3>
                    <h4 class="fs-subtitle">โปรดเลือก ช่องที่ตรงกับความเห็นของท่าน</h4>
                    <h5 class="fs-subtitle text-left">*หมายเหตุ มากที่สุด = 5 , มาก = 4 , ปานกลาง = 3 , น้อย = 2 ,
                        น้อยที่สุด = 1</h5>
                    <h4 class="fs-subtitle"></h4>

                    <table class="w-center">
                        <thead>
                            <tr>
                                <th class="border px-1 py-1 text-center">การบริการของ รพ.สต.</th>
                                <th class="border px-1 py-1 text-center">1</th>
                                <th class="border px-1 py-1 text-center">2</th>
                                <th class="border px-1 py-1 text-center">3</th>
                                <th class="border px-1 py-1 text-center">4</th>
                                <th class="border px-1 py-1 text-center">5</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <th class="border px-1 py-1 text-center">ด้านเจ้าหน้าที่ผู้ให้บริการ</th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">1. ให้การต้อนรับด้วยอัธยาศัยที่ดี สุภาพยิ้มแย้มแจ่มใส	</td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_1_1" name="rd_1" value="1"
                                        <?php echo ($_SESSION['rd_1'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_1_2" name="rd_1" value="2"
                                        <?php echo ($_SESSION['rd_1'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_1_3" name="rd_1" value="3"
                                        <?php echo ($_SESSION['rd_1'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_1_4" name="rd_1" value="4"
                                        <?php echo ($_SESSION['rd_1'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_1_5" name="rd_1" value="5"
                                        <?php echo ($_SESSION['rd_1'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">2. ให้บริการด้วยความเต็มใจ ยินดี กระตือรือร้น
                                </td>
                                <td class="border px-4 py-2 ">
                                    <input type="radio" id="rd_2_1" name="rd_2" value="1"
                                        <?php echo ($_SESSION['rd_2'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2 ">
                                    <input type="radio" id="rd_2_2" name="rd_2" value="2"
                                        <?php echo ($_SESSION['rd_2'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_2_3" name="rd_2" value="3"
                                        <?php echo ($_SESSION['rd_2'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_2_4" name="rd_2" value="4"
                                        <?php echo ($_SESSION['rd_2'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_2_5" name="rd_2" value="5"
                                        <?php echo ($_SESSION['rd_2'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">3. เจ้าหน้าที่ให้ความสนใจและเต็มใจช่วยแก้ปัญหาต่างๆให้กับท่าน	</td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_3_1" name="rd_3" value="1"
                                        <?php echo ($_SESSION['rd_3'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_3_2" name="rd_3" value="2"
                                        <?php echo ($_SESSION['rd_3'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_3_3" name="rd_3" value="3"
                                        <?php echo ($_SESSION['rd_3'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_3_4" name="rd_3" value="4"
                                        <?php echo ($_SESSION['rd_3'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_3_5" name="rd_3" value="5"
                                        <?php echo ($_SESSION['rd_3'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">4. เจ้าหน้าที่ของ รพ.สต. มีความรับผิดชอบและความมุ่งมั่นในการปฏิบัติงาน	</td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_4_1" name="rd_4" value="1"
                                        <?php echo ($_SESSION['rd_4'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_4_2" name="rd_4" value="2"
                                        <?php echo ($_SESSION['rd_4'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_4_3" name="rd_4" value="3"
                                        <?php echo ($_SESSION['rd_4'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_4_4" name="rd_4" value="4"
                                        <?php echo ($_SESSION['rd_4'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_4_5" name="rd_4" value="5"
                                        <?php echo ($_SESSION['rd_4'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">5. เจ้าหน้าที่ได้แจ้งขั้นตอนและเงื่อนไขการบริการให้ผู้มาติดต่อ ทราบอย่างชัดเจน	
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_5_1" name="rd_5" value="1"
                                        <?php echo ($_SESSION['rd_5'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_5_2" name="rd_5" value="2"
                                        <?php echo ($_SESSION['rd_5'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_5_3" name="rd_5" value="3"
                                        <?php echo ($_SESSION['rd_5'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_5_4" name="rd_5" value="4"
                                        <?php echo ($_SESSION['rd_5'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_5_5" name="rd_5" value="5"
                                        <?php echo ($_SESSION['rd_5'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">
                                6. ระดับความพอใจในการให้บริการของเจ้าหน้าที่	
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_6_1" name="rd_6" value="1"
                                        <?php echo ($_SESSION['rd_6'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_6_2" name="rd_6" value="2"
                                        <?php echo ($_SESSION['rd_6'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_6_3" name="rd_6" value="3"
                                        <?php echo ($_SESSION['rd_6'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_6_4" name="rd_6" value="4"
                                        <?php echo ($_SESSION['rd_6'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_6_5" name="rd_6" value="5"
                                        <?php echo ($_SESSION['rd_6'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <th class="border px-1 py-1 text-center">ด้านคุณภาพการให้บริการ	</th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">
                                7. การบริการเป็นไปตามระเบียบปฏิบัติของทางราชการและระบียบอื่นๆ ที่ประกาศ	
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_7_1" name="rd_7" value="1"
                                        <?php echo ($_SESSION['rd_7'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_7_2" name="rd_7" value="2"
                                        <?php echo ($_SESSION['rd_7'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_7_3" name="rd_7" value="3"
                                        <?php echo ($_SESSION['rd_7'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_7_4" name="rd_7" value="4"
                                        <?php echo ($_SESSION['rd_7'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_7_5" name="rd_7" value="5"
                                        <?php echo ($_SESSION['rd_7'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="button" name="previous" class="previous action-button-previous" value="กลับ">
                    <input type="button" name="next" class="next action-button" value="ถัดไป">
                </fieldset>

                <fieldset style="display: none; left: 50%; opacity: 0;">
                    <h3 class="fs-title">ตอนที่ 2 ความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่</h3>
                    <h3 class="fs-subtitle">โปรดเลือก ช่องที่ตรงกับความเห็นของท่าน</h3>
                    <h5 class="fs-subtitle text-left">*หมายเหตุ มากที่สุด = 5 , มาก = 4 , ปานกลาง = 3 , น้อย = 2 ,
                        น้อยที่สุด = 1</h5>
                    <table class="w-center">
                        <thead>
                            <tr>
                                <th class="border px-1 py-1 text-center">การบริการของ รพ.สต.</th>
                                <th class="border px-1 py-1 text-center">1</th>
                                <th class="border px-1 py-1 text-center">2</th>
                                <th class="border px-1 py-1 text-center">3</th>
                                <th class="border px-2 py-1 text-center">4</th>
                                <th class="border px-1 py-1 text-center">5</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <tr>
                                <td class="border px-4 py-2 text-left">8. การบริการเป็นไปตามกำหนดเวลาราชการและ/หรือเวลาที่ประกาศ	</td>
                                <td class="border px-4 py-2 ">
                                    <input type="radio" id="rd_8_1" name="rd_8" value="1"
                                        <?php echo ($_SESSION['rd_8'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_8_2" name="rd_8" value="2"
                                        <?php echo ($_SESSION['rd_8'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_8_3" name="rd_8" value="3"
                                        <?php echo ($_SESSION['rd_8'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_8_4" name="rd_8" value="4"
                                        <?php echo ($_SESSION['rd_8'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_8_5" name="rd_8" value="5"
                                        <?php echo ($_SESSION['rd_8'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">9. ให้บริการด้วยความสะดวก รวดเร็ว</td>
                                <td class="border px-4 py-2 ">
                                    <input type="radio" id="rd_9_1" name="rd_9" value="1"
                                        <?php echo ($_SESSION['rd_9'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2 ">
                                    <input type="radio" id="rd_9_2" name="rd_9" value="2"
                                        <?php echo ($_SESSION['rd_9'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_9_3" name="rd_9" value="3"
                                        <?php echo ($_SESSION['rd_9'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_9_4" name="rd_9" value="4"
                                        <?php echo ($_SESSION['rd_9'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_9_5" name="rd_9" value="5"
                                        <?php echo ($_SESSION['rd_9'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">10. ความเร็วในการให้ความช่วยเหลือเมื่อท่านขอความช่วยเหลือ</td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_10_1" name="rd_10" value="1"
                                        <?php echo ($_SESSION['rd_10'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_10_2" name="rd_10" value="2"
                                        <?php echo ($_SESSION['rd_10'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_10_3" name="rd_10" value="3"
                                        <?php echo ($_SESSION['rd_10'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_10_4" name="rd_10" value="4"
                                        <?php echo ($_SESSION['rd_10'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_10_5" name="rd_10" value="5"
                                        <?php echo ($_SESSION['rd_10'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">11. ผู้รับบริการสามารถติดต่อสื่อสารกับ รพ.สต. ได้สะดวก	</td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_11_1" name="rd_11" value="1"
                                        <?php echo ($_SESSION['rd_11'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_11_2" name="rd_11" value="2"
                                        <?php echo ($_SESSION['rd_11'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_11_3" name="rd_11" value="3"
                                        <?php echo ($_SESSION['rd_11'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_11_4" name="rd_11" value="4"
                                        <?php echo ($_SESSION['rd_11'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_11_5" name="rd_11" value="5"
                                        <?php echo ($_SESSION['rd_11'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">12. รพ.สต. ให้บริการตรงต่อเวลาที่นัดหมาย	</td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_12_1" name="rd_12" value="1"
                                        <?php echo ($_SESSION['rd_12'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_12_2" name="rd_12" value="2"
                                        <?php echo ($_SESSION['rd_12'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_12_3" name="rd_12" value="3"
                                        <?php echo ($_SESSION['rd_12'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_12_4" name="rd_12" value="4"
                                        <?php echo ($_SESSION['rd_12'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_12_5" name="rd_12" value="5"
                                        <?php echo ($_SESSION['rd_12'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <th class="border px-1 py-1 text-center">ด้านสถานที่</th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                                <th class="border px-1 py-1 text-center"></th>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">13. ความสะอาดของสถานที่	</td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_13_1" name="rd_13" value="1"
                                        <?php echo ($_SESSION['rd_13'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_13_2" name="rd_13" value="2"
                                        <?php echo ($_SESSION['rd_13'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_13_3" name="rd_13" value="3"
                                        <?php echo ($_SESSION['rd_13'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_13_4" name="rd_13" value="4"
                                        <?php echo ($_SESSION['rd_13'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_13_5" name="rd_13" value="5"
                                        <?php echo ($_SESSION['rd_13'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">14. มีสิ่งอำนวยความสะดวกในสถานที่ให้บริการ เช่น ป้ายบอกทาง ที่นั่งรอ	
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_14_1" name="rd_14" value="1"
                                        <?php echo ($_SESSION['rd_14'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_14_2" name="rd_14" value="2"
                                        <?php echo ($_SESSION['rd_14'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_14_3" name="rd_14" value="3"
                                        <?php echo ($_SESSION['rd_14'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_14_4" name="rd_14" value="4"
                                        <?php echo ($_SESSION['rd_14'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_14_5" name="rd_14" value="5"
                                        <?php echo ($_SESSION['rd_14'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 text-left">15. ความพึงพอใจโดยรวมที่ได้รับจากการบริการจาก
                                    รพ.สต.
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_15_1" name="rd_15" value="1"
                                        <?php echo ($_SESSION['rd_15'] ?? '') === '1' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_15_2" name="rd_15" value="2"
                                        <?php echo ($_SESSION['rd_15'] ?? '') === '2' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_15_3" name="rd_15" value="3"
                                        <?php echo ($_SESSION['rd_15'] ?? '') === '3' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_15_4" name="rd_15" value="4"
                                        <?php echo ($_SESSION['rd_15'] ?? '') === '4' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="radio" id="rd_15_5" name="rd_15" value="5"
                                        <?php echo ($_SESSION['rd_15'] ?? '') === '5' ? 'checked' : ''; ?>
                                        class="shrink-0 mt-0.5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="button" name="previous" class="previous action-button-previous" value="กลับ">
                    <input type="button" name="next" class="next action-button" value="ถัดไป">
                </fieldset>

                <fieldset style="display: none; left: 50%; opacity: 0; transform: scale(1); position: absolute;">
                    <h2 class="fs-title">ตอนที่ 3 ความคิดเห็นของผู้รับบริการ</h2>

                    <label for="comments_rd16"
                        class="block mb-2 text-md font-medium text-gray-900 dark:text-white text-left">16.
                        ตามที่ท่านได้มารับบริการที่ รพ.สตแห่งนี้ ท่านคิดว่า รพ.สต.ควรปรับปรุงและพัฒนาในเรื่องใด</label>
                    <p class="fs-subtitle text-left">*ถ้ามี โปรดระบุ</p>
                    <textarea id="comments_rd16" rows="4"
                        class="block p-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ความคิดเห็น..."></textarea>

                    <label for="comments_rd17"
                        class="block mb-2 text-md font-medium text-gray-900 dark:text-white text-left">17.
                        ท่านมีข้อเสนอแนะอื่นๆ ในการปรับปรุงการบริการของ รพ.สต.เรื่องใดบ้าง</label>
                    <p class="fs-subtitle text-left">*ถ้ามี โปรดระบุ</p>
                    <textarea id="comments_rd17" rows="4"
                        class="block p-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ความคิดเห็น..."></textarea>

                    <input type="button" name="previous" class="previous action-button-previous" value="กลับ">
                    <input type="submit" name="submit" class="submit action-button" value="ส่งแบบสอบถาม">
                </fieldset>

            </form>
        </div>
    </div>
    <!-- /.MultiStep Form -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script>
    // jQuery time

    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function() {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
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
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".previous").click(function() {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
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
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(document).ready(function() {
        $("#msform").submit(function(event) {

                var formData = {
                    gender: $("input[name='gen']:checked").val(),
                    people: $("input[name='people']:checked").val(),
                    age: $("#age").val(),
                    date: $("#date").val(),
                    ever: $("input[name='ev']:checked").val(),
                    rd_1: $("input[name='rd_1']:checked").val(),
                    rd_2: $("input[name='rd_2']:checked").val(),
                    rd_3: $("input[name='rd_3']:checked").val(),
                    rd_4: $("input[name='rd_4']:checked").val(),
                    rd_5: $("input[name='rd_5']:checked").val(),
                    rd_6: $("input[name='rd_6']:checked").val(),
                    rd_7: $("input[name='rd_7']:checked").val(),
                    rd_8: $("input[name='rd_8']:checked").val(),
                    rd_9: $("input[name='rd_9']:checked").val(),
                    rd_10: $("input[name='rd_10']:checked").val(),
                    rd_11: $("input[name='rd_11']:checked").val(),
                    rd_12: $("input[name='rd_12']:checked").val(),
                    rd_13: $("input[name='rd_13']:checked").val(),
                    rd_14: $("input[name='rd_14']:checked").val(),
                    rd_15: $("input[name='rd_15']:checked").val(),
                    comments16: $("#comments_rd16").val(),
                    comments17: $("#comments_rd17").val(),
                };
                console.log(formData);
                // if (isAnyFieldEmpty(formData)) {
                //     alert('กรุณากรอกข้อมูลให้ครบถ้วน.');
                //     event.preventDefault(); // Prevent form submission
                // } else if (!isValidAge(formData.age)) {
                // alert('กรุณากรอกอายุให้ถูกต้อง.');
                // event.preventDefault(); // Prevent form submission

                // } else {
                //     alert('กรอกข้อมูลสำเร็จ');

                if (isAnyFieldEmpty(formData)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    });
                } else if (!isValidAge(formData.age)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'กรุณากรอกอายุให้ถูกต้อง',
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'กรอกข้อมูลสำเร็จ',
                        text: 'ขอบคุณสำหรับการตอบแบบสอบถาม',
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        // Redirect the user to another page after the timer expires
                        window.location.href ='form.php'; // Replace with the actual URL
                    });
            $.ajax({
                method: 'POST',
                url: './process/process_post.php',
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function(response) {
                console.log(response);
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

    function isAnyFieldEmpty(formData) {
        for (var key in formData) {
            if (formData.hasOwnProperty(key) && (formData[key] === null || formData[key] === undefined)) {
                return true; // Found an empty field
            }
        }
        return false; // All fields are filled
    }

    function isValidAge(age) {
        if (isNaN(age) || age <= 10 || age.length > 2) {
            return false; // Invalid age
        }
        return true; // Valid age
    }
    });
    </script>

</body>

</html>