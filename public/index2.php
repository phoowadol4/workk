<?php
include("./process/process_get.php");
$keepName;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>K-WD Dashboard</title>
    <link rel="stylesheet" href="build/css/tailwind.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./build/css/style_index2.css">
    <link rel="stylesheet" href="./build/css/map.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>

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
                                <span class="ml-2 text-sm"> Dashboard </span>
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
                        <div>
                            <form class="flex items-center">
                                <div class="relative flex w-full flex-wrap items-stretch">
                                    <input type="search"
                                        class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                                        placeholder="ค้นหารายชื่อ" name="re" aria-label="Search"
                                        aria-describedby="button-addon3" />

                                    <!--Search button-->
                                    <button type="submit"
                                        class="relative z-[2] rounded-r border-2 border-primary px-6 py-2 text-xs font-medium uppercase text-primary transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
                                        id="button-addon3" data-te-ripple-init>
                                        ค้นหา
                                    </button>
                                </div>
                            </form>
                        </div>
                        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js">
                        </script>
                        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
                        </form>

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
                                    <span class="ml-2 text-sm"> Pages </span>
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
                    <!-- Charts -->
                    <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                        <!-- Bar chart card -->
                        <div class="bg-white rounded-md dark:bg-darker p-4 overflow-auto">
                            <!-- Card header -->
                            <div class="flex items-center justify-between border-b dark:border-primary">
                                <h4 class="text-lg font-semibold text-black dark:text-light">ข้อมูล</h4>
                            </div>
                            <div id="resultdata">
                            </div>
                            <div>
                                <?php
            if (isset($_GET['re'])) {
                $searchQuery = $_GET['re'];
            }                              
            
            if (isset($data1['result']) && !empty($data1['result'])) {                                
        $mergedData = array();
        foreach ($data1['result'] as $person) {
            if ($person['fname'] == $searchQuery || $person['lname'] == $searchQuery ) {
                $personData = array(
                'cid' => $person['cid'],
                'id' => $person['id'],
                'pname' => $person['pname'],
                'fname' => $person['fname'],
                'lname' => $person['lname'],
                'house_id' => $person['house_id'],
                'pcode' => $person['pcode'],
                'sex' => $person['sex'],
                'nationality' => $person['nationality'],
                'citizenship' => $person['citizenship'],
                'education' => $person['education'],
                'occupation' => $person['occupation'],
                'religion' => $person['religion'],
                'marrystatus' => $person['marrystatus'],
                'house_regist_type_id' => $person['house_regist_type_id'],
                'birthdate' => $person['birthdate'],
                'has_house_regist' => $person['has_house_regist'],
                'chronic_disease_list' => $person['chronic_disease_list'],
                'club_list' => $person['club_list'],
                'village_id' => $person['village_id'],
                'blood_group' => $person['blood_group'],
                'current_age' => $person['current_age'],
                'death_date' => $person['death_date'],
                'hos_guid' => $person['hos_guid'],
                'income_per_year' => $person['income_per_year'],
                'home_position_id' => $person['home_position_id'],
                'family_position_id' => $person['family_position_id'],
                'drug_allergy' => $person['drug_allergy'],
                'last_update' => $person['last_update'],
                'death' => $person['death'],
                'pttype' => $person['pttype'],
                'pttype_begin_date' => $person['pttype_begin_date'],
                'pttype_expire_date' => $person['pttype_expire_date'],
                'pttype_hospmain' => $person['pttype_hospmain'],
                'pttype_hospsub' => $person['pttype_hospsub'],
                'father_person_id' => $person['father_person_id'],
                'mother_person_id' => $person['mother_person_id'],
                'pttype_no' => $person['pttype_no'],
                'sps_person_id' => $person['sps_person_id'],
                'birthtime' => $person['birthtime'],
                'age_y' => $person['age_y'],
                'age_m' => $person['age_m'],
                'age_d' => $person['age_d'],
                'family_id' => $person['family_id'],
                'person_house_position_id' => $person['person_house_position_id'],
                'person_guid' => $person['person_guid'],
                'house_guid' => $person['house_guid'],
                'patient_hn' => $person['patient_hn'],
                'found_dw_emr' => $person['found_dw_emr'],
                'person_discharge_id' => $person['person_discharge_id'],
                'movein_date' => $person['movein_date'],
                'discharge_date' => $person['discharge_date'],
                'person_labor_type_id' => $person['person_labor_type_id'],
                'father_name' => $person['father_name'],
                'mother_name' => $person['mother_name'],
                'sps_name' => $person['sps_name'],
                'father_cid' => $person['father_cid'],
                'mother_cid' => $person['mother_cid'],
                'sps_cid' => $person['sps_cid'],
                'bloodgroup_rh' => $person['bloodgroup_rh'],
                'home_phone' => $person['home_phone'],
                'old_code' => $person['old_code'],
                'deformed_status' => $person['deformed_status'],
                'ncd_dm_history_type_id' => $person['ncd_dm_history_type_id'],
                'ncd_ht_history_type_id' => $person['ncd_ht_history_type_id'],
                'agriculture_member_type_id' => $person['agriculture_member_type_id'],
                'senile' => $person['senile'],
                'in_region' => $person['in_region'],
                'body_weight_kg' => $person['body_weight_kg'],
                'height_cm' => $person['height_cm'],
                'nutrition_level' => $person['nutrition_level'],
                'height_nutrition_level' => $person['height_nutrition_level'],
                'bw_ht_nutrition_level' => $person['bw_ht_nutrition_level'],
                'hometel' => $person['hometel'],
                'worktel' => $person['worktel'],
                'register_conflict' => $person['register_conflict'],
                'care_person_name' => $person['care_person_name'],
                'work_addr' => $person['work_addr'],
                'person_dm_screen_status_id' => $person['person_dm_screen_status_id'],
                'person_ht_screen_status_id' => $person['person_ht_screen_status_id'],
                'person_stroke_screen_status_id' => $person['person_stroke_screen_status_id'],
                'person_obesity_screen_status_id' => $person['person_obesity_screen_status_id'],
                'person_dmht_manage_type_id' => $person['person_dmht_manage_type_id'],
                'last_screen_dmht_bdg_year' => $person['last_screen_dmht_bdg_year'],
                'dw_chronic_register' => $person['dw_chronic_register'],
                'mobile_phone' => $person['mobile_phone'],
                'pttype_nhso_valid' => $person['pttype_nhso_valid'],
                'pttype_nhso_valid_datetime' => $person['pttype_nhso_valid_datetime'],
            );

            
            $sex = $personData['sex'];

            if ($sex == 2){
                 $sex ="หญิง";
            }
            else{
                 $sex = "ชาย";
            }

            echo "
            <div>
                <span class='font-semibold text-primary-dark'>ชื่อ:</span> {$person['pname']} &nbsp;{$person['fname']} &nbsp;{$person['lname']}<br>
                <span class='font-semibold text-primary-dark'>เพศ:</span> {$sex}<br>
            </div>
            ";
            break;
        }
    }

if (isset($data2['result']) && !empty($data2['result'])) {    
    foreach ($data2['result'] as $item) {
        if ($item['house_id'] == $personData['house_id'] ) {
            $houseData = array(
                'house_id' => $item['house_id'],
                'id' => $item['id'],
                'address' => $item['address'],
                'road' => $item['road'],
                'census_id' => $item['census_id'],
                'hos_guid' => $item['hos_guid'],
                'location_area_id' => $item['location_area_id'],
                'latitude' => $item['latitude'],
                'longitude' => $item['longitude'] ,
                'family_count' => $item['family_count'],
                'last_update' => $item['last_update'] ,
                'house_type_id' => $item['house_type_id'],
                'house_guid' => $item['house_guid'],
                'village_guid' => $item['village_guid'],
                'doctor_code' => $item['doctor_code'],
                'head_person_id' => $item['head_person_id'],
                'utm_lat' => $item['utm_lat'],
                'utm_long' => $item['utm_long'],
                'house_social_survey_staff' => $item['house_social_survey_staff'],
                'house_subtype_id' => $item['house_subtype_id'],
                'house_condo_roomno' => $item['house_condo_roomno'],
                'house_condo_name' => $item['house_condo_name'],
                'house_housing_development_name' => $item['house_housing_development_name'],
                'doctor_code2' => $item['doctor_code2'],
                'vms_person_id' => $item['vms_person_id'],
                'person_count' => $item['person_count'],
                'address_int' => $item['address_int'],
                // Add other fields here...
            );
            echo "
            <div>
                <span class='font-semibold text-primary-dark'>บ้านเลขที่:</span> {$item['address']}<br>
                <span class='font-semibold text-primary-dark'>ละติจูด:</span> {$item['latitude']}<br>
                <span class='font-semibold text-primary-dark'>ลองจิจูด:</span> {$item['longitude']}<br>
                

            </div>
            ";
                    $pname = $personData['pname'];
                    $fname = $personData['fname'];
                    $name = $pname . ' ' . $fname . ' ' . $personData['lname'];
                    $keepName = $name;
                    $latitude = $houseData['latitude'];
                    $longitude = $houseData['longitude'];
                    $hasLocation = $latitude !== 'None';
                    $mergedData[] = array_merge($personData, $houseData);


                    break;

                    }

                    }
                    } 
                    }
                    curl_close($curl1);
                    curl_close($curl2);
                    ?>

                            </div>
                        </div>
                        <div class="col-span-2 bg-white rounded-md dark:bg-darker p-4">
                            <!-- Card header -->
                            <div class="flex items-center justify-between border-b dark:border-primary">
                                <h4 class="text-lg font-semibold text-black dark:text-light">
                                    แผนที่
                                </h4>
                            </div>
                            <div id="map" class="overflow-auto h-64">
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js">
                            </script>
                            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

                            <script>
                            <?php
switch (true) {
    case $hasLocation:
        $latitude = json_encode($latitude);
        $longitude = json_encode($longitude);
?>
                            console.log('location', <?= $latitude; ?>);

                            var map = L.map('map').setView([<?= $latitude; ?>, <?= $longitude; ?>], 13);
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            L.marker([<?= $latitude; ?>, <?= $longitude; ?>]).addTo(map)
                                .bindPopup(
                                    '<p class="font-semibold text-primary-dark text-center text-black text-md">บ้านของ</p>' +
                                    '<p class="font-semibold text-primary-dark text-black text-center text-md"><?= $name; ?></p>' +
                                    '<div class="text-center">' +
                                    '<button id="getDirections" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ไปยังเส้นทาง</button>' +
                                    '</div>'
                                )
                                .openPopup();


                            var latitude = <?= $latitude ?>;
                            var longitude = <?= $longitude ?>;

                            var destinationLatitude;
                            var destinationLongitude;

                            if ("geolocation" in navigator) {
                                // Request the user's current location
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    destinationLatitude = position.coords.latitude;
                                    destinationLongitude = position.coords.longitude;

                                    // Function to open Google Maps with directions
                                    function openDirections() {
                                        var mapsURL;
                                        var userAgent = navigator.userAgent.toLowerCase();
                                        var isiOS = /ipad|iphone|ipod/.test(userAgent);
                                        var isAndroid = /android/.test(userAgent);

                                        switch (true) {
                                            case isiOS:
                                                // iOS device
                                                mapsURL =
                                                    `comgooglemaps://?saddr=${destinationLatitude},${destinationLongitude}&daddr=${latitude},${longitude}&views=traffic`;

                                                break;

                                            case isAndroid:
                                                // Android device
                                                mapsURL =
                                                    `google.navigation:q=${destinationLatitude},${destinationLongitude}&origin=${latitude},${longitude}`;

                                                break;

                                            default:
                                                // Fallback for other devices or browsers
                                                mapsURL =
                                                    `https://www.google.com/maps/dir/?api=1&origin=${destinationLatitude},${destinationLongitude}&destination=${latitude},${longitude}`;


                                                break;
                                        }
                                        // Open the URL in a new tab/window
                                        window.open(mapsURL, '_blank');
                                    }
                                    // Add a click event listener to the "Get Directions" button
                                    document.getElementById('getDirections').addEventListener('click',
                                        openDirections);
                                }, function() {});
                            } else {}
                            <?php
        break;
    case $cid && $latitude == 'None':
        ?>

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'ไม่มีข้อมูลบ้านในพิกัด',
                            });

                            var defaultMap = L.map('map').setView([16.797776693735905, 100.21001478729903], 13);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(defaultMap);

                            L.marker([16.797776693735905, 100.21001478729903]).addTo(defaultMap)
                                .bindPopup(
                                    '<p class="font-semibold text-primary-dark text-black text-md">ไม่มีที่อยู่บ้านในพิกัด</p>'
                                    )
                                .openPopup();
                            <?php
        break;
    default:
        ?>
                            console.log('log-no', <?= json_encode($cid); ?>);

                            var defaultMap = L.map('map').setView([16.797776693735905, 100.21001478729903], 13);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(defaultMap);

                            L.marker([16.797776693735905, 100.21001478729903]).addTo(defaultMap)
                                .bindPopup(
                                    '<p class="font-semibold text-primary-dark text-black text-md">ไม่มีที่อยู่บ้านในพิกัด</p>'
                                    )
                                .openPopup();
                            <?php
        break;
}
?>
                            </script>

                        </div>
                    </div>
                </main>

                <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    x-show="isSettingsPanelOpen" @click="isSettingsPanelOpen = false"
                    class="fixed inset-0 z-10 bg-primary-darker" style="opacity: 0.5" aria-hidden="true"></div>
                <!-- Panel -->
                <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    x-ref="settingsPanel" tabindex="-1" x-show="isSettingsPanelOpen"
                    @keydown.escape="isSettingsPanelOpen = false"
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
                            <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-500 dark:text-light">
                                Settings
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

            <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script> -->
            <!-- <script src="build/js/script.js"></script> -->
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
                    //
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
                    }
                }
            }
            </script>
</body>

</html>