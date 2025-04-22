<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Live User</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('/images/avatar.svg') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />


</head>
</head>

<body class="bg-[#FCFAF9] min-h-screen roboto antialiased text-black">
    <header class="bg-[#F2EDE4] border-b border-[#C7C7C7]">
        <nav class="px-4 md:px-16 py-4 flex justify-between gap-10 items-center ">
            <div>
                <a href="/">
                    <img src={{ asset('/images/logo.svg') }} alt="logo" class="h-16" />
                </a>
            </div>

            <div>
                <div class="flex items-center gap-3">
                    <div class="text-end">
                        <div class="text-md font-medium text-black">Coimbatore</div>
                        <div class="text-[#7C7C7C] text-sm">Jewelone Showroom</div>
                    </div>
                    <div>
                        <img class="size-12 block rounded-full" src={{ asset('/images/avatar.svg') }} alt="avatar" />
                    </div>

                    <div>
                        <button
                            class="flex gap-1 items-center border cursor-pointer text-black border-black rounded-sm py-2 px-4 hover:text-white hover:bg-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                            </svg>

                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-[240px_calc(100%-240px)]">
        <aside class="bg-[#F2EDE4] ">
            <div class="p-4">
                <div class="flex flex-col gap-2 items-center">
                    <a href="/dashboard" class="flex items-center gap-1 text-[#4E5356] p-2 w-full rounded-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 fill-[#4E5356] stroke-[#4E5356]"
                            viewBox="0 0 24 24" fill="none">
                            <path
                                d="M6.1609 5H9.87626C10.6094 5 11.2032 5.73312 11.2032 6.32691V10.0423C11.2032 10.7754 10.6094 11.3692 9.87626 11.3692H6.1609C5.42778 11.3692 4.83398 10.6361 4.83398 10.0423V6.32691C4.83398 5.59379 5.42778 5 6.1609 5Z" />
                            <path
                                d="M14.1228 5.5H17.8382C18.0341 5.5 18.241 5.59964 18.4108 5.78175C18.5852 5.96876 18.6651 6.18382 18.6651 6.32691V10.0423C18.6651 10.4992 18.2951 10.8692 17.8382 10.8692H14.1228C13.9269 10.8692 13.7199 10.7695 13.5501 10.5874C13.3758 10.4004 13.2959 10.1854 13.2959 10.0423V6.32691C13.2959 5.86994 13.6658 5.5 14.1228 5.5Z"
                                stroke="inherit" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M6.1609 12.9614H9.87626C10.6094 12.9614 11.2032 13.6945 11.2032 14.2883V18.0037C11.2032 18.7368 10.6094 19.3306 9.87626 19.3306H6.1609C5.42778 19.3306 4.83398 18.5975 4.83398 18.0037V14.2883C4.83398 13.5552 5.42778 12.9614 6.1609 12.9614Z" />
                            <path
                                d="M14.1228 12.9614H17.8382C18.5713 12.9614 19.1651 13.6945 19.1651 14.2883V18.0037C19.1651 18.7368 18.5713 19.3306 17.8382 19.3306H14.1228C13.3897 19.3306 12.7959 18.5975 12.7959 18.0037V14.2883C12.7959 13.5552 13.3897 12.9614 14.1228 12.9614Z" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="/live-user" class="flex items-center gap-1 bg-[#9D4F2A] text-white p-2 w-full rounded-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 fill-white stroke-white" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M8.08908 7.85166C8.08905 7.0899 8.31839 6.34524 8.7481 5.71184C9.17782 5.07845 9.78861 4.58476 10.5032 4.29323C11.2179 4.00169 12.0042 3.92539 12.7629 4.07399C13.5215 4.22258 14.2184 4.58938 14.7654 5.12801C15.3123 5.66665 15.6848 6.35292 15.8358 7.10004C15.9867 7.84716 15.9092 8.62157 15.6132 9.32535C15.3172 10.0291 14.816 10.6307 14.1728 11.0539C13.5297 11.4771 12.7735 11.703 12 11.703C10.9632 11.7018 9.96913 11.2957 9.23595 10.5737C8.50278 9.85165 8.09033 8.87274 8.08908 7.85166ZM18.1928 15.2104C17.6741 14.6278 17.0365 14.1595 16.3216 13.8361C15.6067 13.5126 14.8306 13.3412 14.0439 13.3331H9.95606C9.16936 13.3412 8.39325 13.5126 7.67837 13.8361C6.96348 14.1595 6.32589 14.6278 5.8072 15.2104C4.68039 16.451 4.03967 18.0467 4.00015 19.7108C3.99893 19.7483 4.00538 19.7857 4.01913 19.8208C4.03287 19.8558 4.05363 19.8877 4.08015 19.9147C4.10668 19.9417 4.13845 19.9631 4.17356 19.9778C4.20867 19.9924 4.24642 20 4.28455 20H19.7154C19.7536 20 19.7913 19.9924 19.8264 19.9778C19.8616 19.9631 19.8933 19.9417 19.9198 19.9147C19.9464 19.8877 19.9671 19.8558 19.9809 19.8208C19.9946 19.7857 20.0011 19.7483 19.9999 19.7108C19.9604 18.0467 19.3197 16.451 18.1928 15.2104Z" />
                        </svg>
                        Live User
                    </a>
        </aside>
        <main class="min-h-screen border-l border-[#C7C7C7]">
            <section class="py-8 px-6">
                <div class="flex justify-between items-center gap-6">

                    <h1 class="text-xl font-semibold">Live User</h1>


                    <div x-data="showroomSelect()" class="relative w-64">
                        <!-- Toggle Button -->
                        <button @click="open = !open"
                            class="w-full px-4 py-2 border text-sm cursor-pointer border-gray-300 rounded-md bg-white text-left flex justify-between items-center">
                            <span>Showroom</span>
                            <svg :class="{'rotate-180': open}"
                                class="w-4 h-4 transform transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false; logSelected()" x-transition
                            class="absolute z-10 mt-2 w-full bg-white rounded-md shadow-lg border border-[#C7C7C7]">
                            <!-- Search -->
                            <div class="p-2 border-b border-[#C7C7C7]">
                                <input type="search" x-model="search" placeholder="Search Showroom"
                                    class="w-full px-3 py-1 border border-gray-300 rounded-md text-sm" />
                            </div>

                            <!-- Checkboxes -->
                            <div class="h-36  overflow-y-auto p-2 space-y-2">
                                <template x-for="(item, index) in filteredItems" :key="index">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" :value="item" :checked="selected.includes(item)"
                                            @change="toggleSelection(item)"
                                            class="form-checkbox rounded border-gray-300 text-blue-600" />
                                        <span x-text="item" class="text-sm"></span>
                                    </label>
                                </template>
                            </div>

                            <!-- Done Button -->
                            <div class="p-2 border-t border-[#C7C7C7] text-center">
                                <button @click="logSelected(); open = false"
                                    class="bg-amber-700 text-white px-4 py-1 rounded-md">Done</button>
                            </div>
                        </div>
                    </div>
                </div>





                <div>

                    <div class="swiper my-slider">
                        <div class="flex gap-2 mb-5">
                            <div class="border-b border-[#C7C7C7] mt-6 flex-grow">
                                <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">Anna Nagar
                                </div>
                            </div>
                            <div class="flex gap-1 items-end relative top-2">
                                <button
                                    class="swiper-prev rotate-180 disabled:opacity-25 cursor-pointer disabled:cursor-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect x="-0.400159" y="0.400159" width="23.2092" height="23.2092" rx="5.59984"
                                            transform="matrix(-1 0 0 1 23.2094 0)" stroke="black"
                                            stroke-width="0.800318" />
                                        <path
                                            d="M9.72563 18.2996C9.7977 18.3679 9.89564 18.4066 9.99798 18.4071C10.0488 18.4076 10.0991 18.3983 10.146 18.3798C10.1928 18.3613 10.2351 18.334 10.2703 18.2996L16.6925 12.2648C16.7286 12.2313 16.7572 12.1915 16.7768 12.1476C16.7963 12.1036 16.8064 12.0565 16.8064 12.0089C16.8064 11.9612 16.7963 11.9141 16.7768 11.8702C16.7572 11.8262 16.7286 11.7864 16.6925 11.7529L10.2703 5.7168C10.235 5.68133 10.1925 5.65289 10.1452 5.63319C10.098 5.61348 10.047 5.60291 9.99532 5.6021C9.94364 5.60129 9.89231 5.61026 9.84439 5.62847C9.79647 5.64669 9.75294 5.67377 9.71639 5.70812C9.67984 5.74247 9.65102 5.78337 9.63163 5.8284C9.61225 5.87343 9.60271 5.92166 9.60357 5.97023C9.60443 6.0188 9.61568 6.0667 9.63665 6.1111C9.65762 6.1555 9.68788 6.19548 9.72563 6.22866L15.8754 12.0089L9.72563 17.7878C9.68972 17.8213 9.66123 17.8612 9.64179 17.9051C9.62235 17.949 9.61234 17.9961 9.61234 18.0437C9.61234 18.0913 9.62235 18.1384 9.64179 18.1823C9.66123 18.2262 9.68972 18.2661 9.72563 18.2996Z"
                                            fill="black" />
                                    </svg>
                                </button>
                                <button class="swiper-next disabled:opacity-25 cursor-pointer disabled:cursor-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect x="-0.400159" y="0.400159" width="23.2092" height="23.2092" rx="5.59984"
                                            transform="matrix(-1 0 0 1 23.2094 0)" stroke="black"
                                            stroke-width="0.800318" />
                                        <path
                                            d="M9.72563 18.2996C9.7977 18.3679 9.89564 18.4066 9.99798 18.4071C10.0488 18.4076 10.0991 18.3983 10.146 18.3798C10.1928 18.3613 10.2351 18.334 10.2703 18.2996L16.6925 12.2648C16.7286 12.2313 16.7572 12.1915 16.7768 12.1476C16.7963 12.1036 16.8064 12.0565 16.8064 12.0089C16.8064 11.9612 16.7963 11.9141 16.7768 11.8702C16.7572 11.8262 16.7286 11.7864 16.6925 11.7529L10.2703 5.7168C10.235 5.68133 10.1925 5.65289 10.1452 5.63319C10.098 5.61348 10.047 5.60291 9.99532 5.6021C9.94364 5.60129 9.89231 5.61026 9.84439 5.62847C9.79647 5.64669 9.75294 5.67377 9.71639 5.70812C9.67984 5.74247 9.65102 5.78337 9.63163 5.8284C9.61225 5.87343 9.60271 5.92166 9.60357 5.97023C9.60443 6.0188 9.61568 6.0667 9.63665 6.1111C9.65762 6.1555 9.68788 6.19548 9.72563 6.22866L15.8754 12.0089L9.72563 17.7878C9.68972 17.8213 9.66123 17.8612 9.64179 17.9051C9.62235 17.949 9.61234 17.9961 9.61234 18.0437C9.61234 18.0913 9.62235 18.1384 9.64179 18.1823C9.66123 18.2262 9.68972 18.2661 9.72563 18.2996Z"
                                            fill="black" />
                                    </svg>
                                </button>

                            </div>
                        </div>
                        <div class="swiper-wrapper">

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div
                                        class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">001</span>
                                        </div>
                                        <div class="text-xl font-semibold">Madhu</div>
                                        <div class="mt-4">
                                            <a href="/customer/001"
                                                class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                                Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">20 mins 56 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div
                                        class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">002</span>
                                        </div>
                                        <div class="text-xl font-semibold">Ayesha</div>
                                        <div class="mt-4">
                                            <a href="/customer/002"
                                                class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                                Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">12 mins 14 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div
                                        class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">003</span>
                                        </div>
                                        <div class="text-xl font-semibold">Rahul</div>
                                        <div class="mt-4">
                                            <a href="/customer/003"
                                                class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                                Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">5 mins 33 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div
                                        class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">004</span>
                                        </div>
                                        <div class="text-xl font-semibold">Kiran</div>
                                        <div class="mt-4">
                                            <a href="/customer/004"
                                                class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                                Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">10 mins 2 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div
                                        class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">005</span>
                                        </div>
                                        <div class="text-xl font-semibold">Neha</div>
                                        <div class="mt-4">
                                            <a href="/customer/005"
                                                class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                                Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">7 mins 47 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div
                                        class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">006</span>
                                        </div>
                                        <div class="text-xl font-semibold">Deepak</div>
                                        <div class="mt-4">
                                            <a href="/customer/006"
                                                class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                                Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">15 mins 20 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div
                                        class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">007</span>
                                        </div>
                                        <div class="text-xl font-semibold">Nisha</div>
                                        <div class="mt-4">
                                            <a href="/customer/007"
                                                class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                                Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">22 mins 18 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div
                                        class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">008</span>
                                        </div>
                                        <div class="text-xl font-semibold">Ravi</div>
                                        <div class="mt-4">
                                            <a href="/customer/008"
                                                class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                                Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">8 mins 9 secs</div>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="swiper my-slider mt-5">
                        <div class="flex gap-2 mb-5">
                            <div class="border-b border-[#C7C7C7] mt-6 flex-grow">
                                <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">Vellore</div>
                            </div>
                            <div class="flex gap-1 items-end relative top-2">
                                <button
                                    class="swiper-prev rotate-180 disabled:opacity-25 cursor-pointer disabled:cursor-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect x="-0.400159" y="0.400159" width="23.2092" height="23.2092" rx="5.59984"
                                            transform="matrix(-1 0 0 1 23.2094 0)" stroke="black"
                                            stroke-width="0.800318" />
                                        <path
                                            d="M9.72563 18.2996C9.7977 18.3679 9.89564 18.4066 9.99798 18.4071C10.0488 18.4076 10.0991 18.3983 10.146 18.3798C10.1928 18.3613 10.2351 18.334 10.2703 18.2996L16.6925 12.2648C16.7286 12.2313 16.7572 12.1915 16.7768 12.1476C16.7963 12.1036 16.8064 12.0565 16.8064 12.0089C16.8064 11.9612 16.7963 11.9141 16.7768 11.8702C16.7572 11.8262 16.7286 11.7864 16.6925 11.7529L10.2703 5.7168C10.235 5.68133 10.1925 5.65289 10.1452 5.63319C10.098 5.61348 10.047 5.60291 9.99532 5.6021C9.94364 5.60129 9.89231 5.61026 9.84439 5.62847C9.79647 5.64669 9.75294 5.67377 9.71639 5.70812C9.67984 5.74247 9.65102 5.78337 9.63163 5.8284C9.61225 5.87343 9.60271 5.92166 9.60357 5.97023C9.60443 6.0188 9.61568 6.0667 9.63665 6.1111C9.65762 6.1555 9.68788 6.19548 9.72563 6.22866L15.8754 12.0089L9.72563 17.7878C9.68972 17.8213 9.66123 17.8612 9.64179 17.9051C9.62235 17.949 9.61234 17.9961 9.61234 18.0437C9.61234 18.0913 9.62235 18.1384 9.64179 18.1823C9.66123 18.2262 9.68972 18.2661 9.72563 18.2996Z"
                                            fill="black" />
                                    </svg>
                                </button>
                                <button class="swiper-next disabled:opacity-25 cursor-pointer disabled:cursor-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect x="-0.400159" y="0.400159" width="23.2092" height="23.2092" rx="5.59984"
                                            transform="matrix(-1 0 0 1 23.2094 0)" stroke="black"
                                            stroke-width="0.800318" />
                                        <path
                                            d="M9.72563 18.2996C9.7977 18.3679 9.89564 18.4066 9.99798 18.4071C10.0488 18.4076 10.0991 18.3983 10.146 18.3798C10.1928 18.3613 10.2351 18.334 10.2703 18.2996L16.6925 12.2648C16.7286 12.2313 16.7572 12.1915 16.7768 12.1476C16.7963 12.1036 16.8064 12.0565 16.8064 12.0089C16.8064 11.9612 16.7963 11.9141 16.7768 11.8702C16.7572 11.8262 16.7286 11.7864 16.6925 11.7529L10.2703 5.7168C10.235 5.68133 10.1925 5.65289 10.1452 5.63319C10.098 5.61348 10.047 5.60291 9.99532 5.6021C9.94364 5.60129 9.89231 5.61026 9.84439 5.62847C9.79647 5.64669 9.75294 5.67377 9.71639 5.70812C9.67984 5.74247 9.65102 5.78337 9.63163 5.8284C9.61225 5.87343 9.60271 5.92166 9.60357 5.97023C9.60443 6.0188 9.61568 6.0667 9.63665 6.1111C9.65762 6.1555 9.68788 6.19548 9.72563 6.22866L15.8754 12.0089L9.72563 17.7878C9.68972 17.8213 9.66123 17.8612 9.64179 17.9051C9.62235 17.949 9.61234 17.9961 9.61234 18.0437C9.61234 18.0913 9.62235 18.1384 9.64179 18.1823C9.66123 18.2262 9.68972 18.2661 9.72563 18.2996Z"
                                            fill="black" />
                                    </svg>
                                </button>

                            </div>
                        </div>
                        <div class="swiper-wrapper">

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">001</span>
                                        </div>
                                        <div class="text-xl font-semibold">John</div>
                                        <div class="mt-4">
                                            <a href="/customer/001" class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">20 mins 56 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">002</span>
                                        </div>
                                        <div class="text-xl font-semibold">Ravi</div>
                                        <div class="mt-4">
                                            <a href="/customer/002" class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">15 mins 20 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">003</span>
                                        </div>
                                        <div class="text-xl font-semibold">Divya</div>
                                        <div class="mt-4">
                                            <a href="/customer/003" class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">12 mins 42 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">004</span>
                                        </div>
                                        <div class="text-xl font-semibold">Kiran</div>
                                        <div class="mt-4">
                                            <a href="/customer/004" class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">08 mins 10 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">005</span>
                                        </div>
                                        <div class="text-xl font-semibold">Neha</div>
                                        <div class="mt-4">
                                            <a href="/customer/005" class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">11 mins 03 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">006</span>
                                        </div>
                                        <div class="text-xl font-semibold">Arjun</div>
                                        <div class="mt-4">
                                            <a href="/customer/006" class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">17 mins 35 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">007</span>
                                        </div>
                                        <div class="text-xl font-semibold">Nisha</div>
                                        <div class="mt-4">
                                            <a href="/customer/007" class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">10 mins 50 secs</div>
                                </div>
                            </div>

                            <div class="swiper-slide bg-white max-w-52">
                                <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                    <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                        <div class="flex gap-1 items-center">
                                            <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                            <span class="text-md">008</span>
                                        </div>
                                        <div class="text-xl font-semibold">Rahul</div>
                                        <div class="mt-4">
                                            <a href="/customer/008" class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View Details</a>
                                        </div>
                                    </div>
                                    <div class="text-sm py-2 px-6 text-[#ED3333]">09 mins 28 secs</div>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>

            </section>
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        function showroomSelect() {
            return {
                open: false,
                search: '',
                selected: ['Anna Nagar', 'Vellore'], // pre-selected
                items: ['Anna Nagar', 'Puducherry', 'Vellore', 'Hosur', 'Trichy', 'Coimbatore', 'Hyderabad', 'Bangalore',
                    'Chennai', 'Delhi', 'Mumbai'
                ],

                get filteredItems() {
                    return this.items.filter(item =>
                        item.toLowerCase().includes(this.search.toLowerCase())
                    );
                },

                toggleSelection(item) {
                    const index = this.selected.indexOf(item);
                    if (index > -1) {
                        this.selected.splice(index, 1);
                    } else {
                        this.selected.push(item);
                    }
                },

                logSelected() {
                    console.log('Selected Showrooms:', this.selected);
                }
            }
        }
    </script>


    <script>
        var swiper = new Swiper(".my-slider", {
            slidesPerView: "auto",
            spaceBetween: 10,

            navigation: {
                nextEl: ".swiper-next",
                prevEl: ".swiper-prev",
            },

        });
    </script>



</body>

</html>