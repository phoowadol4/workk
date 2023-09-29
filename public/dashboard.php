<?php
include("./process/post_form_and_get_.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุปผลการตอบแบบสอบถาม</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="./build/images/รพสต.png">
    <link rel="stylesheet" href="build/css/tailwind.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css"  rel="stylesheet" /> -->

    <style>
    .filter-controls {
        display: flex;
        justify-content: flex-end;
        margin-right: 20px;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

</head>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden'); setColors(color);" :class="{ 'dark': isDark}">
        <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- หน้าจอแสดง Loading -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker">
                Loading.....
            </div>

            <!-- แถบเมนูด้านข้าง -->
            <aside
                class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
                <div class="flex flex-col h-full">
                    <!-- ลิงก์เมนู -->
                    <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
                        <span aria-hidden="true" class="flex">
                            <img class="h-16" src="./build/images/รพสต.png" alt="รพสต">
                            <img class="mx-4 my-3 h-10" src="./build/images/gistnu.png" alt="รพสต">

                        </span>
                        <!-- ลิงก์สู่หน้าแสดงข้อมูล-->
                        <div x-data="{ isActive: true, open: true}">
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                :class="{'bg-primary-100 dark:bg-primary': isActive || open}" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm"> ระบบจัดเก็บและแสดงผลข้อมูลการให้บริการสุขภาพในชุมชน </span>
                                <span class="ml-auto" aria-hidden="true">
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>

                            <!-- รายการเมนูที่แสดงเมื่อเปิด -->
                            <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                                <a href="dashboard.php" role="menuitem"
                                    class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    รายงานสรุปผลการตอบแบบสอบถาม
                                </a>
                                <a href="navigator.php" role="menuitem"
                                    class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    ค้นหาเส้นทางไปยังบ้านผู้ป่วย
                                </a>
                            </div>
                        </div>
                        <!-- ลิงก์สู่หน้าแสดงข้อมูลแบบสอบถาม -->
                        <div x-data="{ isActive: false, open: false }">
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm"> ข้อมูลแบบสอบถาม </span>
                                <span aria-hidden="true" class="ml-auto">
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>
                            <!-- รายการเมนูที่แสดงเมื่อเปิด -->
                            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                                <a href="pages/comment.php" role="menuitem"
                                    class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    ความคิดเห็นของผู้รับบริการ
                                </a>
                                <a href="pages/age.php" role="menuitem"
                                    class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    อายุของผู้ตอบแบบสอบถาม
                                </a>
                                <a href="pages/form_response.php" role="menuitem"
                                    class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    ความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่
                                </a>
                            </div>
                        </div>
                        <!-- ลิงก์สู่หน้าเพิ่มข้อมูล -->
                        <div x-data="{ isActive: false, open: false }">
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm"> เพิ่มข้อมูล </span>
                                <span aria-hidden="true" class="ml-auto">
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>
                            <!-- รายการเมนูที่แสดงเมื่อเปิด -->
                            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">

                                <a href="pages/input_user.php" role="menuitem"
                                    class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    เพิ่มข้อมูลผู้ย้ายมาอยู่ใหม่
                                </a>
                            </div>
                        </div>
                    </nav>
                    <div class=" mx-2 mb-4 mt-4 p-2">
                        <div class="text-xs">พัฒนาโดย : สถานภูมิภาคเทคโนโลยีอวกาศ และภูมิสารสนเทศ ภาคเหนือตอนล่าง</div>
                    </div>
                </div>
            </aside>
            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <!-- Navbar -->
                <header class="relative bg-white dark:bg-darker">
                    <div class="flex items-center justify-between p-2 border-b dark:border-primary-darker">
                        <!-- ปุ่มเมนูมือถือ -->
                        <button @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
                            class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
                            <span class="sr-only">Open main manu</span>
                            <span aria-hidden="true">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </span>
                        </button>
                        <!-- ชื่อระบบ -->
                        <a href="dashboard.php"
                            class="inline-block text-2xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
                            ระบบจัดเก็บและแสดงผลข้อมูลการให้บริการสุขภาพในชุมชน
                        </a>
                        <!-- ปุ่มเมนูมือถือ -->
                        <button @click="isMobileSubMenuOpen = !isMobileSubMenuOpen"
                            class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
                            <span class="sr-only">Open sub manu</span>
                            <span aria-hidden="true">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </span>
                        </button>
                        <nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">
                            <!-- ปุ่มสลับธีม dark / light -->
                            <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                                <div
                                    class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-lighter">
                                </div>
                                <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm"
                                    :class="{ 'translate-x-0 -translate-y-px  bg-white text-primary-dark': !isDark, 'translate-x-6 text-primary-100 bg-primary-darker': isDark }">
                                    <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                    <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                            </button>
                            <!-- ปุ่มเปิดเมนูการตั้งค่า -->
                            <button @click="openSettingsPanel"
                                class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                                <span class="sr-only">Open settings panel</span>
                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>

                            <!-- ปุ่มรูปภาพของผู้ใช้ -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                                    type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                                    class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
                                    <span class="sr-only">User menu</span>
                                    <img class="w-10 h-10 rounded-full" src="./build/images/de.jpg" alt="Ahmed Kamel" />
                                </button>

                                <!-- เมนูของผู้ใข้ -->
                                <div x-show="open" x-ref="userMenu"
                                    x-transition:enter="transition-all transform ease-out"
                                    x-transition:enter-start="translate-y-1/2 opacity-0"
                                    x-transition:enter-end="translate-y-0 opacity-100"
                                    x-transition:leave="transition-all transform ease-in"
                                    x-transition:leave-start="translate-y-0 opacity-100"
                                    x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                                    @keydown.escape="open = false"
                                    class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                                    tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                                    <a role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        <?php
                                        if (isset($_SESSION['username'])) {
                                        $username = $_SESSION['username'];
                                        echo $username;
                                        }?>
                                    </a>
                                    <a href="../logout/logout.php" role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        ออกจากระบบ
                                    </a>

                                </div>
                            </div>
                        </nav>
                        <!-- เมนูย่อยมือถือ -->
                        <nav x-transition:enter="transition duration-200 ease-in-out transform sm:duration-500"
                            x-transition:enter-start="-translate-y-full opacity-0"
                            x-transition:enter-end="translate-y-0 opacity-100"
                            x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                            x-transition:leave-start="translate-y-0 opacity-100"
                            x-transition:leave-end="-translate-y-full opacity-0" x-show="isMobileSubMenuOpen"
                            @click.away="isMobileSubMenuOpen = false"
                            class="absolute flex items-center p-4 bg-white rounded-md shadow-lg dark:bg-darker top-16 inset-x-4 md:hidden"
                            aria-label="Secondary">
                            <div class="space-x-2">
                                <!-- ปุ่มสลับธีม dark / light -->
                                <button aria-hidden="true" class="relative focus:outline-none" x-cloak
                                    @click="toggleTheme">
                                    <div
                                        class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-lighter">
                                    </div>
                                    <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 transform scale-110 rounded-full shadow-sm"
                                        :class="{ 'translate-x-0 -translate-y-px  bg-white text-primary-dark': !isDark, 'translate-x-6 text-primary-100 bg-primary-darker': isDark }">
                                        <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                        </svg>
                                        <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </div>
                                </button>
                                <!-- ปุ่มเปิดเมนูการตั้งค่า -->
                                <button @click="openSettingsPanel(); $nextTick(() => { isMobileSubMenuOpen = false })"
                                    class="p-2 transition-colors duration-200 rounded-full text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-darker">
                                    <span class="sr-only">Open settings panel</span>
                                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                            <!-- ปุ่มรูปภาพของผู้ใช้ -->
                            <div class="relative ml-auto" x-data="{ open: false }">
                                <button @click="open = !open" type="button" aria-haspopup="true"
                                    :aria-expanded="open ? 'true' : 'false'"
                                    class="block transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
                                    <span class="sr-only">User menu</span>
                                    <img class="w-10 h-10 rounded-full" src="./build/images/de.jpg" alt="" />
                                </button>

                                <!-- เมนูของผู้ใข้ -->
                                <div x-show="open" x-transition:enter="transition-all transform ease-out"
                                    x-transition:enter-start="translate-y-1/2 opacity-0"
                                    x-transition:enter-end="translate-y-0 opacity-100"
                                    x-transition:leave="transition-all transform ease-in"
                                    x-transition:leave-start="translate-y-0 opacity-100"
                                    x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                                    class="absolute right-0 w-48 py-1 origin-top-right bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark"
                                    role="menu" aria-orientation="vertical" aria-label="User menu">
                                    <a role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        <?php
                                        if (isset($_SESSION['username'])) {
                                        $username = $_SESSION['username'];
                                        echo $username;
                                        }?>
                                    </a>
                                    <a href="../logout/logout.php" role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        ออกจากระบบ
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <!-- ปุ่มเมนูมือถือ -->
                    <div class="border-b md:hidden dark:border-primary-darker" x-show="isMobileMainMenuOpen"
                        @click.away="isMobileMainMenuOpen = false">
                        <nav aria-label="Main" class="px-2 py-4 space-y-2">
                            <span aria-hidden="true" class="flex">
                                <img class=" my-2 h-12" src="./build/images/รพสต.png" alt="รพสต">
                                <img class="my-3 mx-3 h-10" src="./build/images/gistnu.png" alt="รพสต">
                            </span>
                            <!-- ลิงก์สู่หน้าแสดงข้อมูล-->
                            <div x-data="{ isActive: true, open: true}">
                                <a href="#" @click="$event.preventDefault(); open = !open"
                                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}" role="button"
                                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                    <span aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </span>
                                    <span class="ml-2 text-sm"> ระบบจัดเก็บและแสดงผลข้อมูลการให้บริการสุขภาพในชุมชน
                                    </span>
                                    <span class="ml-auto" aria-hidden="true">
                                        <svg class="w-4 h-4 transition-transform transform"
                                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <!-- รายการเมนูที่แสดงเมื่อเปิด -->
                                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                                    <a href="dashboard.php" role="menuitem"
                                        class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        รายงานสรุปผลการตอบแบบสอบถาม
                                    </a>
                                    <a href="navigator.php" role="menuitem"
                                        class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        ค้นหาเส้นทางไปยังบ้านผู้ป่วย

                                    </a>
                                </div>
                            </div>
                            <!-- ลิงก์สู่หน้าแสดงข้อมูลแบบสอบถาม -->
                            <div x-data="{ isActive: false, open: false }">
                                <a href="#" @click="$event.preventDefault(); open = !open"
                                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                    <span aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <span class="ml-2 text-sm "> ข้อมูลแบบสอบถาม </span>
                                    <span aria-hidden="true" class="ml-auto">
                                        <svg class="w-4 h-4 transition-transform transform"
                                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <!-- รายการเมนูที่แสดงเมื่อเปิด -->
                                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                                    <a href="pages/comment.php" role="menuitem"
                                        class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        ความคิดเห็นของผู้รับบริการ

                                    </a>
                                    <a href="pages/age.php" role="menuitem"
                                        class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        อายุของผู้ตอบแบบสอบถาม
                                    </a>
                                    <a href="pages/form_response.php" role="menuitem"
                                        class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        ความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่
                                    </a>
                                </div>
                            </div>
                            <!-- ลิงก์สู่หน้าเพิ่มข้อมูล -->
                            <div x-data="{ isActive: false, open: false }">
                                <a href="#" @click="$event.preventDefault(); open = !open"
                                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button"
                                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                    <span aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <span class="ml-2 text-sm"> เพิ่มข้อมูล </span>
                                    <span aria-hidden="true" class="ml-auto">
                                        <svg class="w-4 h-4 transition-transform transform"
                                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <!-- รายการเมนูที่แสดงเมื่อเปิด -->
                                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                                    <a href="pages/input_user.php" role="menuitem"
                                        class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        เพิ่มข้อมูลผู้ย้ายมาอยู่ใหม่
                                    </a>
                                </div>
                            </div>
                        </nav>
                        <div class=" mx-4 mb-4 mt-4 p-2">
                            <div class="text-xs">พัฒนาโดย : สถานภูมิภาคเทคโนโลยีอวกาศ และภูมิสารสนเทศ ภาคเหนือตอนล่าง
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main content -->
                <main>
                    <!-- ตัวควบคุมการกรอง -->
                    <div class="filter-controls">
                        <!-- เลือกเดือนในการกรอง -->
                        <select id="filterMonth"
                            class="bg-gray-50 border border-gray-300 text-black  text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="filterMonth">
                            <option selected>เลือกเพื่อดูข้อมูลในแต่ละเดือน</option>
                            <option value="1">มกราคม</option>
                            <option value="2">กุมภาพันธ์</option>
                            <option value="3">มีนาคม</option>
                            <option value="4">เมษายน</option>
                            <option value="5">พฤษภาคม</option>
                            <option value="6">มิถุนายน</option>
                            <option value="7">กรกฎาคม</option>
                            <option value="8">สิงหาคม</option>
                            <option value="9">กันยายน</option>
                            <option value="10">ตุลาคม</option>
                            <option value="11">พฤศจิกายน</option>
                            <option value="12">ธันวาคม</option>
                        </select>
                        <!-- ปุ่มค้นหา -->
                        <button id="applyFilter"
                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-80 focus:outline-none focus:bg-opacity-80">
                            ค้นหา
                        </button>
                    </div>
                    <div class="mt-2">
                        <!-- การแสดงผลสถานะ -->
                        <!-- การแสดงผลรายละเอียดของการกรอง -->
                        <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
                            <!-- การแสดงผลค่าความคิดเห็น -->
                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div>
                                    <h6
                                        class="text-sm font-semibold leading-none tracking-wider text-black dark:text-light">
                                        ความคิดเห็นของผู้รับบริการ
                                    </h6>
                                    <span class="text-sm font-semibold" id="comment_user">
                                        <?php
                            echo $countAll . ' ความคิดเห็น';
                        ?>
                                    </span>
                                </div>
                            </div>

                            <!-- การแสดงผลจำนวนผู้ตอบแบบสอบถาม -->
                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div>
                                    <h6
                                        class="text-sm font-semibold leading-none tracking-wider text-black dark:text-light">
                                        จำนวนผู้ตอบแบบสอบถาม
                                    </h6>
                                    <span class="text-md font-semibold" id="user">
                                        <?php
                            echo "จำนวน " . $people_all . " คน";
                        ?>
                                    </span>
                                </div>
                            </div>

                            <!-- การแสดงผลจำนวนผู้ตอบแบบสอบถาม (ญาติ) -->
                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div>
                                    <span
                                        class="text-sm font-semibold leading-none tracking-wider text-black dark:text-light">
                                        ผู้ตอบแบบสอบถาม
                                    </span>
                                    <span
                                        class="text-xs font-semibold leading-none tracking-wider text-black dark:text-light">
                                        (ญาติ)
                                    </span>
                                    <span class="text-md font-semibold" id="relativeCount">
                                        <?php
                            // แสดงผลในรูปแบบที่ต้องการ
                            echo "จำนวน " . $countRelative . " คน";
                        ?>
                                    </span>
                                </div>
                            </div>

                            <!-- การแสดงผลจำนวนผู้ตอบแบบสอบถาม (ผู้ป่วย) -->
                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div>
                                    <h3
                                        class="text-sm font-semibold leading-none tracking-wider text-black dark:text-light">
                                        ผู้ตอบแบบสอบถาม
                                    </h3>
                                    <h6
                                        class="text-xs font-semibold leading-none tracking-wider text-black dark:text-light">
                                        (ผู้ป่วย)
                                    </h6>
                                    <span class="text-md font-semibold" id="patientCount">
                                        <?php
                            echo "จำนวน " . $countPatient . " คน";
                        ?>
                                    </span>
                                </div>
                            </div>
                            <!-- สคริปต์ JavaScript -->
                            <script>
                            // เมื่อคลิกที่ปุ่ม "ค้นหา"
                            document.getElementById('applyFilter').addEventListener('click', function() {
                                const selectedMonth = document.getElementById('filterMonth').value;

                                // อัปเดตแสดงผลใน HTML ด้วยข้อมูลจากอาร์เรย์ของ 'ญาติ' และ 'ผู้ป่วย'
                                const relativeCount = <?php echo json_encode($valueCountsRelativeByMonth); ?>[
                                    selectedMonth];
                                const patientCount = <?php echo json_encode($valueCountsPatientByMonth); ?>[
                                    selectedMonth];
                                const comment_user = <?php echo json_encode($countf); ?>[selectedMonth];

                                const userC = <?php echo json_encode($monthlyCounts); ?>[selectedMonth];

                                // อัปเดตข้อมูลในแต่ละส่วนของ HTML
                                document.getElementById('relativeCount').textContent =
                                    `จำนวน ${relativeCount} คน`;
                                document.getElementById('patientCount').textContent =
                                    `จำนวน ${patientCount} คน`;
                                document.getElementById('comment_user').textContent =
                                    `${comment_user} ความคิดเห็น`;
                                document.getElementById('user').textContent = `จำนวน ${userC} คน`;
                            });
                            </script>
                        </div>
                        <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                            <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-black dark:text-light">
                                        ช่วงอายุของผู้ตอบแบบสอบถาม</h4>
                                    <div class="flex items-center space-x-2">
                                    </div>
                                </div>
                                <!-- Chart -->
                                <div class="relative p-4">
                                    <canvas id="barch"></canvas>
                                    <script>
                                    <?php if (!empty($dataByMonth)) { ?>
                                    // แปลงอาเรย์ PHP เป็นตัวแปร JavaScript สำหรับกราฟ
                                    var dataByMonth = <?php echo json_encode($dataByMonth); ?>;

                                    var dataByMonth_all = <?php echo json_encode($valueCountsage); ?>;
                                    const getTheme = () => {
                                        if (window.localStorage.getItem('dark')) {
                                            return JSON.parse(window.localStorage.getItem('dark'));
                                        }
                                        return !!window.matchMedia && window.matchMedia(
                                            '(prefers-color-scheme: dark)').matches;
                                    };

                                    // ฟังก์ชันในการตั้งค่าธีม
                                    const setTheme = (value) => {
                                        window.localStorage.setItem('dark', value);
                                    };

                                    // กำหนดธีม
                                    const isDarkTheme = getTheme();

                                    // กำหนดสีข้อความตามธีม
                                    const textColorY = isDarkTheme ? '#FFFFFF' :
                                        '#000000'; // สีข้อความแนวตั้ง (ขาวสำหรับธีมมืด ดำสำหรับธีมสว่าง)
                                    const textColorX = isDarkTheme ? '#FFFFFF' : '#000000';

                                    // กำหนดสีเริ่มต้นของ Chart.js ตามธีม
                                    Chart.defaults.color = isDarkTheme ? '#FFFFFF' : '#000000';

                                    // สร้างกราฟแท่งเริ่มต้นทั้งหมด
                                    function createInitialChart() {
                                        const ctx = document.getElementById('barch').getContext('2d');

                                        // กำหนดป้ายชื่อของกราฟ
                                        const labels = ['อายุน้อยกว่า 20 ปี', 'อายุระหว่าง 21-30 ปี',
                                            'อายุระหว่าง 31-40 ปี', 'อายุระหว่าง 41-50 ปี',
                                            'อายุมากกว่า 50 ปีขึ้นไป'
                                        ];

                                        // กำหนดข้อมูลของกราฟ
                                        const dataset = {
                                            label: 'ช่วงอายุของผู้ตอบแบบสอบถาม',
                                            data: Object.values(
                                                dataByMonth_all
                                            ), // ใช้ข้อมูล dataByMonth_all เพื่อแสดงช่วงอายุของผู้ตอบแบบสอบถามทั้งหมด
                                            backgroundColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(255, 159, 64)',
                                                'rgb(255, 205, 86)',
                                                'rgb(75, 192, 192)',
                                                'rgb(54, 162, 235)',
                                            ],
                                            borderWidth: 1,
                                        };

                                        // สร้างกราฟแรกเริ่มต้น
                                        window.myBarChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: labels,
                                                datasets: [dataset],
                                            },
                                            options: {
                                                responsive: true,
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        ticks: {
                                                            color: textColorY,
                                                        },
                                                    },
                                                    x: {
                                                        beginAtZero: true,
                                                        ticks: {
                                                            color: textColorX,
                                                        },
                                                    },
                                                },
                                            },
                                        });
                                    }

                                    // ตัวฟังก์ชันสำหรับการฟังอีเวนต์ของปุ่ม "ค้นหา"
                                    document.getElementById('applyFilter').addEventListener('click', function() {
                                        const selectedMonth = document.getElementById('filterMonth').value;
                                        // อัพเดทกราฟตามเดือนที่ถูกเลือก
                                        updateBarChart(selectedMonth);
                                    });

                                    // สร้างกราฟแรกเริ่มต้นทั้งหมด
                                    createInitialChart();

                                    // ฟังก์ชันสำหรับการอัพเดทกราฟตามเดือนที่เลือก
                                    function updateBarChart(selectedMonth) {
                                        // ดึงข้อมูลสำหรับเดือนที่เลือก
                                        const selectedData = dataByMonth[selectedMonth] || {
                                            'age20': 0,
                                            'age30': 0,
                                            'age40': 0,
                                            'age50': 0,
                                            'age51': 0,
                                        };

                                        // อัพเดทข้อมูลในกราฟ
                                        window.myBarChart.data.datasets[0].data = Object.values(selectedData);

                                        // อัพเดทกราฟ
                                        window.myBarChart.update();
                                    }
                                    <?php } ?>
                                    </script>


                                </div>
                            </div>
                            <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- ส่วนหัวของกราฟวงกลม  เพศ  -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-black dark:text-light"> เพศ </h4>
                                </div>

                                <!-- แผนภูมิวงกลม  เพศ  -->
                                <div class="relative p-4">
                                    <canvas id="dataPieChart"></canvas>
                                </div>

                                <!-- โค้ด JavaScript สำหรับแผนภูมิวงกลม  เพศ  -->
                                <script>
                                <?php if (!empty($sexByMonth)) { ?>

                                // แปลงอาเรย์ PHP เป็นตัวแปร JavaScript สำหรับกราฟ
                                var sexByMonth = <?php echo json_encode($sexByMonth); ?>;
                                // 
                                var sex_all = <?php echo json_encode($sex_all); ?>;

                                // กำหนดค่าเริ่มต้นของกราฟวงกลม เพศ 
                                Chart.defaults.font.family = "Lato";
                                Chart.defaults.font.size = 11.5;

                                var ctx = document.getElementById('dataPieChart').getContext('2d');
                                var myPieChart;

                                // กำหนดค่าเริ่มต้นของกราฟวงกลม เพศ 
                                myPieChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: ['ชาย', 'หญิง'],
                                        datasets: [{
                                            data: Object.values(sex_all),
                                            backgroundColor: [
                                                'rgba(63, 122, 99)',
                                                'rgba(242, 140, 137)',
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true
                                    }
                                });

                                // กำหนดตัวฟังก์ชันสำหรับการกดปุ่ม "ค้นหา" สำหรับกราฟวงกลม เพศ 
                                document.getElementById('applyFilter').addEventListener('click', function() {
                                    const selectedMonth = document.getElementById('filterMonth').value;
                                    // อัปเดตกราฟวงกลม เพศ ตามเดือนที่เลือก
                                    updatePieChart(selectedMonth);
                                });

                                createInitialChart();

                                // ฟังก์ชันสำหรับการอัปเดตกราฟวงกลม เพศ ตามเดือนที่เลือก
                                function updatePieChart(selectedMonth) {

                                    // ดึงข้อมูลสำหรับเดือนที่เลือก
                                    const selectedData = sexByMonth[selectedMonth] || {
                                        'ชาย': 0,
                                        'หญิง': 0,
                                    };

                                    // อัปเดตข้อมูลกราฟวงกลม เพศ 
                                    myPieChart.data.datasets[0].data = Object.values(selectedData);

                                    // อัปเดตกราฟวงกลม เพศ 
                                    myPieChart.update();
                                }

                                // ตั้งค่าแสดงข้อมูลเริ่มต้นสำหรับทุกเดือนสำหรับกราฟวงกลม เพศ 
                                updatePieChart();
                                <?php } ?>
                                </script>
                            </div>

                            <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <div class="col-span-1 bg-white rounded-md dark:bg-darker">
                                    <!-- ส่วนหัวของการ์ดสำหรับ Pie Chart ความถี่ของผู้ใช้บริการครั้งแรก -->
                                    <div class="p-4 border-b dark:border-primary">
                                        <h4 class="text-lg font-semibold text-center text-black dark:text-light">
                                            ผู้ป่วยมาใช้บริการที่นี่เป็นครั้งแรก
                                        </h4>
                                    </div>

                                    <!-- ส่วนของ Pie Chart ความถี่ของผู้ใช้บริการครั้งแรก -->
                                    <div class="relative p-4">
                                        <canvas id="everchart"></canvas>
                                    </div>

                                    <!-- โค้ด JavaScript สำหรับ Pie Chart ความถี่ของผู้ใช้บริการครั้งแรก -->
                                    <script>
                                    <?php if (!empty($everByMonth)) { ?>
                                    // แปลง PHP array เป็นตัวแปร JavaScript สำหรับกราฟ
                                    var everByMonth = <?php echo json_encode($everByMonth); ?>;
                                    var ever_all = <?php echo json_encode($ever_all); ?>;

                                    // กำหนดค่าตัวเลือกสำหรับกราฟ Pie Chart ความถี่ของผู้ใช้บริการครั้งแรก
                                    Chart.defaults.font.family = "Lato";
                                    Chart.defaults.font.size = 11.5;

                                    // กำหนดค่าสีสำหรับกราฟอิงกับตัวแปร 'isDarkTheme' (ตรวจสอบให้แน่ใจว่ามีการกำหนดค่า)
                                    var chartColors = isDarkTheme ? ['rgba(255, 203, 79)', 'rgba(41, 94, 164)'] : [
                                        'rgba(41, 94, 164)', 'rgba(255, 203, 79)'
                                    ];

                                    // รับองค์ประกอบ canvas และสร้าง Pie Chart สำหรับ Pie Chart ความถี่ของผู้ใช้บริการครั้งแรก
                                    var everCtx = document.getElementById('everchart').getContext('2d');
                                    var everPieChart = new Chart(everCtx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['ใช่', 'ไม่'],
                                            datasets: [{
                                                data: Object.values(ever_all),
                                                backgroundColor: chartColors,
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true
                                        }
                                    });

                                    // ตัวฟังก์ชันตรวจสอบการคลิกที่ปุ่ม "ค้นหา" เพื่ออัปเดต Pie Chart ความถี่ของผู้ใช้บริการครั้งแรก
                                    document.getElementById('applyFilter').addEventListener('click', function() {
                                        const selectedMonth = document.getElementById('filterMonth').value;
                                        // อัปเดต Pie Chart ความถี่ของผู้ใช้บริการครั้งแรกตามเดือนที่เลือก
                                        updateEverPieChart(selectedMonth);
                                    });

                                    // ฟังก์ชันสร้างกราฟเริ่มต้น
                                    createInitialChart();

                                    // ฟังก์ชันอัปเดต Pie Chart ความถี่ของผู้ใช้บริการครั้งแรกตามเดือนที่เลือก
                                    function updateEverPieChart(selectedMonth) {
                                        // ดึงข้อมูลสำหรับเดือนที่เลือก
                                        const selectedData = everByMonth[selectedMonth] || {
                                            'ใช่': 0,
                                            'ไม่': 0,
                                        };

                                        // อัปเดตข้อมูลกราฟสำหรับ Pie Chart ความถี่ของผู้ใช้บริการครั้งแรก
                                        everPieChart.data.datasets[0].data = Object.values(selectedData);

                                        // อัปเดต Pie Chart สำหรับ Pie Chart ความถี่ของผู้ใช้บริการครั้งแรก
                                        everPieChart.update();
                                    }

                                    // เริ่มต้นแสดงข้อมูลสำหรับทุกเดือน สำหรับ Pie Chart ความถี่ของผู้ใช้บริการครั้งแรก
                                    updateEverPieChart();
                                    <?php } ?>
                                    </script>
                                </div>
                            </div>

                            <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-black dark:text-light">
                                        ผู้ตอบแบบสอบถามให้คะแนน จากตอนที่ 2
                                        ความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่</h4>
                                    <div class="flex items-center">
                                    </div>
                                </div>
                                <!-- Chart -->
                                <div class="relative p-4 items-center">
                                    <canvas id="dataBarChart" width="140" height="60"></canvas>
                                    <script>
                                    function createChart() {
                                        // แปลง PHP array เป็นตัวแปร JavaScript สำหรับกราฟ
                                        var dataValuespop = <?php echo json_encode(array_values($top5Ratings)); ?>;
                                        var dataLabelspop = <?php echo json_encode(array_keys($top5Ratings)); ?>;

                                        const getTheme = () => {
                                            if (window.localStorage.getItem('dark')) {
                                                return JSON.parse(window.localStorage.getItem('dark'));
                                            }
                                            return !!window.matchMedia && window.matchMedia(
                                                '(prefers-color-scheme: dark)').matches;
                                        };

                                        const setTheme = (value) => {
                                            window.localStorage.setItem('dark', value);
                                        };

                                        const isDarkTheme = getTheme();

                                        // กำหนดสีข้อความขึ้นอยู่กับธีม
                                        const textColorY = isDarkTheme ? '#FFFFFF' :
                                            '#000000';
                                        const textColorX = isDarkTheme ? '#FFFFFF' : '#000000';

                                        Chart.defaults.color = isDarkTheme ? '#FFFFFF' :
                                            '#000000';

                                        var labelsAdjusted = dataLabelspop.map(label => {
                                            var words = label.split(' ');
                                            var shortenedLabel = '';

                                            // ตรวจสอบว่าอาเรย์ words มีความยาวอย่างน้อยหนึ่งสมาชิกหรือไม่
                                            if (words.length >= 1) {
                                                shortenedLabel = words[0];
                                            } else {
                                                // หากไม่มี ให้ใช้ข้อมูลเดิม
                                                shortenedLabel = label;
                                            }
                                            return shortenedLabel;
                                        });

                                        // สร้างกราฟแท่งโดยกำหนดสีข้อความตามธีม
                                        Chart.defaults.font.family = "Lato";
                                        Chart.defaults.font.size = 11.5;

                                        var ctx = document.getElementById('dataBarChart').getContext('2d');
                                        var myBarChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: labelsAdjusted,
                                                datasets: [{
                                                    label: 'ค่าเฉลี่ยมากที่สุด 5 อันดับแรก',
                                                    data: dataValuespop,
                                                    backgroundColor: 'rgb(255, 159, 64)',
                                                    borderColor: 'rgb(255, 159, 64)',
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                responsive: true,

                                                scales: {
                                                    y: {
                                                        ticks: {
                                                            color: textColorY, // กำหนดสีข้อความบนแกน Y
                                                            beginAtZero: true
                                                        }
                                                    },
                                                    x: {
                                                        ticks: {
                                                            color: textColorX, // กำหนดสีข้อความบนแกน X
                                                            beginAtZero: true
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    }

                                    // สร้างกราฟเมื่อเริ่มต้น
                                    createChart();

                                    // ฟังก์ชันสลับธีม
                                    const toggleTheme = () => {
                                        const isDarkTheme = !getTheme();
                                        setTheme(isDarkTheme);

                                        if (myBarChart) {
                                            myBarChart.destroy(); // ทำลายกราฟที่มีอยู่
                                        }

                                        createChart(); // สร้างกราฟใหม่โดยใช้ธีมใหม่
                                    };
                                    </script>
                                </div>
                            </div>
                        </div>

                        <!-- table แสดงคะแนนความพึงพอใจ  มากที่สุด 5 อันดับแรก -->
                        <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                            <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                <h4 class="text-lg font-semibold text-black dark:text-light">
                                    ผู้ตอบแบบสอบถามให้คะแนน จากตอนที่ 2
                                    ความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่</h4>
                                <div class="flex items-center">
                                </div>
                            </div>
                            <div class="relative p-4 items-center">
                                <div>
                                    <div class="block w-full overflow-x-auto">
                                        <table class="w-full bg-transparent border-collapse">
                                            <table class="w-full bg-transparent border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"
                                                            class="p-4 text-base font-medium leading-none tracking-wider text-black dark:text-light ">

                                                        </th>
                                                        <th colspan="2"
                                                            class="py-2 px-4 border border-gray-300 font-semibold text-black dark:text-light">
                                                            คะแนนความพึงพอใจ
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col"
                                                            class="p-4 text-base border border-gray-300 font-medium leading-none tracking-wider text-black dark:text-light ">
                                                            การบริการของ รพ.สต.
                                                        </th>
                                                        <th
                                                            class="py-2 px-4 border border-gray-300 font-semibold text-black dark:text-light">
                                                            ค่าเฉลี่ย
                                                        </th>
                                                        <th
                                                            class="py-2 px-4 border border-gray-300 font-semibold text-black dark:text-light">
                                                            ส่วนเบี่ยงเบนมาตรฐาน
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <!-- เริ่มต้นส่วนข้อมูลในตาราง -->
                                                <tbody class="divide-y divide-gray-100">
                                                    <?php
                                            // ส่วนของ PHP สำหรับการดึงข้อมูลและแสดงในตาราง
                                            $top5RatingsKeys = array_keys($top5Ratingst);
                                            $top5RatingsValues = array_values($top5Ratingst);
                                            $top5StandardDeviations = array_values($topl);
                                            
                                            // วนลูปเพื่อแสดงข้อมูล
                                            for ($i = 0; $i < min(5, count($top5Ratingst)); $i++) {
                                                echo '<tr class="text-black dark:text-light">';
                                                echo '<td class="py-2 px-4 border border-gray-300 ">' . $top5RatingsKeys[$i] . '</td>';
                                                echo '<td class="py-2 px-4 border border-gray-300  text-center">' . json_encode($top5RatingsValues[$i]) . '</td>';
                                                echo '<td class="py-2 px-4 border border-gray-300  text-center">' . $top5StandardDeviations[$i] . '</td>';
                                                echo '</tr>';
                                            }
                                            
                                            // เพิ่มข้อมูลแถวสุดท้าย
                                            echo '<tr class="text-black dark:text-light">';
                                            echo '<td class="py-2 px-4 border border-gray-300 ">' . 'คะแนนแบบสอบถามความพึงพอใจในแต่ละด้าน' . '</td>';
                                            echo '<td class="py-2 px-4 border border-gray-300 text-center">' . 'ค่าเฉลี่ย' . '</td>';
                                            echo '<td class="py-2 px-4 border border-gray-300 text-center ">' . 'ส่วนเบี่ยงเบนมาตรฐาน' . '</td>';
                                            echo '</tr>';

                                            // เพิ่มข้อมูลเกี่ยวกับด้านเจ้าหน้าที่ผู้ให้บริการ
                                            echo '<tr class="text-black dark:text-light">';
                                            echo '<td class="py-2 px-4 border border-gray-300 ">' . 'ด้านเจ้าหน้าที่ผู้ให้บริการ' . '</td>';
                                            echo '<td class="py-2 px-4 border border-gray-300  text-center">' . $average_sevice_officer . '</td>';
                                            echo '<td class="py-2 px-4 border border-gray-300  text-center">' . $sevice_officer_std . '</td>';
                                            echo '</tr>';

                                            // เพิ่มข้อมูลเกี่ยวกับคุณภาพการให้บริการ
                                            echo '<tr class="text-black dark:text-light">';
                                            echo '<td class="py-2 px-4 border border-gray-300 ">' . 'ด้านคุณภาพการให้บริการ	' . '</td>';
                                            echo '<td class="py-2 px-4 border border-gray-300  text-center">' . $service_ser . '</td>';
                                            echo '<td class="py-2 px-4 border border-gray-300  text-center">' . $sevice_quality_std . '</td>';
                                            echo '</tr>';

                                            // เพิ่มข้อมูลเกี่ยวกับสถานที่
                                            echo '<tr class="text-black dark:text-light">';
                                            echo '<td class="py-2 px-4 border border-gray-300 ">' . 'ด้านสถานที่	' . '</td>';
                                            echo '<td class="py-2 px-4 border border-gray-300  text-center">' . $average_location_point . '</td>';
                                            echo '<td class="py-2 px-4 border border-gray-300  text-center">' . $ser_location_std . '</td>';
                                            echo '</tr>';
                                            ?>
                                                </tbody>
                                                <!-- สิ้นสุดส่วนข้อมูลในตาราง -->
                                            </table>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </main>
            </div>

            <!-- พื้นหลังสีที่ใช้ในการแสดง Panel ของการตั้งค่า -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="isSettingsPanelOpen"
                @click="isSettingsPanelOpen = false" class="fixed inset-0 z-10 bg-primary-darker" style="opacity: 0.5"
                aria-hidden="true"></div>

            <!-- ส่วนแสดง Panel การตั้งค่า -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" x-ref="settingsPanel"
                tabindex="-1" x-show="isSettingsPanelOpen" @keydown.escape="isSettingsPanelOpen = false"
                class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
                aria-labelledby="settinsPanelLabel">
                <div class="absolute left-0 p-2 transform -translate-x-full">
                    <!-- ปุ่มปิด Panel -->
                    <button @click="isSettingsPanelOpen = false"
                        class="p-2 text-white rounded-md focus:outline-none focus:ring">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- เนื้อหาของ Panel -->
                <div class="flex flex-col h-screen">
                    <!-- ส่วนหัวของ Panel -->
                    <div
                        class="flex flex-col items-center justify-center flex-shrink-0 px-4 py-8 space-y-4 border-b dark:border-primary-dark">
                        <span aria-hidden="true" class="text-gray-500 dark:text-primary">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </span>
                        <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-500 dark:text-light">
                            การตั้งค่า
                        </h2>
                    </div>
                    <!-- เนื้อหา -->
                    <div class="flex-1 overflow-hidden hover:overflow-y-auto">
                        <!-- ส่วนเลือกโหมด (Light/Dark) -->
                        <div class="p-4 space-y-4 md:p-8">
                            <h6 class="text-lg font-medium text-gray-400 dark:text-light">โหมด</h6>
                            <div class="flex items-center space-x-8">
                                <!-- ปุ่มโหมด Light -->
                                <button @click="setLightTheme"
                                    class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-primary dark:hover:text-primary-100 dark:hover:border-primary-light focus:outline-none focus:ring focus:ring-primary-lighter focus:ring-offset-2 dark:focus:ring-offset-dark dark:focus:ring-primary-dark"
                                    :class="{ 'border-gray-900 text-gray-900 dark:border-primary-light dark:text-primary-100': !isDark, 'text-gray-500 dark:text-primary-light': isDark }">
                                    <span>
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </span>
                                    <span>Light</span>
                                </button>
                                <!-- ปุ่มโหมด Dark -->
                                <button @click="setDarkTheme"
                                    class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-primary dark:hover:text-primary-100 dark:hover:border-primary-light focus:outline-none focus:ring focus:ring-primary-lighter focus:ring-offset-2 dark:focus:ring-offset-dark dark:focus:ring-primary-dark"
                                    :class="{ 'border-gray-900 text-gray-900 dark:border-primary-light dark:text-primary-100': isDark, 'text-gray-500 dark:text-primary-light': !isDark }">
                                    <span>
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                        </svg>
                                    </span>
                                    <span>Dark</span>
                                </button>
                            </div>
                        </div>

                        <!-- ส่วนเลือกสี -->
                        <div class="p-4 space-y-4 md:p-8">
                            <h6 class="text-lg font-medium text-gray-400 dark:text-light">สี</h6>
                            <div>
                                <button @click="setColors('cyan')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-cyan)"></button>
                                <button @click="setColors('teal')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-teal)"></button>
                                <button @click="setColors('green')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-green)"></button>
                                <button @click="setColors('fuchsia')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-fuchsia)"></button>
                                <button @click="setColors('blue')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-blue)"></button>
                                <button @click="setColors('violet')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-violet)"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>

    <!--ส่วนของการตั้งค่า theme, setting, color และ menu -->
    <script>
    const setup = () => {
        // ฟังก์ชัน getTheme ใช้ในการตรวจสอบโหมดสีที่ผู้ใช้เลือก
        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }

            return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
        }
        // ฟังก์ชัน setTheme ใช้ในการตั้งค่าโหมดสี
        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }
        // ฟังก์ชัน getColor ใช้ในการรับค่าสีที่ผู้ใช้เลือก
        const getColor = () => {
            if (window.localStorage.getItem('color')) {
                return window.localStorage.getItem('color')

            }
            return 'cyan'
        }
        // ฟังก์ชัน setColors ใช้ในการตั้งค่าสีที่ผู้ใช้เลือก
        const setColors = (color) => {
            const root = document.documentElement
            root.style.setProperty('--color-primary', `var(--color-${color})`)
            root.style.setProperty('--color-primary-50', `var(--color-${color}-50)`)
            root.style.setProperty('--color-primary-100', `var(--color-${color}-100)`)
            root.style.setProperty('--color-primary-light', `var(--color-${color}-light)`)
            root.style.setProperty('--color-primary-lighter', `var(--color-${color}-lighter)`)
            root.style.setProperty('--color-primary-dark', `var(--color-${color}-dark)`)
            root.style.setProperty('--color-primary-darker', `var(--color-${color}-darker)`)
            this.selectedColor = color
            window.localStorage.setItem('color', color)
            //
            
        }

        return {
            loading: true,
            isDark: getTheme(),
            toggleTheme() {
                this.isDark = !this.isDark
                setTheme(this.isDark)
                window.location.reload();
            },
            setLightTheme() {
                this.isDark = false
                setTheme(this.isDark)
                window.location.reload();

            },
            setDarkTheme() {
                this.isDark = true
                setTheme(this.isDark)
                window.location.reload();

            },
            color: getColor(),
            selectedColor: 'cyan',
            setColors,
            // ส่วนของการเปิด/ปิดเมนูไซด์บาร์
            toggleSidbarMenu() {
                this.isSidebarOpen = !this.isSidebarOpen
            },
            isSettingsPanelOpen: false,
            // ส่วนของการเปิดตัวเลือกการตั้งค่า
            openSettingsPanel() {
                this.isSettingsPanelOpen = true
                this.$nextTick(() => {
                    this.$refs.settingsPanel.focus()
                })
            },
            isMobileSubMenuOpen: false,
            // ส่วนของการเปิดเมนูย่อยบนมือถือ
            openMobileSubMenu() {
                this.isMobileSubMenuOpen = true
                this.$nextTick(() => {
                    this.$refs.mobileSubMenu.focus()
                })
            },
            isMobileMainMenuOpen: false,
            // ส่วนของการเปิดเมนูหลักบนมือถือ
            openMobileMainMenu() {
                this.isMobileMainMenuOpen = true
                this.$nextTick(() => {
                    this.$refs.mobileMainMenu.focus()
                })
            }
        }
    }
    </script>
</body>

</html>