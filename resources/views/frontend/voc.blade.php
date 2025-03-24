<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FCFAF9] min-h-screen roboto antialiased">
    <header class="bg-[#F2EDE4] border-b border-[#C7C7C7]">
        <nav class="px-4 md:px-16 py-4 flex justify-between gap-10 items-center">
            <div>
                <a href="/">
                    <img src="{{ asset('/images/logo.svg') }}" alt="logo" class="h-16" />
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
                        <a href="{{ route('logout') }}"
                            class="flex gap-1 text-black items-center border cursor-pointer border-black rounded-sm py-2 px-4 hover:text-white hover:bg-black">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                fill="none">
                                <path
                                    d="M7.11021 2.43868H5.92517V1.28257H1.18503V12.8437H5.92517V11.6876H7.11021V12.8437C7.11021 13.4822 6.57965 13.9998 5.92517 13.9998H1.18503C0.530556 13.9998 0 13.4822 0 12.8437V1.28257C0 0.644073 0.530556 0.126465 1.18503 0.126465H5.92517C6.57965 0.126465 7.11021 0.644073 7.11021 1.28257V2.43868ZM11.6049 6.48507L9.0613 4.00354L9.89925 3.18605L13.8733 7.06313L9.89925 10.9402L9.0613 10.1227L11.6049 7.64118H4.74014V6.48507H11.6049Z"
                                    fill="black" />
                            </svg>

                            Logout
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
      ">
        <section class="p-4 py-8 md:p-16">
            <div class="border-b border-gray-300 pb-4 mb-4 flex gap-4 justify-between items-center flex-wrap">
                <div>
                    <button class="px-4 py-2 font-semibold border-b-4 text-lg border-[#9D4F2A] text-[#9D4F2A] relative">
                        Live Customer

                        <span
                            class="absolute -top-3 -right-2 bg-green-200 text-green-500 flex items-center justify-center px-2 py-1 rounded-full text-sm">
                            {{ $walkincustomer->count() }}
                        </span>
                    </button>
                </div>

                <div>
                    <button onclick="addCustomer.showModal()"
                        class="bg-[#9D4F2A] text-white px-6 py-3 rounded-sm font-medium shadow-md cursor-pointer flex gap-1 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                clip-rule="evenodd" />
                        </svg>

                        Add customer
                    </button>

                    <dialog id="addCustomer" class="modal">
                        <div class="modal-box p-0 max-w-2xl bg-[#FCFAF9]">
                            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                                <div class="pe-4">
                                    <img class="h-18" src={{ asset('/images/logo-white.svg') }} alt="logo" />
                                </div>
                                <div class="text-xl text-white font-medium uppercase">
                                    Welcome to Jewel one
                                </div>
                            </div>

                            <div class="px-6 py-10 text-[#4E5356]">
                                <form id="add-customer-form">

                                    <!-- Phone Number Fields -->
                                    <div class="flex flex-col justify-center items-center gap-6">
                                        <div class="text-[#9D4F2A] text-md font-semibold">Enter your phone number</div>
                                        <div class="input-container phone-group">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 31 31" fill="none">
                                    <circle cx="15.5" cy="15.5" r="15.5" fill="black"/>
                                    <path d="M9.39522 23L15.5 16.8462L21.6048 23L23 21.6048L16.8462 15.5L23 9.39522L21.6048 8L15.5 14.1538L9.39522 8L8 9.39522L14.1538 15.5L8 21.6048L9.39522 23Z" fill="#FCFAF9"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </dialog>
                </div>
            </div>

            <div class="p-4" x-data="getfeedbackData">

              
                @if (count($walkincustomer) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-5 flex-wrap">
                    @foreach ($walkincustomer as $item)
                        <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                            <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                <div class="flex gap-1 items-center">
                                    <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                    <span class="text-md">Customer #{{ $item->formattedCount }}</span>
                                </div>
                                <div class="text-xl font-semibold">
                                    {{ $item->name ? $item->name : 'new customer' }}
                                </div>
                                <div class="my-4">
                                    <button
                                        @click="open = true; formData.customerId = {{ $item->id }}; viewCustomerDetails({{ $item->customer_id }})"
                                        class="px-4 py-2 block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">
                                        View Details
                                    </button>
                                </div>
                                <div>
                                    <button onclick="getFeedback.showModal()"
                                        @click="open = true; formData.customerId = {{ $item->id }}"
                                        class="px-4 py-2 block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-black bg-white hover:bg-[#9D4F2A] hover:text-white">
                                        Get Feedback
                                    </button>
                                </div>
                            </div>
                            <div class="text-sm py-2 px-6" style="color: red;">
                                <span id="timer-{{ $item->id }}" data-enter-time="{{ $item->customer_enter_time }}">Loading...</span>
                                <input type="hidden" name="spent_time" id="spent_time" value="">
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
            <div class="flex flex-col gap-6 text-lg justify-center items-center max-w-md mx-auto text-center py-10">
                <div>
                    <img class="h-20" src="/images/customers.svg" alt="customers">
                </div>
                <div>
                    Once you have started to create a New Customer, you’ll see it listed here
                </div>
            </div>
            @endif



                <dialog id="getFeedback" class="modal">
                    <div class="modal-box p-0 max-w-4xl min-h-60 bg-[#FCFAF9]">
                        <div x-show="step === 1" x-cloak>
                            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                                <div class="pe-4">
                                    <img class="h-18" src={{ asset('/images/logo-white.svg') }} alt="logo" />
                                </div>
                                <div class="text-xl text-white font-medium uppercase">
                                    showroom staff usage
                                </div>
                            </div>

                            <div class="px-6 py-10 text-[#4E5356]">
                                <!-- Step 1 -->
                                <div>
                                    <div class="relative mb-6">
                                        <!-- Sales Executive Select -->
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Sales
                                            Executive Name</label>
                                        <select x-model="formData.salesExecutive" @change="errors.salesExecutive = ''"
                                            class="bg-transparent border py-3 border-[#C7C7C7] text-black focus:outline-black placeholder:!text-black rounded-lg block w-full p-3">
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






                                        <label
                                            @click="formData.customerType = 'Purchased Customer'; errors.customerType = ''; customerType = 'purchased'"
                                            class="cursor-pointer p-3 border border-[#C7C7C7] rounded-lg px-6 text-center"
                                            :class="{
                                                'border-[#9D4F2A] ring ring-[#9D4F2A]': formData
                                                    .customerType === 'Purchased Customer'
                                            }">
                                            Purchased Customer
                                        </label>
                                        <label
                                            @click="formData.customerType = 'Non-Purchased Customer'; errors.customerType = ''; customerType = 'non-purchased'"
                                            class="cursor-pointer p-3 border border-[#C7C7C7] rounded-lg  px-6 text-center"
                                            :class="{
                                                'border-[#9D4F2A] ring ring-[#9D4F2A]': formData
                                                    .customerType === 'Non-Purchased Customer'
                                            }">
                                            Non-Purchased Customer
                                        </label>
                                    </div>
                                    <p x-show="errors.customerType" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors.customerType">
                                    </p>

                                    <button @click="validateStep1()" class="mt-8 main-btn">
                                        Continue
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div x-show="step === 2 && customerType === 'purchased'" x-cloak>
                            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                                <div class="pe-4">
                                    <img class="h-18" src={{ asset('/images/logo-white.svg') }} alt="logo" />
                                </div>
                                <div class="text-lg text-white font-medium uppercase">
                                    Please share your thoughts about your
                                    <b>IN-Store Experience</b>
                                </div>
                            </div>

                            <div class="px-6 py-10 text-[#4E5356]">
                                <!-- Step 2A: Purchased Customer Feedback -->
                                <div>
                                    <div class="mb-4 text-lg text-[#9D4F2A]">
                                        Please share your thoughts about your
                                        <b>IN-Store Experience</b>
                                    </div>
                                    <!-- Satisfaction -->
                                    <div class="block mb-4">1.⁠ ⁠How would you rate the cleanliness and maintenance
                                        of our showroom?</div>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <input type="radio" id="inStoreFeedback-option1" name="inStoreFeedback"
                                            value="Excellent" class="hidden">
                                        <label for="inStoreFeedback-option1"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id="inStoreFeedback-option2" name="inStoreFeedback"
                                                value="Good" class="hidden">

                                            <label for="inStoreFeedback-option2"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good" />
                                                </div>
                                                <div>Good</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id="inStoreFeedback-option3" name="inStoreFeedback"
                                                value="Average" class="hidden">

                                            <label for="inStoreFeedback-option3"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/average.svg') }}
                                                        alt="average" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id="inStoreFeedback-option4" name="inStoreFeedback"
                                                value="Poor" class="hidden">

                                            <label for="inStoreFeedback-option4"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor" />
                                                </div>
                                                <div>Poor</div>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="my-5">
                                        <hr class="border-gray-300" />
                                    </div>

                                    <div class="mb-4 text-lg text-[#9D4F2A]">
                                        About our <b>Jewellery Designs</b>
                                    </div>

                                    <div class="block mb-4">1.⁠ ⁠How unique and stylish do you find the Jewellery
                                        design?</div>

                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <input type="radio" id=" jewelleryDesignQuestion1-option1"
                                            name=" jewelleryDesignQuestion1" value="Excellent" class="hidden">
                                        <label for=" jewelleryDesignQuestion1-option1"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id=" jewelleryDesignQuestion1-option2"
                                                name=" jewelleryDesignQuestion1" value="Good" class="hidden">

                                            <label for=" jewelleryDesignQuestion1-option2"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good" />
                                                </div>
                                                <div>Good</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" jewelleryDesignQuestion1-option3"
                                                name=" jewelleryDesignQuestion1" value="Average" class="hidden">

                                            <label for=" jewelleryDesignQuestion1-option3"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/average.svg') }}
                                                        alt="average" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" jewelleryDesignQuestion1-option4"
                                                name=" jewelleryDesignQuestion1" value="Poor" class="hidden">

                                            <label for=" jewelleryDesignQuestion1-option4"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor" />
                                                </div>
                                                <div>Poor</div>
                                            </label>
                                        </div>
                                    </div>



                                    <div class="block mb-4">2.⁠ ⁠How would you rate our jewelry's design and pricing
                                        compared to other brands</div>

                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <input type="radio" id=" jewelleryDesignQuestion2-option1"
                                            name=" jewelleryDesignQuestion2" value="Excellent" class="hidden">
                                        <label for=" jewelleryDesignQuestion2-option1"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id=" jewelleryDesignQuestion2-option2"
                                                name=" jewelleryDesignQuestion2" value="Good" class="hidden">

                                            <label for=" jewelleryDesignQuestion2-option2"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good" />
                                                </div>
                                                <div>Good</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" jewelleryDesignQuestion2-option3"
                                                name=" jewelleryDesignQuestion2" value="Average" class="hidden">

                                            <label for=" jewelleryDesignQuestion2-option3"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/average.svg') }}
                                                        alt="average" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" jewelleryDesignQuestion2-option4"
                                                name=" jewelleryDesignQuestion2" value="Poor" class="hidden">

                                            <label for=" jewelleryDesignQuestion2-option4"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor" />
                                                </div>
                                                <div>Poor</div>
                                            </label>
                                        </div>
                                    </div>



                                    <div class="mt-8 flex justify-center">
                                        <button @click="validateStep2()" class="main-btn ">
                                            Continue
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-show="step === 2 && customerType === 'non-purchased'" x-cloak>
                            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                                <div class="pe-4">
                                    <img class="h-18" src={{ asset('/images/logo-white.svg') }} alt="logo" />
                                </div>
                                <div class="text-lg text-white font-medium uppercase">
                                    Please let us know how we can serve you better?
                                </div>
                            </div>

                            <div class="px-6 py-10 text-[#4E5356]">
                                <!-- Step 2B: Non-Purchased Customer Feedback -->
                                <div>
                                    <!-- Reason -->
                                    <div class="block mb-4 text-lg text-[#9D4F2A] font-semibold">What was the reason
                                        for not purchasing
                                        today?</div>
                                    <div class="grid gap-6 grid-cols-2 md:grid-cols-4">


                                        <div>
                                            <input type="radio" x-model="formData.nonPurchasedFeedback.reason"
                                                id="non-purchase-reason-question1" name=" non-purchase-reason"
                                                value="Poor" class="hidden">

                                            <label for="non-purchase-reason-question1"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img class="h-8"
                                                        src={{ asset('/images/icons/non-purchase-reason/icon1.svg') }}
                                                        alt="Expected design not available" />
                                                </div>
                                                <div>Expected design not available</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" x-model="formData.nonPurchasedFeedback.reason"
                                                id="non-purchase-reason-question2" name=" non-purchase-reason"
                                                value="Poor" class="hidden">

                                            <label for="non-purchase-reason-question2"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img class="h-8"
                                                        src={{ asset('/images/icons/non-purchase-reason/icon2.svg') }}
                                                        alt="Less Collection" />
                                                </div>
                                                <div>Less Collection</div>
                                            </label>
                                        </div>


                                        <div>
                                            <input type="radio" x-model="formData.nonPurchasedFeedback.reason"
                                                id="non-purchase-reason-question3" name=" non-purchase-reason"
                                                value="Poor" class="hidden">

                                            <label for="non-purchase-reason-question3"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img class="h-8"
                                                        src={{ asset('/images/icons/non-purchase-reason/icon3.svg') }}
                                                        alt="Service was Bad" />
                                                </div>
                                                <div>Service was Bad</div>
                                            </label>
                                        </div>


                                        <div>
                                            <input type="radio" x-model="formData.nonPurchasedFeedback.reason"
                                                id="non-purchase-reason-question4" name=" non-purchase-reason"
                                                value="Poor" class="hidden">

                                            <label for="non-purchase-reason-question4"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img class="h-8"
                                                        src={{ asset('/images/icons/non-purchase-reason/icon4.svg') }}
                                                        alt="Size not available" />
                                                </div>
                                                <div>Size not available</div>
                                            </label>
                                        </div>




                                        <div>
                                            <input type="radio" x-model="formData.nonPurchasedFeedback.reason"
                                                id="non-purchase-reason-question5" name=" non-purchase-reason"
                                                value="Poor" class="hidden">

                                            <label for="non-purchase-reason-question5"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img class="h-8"
                                                        src={{ asset('/images/icons/non-purchase-reason/icon5.svg') }}
                                                        alt="Price is too high" />
                                                </div>
                                                <div>Price is too high</div>
                                            </label>
                                        </div>








                                        <div>
                                            <input type="radio" x-model="formData.nonPurchasedFeedback.reason"
                                                id="non-purchase-reason-question6" name=" non-purchase-reason"
                                                value="Poor" class="hidden">

                                            <label for="non-purchase-reason-question6"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center flex items-center justify-center content-center">
                                                <div>Others</div>
                                            </label>
                                        </div>





                                    </div>
                                    <p x-show="errors.reason" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors.reason"></p>

                                    <div class="flex justify-center !px-10">
                                        <button @click="validateStep2()" class="mt-8 main-btn">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-show="step === 3 && customerType === 'purchased'" x-cloak>
                            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                                <div class="pe-4">
                                    <img class="h-18" src={{ asset('/images/logo-white.svg') }} alt="logo" />
                                </div>
                                <div class="text-lg text-white font-medium uppercase">
                                    How was your experience with our <b>Sales Executive</b>
                                </div>
                            </div>

                            <div class="px-6 py-10 text-[#4E5356]">
                                <!-- Step 3A: Purchased Customer Additional Feedback -->
                                <div>
                                    <!-- Question 1 -->
                                    <div class="block mb-4">1.⁠ ⁠How satisfied are you with the overall service
                                        provided by our showroom staff?
                                    </div>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <input type="radio" id=" step3Question1-option1" name=" step3Question1"
                                            value="Excellent" class="hidden">
                                        <label for=" step3Question1-option1"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id=" step3Question1-option2" name=" step3Question1"
                                                value="Good" class="hidden">

                                            <label for=" step3Question1-option2"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good" />
                                                </div>
                                                <div>Good</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" step3Question1-option3" name=" step3Question1"
                                                value="Average" class="hidden">

                                            <label for=" step3Question1-option3"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/average.svg') }}
                                                        alt="average" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" step3Question1-option4" name=" step3Question1"
                                                value="Poor" class="hidden">

                                            <label for=" step3Question1-option4"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor" />
                                                </div>
                                                <div>Poor</div>
                                            </label>
                                        </div>
                                    </div>



                                    <div class="block mb-4">2.⁠ ⁠How would you rate the friendliness and courtesy of
                                        our showroom staff?</div>

                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <input type="radio" id=" step3Question2-option1" name=" step3Question2"
                                            value="Excellent" class="hidden">
                                        <label for=" step3Question2-option1"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id=" step3Question2-option2" name=" step3Question2"
                                                value="Good" class="hidden">

                                            <label for=" step3Question2-option2"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good" />
                                                </div>
                                                <div>Good</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" step3Question2-option3" name=" step3Question2"
                                                value="Average" class="hidden">

                                            <label for=" step3Question2-option3"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/average.svg') }}
                                                        alt="average" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" step3Question2-option4" name=" step3Question2"
                                                value="Poor" class="hidden">

                                            <label for=" step3Question2-option4"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor" />
                                                </div>
                                                <div>Poor</div>
                                            </label>
                                        </div>
                                    </div>


                                    <!-- Question 3 -->
                                    <div class="block mb-4">3.⁠ ⁠How knowledgeable was our staff in explaining
                                        products and services?</div>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <input type="radio" id=" step3Question3-option1" name=" step3Question3"
                                            value="Excellent" class="hidden">
                                        <label for=" step3Question3-option1"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id=" step3Question3-option2" name=" step3Question3"
                                                value="Good" class="hidden">

                                            <label for=" step3Question3-option2"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good" />
                                                </div>
                                                <div>Good</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" step3Question3-option3" name=" step3Question3"
                                                value="Average" class="hidden">

                                            <label for=" step3Question3-option3"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/average.svg') }}
                                                        alt="average" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" step3Question3-option4" name=" step3Question3"
                                                value="Poor" class="hidden">

                                            <label for=" step3Question3-option4"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor" />
                                                </div>
                                                <div>Poor</div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Question 4 -->
                                    <div class="block mb-4">4.How would you rate the attentiveness of our staff in
                                        assisting you?</div>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <input type="radio" id=" step3Question4-option1" name=" step3Question4"
                                            value="Excellent" class="hidden">
                                        <label for=" step3Question4-option1"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id=" step3Question4-option2" name=" step3Question4"
                                                value="Good" class="hidden">

                                            <label for=" step3Question4-option2"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good" />
                                                </div>
                                                <div>Good</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" step3Question4-option3" name=" step3Question4"
                                                value="Average" class="hidden">

                                            <label for=" step3Question4-option3"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/average.svg') }}
                                                        alt="average" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id=" step3Question4-option4" name=" step3Question4"
                                                value="Poor" class="hidden">

                                            <label for=" step3Question4-option4"
                                                class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor" />
                                                </div>
                                                <div>Poor</div>
                                            </label>
                                        </div>
                                    </div>


                                    <!-- Continue Button -->
                                    <div class="flex justify-center">
                                        <button @click="validateStep3()" class="mt-8 main-btn">
                                            Continue
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-10 text-[#4E5356]" x-show="step === 4" x-cloak>
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

                        <form method="dialog" class="modal-backdrop z-10">
                            <button class="text-white absolute top-0 right-0 p-1" @click="clearData">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 31 31" fill="none">
                                    <circle cx="15.5" cy="15.5" r="15.5" fill="black"/>
                                    <path d="M9.39522 23L15.5 16.8462L21.6048 23L23 21.6048L16.8462 15.5L23 9.39522L21.6048 8L15.5 14.1538L9.39522 8L8 9.39522L14.1538 15.5L8 21.6048L9.39522 23Z" fill="#FCFAF9"/>
                                    </svg>

                            </button>
                        </form>
                    </div>
                </dialog>

                <dialog id="customerDetails" class="modal">
                    <div class="modal-box p-0 max-w-3xl bg-[#FCFAF9]">
                        <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                            <div class="pe-4">
                                <img class="h-18" src={{ asset('/images/logo-white.svg') }} alt="logo" />
                            </div>
                            <div class="text-xl text-white font-medium uppercase">
                                Welcome to Jewel one
                            </div>
                        </div>

                        <div class="p-8 text-[#4E5356]">
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
                                            Name
                                        </label>
                                        <input name="name" id="name" type="text" required
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black placeholder:!text-black rounded-lg block w-full p-3" />
                                    </div>

                                    <!-- Gender -->
                                    <div class="flex items-center gap-2">
                                        <div class="text-sm text-black">Gender</div>
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
                                    <div class="mb-1 text-black text-sm">Phone Number</div>
                                    <div class="input-container phone-group flex gap-1 flex-wrap">
                                        <!-- Generate 10 input fields with the class "phone" -->
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        <input type="text" maxlength="1"
                                            class="phone_number input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                    </div>
                                    <!-- Hidden input to store combined value -->
                                    <input type="hidden" id="hiddenPhoneNumber" name="hiddenPhoneNumber" />

                                </div>


                                <!-- Email and DOB -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-4">
                                    <div class="relative grow">
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Email</label>
                                        <input type="email" name="email" id="email" required
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />
                                    </div>

                                    <div class="relative">
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Date
                                            of Birth</label>
                                        <input type="date" name="date-of-birth" id="date-of-birth" required
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />
                                    </div>
                                </div>

                                <!-- Marital Status -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-center mb-4"
                                    x-data="{ maritalStatus: '' }">
                                    <div class="grow flex items-center gap-4">
                                        <div class="text-black text-sm">Marital Status</div>
                                        <div class="flex space-x-4">
                                            <div>
                                                <input type="radio" name="marital-status"
                                                    id="marital-status-married" value="0"
                                                    class="peer sr-only" x-model="maritalStatus" />
                                                <label for="marital-status-married"
                                                    class="flex items-center space-x-2 cursor-pointer !h-auto !bg-transparent peer-checked:!bg-[#9D4F2A] peer-checked:!text-white peer-checked:!border-[#9D4F2A] transition duration-300">
                                                    Married
                                                </label>
                                            </div>



                                            <div>
                                                <input type="radio" name="marital-status"
                                                    id="marital-status-not-married" value="1"
                                                    class="peer sr-only" x-model="maritalStatus" />
                                                <label for="marital-status-not-married"
                                                class="flex items-center space-x-2 cursor-pointer !h-auto !bg-transparent peer-checked:!bg-[#9D4F2A] peer-checked:!text-white peer-checked:!border-[#9D4F2A] transition duration-300">

                                                    Not Married
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="relative" x-show="maritalStatus === '0'" x-transition>
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Anniversary
                                            Date</label>
                                        <input type="date" name="anniversary-date" id="anniversary-date"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />
                                    </div>
                                </div>

                                <!-- Profession & Qualification -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-center mb-4">
                                    <div class="relative grow">
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Profession</label>
                                        <select id="profession" name="profession"
                                            class="w-full border border-[#C7C7C7] p-3 rounded text-black bg-transparent">
                                            <option value="">Select</option>
                                            @foreach ($professions as $item)
                                                <option value={{ $item->id }}>{{ $item->profession }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="relative grow">
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Qualification</label>
                                        <select id="qualification" name="qualification"
                                            class="w-full border border-[#C7C7C7] p-3 rounded text-black bg-transparent">
                                            <option value="">Select</option>
                                            @foreach ($qualifications as $item)
                                                <option value={{ $item->id }}>{{ $item->qualification }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-4">
                                    <div class="relative grow">
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Address</label>
                                        <textarea name="address" id="address" rows="2" required
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3 resize-none"></textarea>
                                    </div>

                                    <div>
                                        <div class="mb-1 text-sm text-black">Pincode</div>
                                        <div class="input-container zip-group flex gap-1 flex-wrap">
                                            <!-- Pincode inputs with class 'zip' for identification -->
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                            <input required name="pincode" type="text" maxlength="1"
                                                class="zip input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />

                                            <input type="hidden" name="hiddenPincode" id="hiddenPincode">
                                        </div>
                                    </div>


                                </div>

                                <div class="text-lg font-medium text-[#9D4F2A] mt-6 mb-4">
                                    How do you know about Jewel One?
                                </div>

                                <!-- Source Options -->
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-4">
                                    <div>
                                        <input id="source1" name="source" value="Television Commercial"
                                            type="radio" class="hidden" />
                                        <label for="source1" class="text-center">
                                            <img src={{ asset('/images/icons/televison.svg') }}
                                                alt="Television Commercial" class="h-8" />
                                            <span> Television Commercial </span>
                                        </label>
                                    </div>

                                    <div>
                                        <input id="source2" name="source" value="Newspaper" type="radio"
                                            class="hidden" />
                                        <label for="source2" class="text-center">
                                            <img src={{ asset('/images/icons/newspaper.svg') }} alt="newspaper"
                                                class="h-8" />
                                            <span> Newspaper </span>
                                        </label>
                                    </div>

                                    <div>
                                        <input id="source3" name="source" value="Social Media" type="radio"
                                            class="hidden" />
                                        <label for="source3" class="text-center">
                                            <img src={{ asset('/images/icons/socialmedia.svg') }} alt="Social Media"
                                                class="h-8" />
                                            <span> Social Media </span>
                                        </label>
                                    </div>

                                    <div>
                                        <input id="source4" name="source" value="Flyer, Brochure, Flex"
                                            type="radio" class="hidden" />
                                        <label for="source4" class="text-center">
                                            <img src={{ asset('/images/icons/brochure.svg') }}
                                                alt="Flyer, Brochure, Flex" class="h-8" />
                                            <span>Flyer, Brochure, Flex</span>
                                        </label>
                                    </div>

                                    <div>
                                        <input id="source5" name="source" value="Friends & Family" type="radio"
                                            class="hidden" />
                                        <label for="source5" class="text-center">
                                            <img src={{ asset('/images/icons/family.svg') }} alt="Friends & Family"
                                                class="h-8" />
                                            <span>Friends & Family</span>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 31 31" fill="none">
                                    <circle cx="15.5" cy="15.5" r="15.5" fill="black"/>
                                    <path d="M9.39522 23L15.5 16.8462L21.6048 23L23 21.6048L16.8462 15.5L23 9.39522L21.6048 8L15.5 14.1538L9.39522 8L8 9.39522L14.1538 15.5L8 21.6048L9.39522 23Z" fill="#FCFAF9"/>
                                    </svg>

                            </button>
                        </form>
                    </div>
                </dialog>

            </div>
        </section>
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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


        // function viewCustomerDetails(customer) {
        //     console.log(customer, "customer");
        //     const form = document.getElementById("customer-details-form");

        //     const phoneInputs = form.querySelectorAll(".phone.input-box");

        //     const zipInputs = form.querySelectorAll(".zip.input-box");


        //     createInputHandlers(phoneInputs, 10);
        //     createInputHandlers(zipInputs, 6);

        //     form.addEventListener("submit", (e) => {
        //         e.preventDefault();


        //         const phoneNumber = Array.from(phoneInputs).map(input => input.value).join('');
        //         const pincode = Array.from(zipInputs).map(input => input.value).join('');

        //         console.log({
        //             phoneNumber,
        //             pincode,
        //         });
        //         form.reset();
        //     });

        // }
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
                        this.step = 2;
                    }
                },
                validateStep2() {
                    this.errors = {};
                    if (this.customerType === "purchased") {
                        this.step = 3;
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
    </script>
</body>

</html>
