<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('/images/avatar.svg') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body class="bg-[#FCFAF9] min-h-screen roboto antialiased">
    <header class="bg-[#F2EDE4] border-b border-[#C7C7C7]">
        <nav class="px-4 md:px-16 py-4 flex justify-between gap-5 items-center">
            <div>
                <a href="{{ route('voc') }}">
                    <img src="{{ asset('/images/logo.svg') }}" alt="logo" class="h-14 lg:h-16" />
                </a>
            </div>

            <div>
                <div class="flex items-center gap-3">
                    <div class="text-end">
                        <div class="text-md font-medium text-black">{{ Auth::user()->name }}</div>
                        <div class="text-[#7C7C7C] text-sm hidden lg:block">Jewelone Showroom</div>
                    </div>
                    <div class="hidden lg:block">
                        <img class="size-12 block rounded-full" src={{ asset('/images/avatar.svg') }} alt="avatar" />
                    </div>

                    <div>
                        <a href="{{ route('logout') }}"
                            class="hidden lg:flex gap-1 items-center border cursor-pointer text-black border-black rounded-sm py-2 px-4 hover:text-white hover:bg-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                            </svg>

                            Logout
                        </a>

                        <a href="{{ route('logout') }}" class="lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38"
                                fill="none">
                                <path
                                    d="M19 0C8.52197 0 0 8.52197 0 19C0 29.478 8.52197 38 19 38C29.478 38 38 29.478 38 19C38 8.52197 29.478 0 19 0ZM18.05 8.75425C18.05 8.22729 18.4768 7.80425 19 7.80425C19.5232 7.80425 19.95 8.22729 19.95 8.75425V16.3913C19.95 16.9183 19.5232 17.3413 19 17.3413C18.4768 17.3413 18.05 16.9183 18.05 16.3913V8.75425ZM19 27.5315C14.2983 27.5315 10.4685 23.7036 10.4685 19C10.4685 16.0461 11.964 13.3427 14.4782 11.771C14.9198 11.4908 15.5098 11.6244 15.7844 12.0697C16.0646 12.5113 15.931 13.1014 15.4857 13.376C13.5337 14.6006 12.3704 16.701 12.3704 19C12.3704 22.6571 15.3447 25.6314 19.0018 25.6314C22.659 25.6314 25.6333 22.6571 25.6333 19C25.6333 16.7011 24.47 14.6006 22.518 13.376C22.0708 13.1013 21.9391 12.5113 22.2193 12.0697C22.4939 11.6225 23.0783 11.4908 23.5255 11.771C26.0378 13.3426 27.5352 16.046 27.5352 19C27.5352 23.7017 23.7073 27.5315 19.0037 27.5315H19Z"
                                    fill="#9D4F2A" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="relative min-h-screen"
        style="
        background-image: url('/images/watermark.png');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 280px;
      ">
        <section class="p-4 py-8 md:p-16" x-data="{ tab: 'live-customer' }">
            <div class="border-b border-gray-300 pb-4 mb-4 flex gap-4 justify-between items-center flex-wrap">
                <div class="space-x-6">
                    <button class="p-2 font-semibold text-md border-[#9D4F2A] text-[#9D4F2A] relative" :class="{ 'border-b-3': tab === 'live-customer' }" @click="tab = 'live-customer'">
                        Live Customer

                        <span
                            class="absolute -top-3 -right-2 bg-green-200 text-green-500 flex items-center justify-center px-2 py-1 rounded-full text-sm">
                            {{ $walkincustomer->count() }}
                        </span>
                    </button>

                    <button class="p-2 font-semibold text-md border-[#9D4F2A] text-[#9D4F2A] relative" :class="{ 'border-b-3': tab === 'customer-list' }" @click="tab = 'customer-list'">
                        Customer List
                    </button>
                </div>

                <div>
                    <button onclick="addCustomer.showModal()"
                        class="bg-[#9D4F2A] text-white px-6 py-3 rounded-sm font-medium shadow-md cursor-pointer text-sm flex gap-1 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd"
                                d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                clip-rule="evenodd" />
                        </svg>

                        Add customer
                    </button>

                    <dialog id="addCustomer" class="modal">
                        <div class="modal-box p-0 max-w-2xl bg-[#FCFAF9]">
                            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10  divide-x divide-white">
                                <div class="pe-4">
                                    <img class="h-14 lg:h-16" src={{ asset('/images/logo-white.svg') }}
                                        alt="logo" />
                                </div>
                                <div class="text-lg lg:text-xl text-white font-medium uppercase">
                                    Welcome to Jewel one
                                </div>
                            </div>

                            <div class="px-4 md:px-6 py-10 lg:px-12 text-[#4E5356]">
                                <form id="add-customer-form">

                                    <!-- Phone Number Fields -->
                                    <div class="flex flex-col justify-center items-center gap-6">
                                        <div class="text-[#9D4F2A] text-md font-semibold">Enter your phone number</div>
                                        <div class="input-container phone-group grid grid-cols-10 gap-1">
                                            <input required type="text" maxlength="1" id="phone-1"
                                                class="phone input-box" />
                                            <input required type="text" maxlength="1" id="phone-2"
                                                class="phone input-box" />
                                            <input required type="text" maxlength="1" id="phone-3"
                                                class="phone input-box" />
                                            <input required type="text" maxlength="1" id="phone-4"
                                                class="phone input-box" />
                                            <input required type="text" maxlength="1" id="phone-5"
                                                class="phone input-box" />
                                            <input required type="text" maxlength="1" id="phone-6"
                                                class="phone input-box" />
                                            <input required type="text" maxlength="1" id="phone-7"
                                                class="phone input-box" />
                                            <input required type="text" maxlength="1" id="phone-8"
                                                class="phone input-box" />
                                            <input required type="text" maxlength="1" id="phone-9"
                                                class="phone input-box" />
                                            <input required type="text" maxlength="1" id="phone-10"
                                                class="phone input-box" />
                                        </div>

                                        <!-- Hidden input to store combined value -->
                                        <input type="hidden" id="hiddenPhone" name="hiddenPhone" />

                                        <div>
                                            <button type="submit" class="main-btn !px-10">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <form method="dialog" class="modal-backdrop z-10">
                                <button class="text-white absolute top-0 right-0 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                        viewBox="0 0 31 31" fill="none">
                                        <circle cx="15.5" cy="15.5" r="15.5" fill="black" />
                                        <path
                                            d="M9.39522 23L15.5 16.8462L21.6048 23L23 21.6048L16.8462 15.5L23 9.39522L21.6048 8L15.5 14.1538L9.39522 8L8 9.39522L14.1538 15.5L8 21.6048L9.39522 23Z"
                                            fill="#FCFAF9" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </dialog>
                </div>
            </div>

            <div class="lg:p-4" x-data="getfeedbackData" x-show="tab === 'live-customer'" x-cloak>

                @if (count($walkincustomer) > 0)
                    <div
                        class="grid min-[360px]:grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-2 gap-y-5 sm:gap-5 flex-wrap">
                        @foreach ($walkincustomer as $item)
                            <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-4">
                                    <div class="flex gap-1 items-center">
                                        <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                        <span class="text-sm">Customer #{{ $item->daily_count }}</span>
                                    </div>
                                    <div class="text-lg font-semibold">
                                        {{ $item->name ? $item->name : 'new customer' }}
                                    </div>
                                    <div class="my-4">
                                        <button id="viewDetailsBtn-{{ $item->customer_id }}"
                                            @click="open = true; formData.customerId = {{ $item->id }}; viewCustomerDetails({{ $item->customer_id }})"
                                            class="px-4 py-2 text-sm block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">
                                            View Details
                                        </button>
                                    </div>
                                    <div class="mb-4">
                                        <button @click="open = true; viewHistory({{ $item->customer_id }})"
                                            class="px-4 py-2 text-sm block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-black bg-white hover:bg-[#9D4F2A] hover:text-white">
                                            View History
                                        </button>
                                    </div>
                                    <div>
                                        <button @click="open = true; getFeedback({{ $item->id }})"
                                            class="px-4 py-2 text-sm block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-black bg-white hover:bg-[#9D4F2A] hover:text-white">
                                            Get Feedback
                                        </button>
                                    </div>
                                </div>
                                <div class="text-xs py-2 px-4" style="color: red;">
                                    <span id="timer-{{ $item->id }}"
                                        data-enter-time="{{ $item->customer_enter_time }}"
                                        data-customer-id="{{ $item->id }}">Loading...</span>
                                    <input type="hidden" name="spent_time_{{ $item->id }}"
                                        id="spent_time_{{ $item->id }}" value="">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="flex flex-col text-black gap-6 text-lg justify-center items-center max-w-md mx-auto text-center py-10 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <div>
                            <img class="h-20" src="{{ asset('/images/customers.svg') }}" alt="customers">
                        </div>
                        <div>
                            Once you have started to create a New Customer, <br> you’ll see it listed here
                        </div>
                    </div>
                @endif

                <dialog id="viewHistory" class="modal">
                    <div class="modal-box p-0 max-w-4xl min-h-60 bg-[#FCFAF9]">
                        <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10 divide-x divide-white">
                            <div class="pe-4">
                                <img class="h-14 lg:h-16" src="{{ asset('/images/logo-white.svg') }}"
                                    alt="logo" />
                            </div>
                            <div class="text-lg lg:text-xl text-white font-medium uppercase">
                                Past History
                            </div>
                        </div>

                        <div class="padding_alignment_1 flex flex-row justify-between">
                            <div class="text-black">Customer Id: <span id="customer-id"></span></div>
                            <div class="text-black">Customer Name: <span id="customer-name"></span></div>
                            <div class="text-black">Customer Number: <span id="customer-phone"></span></div>
                        </div>

                        <div class="p-10" x-data="{ openRow: null }">
                            <div class="overflow-x-auto">
                                <table class="table border border-[#C7C7C7] text-center">
                                    <thead class="bg-black text-white text-sm">
                                        <tr>
                                            <th class="px-4 py-3">S.No</th>
                                            <th class="px-4 py-3">DATE OF VISIT</th>
                                            <th class="px-4 py-3">CUSTOMER TYPE</th>
                                            <th class="px-4 py-3">VIEW FEEDBACK</th>
                                            <th class="px-4 py-3">ORDER HISTORY</th>
                                        </tr>
                                    </thead>
                                    <tbody id="history" class="text-sm text-gray-700">
                                        <!-- Content injected dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <form method="dialog" class="modal-backdrop z-10">
                            <button class="text-white absolute top-0 right-0 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    viewBox="0 0 31 31" fill="none">
                                    <circle cx="15.5" cy="15.5" r="15.5" fill="black" />
                                    <path
                                        d="M9.39522 23L15.5 16.8462L21.6048 23L23 21.6048L16.8462 15.5L23 9.39522L21.6048 8L15.5 14.1538L9.39522 8L8 9.39522L14.1538 15.5L8 21.6048L9.39522 23Z"
                                        fill="#FCFAF9" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </dialog>

                <dialog id="getFeedback" class="modal">
                    <div class="modal-box p-0 max-w-4xl min-h-60 bg-[#FCFAF9]">
                        <div>
                            <form id="getFeedbackForm">
                                <input type="hidden" name="feedbackCustomerId" id="feedbackCustomerId"
                                    value="">
                                <div x-show="step === 1" x-cloak>
                                    <div
                                        class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10  divide-x divide-white">
                                        <div class="pe-4">
                                            <img class="h-14 lg:h-16" src={{ asset('/images/logo-white.svg') }}
                                                alt="logo" />
                                        </div>
                                        <div class="text-lg lg:text-xl text-white font-medium uppercase">
                                            showroom staff usage
                                        </div>
                                    </div>

                                    <div class="px-4 md:px-6 py-10 lg:px-12 text-[#4E5356]">
                                        <!-- Step 1 -->
                                        <div>
                                            <div class="relative mb-6">
                                                <!-- Sales Executive Select -->
                                                <label
                                                    class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Sales
                                                    Executive Name</label>
                                                <select x-model="formData.salesExecutive"
                                                    @change="errors.salesExecutive = ''"
                                                    class="bg-transparent border py-3 border-[#C7C7C7] text-black focus:outline-black placeholder:!text-black rounded-lg block w-full p-3"
                                                    name="salesExcutiveName" id="salesExcutiveName">
                                                    <option value>Select Executive</option>
                                                    @foreach ($employee as $item)
                                                        <option value={{ $item->id }}>
                                                            {{ $item->name }} ({{ $item->emp_no }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p x-show="errors.salesExecutive" class="text-red-500 text-sm my-2"
                                                    x-text="errors.salesExecutive">
                                                </p>
                                            </div>

                                            <!-- Customer Type Selection -->
                                            <div class="block mb-4 text-md font-semibold text-[#9D4F2A]">Customer
                                                Type</div>
                                            <div class="flex gap-4 flex-wrap">

                                                <div>
                                                    <input type="radio" @change="errors.customerType = ''"
                                                        name="customerType" id="purchased-customer"
                                                        class="sr-only peer" x-model="formData.customerType"
                                                        value="1">
                                                    <label for="purchased-customer"
                                                        class="flex items-center cursor-pointer !py-0 !h-12 !bg-transparent peer-checked:!bg-[#9D4F2A] peer-checked:!text-white peer-checked:!border-[#9D4F2A] transition duration-300">
                                                        Purchased Customer
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" @change="errors.customerType = ''"
                                                        name="customerType" id="non-purchased" class="sr-only peer"
                                                        x-model="formData.customerType" value="0">
                                                    <label for="non-purchased"
                                                        class="flex items-center cursor-pointer !py-0 !h-12 !bg-transparent peer-checked:!bg-[#9D4F2A] peer-checked:!text-white peer-checked:!border-[#9D4F2A] transition duration-300">
                                                        Non-Purchased Customer
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" @change="errors.customerType = ''"
                                                        name="customerType" id="repaired-customer"
                                                        class="sr-only peer" x-model="formData.customerType"
                                                        value="2">
                                                    <label for="repaired-customer"
                                                        class="flex items-center cursor-pointer !py-0 !h-12 !bg-transparent peer-checked:!bg-[#9D4F2A] peer-checked:!text-white peer-checked:!border-[#9D4F2A] transition duration-300">
                                                        Repair - Customer
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="radio" @change="errors.customerType = ''"
                                                        name="customerType" id="schemejoining-customer"
                                                        class="sr-only peer" x-model="formData.customerType"
                                                        value="3">
                                                    <label for="schemejoining-customer"
                                                        class="flex items-center cursor-pointer !py-0 !h-12 !bg-transparent peer-checked:!bg-[#9D4F2A] peer-checked:!text-white peer-checked:!border-[#9D4F2A] transition duration-300">
                                                        Scheme Payment Customer
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <label class="text-md text-[#4E5356] label">
                                                    <input type="checkbox" name="scheme-redemption"
                                                        id="scheme-redemption" value="1"
                                                        class="checkbox  checkbox-neutral rounded-sm checkbox-xs border-[#4E5356]">
                                                    Scheme Redemption
                                                </label>
                                            </div>

                                            <p x-show="errors.customerType" class="text-red-500 text-sm mt-2 mb-4"
                                                x-text="errors.customerType">
                                            </p>

                                            <button type="button" @click="validateStep1()" class="mt-8 main-btn">
                                                Continue
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="step === 2 && formData.customerType === '1'" x-cloak>
                                    <div
                                        class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10  divide-x divide-white">
                                        <div class="pe-4">
                                            <img class="h-14 lg:h-16" src={{ asset('/images/logo-white.svg') }}
                                                alt="logo" />
                                        </div>
                                        <div class="text-lg text-white font-medium uppercase">
                                            Please share your thoughts about your
                                            <b>IN-Store Experience</b>
                                        </div>
                                    </div>

                                    <div class="px-4 md:px-6 py-10 lg:px-12 text-[#4E5356]">
                                        <!-- Step 2A: Purchased Customer Feedback -->
                                        <div>

                                            <!-- <div class="my-5">
                                                <hr class="border-gray-300" />
                                            </div> -->

                                            <div class="mb-4 text-lg text-[#9D4F2A]">
                                                About our <b>Jewellery Designs</b>
                                            </div>

                                            <div class="block mb-4">1.⁠ ⁠How unique and stylish do you find the
                                                Jewellery
                                                design?</div>

                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                <input type="radio" id="jewelleryDesignQuestion1-option1"
                                                    name="jewelleryDesignQuestion1"
                                                    value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                <label for="jewelleryDesignQuestion1-option1"
                                                    class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                    <div>
                                                        <img src={{ asset('/images/icons/excellent.svg') }}
                                                            alt="excellent" />
                                                    </div>
                                                    <div>Excellent</div>
                                                </label>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion1-option2"
                                                        name="jewelleryDesignQuestion1"
                                                        value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion1-option2"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/good.svg') }}
                                                                alt="good" />
                                                        </div>
                                                        <div>Good</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion1-option3"
                                                        name="jewelleryDesignQuestion1"
                                                        value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion1-option3"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/average.svg') }}
                                                                alt="average" />
                                                        </div>
                                                        <div>Average</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion1-option4"
                                                        name="jewelleryDesignQuestion1"
                                                        value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion1-option4"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/poor.svg') }}
                                                                alt="poor" />
                                                        </div>
                                                        <div>Poor</div>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="block mb-4">2.⁠ ⁠How would you rate our jewelry's design and
                                                pricing
                                                compared to other brands</div>

                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                <input type="radio" id="jewelleryDesignQuestion2-option1"
                                                    name="jewelleryDesignQuestion2"
                                                    value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                <label for="jewelleryDesignQuestion2-option1"
                                                    class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                    <div>
                                                        <img src={{ asset('/images/icons/excellent.svg') }}
                                                            alt="excellent" />
                                                    </div>
                                                    <div>Excellent</div>
                                                </label>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion2-option2"
                                                        name="jewelleryDesignQuestion2"
                                                        value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion2-option2"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/good.svg') }}
                                                                alt="good" />
                                                        </div>
                                                        <div>Good</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion2-option3"
                                                        name="jewelleryDesignQuestion2"
                                                        value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion2-option3"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/average.svg') }}
                                                                alt="average" />
                                                        </div>
                                                        <div>Average</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion2-option4"
                                                        name="jewelleryDesignQuestion2"
                                                        value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion2-option4"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/poor.svg') }}
                                                                alt="poor" />
                                                        </div>
                                                        <div>Poor</div>
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="mt-8">
                                                <div class="mb-4 text-lg text-[#9D4F2A]">
                                                    How was your experience with our <b>Sales Executive</b>?

                                                </div>
                                                <!-- Question 1 -->
                                                <div class="block mb-4">1.⁠ ⁠How satisfied are you with the overall
                                                    service
                                                    provided by our showroom staff?
                                                </div>
                                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                    <input type="radio" id="step3Question1-option1"
                                                        name="step3Question1"
                                                        value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                    <label for="step3Question1-option1"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/excellent.svg') }}
                                                                alt="excellent" />
                                                        </div>
                                                        <div>Excellent</div>
                                                    </label>

                                                    <div>
                                                        <input type="radio" id="step3Question1-option2"
                                                            name="step3Question1"
                                                            value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                        <label for="step3Question1-option2"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/good.svg') }}
                                                                    alt="good" />
                                                            </div>
                                                            <div>Good</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="step3Question1-option3"
                                                            name="step3Question1"
                                                            value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                        <label for="step3Question1-option3"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/average.svg') }}
                                                                    alt="average" />
                                                            </div>
                                                            <div>Average</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="step3Question1-option4"
                                                            name="step3Question1"
                                                            value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                        <label for="step3Question1-option4"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                                    alt="poor" />
                                                            </div>
                                                            <div>Poor</div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Question 3 -->
                                                <div class="block mb-4">2.⁠ ⁠How knowledgeable was our staff in
                                                    explaining
                                                    products and services?</div>
                                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                    <input type="radio" id="step3Question3-option1"
                                                        name="step3Question3"
                                                        value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                    <label for="step3Question3-option1"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/excellent.svg') }}
                                                                alt="excellent" />
                                                        </div>
                                                        <div>Excellent</div>
                                                    </label>

                                                    <div>
                                                        <input type="radio" id="step3Question3-option2"
                                                            name="step3Question3"
                                                            value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                        <label for="step3Question3-option2"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/good.svg') }}
                                                                    alt="good" />
                                                            </div>
                                                            <div>Good</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="step3Question3-option3"
                                                            name="step3Question3"
                                                            value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                        <label for="step3Question3-option3"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/average.svg') }}
                                                                    alt="average" />
                                                            </div>
                                                            <div>Average</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="step3Question3-option4"
                                                            name="step3Question3"
                                                            value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                        <label for="step3Question3-option4"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                                    alt="poor" />
                                                            </div>
                                                            <div>Poor</div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Question 4 -->
                                                <div class="block mb-4">3.How would you rate the attentiveness of our
                                                    staff
                                                    in
                                                    assisting you?</div>
                                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                    <input type="radio" id="step3Question4-option1"
                                                        name="step3Question4"
                                                        value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                    <label for="step3Question4-option1"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/excellent.svg') }}
                                                                alt="excellent" />
                                                        </div>
                                                        <div>Excellent</div>
                                                    </label>

                                                    <div>
                                                        <input type="radio" id="step3Question4-option2"
                                                            name="step3Question4"
                                                            value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                        <label for="step3Question4-option2"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/good.svg') }}
                                                                    alt="good" />
                                                            </div>
                                                            <div>Good</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="step3Question4-option3"
                                                            name="step3Question4"
                                                            value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                        <label for="step3Question4-option3"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/average.svg') }}
                                                                    alt="average" />
                                                            </div>
                                                            <div>Average</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="step3Question4-option4"
                                                            name="step3Question4"
                                                            value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                        <label for="step3Question4-option4"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                                    alt="poor" />
                                                            </div>
                                                            <div>Poor</div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-8 flex justify-center">
                                                <button type="button" @click="validateStep2()" class="main-btn ">
                                                    Continue
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="step === 2 && formData.customerType === '0'" x-cloak>
                                    <div
                                        class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10  divide-x divide-white">
                                        <div class="pe-4">
                                            <img class="h-14 lg:h-16" src={{ asset('/images/logo-white.svg') }}
                                                alt="logo" />
                                        </div>
                                        <div class="text-lg text-white font-medium uppercase">
                                            Please let us know how we can serve you better?
                                        </div>
                                    </div>

                                    <div class="px-4 md:px-6 py-10 lg:px-12 text-[#4E5356]">
                                        <!-- Step 2B: Non-Purchased Customer Feedback -->
                                        <div>
                                            <!-- Reason -->
                                            <div class="block mb-4 text-lg text-[#9D4F2A] font-semibold">What was the
                                                reason
                                                for not purchasing
                                                today?</div>
                                            <div class="grid gap-6 grid-cols-2 md:grid-cols-4">


                                                <div>
                                                    <input type="radio"
                                                        x-model="formData.nonPurchasedFeedback.reason"
                                                        id="non-purchase-reason-question1" name="non-purchase-reason"
                                                        value="1" class="hidden">

                                                    <label for="non-purchase-reason-question1"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img class="h-8"
                                                                src={{ asset('/images/icons/non-purchase-reason/icon1.svg') }}
                                                                alt="Expected design not available" />
                                                        </div>
                                                        <div>Expected design not available</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio"
                                                        x-model="formData.nonPurchasedFeedback.reason"
                                                        id="non-purchase-reason-question2" name="non-purchase-reason"
                                                        value="2" class="hidden">

                                                    <label for="non-purchase-reason-question2"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img class="h-8"
                                                                src={{ asset('/images/icons/non-purchase-reason/icon2.svg') }}
                                                                alt="Less Collection" />
                                                        </div>
                                                        <div>Less Collection</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio"
                                                        x-model="formData.nonPurchasedFeedback.reason"
                                                        id="non-purchase-reason-question3" name="non-purchase-reason"
                                                        value="3" class="hidden">

                                                    <label for="non-purchase-reason-question3"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img class="h-8"
                                                                src={{ asset('/images/icons/non-purchase-reason/icon3.svg') }}
                                                                alt="Service was Bad" />
                                                        </div>
                                                        <div>Service was Bad</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio"
                                                        x-model="formData.nonPurchasedFeedback.reason"
                                                        id="non-purchase-reason-question4" name="non-purchase-reason"
                                                        value="4" class="hidden">

                                                    <label for="non-purchase-reason-question4"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img class="h-8"
                                                                src={{ asset('/images/icons/non-purchase-reason/icon4.svg') }}
                                                                alt="Size not available" />
                                                        </div>
                                                        <div>Size not available</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio"
                                                        x-model="formData.nonPurchasedFeedback.reason"
                                                        id="non-purchase-reason-question5" name="non-purchase-reason"
                                                        value="5" class="hidden">

                                                    <label for="non-purchase-reason-question5"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img class="h-8"
                                                                src={{ asset('/images/icons/non-purchase-reason/icon5.svg') }}
                                                                alt="Price is too high" />
                                                        </div>
                                                        <div>Price is too high</div>
                                                    </label>
                                                </div>

                                                <div
                                                    :class="{
                                                        'md:col-span-3': formData.nonPurchasedFeedback
                                                            .reason === '6'
                                                    }">
                                                    <input type="radio"
                                                        x-model="formData.nonPurchasedFeedback.reason"
                                                        id="non-purchase-reason-question6" name="non-purchase-reason"
                                                        value="6" class="hidden">

                                                    <label for="non-purchase-reason-question6"
                                                        class="cursor-pointer p-3 border bg-white shadow rounded-lg  flex flex-col"
                                                        :class="{
                                                            'items-center text-center justify-center content-center': formData
                                                                .nonPurchasedFeedback.reason !== '6'
                                                        }">
                                                        <div class="w-full">
                                                            <div>Others</div>
                                                            <div x-show ="formData.nonPurchasedFeedback.reason === '6'"
                                                                x-cloak>
                                                                <textarea placeholder="Enter your reason" id="non_purchased_others"
                                                                    class="border mt-2 resize-none border-gray-400 shadow-md rounded-md p-2 w-full"></textarea>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>

                                            </div>
                                            <p x-show="errors.reason" class="text-red-500 text-sm mt-2 mb-4"
                                                x-text="errors.reason"></p>

                                            <div class="flex justify-center !px-10">
                                                <button type="submit" @click="validateStep2()"
                                                    class="mt-8 main-btn">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <!-- <div x-show="step === 3 && formData.customerType === '1'" x-cloak>
                                    <div
                                        class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10  divide-x divide-white">
                                        <div class="pe-4">
                                            <img class="h-14 lg:h-16" src={{ asset('/images/logo-white.svg') }}
                                                alt="logo" />
                                        </div>
                                        <div class="text-lg text-white font-medium uppercase">
                                            How was your experience with our <b>Sales Executive</b>
                                        </div>
                                    </div>

                                    <div class="px-4 md:px-6 py-10 lg:px-12 text-[#4E5356]">
                                        <div>
                                            <div class="block mb-4">1.⁠ ⁠How satisfied are you with the overall service
                                                provided by our showroom staff?
                                            </div>
                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                <input type="radio" id="step3Question1-option1"
                                                    name="step3Question1" value="{{ App\Enums\Review::EXCELLENT }}"
                                                    class="hidden">
                                                <label for="step3Question1-option1"
                                                    class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                    <div>
                                                        <img src={{ asset('/images/icons/excellent.svg') }}
                                                            alt="excellent" />
                                                    </div>
                                                    <div>Excellent</div>
                                                </label>

                                                <div>
                                                    <input type="radio" id="step3Question1-option2"
                                                        name="step3Question1" value="{{ App\Enums\Review::GOOD }}"
                                                        class="hidden">

                                                    <label for="step3Question1-option2"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/good.svg') }}
                                                                alt="good" />
                                                        </div>
                                                        <div>Good</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="step3Question1-option3"
                                                        name="step3Question1" value="{{ App\Enums\Review::AVERAGE }}"
                                                        class="hidden">

                                                    <label for="step3Question1-option3"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/average.svg') }}
                                                                alt="average" />
                                                        </div>
                                                        <div>Average</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="step3Question1-option4"
                                                        name="step3Question1" value="{{ App\Enums\Review::POOR }}"
                                                        class="hidden">

                                                    <label for="step3Question1-option4"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/poor.svg') }}
                                                                alt="poor" />
                                                        </div>
                                                        <div>Poor</div>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="block mb-4">2.⁠ ⁠How knowledgeable was our staff in explaining
                                                products and services?</div>
                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                <input type="radio" id="step3Question3-option1"
                                                    name="step3Question3" value="{{ App\Enums\Review::EXCELLENT }}"
                                                    class="hidden">
                                                <label for="step3Question3-option1"
                                                    class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                    <div>
                                                        <img src={{ asset('/images/icons/excellent.svg') }}
                                                            alt="excellent" />
                                                    </div>
                                                    <div>Excellent</div>
                                                </label>

                                                <div>
                                                    <input type="radio" id="step3Question3-option2"
                                                        name="step3Question3" value="{{ App\Enums\Review::GOOD }}"
                                                        class="hidden">

                                                    <label for="step3Question3-option2"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/good.svg') }}
                                                                alt="good" />
                                                        </div>
                                                        <div>Good</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="step3Question3-option3"
                                                        name="step3Question3" value="{{ App\Enums\Review::AVERAGE }}"
                                                        class="hidden">

                                                    <label for="step3Question3-option3"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/average.svg') }}
                                                                alt="average" />
                                                        </div>
                                                        <div>Average</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="step3Question3-option4"
                                                        name="step3Question3" value="{{ App\Enums\Review::POOR }}"
                                                        class="hidden">

                                                    <label for="step3Question3-option4"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/poor.svg') }}
                                                                alt="poor" />
                                                        </div>
                                                        <div>Poor</div>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="block mb-4">3.How would you rate the attentiveness of our staff
                                                in
                                                assisting you?</div>
                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                <input type="radio" id="step3Question4-option1"
                                                    name="step3Question4" value="{{ App\Enums\Review::EXCELLENT }}"
                                                    class="hidden">
                                                <label for="step3Question4-option1"
                                                    class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                    <div>
                                                        <img src={{ asset('/images/icons/excellent.svg') }}
                                                            alt="excellent" />
                                                    </div>
                                                    <div>Excellent</div>
                                                </label>

                                                <div>
                                                    <input type="radio" id="step3Question4-option2"
                                                        name="step3Question4" value="{{ App\Enums\Review::GOOD }}"
                                                        class="hidden">

                                                    <label for="step3Question4-option2"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/good.svg') }}
                                                                alt="good" />
                                                        </div>
                                                        <div>Good</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="step3Question4-option3"
                                                        name="step3Question4" value="{{ App\Enums\Review::AVERAGE }}"
                                                        class="hidden">

                                                    <label for="step3Question4-option3"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/average.svg') }}
                                                                alt="average" />
                                                        </div>
                                                        <div>Average</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="step3Question4-option4"
                                                        name="step3Question4" value="{{ App\Enums\Review::POOR }}"
                                                        class="hidden">

                                                    <label for="step3Question4-option4"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/poor.svg') }}
                                                                alt="poor" />
                                                        </div>
                                                        <div>Poor</div>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="flex justify-center">
                                                <button type="submit" @click="validateStep3()"
                                                    class="mt-8 main-btn">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="px-4 md:px-6 py-10 lg:px-12 text-[#4E5356]" x-show="step === 4" x-cloak>
                                    <!-- Step 3: Thank You -->
                                    <div class="flex flex-col items-center justify-center gap-6">
                                        <div>
                                            <img src={{ asset('/images/thank-you.svg') }} alt="thank you" />
                                        </div>
                                        <p class="text-gray-600 text-lg text-center">
                                            Thanks for your valuable feedback
                                        </p>

                                        <form method="dialog">
                                            <button class="main-btn" @click="clearData">OK</button>
                                        </form>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <form method="dialog" class="modal-backdrop z-10">
                            <button class="text-white absolute top-0 right-0 p-1" @click="clearData">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    viewBox="0 0 31 31" fill="none">
                                    <circle cx="15.5" cy="15.5" r="15.5" fill="black" />
                                    <path
                                        d="M9.39522 23L15.5 16.8462L21.6048 23L23 21.6048L16.8462 15.5L23 9.39522L21.6048 8L15.5 14.1538L9.39522 8L8 9.39522L14.1538 15.5L8 21.6048L9.39522 23Z"
                                        fill="#FCFAF9" />
                                </svg>

                            </button>
                        </form>
                    </div>
                </dialog>

                <dialog id="getFeedbackdetail" class="modal">
                    <div class="modal-box p-0 min-h-60 bg-[#FCFAF9]">
                        <div>
                            <form id="getFeedbackForm">
                                <div>
                                    <div
                                        class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10  divide-x divide-white">
                                        <div class="pe-4">
                                            <img class="h-14 lg:h-16" src={{ asset('/images/logo-white.svg') }}
                                                alt="logo" />
                                        </div>
                                        <div class="text-md text-white font-medium uppercase">
                                            Please share your thoughts about your
                                            <b>IN-Store Experience</b>
                                        </div>
                                    </div>

                                    <div class="px-4 md:px-6 py-10 lg:px-12 text-[#4E5356] text-sm">
                                        <!-- Step 2A: Purchased Customer Feedback -->
                                        <div>
                                            <div class="mb-4 !text-md text-[#9D4F2A]">
                                                About our <b>Jewellery Designs</b>
                                            </div>

                                            <div class="block mb-4">1.⁠ ⁠How unique and stylish do you find the
                                                Jewellery
                                                design?</div>

                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                <input type="radio" id="jewelleryDesignQuestion1-option1"
                                                    name="jewelleryDesignQuestion1"
                                                    value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                <label for="jewelleryDesignQuestion1-option1"
                                                    class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                    <div>
                                                        <img src={{ asset('/images/icons/excellent.svg') }}
                                                            alt="excellent" width="40" />
                                                    </div>
                                                    <div>Excellent</div>
                                                </label>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion1-option2"
                                                        name="jewelleryDesignQuestion1"
                                                        value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion1-option2"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/good.svg') }}
                                                                alt="good" width="40" />
                                                        </div>
                                                        <div>Good</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion1-option3"
                                                        name="jewelleryDesignQuestion1"
                                                        value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion1-option3"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/average.svg') }}
                                                                alt="average" width="40" />
                                                        </div>
                                                        <div>Average</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion1-option4"
                                                        name="jewelleryDesignQuestion1"
                                                        value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion1-option4"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/poor.svg') }}
                                                                alt="poor" width="40" />
                                                        </div>
                                                        <div>Poor</div>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="block mb-4">2.⁠ ⁠How would you rate our jewelry's design and
                                                pricing
                                                compared to other brands</div>

                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                <input type="radio" id="jewelleryDesignQuestion2-option1"
                                                    name="jewelleryDesignQuestion2"
                                                    value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                <label for="jewelleryDesignQuestion2-option1"
                                                    class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                    <div>
                                                        <img src={{ asset('/images/icons/excellent.svg') }}
                                                            alt="excellent" width="40" />
                                                    </div>
                                                    <div>Excellent</div>
                                                </label>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion2-option2"
                                                        name="jewelleryDesignQuestion2"
                                                        value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion2-option2"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/good.svg') }}
                                                                alt="good" width="40" />
                                                        </div>
                                                        <div>Good</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion2-option3"
                                                        name="jewelleryDesignQuestion2"
                                                        value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion2-option3"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/average.svg') }}
                                                                alt="average" width="40" />
                                                        </div>
                                                        <div>Average</div>
                                                    </label>
                                                </div>

                                                <div>
                                                    <input type="radio" id="jewelleryDesignQuestion2-option4"
                                                        name="jewelleryDesignQuestion2"
                                                        value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                    <label for="jewelleryDesignQuestion2-option4"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/poor.svg') }}
                                                                alt="poor" width="40" />
                                                        </div>
                                                        <div>Poor</div>
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="mt-8">
                                                <div class="mb-4 !text-md text-[#9D4F2A]">
                                                    How was your experience with our <b>Sales Executive</b>?

                                                </div>
                                                <!-- Question 1 -->
                                                <div class="block mb-4">1.⁠ ⁠How satisfied are you with the overall
                                                    service
                                                    provided by our showroom staff?
                                                </div>
                                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                    <input type="radio" id="salesExecutiveQuestion1-option1"
                                                        name="salesExecutiveQuestion1"
                                                        value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                    <label for="salesExecutiveQuestion1-option1"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/excellent.svg') }}
                                                                alt="excellent" width="40" />
                                                        </div>
                                                        <div>Excellent</div>
                                                    </label>

                                                    <div>
                                                        <input type="radio" id="salesExecutiveQuestion1-option2"
                                                            name="salesExecutiveQuestion1"
                                                            value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                        <label for="salesExecutiveQuestion1-option2"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/good.svg') }}
                                                                    alt="good" width="40" />
                                                            </div>
                                                            <div>Good</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="salesExecutiveQuestion1-option3"
                                                            name="salesExecutiveQuestion1"
                                                            value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                        <label for="salesExecutiveQuestion1-option3"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/average.svg') }}
                                                                    alt="average" width="40" />
                                                            </div>
                                                            <div>Average</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="salesExecutiveQuestion1-option4"
                                                            name="salesExecutiveQuestion1"
                                                            value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                        <label for="salesExecutiveQuestion1-option4"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                                    alt="poor" width="40" />
                                                            </div>
                                                            <div>Poor</div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Question 3 -->
                                                <div class="block mb-4">2.⁠ ⁠How knowledgeable was our staff in
                                                    explaining
                                                    products and services?</div>
                                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                    <input type="radio" id="salesExecutiveQuestion2-option1"
                                                        name="salesExecutiveQuestion2"
                                                        value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                    <label for="salesExecutiveQuestion2-option1"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/excellent.svg') }}
                                                                alt="excellent" width="40" />
                                                        </div>
                                                        <div>Excellent</div>
                                                    </label>

                                                    <div>
                                                        <input type="radio" id="salesExecutiveQuestion2-option2"
                                                            name="salesExecutiveQuestion2"
                                                            value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                        <label for="salesExecutiveQuestion2-option2"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/good.svg') }}
                                                                    alt="good" width="40" />
                                                            </div>
                                                            <div>Good</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="salesExecutiveQuestion2-option3"
                                                            name="salesExecutiveQuestion2"
                                                            value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                        <label for="salesExecutiveQuestion2-option3"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/average.svg') }}
                                                                    alt="average" width="40" />
                                                            </div>
                                                            <div>Average</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="salesExecutiveQuestion2-option4"
                                                            name="salesExecutiveQuestion2"
                                                            value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                        <label for="salesExecutiveQuestion2-option4"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                                    alt="poor" width="40" />
                                                            </div>
                                                            <div>Poor</div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Question 4 -->
                                                <div class="block mb-4">3.How would you rate the attentiveness of our
                                                    staff
                                                    in
                                                    assisting you?</div>
                                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                                    <input type="radio" id="salesExecutiveQuestion3-option1"
                                                        name="salesExecutiveQuestion3"
                                                        value="{{ App\Enums\Review::EXCELLENT }}" class="hidden">
                                                    <label for="salesExecutiveQuestion3-option1"
                                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                        <div>
                                                            <img src={{ asset('/images/icons/excellent.svg') }}
                                                                alt="excellent" width="40" />
                                                        </div>
                                                        <div>Excellent</div>
                                                    </label>

                                                    <div>
                                                        <input type="radio" id="salesExecutiveQuestion3-option2"
                                                            name="salesExecutiveQuestion3"
                                                            value="{{ App\Enums\Review::GOOD }}" class="hidden">

                                                        <label for="salesExecutiveQuestion3-option2"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/good.svg') }}
                                                                    alt="good" width="40" />
                                                            </div>
                                                            <div>Good</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="salesExecutiveQuestion3-option3"
                                                            name="salesExecutiveQuestion3"
                                                            value="{{ App\Enums\Review::AVERAGE }}" class="hidden">

                                                        <label for="salesExecutiveQuestion3-option3"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/average.svg') }}
                                                                    alt="average" width="40" />
                                                            </div>
                                                            <div>Average</div>
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <input type="radio" id="salesExecutiveQuestion3-option4"
                                                            name="salesExecutiveQuestion3"
                                                            value="{{ App\Enums\Review::POOR }}" class="hidden">

                                                        <label for="salesExecutiveQuestion3-option4"
                                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                            <div>
                                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                                    alt="poor" width="40" />
                                                            </div>
                                                            <div>Poor</div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <form method="dialog" class="modal-backdrop z-10">
                            <button class="text-white absolute top-0 right-0 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    viewBox="0 0 31 31" fill="none">
                                    <circle cx="15.5" cy="15.5" r="15.5" fill="black" />
                                    <path
                                        d="M9.39522 23L15.5 16.8462L21.6048 23L23 21.6048L16.8462 15.5L23 9.39522L21.6048 8L15.5 14.1538L9.39522 8L8 9.39522L14.1538 15.5L8 21.6048L9.39522 23Z"
                                        fill="#FCFAF9" />
                                </svg>

                            </button>
                        </form>
                    </div>
                </dialog>

                <dialog id="customerDetails" class="modal">
                    <div class="modal-box p-0 max-w-3xl bg-[#FCFAF9]">
                        <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10  divide-x divide-white">
                            <div class="pe-4">
                                <img class="h-14 lg:h-16" src={{ asset('/images/logo-white.svg') }}
                                    alt="logo" />
                            </div>
                            <div class="text-lg lg:text-xl text-white font-medium uppercase">
                                Welcome to Jewel one
                            </div>
                        </div>

                        <div class="p-4 py-8 md:p-8 text-[#4E5356]">
                            <form id="customer-details-form">
                                <input type="hidden" name="customerId" id="customerId" value="">
                                <!-- Header -->
                                <div class="flex justify-between gap-5 items-center mb-4">
                                    <div class="text-lg font-medium text-[#9D4F2A]">
                                        Please enter your below details
                                    </div>

                                </div>

                                <!-- Name & Gender -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-4">
                                    <div class="relative grow">
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">
                                            Name <span class="text-red-600">*</span>
                                        </label>
                                        <input name="name" id="name" type="text" required
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black placeholder:!text-black rounded-lg block w-full p-3" />
                                    </div>

                                    <!-- Gender -->
                                    <div class="flex items-center gap-2">
                                        <div class="text-sm text-black">Gender <span class="text-red-600">*</span>
                                        </div>
                                        <div class="flex gap-1">
                                            <label class="cursor-pointer">
                                                <input type="radio" name="gender" id="gender" value="M"
                                                    class="sr-only peer" required />
                                                <span
                                                    class="flex items-center justify-center py-2 px-4 border-2 border-gray-300 rounded-lg text-gray-700 peer-checked:bg-[#9D4F2A] peer-checked:text-white peer-checked:border-[#9D4F2A] transition duration-300">
                                                    M
                                                </span>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="gender" id="gender" value="F"
                                                    class="sr-only peer" required />
                                                <span
                                                    class="flex items-center justify-center py-2 px-4 border-2 border-gray-300 rounded-lg text-gray-700 peer-checked:bg-[#9D4F2A] peer-checked:text-white peer-checked:border-[#9D4F2A] transition duration-300">
                                                    F
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="mb-4">
                                    <div class="mb-1 text-black text-sm">Phone Number <span
                                            class="text-red-600">*</span></div>
                                    <div class="input-container phone-group grid gap-1 grid-cols-10 max-w-fit">
                                        <!-- Generate 10 input fields with the class "phone" -->
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black text-center h-10" />
                                    </div>
                                    <!-- Hidden input to store combined value -->
                                    <input type="hidden" id="hiddenPhoneNumber" name="hiddenPhoneNumber" />

                                </div>

                                <!-- Email and DOB -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-4">
                                    <div class="relative grow">
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />
                                    </div>

                                    <div class="relative">
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Date
                                            of Birth <span class="text-red-600">*</span></label>
                                        <input type="date" name="date-of-birth" id="date-of-birth" required
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />
                                    </div>
                                </div>

                                <!-- Marital Status -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-center mb-4"
                                    x-data="{ maritalStatus: '' }" x-ref="maritalStatusWrapper">
                                    <div class="grow flex items-center gap-4 flex-wrap">
                                        <div class="text-black text-sm">Marital Status <span
                                                class="text-red-600">*</span></div>
                                        <div class="flex space-x-2">
                                            <div>
                                                <input type="radio" name="marital-status"
                                                    id="marital-status-married" value="0"
                                                    class="peer sr-only" x-model="maritalStatus" />
                                                <label for="marital-status-married"
                                                    class="flex items-center space-x-2 cursor-pointer !h-auto !bg-transparent peer-checked:!bg-[#9D4F2A] peer-checked:!text-white peer-checked:!border-[#9D4F2A] transition duration-300 !py-2 !px-5 !rounded-sm !border-[#C7C7C7]">
                                                    Married
                                                </label>
                                            </div>

                                            <div>
                                                <input type="radio" name="marital-status"
                                                    id="marital-status-not-married" value="1"
                                                    class="peer sr-only" x-model="maritalStatus" />
                                                <label for="marital-status-not-married"
                                                    class="flex items-center space-x-2 cursor-pointer !h-auto !bg-transparent peer-checked:!bg-[#9D4F2A] peer-checked:!text-white peer-checked:!border-[#9D4F2A] transition duration-300 !py-2 !px-5 !rounded-sm !border-[#C7C7C7]">

                                                    Not Married
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="relative" x-show="maritalStatus === '0'" x-transition>
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Anniversary
                                            Date <span class="text-red-600">*</span></label>
                                        <input type="date" name="anniversary-date" id="anniversary-date"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />
                                    </div>
                                </div>

                                <!-- Profession & Qualification -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-5">
                                    <div class="relative grow">
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Profession
                                            <span class="text-red-600">*</span></label>
                                        <select id="profession" name="profession"
                                            class="w-full border border-[#C7C7C7] p-3 rounded text-black bg-transparent">
                                            <option value="">Select</option>
                                            @foreach ($professions as $item)
                                                <option value={{ $item->id }}>{{ $item->profession }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <div class="mb-1 text-sm text-black">Pincode <span
                                                class="text-red-600">*</span></div>
                                        <div class="input-container zip-group grid gap-1 grid-cols-6 max-w-fit">
                                            <!-- Pincode inputs with class 'zip' for identification -->
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black h-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black h-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black h-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black h-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black h-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black h-10 text-center" />

                                            <input type="hidden" name="hiddenPincode" id="hiddenPincode">
                                        </div>
                                    </div>

                                </div>

                                <!-- Address -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-4">

                                    <div class="grow space-y-4">
                                        <div class="relative">
                                            <label
                                                class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Address
                                                <span class="text-red-600">*</span></label>
                                            <!-- <textarea name="address" id="address" rows="2" required
                                                class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3 resize-none"></textarea>
                                     -->
                                            <input type="text" name="address" id="address" required
                                                placeholder="Address Line 1"
                                                class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />

                                        </div>

                                        {{-- <input type="text" name="address2" id="address2" required
                                            placeholder="Address Line 2"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" /> --}}

                                    </div>

                                </div>

                                <div class="text-lg font-medium text-[#9D4F2A] mt-6 mb-4">
                                    How do you know about Jewel One?
                                </div>

                                <!-- Source Options -->
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-4"
                                    x-data="{ source: '' }">
                                    <!-- Television -->
                                    <div>
                                        <input id="source1" name="source" x-model="source"
                                            value="Television Commercial" type="radio" class="hidden" />
                                        <label for="source1" class="text-center">
                                            <img src="{{ asset('/images/icons/televison.svg') }}"
                                                alt="Television Commercial" class="h-8" />
                                            <span> Television Commercial </span>
                                        </label>
                                    </div>

                                    <!-- Newspaper -->
                                    <div>
                                        <input id="source2" name="source" x-model="source" value="Newspaper"
                                            type="radio" class="hidden" />
                                        <label for="source2" class="text-center">
                                            <img src="{{ asset('/images/icons/newspaper.svg') }}" alt="Newspaper"
                                                class="h-8" />
                                            <span> Newspaper </span>
                                        </label>
                                    </div>

                                    <!-- Social Media -->
                                    <div>
                                        <input id="source3" name="source" x-model="source"
                                            value="Social Media" type="radio" class="hidden" />
                                        <label for="source3" class="text-center">
                                            <img src="{{ asset('/images/icons/socialmedia.svg') }}"
                                                alt="Social Media" class="h-8" />
                                            <span> Social Media </span>
                                        </label>
                                    </div>

                                    <!-- Brochure -->
                                    <div>
                                        <input id="source4" name="source" x-model="source"
                                            value="Flyer, Brochure, Flex" type="radio" class="hidden" />
                                        <label for="source4" class="text-center">
                                            <img src="{{ asset('/images/icons/brochure.svg') }}"
                                                alt="Flyer, Brochure, Flex" class="h-8" />
                                            <span> Flyer, Brochure, Flex </span>
                                        </label>
                                    </div>

                                    <!-- Friends & Family -->
                                    <div>
                                        <input id="source5" name="source" x-model="source"
                                            value="Friends & Family" type="radio" class="hidden" />
                                        <label for="source5" class="text-center">
                                            <img src="{{ asset('/images/icons/family.svg') }}"
                                                alt="Friends & Family" class="h-8" />
                                            <span> Friends & Family </span>
                                        </label>
                                    </div>

                                    <!-- Others with textarea -->
                                    <div :class="{ 'md:col-span-2': source === 'others' }">
                                        <input id="others" name="source" x-model="source" value="others"
                                            type="radio" class="hidden" />
                                        <label for="others" class="text-center block">
                                            <div class="m-auto">Others</div>
                                            <div class="w-full" x-show="source === 'others'" x-cloak>
                                                <textarea placeholder="Enter your reason" id="know_about_others"
                                                    class="border mt-2 resize-none border-gray-400 shadow-md rounded-md p-2 w-full"></textarea>
                                            </div>
                                        </label>


                                    </div>
                                </div>


                                <!-- Save Button -->
                                <div class="flex justify-center">
                                    <button type="submit"
                                        class="px-10 py-2 cursor-pointer disabled:cursor-not-allowed bg-[#9D4F2A] text-white text-sm rounded hover:bg-[#7C3E21] transition disabled:opacity-50">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>

                        <form method="dialog" class="modal-backdrop z-10">
                            <button class="text-white absolute  top-0 right-0 p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    viewBox="0 0 31 31" fill="none">
                                    <circle cx="15.5" cy="15.5" r="15.5" fill="black" />
                                    <path
                                        d="M9.39522 23L15.5 16.8462L21.6048 23L23 21.6048L16.8462 15.5L23 9.39522L21.6048 8L15.5 14.1538L9.39522 8L8 9.39522L14.1538 15.5L8 21.6048L9.39522 23Z"
                                        fill="#FCFAF9" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </dialog>

            </div>

            <div x-show="tab === 'customer-list'" x-cloak>


            <div class="mt-6 flex justify-between items-center gap-5">
                <div class="w-full max-w-md">
                <label class="input">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2.5"
                    fill="none"
                    stroke="currentColor"
                    >
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input type="search" class="grow" placeholder="Type to search" />
                </label>
                </div>


                <div class="relative max-w-xs">
                
               

                <!-- Flatpickr Date Input -->
                <input
                    type="text"
                    id="datePicker"
                    class="input pr-10 w-full"
                    placeholder="Date"
                />

                <!-- Calendar Icon -->
                <svg xmlns="http://www.w3.org/2000/svg"                     
                class="w-5 h-5 absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none z-2"
                                viewBox="0 0 25 24" fill="none">
                <path d="M7.72266 5.0061V5.83264H6.45791C5.38265 5.83264 4.5 6.70776 4.5 7.78057V18.8086C4.5 19.8814 5.38265 20.7565 6.45791 20.7565H18.3324C19.4076 20.7565 20.2939 19.8814 20.2939 18.8086V7.78057C20.2939 6.70775 19.4076 5.83264 18.3324 5.83264H17.0677V5.0061H16.1377V5.83264H8.65262V5.0061H7.72266ZM6.45791 6.7626H7.72266V7.58823H8.65262V6.7626H16.1377V7.58823H17.0677V6.7626H18.3324C18.9127 6.7626 19.3649 7.21013 19.3649 7.78057V9.09703H5.42906V7.78057C5.42906 7.21012 5.87755 6.7626 6.45791 6.7626ZM5.42906 10.027H19.3649V18.8086C19.3649 19.379 18.9127 19.8274 18.3324 19.8274H6.45791C5.87755 19.8274 5.42906 19.379 5.42906 18.8086V10.027ZM7.0168 11.6175V12.5474H9.62251V11.6175H7.0168ZM11.0941 11.6175V12.5474H13.6962V11.6175H11.0941ZM15.1714 11.6175V12.5474H17.7735V11.6175H15.1714ZM7.0168 14.4636V15.3936H9.62251V14.4636H7.0168ZM11.0941 14.4636V15.3936H13.6962V14.4636H11.0941ZM15.1714 14.4636V15.3936H17.7735V14.4636H15.1714ZM7.0168 17.307V18.2361H9.62251V17.307H7.0168ZM11.0941 17.307V18.2361H13.6962V17.307H11.0941ZM15.1714 17.307V18.2361H17.7735V17.307H15.1714Z" fill="#9D4F2A"/>
                </svg>
                </div>

            </div>

                <div class="overflow-x-auto rounded-box border border-[#E0E0E0] bg-white mt-8">
                    <table class="table">
                        <!-- head -->
                        <thead class="bg-black text-white text-center">
                        <tr>
                            <th>S.No</th>
                            <th>Token No</th>
                            <th>Customer Name</th>
                            <th>Customer In / Out</th>
                            <th>Branch</th>
                            <th>Sales Executive</th>
                            <th>Spent Time</th>
                            <th>Purchased / Non Purchased</th>
                            <th>Scheme Redemption</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <!-- row 1 -->
                        <tr>
                            <th>1</th>
                            <td>001</td>
                            <td>Vivin Raj</td>
                            <td>
                            <div class="text-sm">
                                2025-04-23 09:51:51<br />
                                2025-04-23 09:59:51
                            </div>
                            </td>
                            <td>Coimbatore</td>
                            <td>Narasimman</td>
                            <td>0hr 8min 0sec</td>
                            <td class="text-error">Non Purchased</td>
                            <td>-</td>
                        </tr>
                        <!-- row 2 -->
                        <tr>
                            <th>2</th>
                            <td>002</td>
                            <td>Vinoth</td>
                            <td>
                            <div class="text-sm">
                                2025-04-23 09:51:51<br />
                                2025-04-23 09:59:51
                            </div>
                            </td>
                            <td>Coimbatore</td>
                            <td>Narasimman</td>
                            <td>0hr 8min 0sec</td>
                            <td class="text-success">Purchased</td>
                            <td>-</td>
                        </tr>
                        </tbody>
                    </table>
                </div>



            </div>


        </section>
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <script>
  flatpickr("#datePicker", {
    dateFormat: "Y-m-d", // Customize format if needed
    allowInput: true
  });
</script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session()->has('alert-type') && session()->has('message'))
                let toastStyles = {
                    success: "linear-gradient(to right, #00b09b, #96c93d)",
                    error: "linear-gradient(to right, #ff416c, #ff4b2b)",
                    warning: "linear-gradient(to right, #ffcc00, #ff8800)",
                    info: "linear-gradient(to right, #3498db, #2980b9)"
                };

                Toastify({
                    text: "{{ session('message') }}",
                    className: "{{ session('alert-type') }}",
                    close: true,
                    duration: 3000,
                    style: {
                        background: toastStyles["{{ session('alert-type') }}"]
                    }
                }).showToast();
            @endif
        });
    </script>

    <script src="{{ asset('js/frontend/voc.js') }}"></script>
    <script>
        // Create handlers for OTP, Phone, and Zip groups
        const createInputHandlers = (inputs, expectedLength) => {
            inputs.forEach((input, index) => {
                input.addEventListener("input", (e) => {
                    const val = e.target.value;
                    if (/^\d$/.test(val) && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    } else if (!/^\d$/.test(val)) {
                        e.target.value = ""; // Clear non-digit values
                    }
                });

                input.addEventListener("keydown", (e) => {
                    const key = e.key;

                    if (
                        !/^\d$/.test(key) &&
                        key !== "Backspace" &&
                        key !== "Delete" &&
                        key !== "ArrowLeft" &&
                        key !== "ArrowRight" &&
                        !e.metaKey
                    ) {
                        e.preventDefault();
                    }

                    if (key === "Backspace" || key === "Delete") {
                        e.preventDefault();
                        if (input.value !== "") {
                            input.value = "";
                        } else if (index > 0) {
                            inputs[index - 1].focus();
                            inputs[index - 1].value = "";
                        }
                    }

                    if (key === "ArrowLeft" && index > 0) {
                        inputs[index - 1].focus();
                    }
                    if (key === "ArrowRight" && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                input.addEventListener("focus", (e) => {
                    e.target.select();
                });

                input.addEventListener("paste", (e) => {
                    e.preventDefault();
                    const text = e.clipboardData.getData("text").trim();
                    if (!/^\d+$/.test(text)) return;
                    const chars = [...text];
                    chars.forEach((char, i) => {
                        if (inputs[i]) {
                            inputs[i].value = char;
                        }
                    });
                    if (inputs[chars.length - 1]) {
                        inputs[Math.min(chars.length, inputs.length) - 1].focus();
                    }
                });
            });
        };

        function addCustomerForm() {
            const form = document.getElementById("add-customer-form");

            const phoneInputs = [...form.querySelectorAll(".phone")];

            createInputHandlers(phoneInputs, 10);

            form.addEventListener("submit", (e) => {
                e.preventDefault();

                const phoneNumber = Array.from(phoneInputs).map(input => input.value).join('');

                console.log({
                    phoneNumber,
                });

                form.reset();
                document.getElementById("addCustomer").close();

            });
        }

        addCustomerForm();
    </script>

    <script>
        function getfeedbackData() {
            return {
                open: false,
                step: 1,
                customerType: "",
                errors: {},
                formData: {
                    customerId: "",
                    salesExecutive: "",
                    customerType: "",
                    purchasedFeedback: {
                        cleanlinessRating: "",
                        designUniqueness: "",
                        designPricingComparison: "",
                        serviceSatisfaction: "",
                        staffFriendliness: "",
                        staffKnowledge: "",
                        staffAttentiveness: "",
                    },
                    nonPurchasedFeedback: {
                        reason: ""
                    },
                },
                validateStep1() {
                    this.errors = {};
                    if (!this.formData.salesExecutive) {
                        this.errors.salesExecutive = "Please select a sales executive.";
                    }
                    if (!this.formData.customerType) {
                        this.errors.customerType = "Please select a customer type.";
                    }
                    if (Object.keys(this.errors).length === 0) {

                        if (this.formData.customerType === "2" || this.formData.customerType === "3") {
                            this.step = 4;

                        } else {
                            this.step = 2;
                        }
                    }

                },
                validateStep2() {
                    this.errors = {};
                    if (this.formData.customerType === "1") {
                        this.step = 4;
                    } else {
                        if (!this.formData.nonPurchasedFeedback.reason) {
                            this.errors.reason = "Please select a reason.";
                        }

                        if (Object.keys(this.errors).length === 0) {
                            // Create filtered form data for non-purchased
                            const filteredData = {
                                customerId: this.formData.customerId,
                                salesExecutive: this.formData.salesExecutive,
                                customerType: this.formData.customerType,
                                nonPurchasedFeedback: this.formData.nonPurchasedFeedback,
                            };

                            this.step = 4;
                        }
                    }
                },

                validateStep3() {
                    this.step = 4;
                },
                clearData() {
                    setTimeout(() => {
                        this.open = false;
                        this.step = 1;
                        this.customerType = "";
                        this.errors = {};
                        this.formData = {
                            customerId: "",
                            salesExecutive: "",
                            customerType: "",
                            purchasedFeedback: {
                                cleanlinessRating: "",
                                designUniqueness: "",
                                designPricingComparison: "",
                                serviceSatisfaction: "",
                                staffFriendliness: "",
                                staffKnowledge: "",
                                staffAttentiveness: "",
                            },
                            nonPurchasedFeedback: {
                                reason: ""
                            },
                        };
                    }, 200);
                },
            };
        }

        document.getElementById("getFeedbackForm").addEventListener("submit", (e) => {
            e.preventDefault();

            const formData = new FormData(e.target);

            const data = {}

            formData.forEach((value, key) => {
                data[key] = value;
            });

            console.log(data);
        })
    </script>

</body>

</html>
