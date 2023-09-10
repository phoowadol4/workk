<?php
include("./process/process_get.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>K-WD Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="build/css/tailwind.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden'); setColors(color);" :class="{ 'dark': isDark}">
        <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker">
                Loading.....
            </div>

            <!-- Sidebar -->
            <aside
                class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
                <div class="flex flex-col h-full">
                    <!-- Sidebar links -->
                    <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
                        <!-- Dashboards links -->
                        <div x-data="{ isActive: true, open: true}">
                            <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
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
                                <span class="ml-2 text-sm"> Dashboards </span>
                                <span class="ml-auto" aria-hidden="true">
                                    <!-- active class 'rotate-180' -->
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>
                            <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                <a href="index.php" role="menuitem"
                                    class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    รายงานสรุปผลการตอบแบบสอบถาม
                                </a>
                                <a href="index2.php" role="menuitem"
                                    class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    ระบบแผนที่นำทางไปยังบ้านผู้ป่วย
                                </a>

                            </div>
                        </div>
                        <!-- Pages links -->
                        <div x-data="{ isActive: false, open: false }">
                            <!-- active classes 'bg-primary-100 dark:bg-primary' -->
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
                                <span class="ml-2 text-sm"> Pages </span>
                                <span aria-hidden="true" class="ml-auto">
                                    <!-- active class 'rotate-180' -->
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>
                            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->

                                <!-- <a href="pages/people.php" role="menuitem"
                                    class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    ผู้ตอบแบบสอบถาม
                                </a> -->

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
                                    ความพึงพอใจความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่
                                </a>
                            </div>
                        </div>

                    </nav>
                </div>
            </aside>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <!-- Navbar -->
                <header class="relative bg-white dark:bg-darker">
                    <div class="flex items-center justify-between p-2 border-b dark:border-primary-darker">
                        <!-- Mobile menu button -->
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

                        <!-- Brand -->
                        <a href="index.php"
                            class="inline-block text-2xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
                            Dashboard
                        </a>

                        <!-- Mobile sub menu button -->
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

                        <!-- Desktop Right buttons -->
                        <nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">
                            <!-- Toggle dark theme button -->
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
                            <!-- Settings button -->
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

                            <!-- User avatar button -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                                    type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                                    class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
                                    <span class="sr-only">User menu</span>
                                    <img class="w-10 h-10 rounded-full" src="build/images/avatar.jpg"
                                        alt="Ahmed Kamel" />
                                </button>

                                <!-- User dropdown menu -->
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
                                    <a href="/workk/work1/logout.php" role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        ออกจากระบบ
                                    </a>

                                </div>
                            </div>
                        </nav>

                        <!-- Mobile sub menu -->
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
                                <!-- Toggle dark theme button -->
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
                                <!-- Settings button -->
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
                            <!-- User avatar button -->
                            <div class="relative ml-auto" x-data="{ open: false }">
                                <button @click="open = !open" type="button" aria-haspopup="true"
                                    :aria-expanded="open ? 'true' : 'false'"
                                    class="block transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
                                    <span class="sr-only">User menu</span>
                                    <img class="w-10 h-10 rounded-full" src="build/images/avatar.jpg"
                                        alt="Ahmed Kamel" />
                                </button>

                                <!-- User dropdown menu -->
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
                                    <a href="/workk/work1/logout.php" role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary">
                                        ออกจากระบบ
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <!-- Mobile main manu -->
                    <div class="border-b md:hidden dark:border-primary-darker" x-show="isMobileMainMenuOpen"
                        @click.away="isMobileMainMenuOpen = false">
                        <nav aria-label="Main" class="px-2 py-4 space-y-2">
                            <!-- Dashboards links -->
                            <div x-data="{ isActive: true, open: true}">
                                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
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
                                    <span class="ml-2 text-sm"> Dashboards </span>
                                    <span class="ml-auto" aria-hidden="true">
                                        <!-- active class 'rotate-180' -->
                                        <svg class="w-4 h-4 transition-transform transform"
                                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                    <a href="index.php" role="menuitem"
                                        class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        รายงานสรุปผลการตอบแบบสอบถาม
                                    </a>
                                    <a href="index2.php" role="menuitem"
                                        class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        ระบบแผนที่นำทางไปยังบ้านผู้ป่วย
                                    </a>

                                </div>
                            </div>

                            <!-- Pages links -->
                            <div x-data="{ isActive: false, open: false }">
                                <!-- active classes 'bg-primary-100 dark:bg-primary' -->
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
                                    <span class="ml-2 text-sm "> Pages </span>
                                    <span aria-hidden="true" class="ml-auto">
                                        <!-- active class 'rotate-180' -->
                                        <svg class="w-4 h-4 transition-transform transform"
                                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->

                                    <!-- <a href="pages/people.php" role="menuitem"
                                        class="block p-2 text-sm text-black transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        ผู้ตอบแบบสอบถาม
                                    </a> -->

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
                                        ความพึงพอใจความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </header>
                <!-- Main content -->
                <main>
                    <!-- Content header -->
                    <!-- Content -->
                    <div class="mt-2">
                        <!-- State cards -->
                        <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
                            <!-- Value card -->
                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div>
                                    <h6
                                        class="text-sm font-semibold leading-none tracking-wider text-black dark:text-light">
                                        ความคิดเห็นของผู้รับบริการ
                                    </h6>
                                    <span class="text-sm font-semibold">
                                        <?php
                                        $fImproveCount = 0;
                                        $fOtherCount = 0;

                                        foreach ($dataArray['result'] as $survey) {
                                            // Check if f_improve has a value
                                            if (!empty($survey['f_improve'])) {
                                                $fImproveCount++;
                                            }
                                            // Check if f_other has a value
                                            if (!empty($survey['f_other'])) {
                                                $fOtherCount++;
                                            }
                                            $countf=$fImproveCount+$fOtherCount;
                                        }
                                        // Output the counts
                                    echo  $countf .'' .'&nbspความคิดเห็น';
                                        ?>
                                    </span>
                                </div>
                                <!-- <div>
                                    <span>
                                        <svg class="w-12 h-12 text-black dark:text-primary-dark"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M10.25,2.375c-4.212,0-7.625,3.413-7.625,7.625s3.413,7.625,7.625,7.625s7.625-3.413,7.625-7.625S14.462,2.375,10.25,2.375M10.651,16.811v-0.403c0-0.221-0.181-0.401-0.401-0.401s-0.401,0.181-0.401,0.401v0.403c-3.443-0.201-6.208-2.966-6.409-6.409h0.404c0.22,0,0.401-0.181,0.401-0.401S4.063,9.599,3.843,9.599H3.439C3.64,6.155,6.405,3.391,9.849,3.19v0.403c0,0.22,0.181,0.401,0.401,0.401s0.401-0.181,0.401-0.401V3.19c3.443,0.201,6.208,2.965,6.409,6.409h-0.404c-0.22,0-0.4,0.181-0.4,0.401s0.181,0.401,0.4,0.401h0.404C16.859,13.845,14.095,16.609,10.651,16.811 M12.662,12.412c-0.156,0.156-0.409,0.159-0.568,0l-2.127-2.129C9.986,10.302,9.849,10.192,9.849,10V5.184c0-0.221,0.181-0.401,0.401-0.401s0.401,0.181,0.401,0.401v4.651l2.011,2.008C12.818,12.001,12.818,12.256,12.662,12.412" />
                                        </svg>
                                    </span>
                                </div> -->
                            </div>
                            <!-- Users card -->
                            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div>
                                    <h6
                                        class="text-sm font-semibold leading-none tracking-wider text-black dark:text-light">
                                        จำนวนผู้ตอบแบบสอบถาม
                                    </h6>
                                    <span class="text-md font-semibold"> <?php
                                          foreach ($dataArray['result'] as $survey){
                                        } echo $survey['id']."&nbspคน";?></span>
                                </div>
                                <!-- <div>
                                    <span>
                                        <svg class="w-12 h-12 text-black dark:text-primary-dark"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>
                                </div> -->
                            </div>

                            <!-- Orders card -->
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
                                    <span class="text-md font-semibold">
                                        <?php
                                        // Initialize an array to store the count for 'ผู้ป่วย'
                                        $valueCountspeople11 = array(
                                            'ญาติ' => 0,
                                        );

                                        foreach ($dataArray['result'] as $people) {
                                            $people11 = $people['answerer'];

                                            if ($people11 == 'ญาติ') {
                                                $valueCountspeople11['ญาติ']++;
                                            }
                                        }

                                        // Access the count from the PHP array
                                        $count = $valueCountspeople11['ญาติ'];

                                        // Print the result in the desired format
                                        echo "จำนวน $count คน";
                                        ?>
                                    </span>

                                </div>
                                <!-- <div>
                                    <span>
                                        <svg class="w-12 h-12 text-black dark:text-primary-dark"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </span>
                                </div> -->
                            </div>
                            <!-- Tickets card -->
                            <a class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
                                <div>
                                    <h3
                                        class="text-sm font-semibold leading-none tracking-wider text-black dark:text-light">
                                        ผู้ตอบแบบสอบถาม
                                    </h3>
                                    <h6
                                        class="text-xs font-semibold leading-none tracking-wider text-black dark:text-light">
                                        (ผู้ป่วย)

                                    </h6>
                                    <span class="text-md font-semibold">
                                        <?php
                                        // Initialize an array to store the count for 'ผู้ป่วย'
                                        $valueCountspeople12 = array(
                                            'ผู้ป่วย' => 0,
                                        );

                                        foreach ($dataArray['result'] as $people) {
                                            $people12 = $people['answerer'];

                                            if ($people12 == 'ผู้ป่วย') {
                                                $valueCountspeople12['ผู้ป่วย']++;
                                            }
                                        }

                                        // Access the count from the PHP array
                                        $count = $valueCountspeople12['ผู้ป่วย'];

                                        // Print the result in the desired format
                                        echo "จำนวน $count คน";
                                        ?>


                                    </span>

                                </div>
                                <!-- <div>
                                    <span>
                                        <svg class="w-12 h-12 text-black dark:text-primary-dark"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                    </span>
                                </div> -->
                            </a>
                        </div>

                        <!-- Charts -->
                        <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                            <!-- Bar chart card -->
                            <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
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
                                    // Convert PHP array to JavaScript variables for chart
                                    var dataValuesage = <?php echo json_encode(array_values($valueCountsage)); ?>;

                                    const getTheme = () => {
                                        if (window.localStorage.getItem('dark')) {
                                            return JSON.parse(window.localStorage.getItem('dark'));
                                        }
                                        return !!window.matchMedia && window.matchMedia(
                                            '(prefers-color-scheme: dark)').matches;
                                    };

                                    // Function to set the theme (replace with your actual logic)
                                    const setTheme = (value) => {
                                        window.localStorage.setItem('dark', value);
                                    };

                                    // Convert PHP array to JavaScript variables for chart
                                    var dataValuesage = <?php echo json_encode(array_values($valueCountsage)); ?>;

                                    // Determine the theme
                                    const isDarkTheme = getTheme();

                                    // Determine text colors based on the theme
                                    const textColorY = isDarkTheme ? '#FFFFFF' :
                                        '#000000'; // Y-axis label text color (white for dark, black for light)
                                    const textColorX = isDarkTheme ? '#FFFFFF' : '#000000';

                                    // Set Chart.js default color based on the theme
                                    Chart.defaults.color = isDarkTheme ? '#FFFFFF' : '#000000';

                                    // Create the bar chart
                                    var ctx = document.getElementById('barch').getContext('2d');
                                    Chart.defaults.font.family = "Lato";
                                    Chart.defaults.font.size = 14;

                                    var myBarChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['อายุน้อยกว่า 20 ปี', 'อายุระหว่าง 21-30 ปี',
                                                'อายุระหว่าง 31-40 ปี', 'อายุระหว่าง 41-50 ปี',
                                                'อายุมากกว่า 60 ปี'
                                            ],
                                            datasets: [{
                                                label: 'ช่วงอายุของผู้ตอบแบบสอบถาม',
                                                data: dataValuesage,
                                                backgroundColor: [
                                                    'rgb(255, 99, 132)',
                                                    'rgb(255, 159, 64)',
                                                    'rgb(255, 205, 86)',
                                                    'rgb(75, 192, 192)',
                                                    'rgb(54, 162, 235)'
                                                    // Add more colors here if needed
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                y: {
                                                    ticks: {
                                                        color: textColorY, // Set the Y-axis label text color
                                                        beginAtZero: true
                                                    }
                                                },
                                                x: {
                                                    ticks: {
                                                        color: textColorX, // Set the X-axis label text color
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        }
                                    });
                                    </script>
                                </div>
                            </div>
                            <!-- Doughnut chart card -->
                            <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-black dark:text-light">เพศ</h4>
                                </div>
                                <!-- Chart -->
                                <div class="relative p-4"></div>
                                <canvas id="dataPieChart"></canvas>
                                <script>
                                // Convert PHP array to JavaScript array for chart
                                var dataValues = <?php echo json_encode(array_values($valueCounts)); ?>;
                                var dataLabels = <?php echo json_encode(array_keys($valueCounts)); ?>;

                                Chart.defaults.font.family = "Lato";
                                Chart.defaults.font.size = 16;

                                var ctx = document.getElementById('dataPieChart').getContext('2d');
                                var myPieChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: dataLabels,
                                        datasets: [{
                                            data: dataValues,
                                            backgroundColor: [
                                                'rgba(63, 122, 99)',
                                                'rgba(242, 140, 137)',
                                                // 'rgba(255, 206, 86, 0.7)',
                                                // Add more colors here if you have more data points
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true
                                    }
                                });
                                </script>

                            </div>
                        </div>

                        <!-- Two grid columns -->
                        <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                            <!-- Active users chart -->
                            <div class="col-span-1 bg-white rounded-md dark:bg-darker">
                                <!-- Card header -->
                                <div class="p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-center text-black  dark:text-light">
                                        ผู้ป่วยมาใช้บริการที่นี่เป็นครั้งแรก
                                    </h4>
                                </div>

                                <!-- Chart -->
                                <div class="relative p-4">
                                    <canvas id="everchart"></canvas>
                                    <script>
                                    // Convert PHP array data to JavaScript
                                    var dataValuesever = <?php echo json_encode(array_values($valueCountsever)); ?>;
                                    var dataLabelsever = <?php echo json_encode(array_keys($valueCountsever)); ?>;

                                    // Set chart font options
                                    Chart.defaults.font.family = "Lato";
                                    Chart.defaults.font.size = 16;

                                    // Set chart color options
                                    Chart.defaults.color = isDarkTheme ? '#FFFFFF' :
                                        '#000000';
                                    // Get the canvas element and create the pie chart
                                    var ctx = document.getElementById('everchart').getContext('2d');
                                    var myPieChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: dataLabelsever,
                                            datasets: [{
                                                data: dataValuesever,
                                                backgroundColor: [
                                                    'rgba(41, 94, 164)',
                                                    'rgba(255, 203, 79)',
                                                    // Add more colors here if you have more data points
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: false
                                        }
                                    });
                                    </script>
                                </div>
                            </div>

                            <!-- Line chart card -->
                            <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                                <!-- Card header -->
                                <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                    <h4 class="text-lg font-semibold text-black dark:text-light">
                                        ผู้ตอบแบบสอบถามให้คะแนน จากตอนที่ 2
                                        ความพึงพอใจความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่</h4>
                                    <div class="flex items-center">
                                    </div>
                                </div>
                                <!-- Chart -->
                                <div class="relative p-4 items-center">
                                    <canvas id="dataBarChart"></canvas>
                                    <script>
                                    function createChart() {
                                        // Convert PHP array to JavaScript array for chart
                                        var dataValuespop = <?php echo json_encode(array_values($top5Ratings)); ?>;
                                        var dataLabelspop = <?php echo json_encode(array_keys($top5Ratings)); ?>;

                                        // console.log(dataValuespop);
                                        // console.log(dataLabelspop);

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

                                        // Determine text colors based on the theme
                                        const textColorY = isDarkTheme ? '#FFFFFF' :
                                            '#000000'; // Y-axis label text color (white for dark, black for light)
                                        const textColorX = isDarkTheme ? '#FFFFFF' : '#000000';

                                        Chart.defaults.color = isDarkTheme ? '#FFFFFF' :
                                            '#000000';


                                        var labelsAdjusted = dataLabelspop.map(label => {
                                            var words = label.split(' ');
                                            var shortenedLabel = '';

                                            // Check if the words array has at least one element
                                            if (words.length >= 1) {
                                                shortenedLabel = words[0];
                                            } else {
                                                // If not, use the original label
                                                shortenedLabel = label;
                                            }
                                            return shortenedLabel;
                                        });

                                        console.log(labelsAdjusted);

                                        // Create the bar chart with the determined text color
                                        Chart.defaults.font.family = "Lato";
                                        Chart.defaults.font.size = 12;

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
                                                            color: textColorY, // Set the Y-axis label text color
                                                            beginAtZero: true
                                                        }
                                                    },
                                                    x: {
                                                        ticks: {
                                                            color: textColorX, // Set the X-axis label text color
                                                            beginAtZero: true
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    }

                                    // Create the chart initially
                                    createChart();

                                    // Toggle theme function
                                    const toggleTheme = () => {
                                        const isDarkTheme = !getTheme();
                                        setTheme(isDarkTheme);

                                        if (myBarChart) {
                                            myBarChart.destroy(); // Destroy the existing chart
                                        }

                                        createChart(); // Re-create the chart with the new theme
                                    };
                                    </script>

                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                            <!-- Card header -->
                            <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                                <h4 class="text-lg font-semibold text-black dark:text-light">
                                    ผู้ตอบแบบสอบถามให้คะแนน จากตอนที่ 2
                                    ความพึงพอใจความพึงพอใจต่อการปฎิบัติงานของเจ้าหน้าที่</h4>
                                <div class="flex items-center">
                                </div>
                            </div>
                            <!-- Chart -->
                            <div class="relative p-4 items-center">
                                <div>
                                    <div class="block w-full overflow-x-auto">
                                        <table class="w-full bg-transparent border-collapse">
                                            <table class="w-full bg-transparent border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="py-2 px-4 border-b border-r border-gray-300 font-semibold text-black dark:text-light">
                                                            การบริการของ รพ.สต.</th>
                                                        <th
                                                            class="py-2 px-4 border-b border-gray-300 font-semibold text-black dark:text-light">
                                                            ค่าเฉลี่ย</th>
                                                        <th class="py-2 px-4 border-b border-gray-300"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-100">
                                                    <?php
                            $top5RatingsKeys = array_keys($top5Ratings);
                            $top5RatingsValues = array_values($top5Ratings);

                            for ($i = 0; $i < min(15, count($top5Ratings)); $i++) {
                                echo '<tr class=" text-black dark:text-light">';
                                echo '<td class="py-2 px-4 border-b border-r border-gray-300 table-cell">' . $top5RatingsKeys[$i] . '</td>';
                                echo '<td class="py-2 px-4 border-b border-gray-300 table-cell text-center">' . json_encode($top5RatingsValues[$i]) . '</td>';
                                echo '<td class="py-2 px-4 border-b border-gray-300 table-cell"></td>';
                                echo '</tr>';
                            }
                            ?>
                                                </tbody>
                                            </table>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- <div class="col-span-12 xl:col-span-6"> -->

                        </div>
                </main>


            </div>

            <!-- Panels -->

            <!-- Settings Panel -->
            <!-- Backdrop -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="isSettingsPanelOpen"
                @click="isSettingsPanelOpen = false" class="fixed inset-0 z-10 bg-primary-darker" style="opacity: 0.5"
                aria-hidden="true"></div>
            <!-- Panel -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" x-ref="settingsPanel"
                tabindex="-1" x-show="isSettingsPanelOpen" @keydown.escape="isSettingsPanelOpen = false"
                class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
                aria-labelledby="settinsPanelLabel">
                <div class="absolute left-0 p-2 transform -translate-x-full">
                    <!-- Close button -->
                    <button @click="isSettingsPanelOpen = false"
                        class="p-2 text-white rounded-md focus:outline-none focus:ring">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Panel content -->
                <div class="flex flex-col h-screen">
                    <!-- Panel header -->
                    <div
                        class="flex flex-col items-center justify-center flex-shrink-0 px-4 py-8 space-y-4 border-b dark:border-primary-dark">
                        <span aria-hidden="true" class="text-gray-500 dark:text-primary">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </span>
                        <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-500 dark:text-light">Settings
                        </h2>
                    </div>
                    <!-- Content -->
                    <div class="flex-1 overflow-hidden hover:overflow-y-auto">
                        <!-- Theme -->
                        <div class="p-4 space-y-4 md:p-8">
                            <h6 class="text-lg font-medium text-gray-400 dark:text-light">Mode</h6>
                            <div class="flex items-center space-x-8">
                                <!-- Light button -->
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

                                <!-- Dark button -->
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

                        <!-- Colors -->
                        <div class="p-4 space-y-4 md:p-8">
                            <h6 class="text-lg font-medium text-gray-400 dark:text-light">Colors</h6>
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
    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
    <!-- <script src="build/js/script.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script>
    const setup = () => {
        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }

            return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
        }

        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }

        const getColor = () => {
            if (window.localStorage.getItem('color')) {
                return window.localStorage.getItem('color')
            }
            return 'cyan'
        }
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
        }
        return {
            loading: true,
            isDark: getTheme(),
            toggleTheme() {
                this.isDark = !this.isDark
                setTheme(this.isDark)
            },
            setLightTheme() {
                this.isDark = false
                setTheme(this.isDark)
            },
            setDarkTheme() {
                this.isDark = true
                setTheme(this.isDark)
            },
            color: getColor(),
            selectedColor: 'cyan',
            setColors,
            toggleSidbarMenu() {
                this.isSidebarOpen = !this.isSidebarOpen
            },
            isSettingsPanelOpen: false,
            openSettingsPanel() {
                this.isSettingsPanelOpen = true
                this.$nextTick(() => {
                    this.$refs.settingsPanel.focus()
                })
            },
            isMobileSubMenuOpen: false,
            openMobileSubMenu() {
                this.isMobileSubMenuOpen = true
                this.$nextTick(() => {
                    this.$refs.mobileSubMenu.focus()
                })
            },
            isMobileMainMenuOpen: false,
            openMobileMainMenu() {
                this.isMobileMainMenuOpen = true
                this.$nextTick(() => {
                    this.$refs.mobileMainMenu.focus()
                })
            },
        }
    }
    </script>
</body>

</html>