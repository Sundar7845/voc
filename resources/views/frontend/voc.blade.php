<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body class="bg-[#FCFAF9] min-h-screen roboto antialiased">
    <header class="bg-[#F2EDE4] border-b border-[#C7C7C7]">
        <nav class="px-4 md:px-16 py-4 flex justify-between gap-10 items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.svg" alt="logo" class="h-16" />
                </a>
            </div>

            <div>
                <div class="flex items-center gap-3">
                    <div class="text-end">
                        <div class="text-md font-medium text-black">Coimbatore</div>
                        <div class="text-[#7C7C7C] text-sm">Jewelone Showroom</div>
                    </div>
                    <div>
                        <img class="size-12 block rounded-full" src="/images/avatar.svg" alt="avatar" />
                    </div>

                    <div>
                        <a href="{{ route('logout') }}"
                            class="flex gap-1 items-center border cursor-pointer border-black rounded-sm py-2 px-4 hover:text-white hover:bg-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
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
                            0
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
                                    <img class="h-14" src="/images/logo-white.svg" alt="logo" />
                                </div>
                                <div class="text-xl text-white font-medium uppercase">
                                    Welcome to Jewel one
                                </div>
                            </div>

                            <div class="px-6 py-10 text-[#4E5356]">
                                <form id="add-customer-form">
                                    <!-- Name Field -->
                                    <div class="relative mb-4">
                                        <label for="customer-name"
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Name</label>
                                        <input id="customer-name" name="name" type="text" required
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black focus:outline-black placeholder:!text-black rounded-lg block w-full p-3" />
                                    </div>

                                    <!-- Phone Number Fields -->
                                    <div class="mb-4">
                                        <div class="mb-1 text-black text-sm">Phone Number</div>
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
                                    </div>

                                    <!-- Email & Pincode -->
                                    <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-4">
                                        <div class="relative grow">
                                            <label for="customer-email"
                                                class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Email</label>
                                            <input type="email" id="customer-email" name="email" required
                                                class="bg-transparent border py-2 border-[#C7C7C7] text-black focus:outline-black placeholder:!text-black rounded-lg block w-full p-3" />
                                        </div>

                                        <div>
                                            <div class="mb-1 text-sm text-black">Pincode</div>
                                            <div class="input-container zip-group">
                                                <input required type="text" maxlength="1" id="zip-1"
                                                    class="zip input-box" />
                                                <input required type="text" maxlength="1" id="zip-2"
                                                    class="zip input-box" />
                                                <input required type="text" maxlength="1" id="zip-3"
                                                    class="zip input-box" />
                                                <input required type="text" maxlength="1" id="zip-4"
                                                    class="zip input-box" />
                                                <input required type="text" maxlength="1" id="zip-5"
                                                    class="zip input-box" />
                                                <input required type="text" maxlength="1" id="zip-6"
                                                    class="zip input-box" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Source Options -->
                                    <div class="flex flex-wrap gap-4 mb-4">
                                        <div>
                                            <input id="source1" name="source" value="Television Commercial"
                                                type="radio" class="hidden" />
                                            <label for="source1" class="text-center">
                                                <img src="/images/icons/televison.svg" alt="Television Commercial"
                                                    class="h-8" />
                                                <span> Television Commercial </span>
                                            </label>
                                        </div>

                                        <div>
                                            <input id="source2" name="source" value="Newspaper" type="radio"
                                                class="hidden" />
                                            <label for="source2" class="text-center">
                                                <img src="/images/icons/newspaper.svg" alt="newspaper"
                                                    class="h-8" />
                                                <span> Newspaper </span>
                                            </label>
                                        </div>

                                        <div>
                                            <input id="source3" name="source" value="Social Media" type="radio"
                                                class="hidden" />
                                            <label for="source3" class="text-center">
                                                <img src="/images/icons/socialmedia.svg" alt="Social Media"
                                                    class="h-8" />
                                                <span> Social Media </span>
                                            </label>
                                        </div>

                                        <div>
                                            <input id="source4" name="source" value="Flyer, Brochure, Flex"
                                                type="radio" class="hidden" />
                                            <label for="source4" class="text-center">
                                                <img src="/images/icons/brochure.svg" alt="Flyer, Brochure, Flex"
                                                    class="h-8" />
                                                <span>Flyer, Brochure, Flex</span>
                                            </label>
                                        </div>

                                        <div>
                                            <input id="source5" name="source" value="Friends & Family"
                                                type="radio" class="hidden" />
                                            <label for="source5" class="text-center">
                                                <img src="/images/icons/family.svg" alt="Friends & Family"
                                                    class="h-8" />
                                                <span>Friends & Family</span>
                                            </label>
                                        </div>

                                        <div>
                                            <input id="source6" name="source" value="Others" type="radio"
                                                class="hidden" />
                                            <label for="source6"
                                                class="text-center flex justify-center items-center h-full">
                                                <div>Others</div>
                                            </label>
                                        </div>


                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit" class="main-btn">Submit</button>
                                    </div>
                                </form>
                            </div>

                            <form method="dialog" class="modal-backdrop z-10">
                                <button class="text-white absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </dialog>
                </div>
            </div>

            <div class="p-4" x-data="getfeedbackData">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-5 flex-wrap">
                    <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                        <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                            <div class="flex gap-1 items-center">
                                <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                <span class="text-md"> Customer #001 </span>
                            </div>
                            <div class="text-xl font-semibold">Madhu</div>
                            <div class="my-4">
                                <button onclick="customerDetails.showModal()" @click="viewCustomerDetails('001')"
                                    class="px-4 py-2 block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">
                                    View Details
                                </button>
                            </div>
                            <div>
                                <button onclick="getFeedback.showModal()"
                                    @click="open = true; formData.customerId = '001'"
                                    class="px-4 py-2 block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-black bg-white hover:bg-[#9D4F2A] hover:text-white">
                                    Get Feedback
                                </button>
                            </div>
                        </div>
                        <div class="text-sm py-2 px-6">20 mins 56 secs</div>
                    </div>

                    <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                        <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                            <div class="flex gap-1 items-center">
                                <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                <span class="text-md"> Customer #002 </span>
                            </div>
                            <div class="text-xl font-semibold">Gavya</div>
                            <div class="my-4">
                                <button onclick="customerDetails.showModal()" @click="viewCustomerDetails('002')"
                                    class="px-4 py-2 block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">
                                    View Details
                                </button>
                            </div>
                            <div>
                                <button onclick="getFeedback.showModal()"
                                    @click="open = true; formData.customerId = '002'"
                                    class="px-4 py-2 block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-black bg-white hover:bg-[#9D4F2A] hover:text-white">
                                    Get Feedback
                                </button>
                            </div>
                        </div>
                        <div class="text-sm py-2 px-6">20 mins 56 secs</div>
                    </div>

                    <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                        <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                            <div class="flex gap-1 items-center">
                                <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                <span class="text-md"> Customer #003 </span>
                            </div>
                            <div class="text-xl font-semibold">Jane</div>
                            <div class="my-4">
                                <button onclick="customerDetails.showModal()" @click="viewCustomerDetails('003')"
                                    class="px-4 py-2 block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">
                                    View Details
                                </button>
                            </div>
                            <div>
                                <button onclick="getFeedback.showModal()"
                                    @click="open = true; formData.customerId = '003'"
                                    class="px-4 py-2 block border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-black bg-white hover:bg-[#9D4F2A] hover:text-white">
                                    Get Feedback
                                </button>
                            </div>
                        </div>
                        <div class="text-sm py-2 px-6">20 mins 56 secs</div>
                    </div>
                </div>

                <dialog id="getFeedback" class="modal">
                    <div class="modal-box p-0 max-w-3xl min-h-60 bg-[#FCFAF9]">
                        <div x-show="step === 1" x-cloak>
                            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                                <div class="pe-4">
                                    <img class="h-14" src="/images/logo-white.svg" alt="logo" />
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
                                            <option value="John Doe">John Doe</option>
                                            <option value="Jane Smith">Jane Smith</option>
                                        </select>
                                        <p x-show="errors.salesExecutive" class="text-red-500 text-sm my-2"
                                            x-text="errors.salesExecutive">
                                        </p>
                                    </div>

                                    <!-- Customer Type Selection -->
                                    <label class="block mb-4 text-md font-semibold text-[#9D4F2A]">Customer
                                        Type</label>
                                    <div class="flex gap-4">
                                        <label
                                            @click="formData.customerType = 'Purchased Customer'; errors.customerType = ''; customerType = 'purchased'"
                                            class="cursor-pointer p-3 border rounded-lg w-1/2 text-center"
                                            :class="{ 'bg-green-500 text-white': formData
                                                .customerType === 'Purchased Customer' }">
                                            Purchased Customer
                                        </label>
                                        <label
                                            @click="formData.customerType = 'Non-Purchased Customer'; errors.customerType = ''; customerType = 'non-purchased'"
                                            class="cursor-pointer p-3 border rounded-lg w-1/2 text-center"
                                            :class="{ 'bg-red-500 text-white': formData
                                                    .customerType === 'Non-Purchased Customer' }">
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
                                    <img class="h-14" src="/images/logo-white.svg" alt="logo" />
                                </div>
                                <div class="text-xl text-white font-medium uppercase">
                                    Please share your thoughts about your
                                    <b>IN-Store Experience</b>
                                </div>
                            </div>

                            <div class="px-6 py-10 text-[#4E5356]">
                                <!-- Step 2A: Purchased Customer Feedback -->
                                <div>
                                    <div class="mb-4 text-md text-[#9D4F2A]">
                                        Please share your thoughts about your
                                        <b>IN-Store Experience</b>
                                    </div>
                                    <!-- Satisfaction -->
                                    <label class="block mb-4">1.⁠ ⁠How would you rate the cleanliness and maintenance
                                        of our showroom?</label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <label
                                            @click="formData.purchasedFeedback.cleanlinessRating = 'Excellent'; errors.cleanlinessRating = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .cleanlinessRating === 'Excellent' }">
                                            <div>
                                                <img src="/images/icons/excellent.svg" alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.cleanlinessRating = 'Good'; errors.cleanlinessRating = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .cleanlinessRating === 'Good' }">
                                            <div>
                                                <img src="/images/icons/good.svg" alt="good" />
                                            </div>
                                            <div>Good</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.cleanlinessRating = 'Average'; errors.cleanlinessRating = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-orange-500 text-white': formData.purchasedFeedback
                                                    .cleanlinessRating === 'Average' }">
                                            <div>
                                                <img src="/images/icons/average.svg" alt="average" />
                                            </div>
                                            <div>Average</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.cleanlinessRating = 'Poor'; errors.cleanlinessRating = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-red-500 text-white': formData.purchasedFeedback
                                                    .cleanlinessRating === 'Poor' }">
                                            <div>
                                                <img src="/images/icons/poor.svg" alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                    <p x-show="errors.cleanlinessRating" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors.cleanlinessRating"></p>

                                    <div class="my-5">
                                        <hr class="border-gray-300" />
                                    </div>

                                    <div class="mb-4 text-md text-[#9D4F2A]">
                                        About our <b>Jewellery Designs</b>
                                    </div>

                                    <label class="block mb-4">1.⁠ ⁠How unique and stylish do you find the Jewellery
                                        design?</label>

                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <label
                                            @click="formData.purchasedFeedback.designUniqueness = 'Excellent'; errors.designUniqueness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .designUniqueness === 'Excellent' }">
                                            <div>
                                                <img src="/images/icons/excellent.svg" alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.designUniqueness = 'Good'; errors.designUniqueness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .designUniqueness === 'Good' }">
                                            <div>
                                                <img src="/images/icons/good.svg" alt="good" />
                                            </div>
                                            <div>Good</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.designUniqueness = 'Average'; errors.designUniqueness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-orange-500 text-white': formData.purchasedFeedback
                                                    .designUniqueness === 'Average' }">
                                            <div>
                                                <img src="/images/icons/average.svg" alt="average" />
                                            </div>
                                            <div>Average</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.designUniqueness = 'Poor'; errors.designUniqueness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-red-500 text-white': formData.purchasedFeedback
                                                    .designUniqueness === 'Poor' }">
                                            <div>
                                                <img src="/images/icons/poor.svg" alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                    <p x-show="errors.designUniqueness" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors.designUniqueness"></p>

                                    <label class="block mb-4">2.⁠ ⁠How would you rate our jewelry's design and pricing
                                        compared to other brands</label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <label
                                            @click="formData.purchasedFeedback.designPricingComparison = 'Excellent'; errors.designPricingComparison = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .designPricingComparison === 'Excellent' }">
                                            <div>
                                                <img src="/images/icons/excellent.svg" alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.designPricingComparison = 'Good'; errors.designPricingComparison = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .designPricingComparison === 'Good' }">
                                            <div>
                                                <img src="/images/icons/good.svg" alt="good" />
                                            </div>
                                            <div>Good</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.designPricingComparison = 'Average'; errors.designPricingComparison = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-orange-500 text-white': formData.purchasedFeedback
                                                    .designPricingComparison === 'Average' }">
                                            <div>
                                                <img src="/images/icons/average.svg" alt="average" />
                                            </div>
                                            <div>Average</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.designPricingComparison = 'Poor'; errors.designPricingComparison = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-red-500 text-white': formData.purchasedFeedback
                                                    .designPricingComparison === 'Poor' }">
                                            <div>
                                                <img src="/images/icons/poor.svg" alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                    <p x-show="errors.designPricingComparison" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors.designPricingComparison"></p>

                                    <button @click="validateStep2()" class="mt-8 main-btn">
                                        Continue
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div x-show="step === 2 && customerType === 'non-purchased'" x-cloak>
                            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                                <div class="pe-4">
                                    <img class="h-14" src="/images/logo-white.svg" alt="logo" />
                                </div>
                                <div class="text-xl text-white font-medium uppercase">
                                    Please let us know how we can serve you better?
                                </div>
                            </div>

                            <div class="px-6 py-10 text-[#4E5356]">
                                <!-- Step 2B: Non-Purchased Customer Feedback -->
                                <div>
                                    <!-- Reason -->
                                    <label class="block mb-4 text-md text-[#9D4F2A] font-semibold">What was the reason
                                        for not purchasing
                                        today?</label>
                                    <div class="grid gap-6 grid-cols-2 md:grid-cols-4">
                                        <label
                                            @click="formData.nonPurchasedFeedback.reason = 'Expected design not available'; errors.reason = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!border-[#9D4F2A] !bg-red-100 ring ring-[#9D4F2A]': formData
                                                    .nonPurchasedFeedback.reason === 'Expected design not available' }">
                                            <div>
                                                <img class="h-8" src="/images/icons/non-purchase-reason/icon1.svg"
                                                    alt="Expected design not available" />
                                            </div>
                                            <div>Expected design not available</div>
                                        </label>

                                        <label
                                            @click="formData.nonPurchasedFeedback.reason = 'Less Collection'; errors.reason = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!border-[#9D4F2A] !bg-red-100 ring ring-[#9D4F2A]': formData
                                                    .nonPurchasedFeedback.reason === 'Less Collection' }">
                                            <div>
                                                <img class="h-8" src="/images/icons/non-purchase-reason/icon2.svg"
                                                    alt="Less Collection" />
                                            </div>
                                            <div>Less Collection</div>
                                        </label>

                                        <label
                                            @click="formData.nonPurchasedFeedback.reason = 'Service was Bad'; errors.reason = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!border-[#9D4F2A] !bg-red-100 ring ring-[#9D4F2A]': formData
                                                    .nonPurchasedFeedback.reason === 'Service was Bad' }">
                                            <div>
                                                <img class="h-8" src="/images/icons/non-purchase-reason/icon3.svg"
                                                    alt="Service was Bad" />
                                            </div>
                                            <div>Service was Bad</div>
                                        </label>

                                        <label
                                            @click="formData.nonPurchasedFeedback.reason = 'Size not available'; errors.reason = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!border-[#9D4F2A] !bg-red-100 ring ring-[#9D4F2A]': formData
                                                    .nonPurchasedFeedback.reason === 'Size not available' }">
                                            <div>
                                                <img class="h-8" src="/images/icons/non-purchase-reason/icon4.svg"
                                                    alt="Size not available" />
                                            </div>
                                            <div>Size not available</div>
                                        </label>

                                        <label
                                            @click="formData.nonPurchasedFeedback.reason = 'Price is too high'; errors.reason = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!border-[#9D4F2A] !bg-red-100 ring ring-[#9D4F2A]': formData
                                                    .nonPurchasedFeedback.reason === 'Price is too high' }">
                                            <div>
                                                <img class="h-8" src="/images/icons/non-purchase-reason/icon5.svg"
                                                    alt="Price is too high" />
                                            </div>
                                            <div>Price is too high</div>
                                        </label>

                                        <label
                                            @click="formData.nonPurchasedFeedback.reason = 'Others'; errors.reason = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center flex items-center justify-center content-center"
                                            :class="{ '!border-[#9D4F2A] !bg-red-100 ring ring-[#9D4F2A]': formData
                                                    .nonPurchasedFeedback.reason === 'Others' }">
                                            <div>Others</div>
                                        </label>
                                    </div>
                                    <p x-show="errors.reason" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors.reason"></p>

                                    <button @click="validateStep2()" class="mt-8 main-btn">
                                        Continue
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div x-show="step === 3 && customerType === 'purchased'" x-cloak>
                            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                                <div class="pe-4">
                                    <img class="h-14" src="/images/logo-white.svg" alt="logo" />
                                </div>
                                <div class="text-xl text-white font-medium uppercase">
                                    How was your experience with our <b>Sales Executive</b>
                                </div>
                            </div>

                            <div class="px-6 py-10 text-[#4E5356]">
                                <!-- Step 3A: Purchased Customer Additional Feedback -->
                                <div>
                                    <!-- Question 1 -->
                                    <label class="block mb-4">1.⁠ ⁠How satisfied are you with the overall service
                                        provided by our showroom staff?
                                    </label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <label
                                            @click="formData.purchasedFeedback.serviceSatisfaction = 'Excellent'; errors.serviceSatisfaction = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .serviceSatisfaction === 'Excellent' }">
                                            <div>
                                                <img src="/images/icons/excellent.svg" alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.serviceSatisfaction = 'Good'; errors.serviceSatisfaction = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .serviceSatisfaction === 'Good' }">
                                            <div>
                                                <img src="/images/icons/good.svg" alt="good" />
                                            </div>
                                            <div>Good</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.serviceSatisfaction = 'Average'; errors.serviceSatisfaction = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-orange-500 text-white': formData.purchasedFeedback
                                                    .serviceSatisfaction === 'Average' }">
                                            <div>
                                                <img src="/images/icons/average.svg" alt="average" />
                                            </div>
                                            <div>Average</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.serviceSatisfaction = 'Poor'; errors.serviceSatisfaction = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-red-500 text-white': formData.purchasedFeedback
                                                    .serviceSatisfaction === 'Poor' }">
                                            <div>
                                                <img src="/images/icons/poor.svg" alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                    <p x-show="errors.serviceSatisfaction" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors.serviceSatisfaction"></p>

                                    <!-- Question 2 -->
                                    <label class="block mb-4">2.⁠ ⁠How would you rate the friendliness and courtesy of
                                        our showroom staff?</label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <label
                                            @click="formData.purchasedFeedback. staffFriendliness = 'Excellent'; errors. staffFriendliness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .staffFriendliness === 'Excellent' }">
                                            <div>
                                                <img src="/images/icons/excellent.svg" alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback. staffFriendliness = 'Good'; errors.staffFriendliness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .staffFriendliness === 'Good' }">
                                            <div>
                                                <img src="/images/icons/good.svg" alt="good" />
                                            </div>
                                            <div>Good</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback. staffFriendliness = 'Average'; errors.staffFriendliness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-orange-500 text-white': formData.purchasedFeedback
                                                    .staffFriendliness === 'Average' }">
                                            <div>
                                                <img src="/images/icons/average.svg" alt="average" />
                                            </div>
                                            <div>Average</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback. staffFriendliness = 'Poor'; errors.staffFriendliness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-red-500 text-white': formData.purchasedFeedback
                                                    .staffFriendliness === 'Poor' }">
                                            <div>
                                                <img src="/images/icons/poor.svg" alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                    <p x-show="errors. staffFriendliness" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors. staffFriendliness"></p>

                                    <!-- Question 3 -->
                                    <label class="block mb-4">3.⁠ ⁠How knowledgeable was our staff in explaining
                                        products and services?</label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <label
                                            @click="formData.purchasedFeedback.staffKnowledge = 'Excellent'; errors.staffKnowledge = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .staffKnowledge === 'Excellent' }">
                                            <div>
                                                <img src="/images/icons/excellent.svg" alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.staffKnowledge = 'Good'; errors.staffKnowledge = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .staffKnowledge === 'Good' }">
                                            <div>
                                                <img src="/images/icons/good.svg" alt="good" />
                                            </div>
                                            <div>Good</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.staffKnowledge = 'Average'; errors.staffKnowledge = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-orange-500 text-white': formData.purchasedFeedback
                                                    .staffKnowledge === 'Average' }">
                                            <div>
                                                <img src="/images/icons/average.svg" alt="average" />
                                            </div>
                                            <div>Average</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.staffKnowledge = 'Poor'; errors.staffKnowledge = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-red-500 text-white': formData.purchasedFeedback
                                                    .staffKnowledge === 'Poor' }">
                                            <div>
                                                <img src="/images/icons/poor.svg" alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                    <p x-show="errors.staffKnowledge" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors.staffKnowledge"></p>

                                    <!-- Question 4 -->
                                    <label class="block mb-4">4.How would you rate the attentiveness of our staff in
                                        assisting you?</label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                        <label
                                            @click="formData.purchasedFeedback.staffAttentiveness = 'Excellent'; errors.staffAttentiveness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .staffAttentiveness === 'Excellent' }">
                                            <div>
                                                <img src="/images/icons/excellent.svg" alt="excellent" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.staffAttentiveness = 'Good'; errors.staffAttentiveness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-green-500 text-white': formData.purchasedFeedback
                                                    .staffAttentiveness === 'Good' }">
                                            <div>
                                                <img src="/images/icons/good.svg" alt="good" />
                                            </div>
                                            <div>Good</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.staffAttentiveness = 'Average'; errors.staffAttentiveness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-orange-500 text-white': formData.purchasedFeedback
                                                    .staffAttentiveness === 'Average' }">
                                            <div>
                                                <img src="/images/icons/average.svg" alt="average" />
                                            </div>
                                            <div>Average</div>
                                        </label>
                                        <label
                                            @click="formData.purchasedFeedback.staffAttentiveness = 'Poor'; errors.staffAttentiveness = ''"
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center"
                                            :class="{ '!bg-red-500 text-white': formData.purchasedFeedback
                                                    .staffAttentiveness === 'Poor' }">
                                            <div>
                                                <img src="/images/icons/poor.svg" alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                    <p x-show="errors.staffAttentiveness" class="text-red-500 text-sm mt-2 mb-4"
                                        x-text="errors.staffAttentiveness"></p>

                                    <!-- Continue Button -->
                                    <button @click="validateStep3()" class="mt-8 main-btn">
                                        Continue
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-10 text-[#4E5356]" x-show="step === 4" x-cloak>
                            <!-- Step 3: Thank You -->
                            <div class="flex flex-col items-center justify-center gap-6">
                                <div>
                                    <img src="/images/thank-you.svg" alt="thank you" />
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
                            <button class="text-white absolute top-0 right-0" @click="clearData">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </dialog>

                <dialog id="customerDetails" class="modal">
                    <div class="modal-box p-0 max-w-2xl bg-[#FCFAF9]">
                        <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 divide-x divide-white">
                            <div class="pe-4">
                                <img class="h-14" src="/images/logo-white.svg" alt="logo" />
                            </div>
                            <div class="text-xl text-white font-medium uppercase">
                                Welcome to Jewel one
                            </div>
                        </div>

                        <div x-data="{ disabled: true }" class="px-6 py-8 text-[#4E5356]">
                            <form id="customer-details-form">
                                <!-- Header -->
                                <div class="flex justify-between gap-5 items-center mb-6">
                                    <div class="text-md font-medium text-[#9D4F2A]">
                                        Please enter your below details
                                    </div>
                                    <div>
                                        <button type="button"
                                            @click="disabled = !disabled"
                                            class="flex items-center gap-1 cursor-pointer px-4 py-2 text-sm border border-[#C7C7C7] rounded-sm">
                                            <svg width="14" height="14" viewBox="0 0 14 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.613296 9.58195C0.435577 9.75967 0.336844 9.97688 0.317097 10.2138L0.0011519 14.0052C-0.0185947 14.2816 0.218364 14.5186 0.494817 14.4988L4.28616 14.1829C4.52312 14.1632 4.76008 14.0644 4.91805 13.8867L11 7.80476L6.71499 3.5L0.613296 9.58195Z" fill="#4E5356" />
                                                <path d="M13.7812 3.99548L10.517 0.721857C10.222 0.426048 9.76975 0.426048 9.47479 0.721857L8 2.2009L12.2867 6.5L13.7615 5.02095C14.0761 4.74486 14.0761 4.27157 13.7812 3.99548Z" fill="#4E5356" />
                                            </svg>
                                            <span x-text="disabled ? 'Edit' : 'Cancel'"></span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Name & Gender -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-6">
                                    <div class="relative grow">
                                        <label class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">
                                            Name
                                        </label>
                                        <input name="name" type="text" required
                                            :disabled="disabled"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black placeholder:!text-black rounded-lg block w-full p-3" />
                                    </div>

                                    <!-- Gender -->
                                    <div class="flex items-center gap-2">
                                        <div class="text-sm text-black">Gender</div>
                                        <div class="flex gap-1">
                                            <label class="cursor-pointer">
                                                <input type="radio" name="gender" value="M"
<<<<<<< HEAD
                                                    class="sr-only peer" required />
=======
                                                    class="sr-only peer" required :disabled="disabled" />
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                                <span
                                                    class="flex items-center justify-center py-2 px-4 border-2 border-gray-300 rounded-lg text-gray-700 peer-checked:bg-[#9D4F2A] peer-checked:text-white peer-checked:border-[#9D4F2A] transition duration-300">
                                                    M
                                                </span>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="gender" value="F"
<<<<<<< HEAD
                                                    class="sr-only peer" required />
=======
                                                    class="sr-only peer" required :disabled="disabled" />
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                                <span
                                                    class="flex items-center justify-center py-2 px-4 border-2 border-gray-300 rounded-lg text-gray-700 peer-checked:bg-[#9D4F2A] peer-checked:text-white peer-checked:border-[#9D4F2A] transition duration-300">
                                                    F
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="mb-8">
                                    <div class="mb-1 text-black text-sm">Phone Number</div>
<<<<<<< HEAD
                                    <div class="input-container phone-group">
                                        <input required type="text" maxlength="1" class="phone input-box" />
                                        <input required type="text" maxlength="1" class="phone input-box" />
                                        <input required type="text" maxlength="1" class="phone input-box" />
                                        <input required type="text" maxlength="1" id="phone-4"
                                            class="phone input-box" />
                                        <input required type="text" maxlength="1" class="phone input-box" />
                                        <input required type="text" maxlength="1" class="phone input-box" />
                                        <input required type="text" maxlength="1" class="phone input-box" />
                                        <input required type="text" maxlength="1" class="phone input-box" />
                                        <input required type="text" maxlength="1" class="phone input-box" />
                                        <input required type="text" maxlength="1" class="phone input-box" />
=======
                                    <div class="input-container phone-group flex gap-1 flex-wrap">
                                        <template x-for="i in 10" :key="i">
                                            <input required type="text" maxlength="1"
                                                :disabled="disabled"
                                                class="phone input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        </template>
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                    </div>
                                </div>

                                <!-- Email and DOB -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-6">
                                    <div class="relative grow">
                                        <label class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Email</label>
                                        <input type="email" name="email" required
                                            :disabled="disabled"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />
                                    </div>

                                    <div class="relative">
<<<<<<< HEAD
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Date
                                            of
                                            Birth</label>
=======
                                        <label class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Date of Birth</label>
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                        <input type="date" name="date-of-birth" required
                                            :disabled="disabled"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />
                                    </div>
                                </div>

<<<<<<< HEAD

=======
                                <!-- Marital Status -->
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-center mb-6"
                                    x-data="{ maritalStatus: '' }">
                                    <div class="grow flex items-center gap-4">
                                        <div class="text-black text-sm">Marital Status</div>
                                        <div class="flex space-x-4">
                                            <label class="flex items-center space-x-2 cursor-pointer">
                                                <input type="radio" name="marital-status" value="Married"
<<<<<<< HEAD
                                                    class="accent-amber-700" required
=======
                                                    class="accent-amber-700"
                                                    :disabled="disabled"
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                                    @change="maritalStatus = 'Married'" />
                                                <span>Married</span>
                                            </label>

                                            <label class="flex items-center space-x-2 cursor-pointer">
                                                <input type="radio" name="marital-status" value="Not Married"
<<<<<<< HEAD
                                                    class="accent-amber-700" required
=======
                                                    class="accent-amber-700"
                                                    :disabled="disabled"
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                                    @change="maritalStatus = 'Not Married'" />
                                                <span>Not Married</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="relative" x-show="maritalStatus === 'Married'" x-transition>
<<<<<<< HEAD
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">
                                            Anniversary Date
                                        </label>
                                        <input type="date" name="anniversary-date"
                                            :required="maritalStatus === 'Married'"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black focus:outline-black placeholder:!text-black rounded-lg block w-full p-3" />
=======
                                        <label class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Anniversary Date</label>
                                        <input type="date" name="anniversary-date"
                                            :disabled="disabled"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3" />
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                    </div>
                                </div>

                                <!-- Profession & Qualification -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-center mb-6">
                                    <div class="relative grow">
<<<<<<< HEAD
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Profession</label>
                                        <select id="profession" class="w-full border border-gray-300 p-3 rounded"
                                            required
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black focus:outline-black placeholder:!text-black rounded-lg block w-full p-3">
=======
                                        <label class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Profession</label>
                                        <select id="profession"
                                            :disabled="disabled"
                                            class="w-full border border-[#C7C7C7] p-3 rounded text-black bg-transparent">
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                            <option value="">Select</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Engineer">Engineer</option>
                                            <option value="Teacher">Teacher</option>
                                            <option value="Student">Student</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="relative grow">
<<<<<<< HEAD
                                        <label
                                            class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Qualification</label>
                                        <select id="qualification" class="w-full border border-gray-300 p-3 rounded"
                                            required
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black focus:outline-black placeholder:!text-black rounded-lg block w-full p-3">
=======
                                        <label class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Qualification</label>
                                        <select id="qualification"
                                            :disabled="disabled"
                                            class="w-full border border-[#C7C7C7] p-3 rounded text-black bg-transparent">
>>>>>>> c86e4317ac95797180ea2a0fcfaa339d6cb9ed63
                                            <option value="">Select</option>
                                            <option value="High School">High School</option>
                                            <option value="Bachelor's">Bachelor's</option>
                                            <option value="Master's">Master's</option>
                                            <option value="PhD">PhD</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="flex flex-col xl:flex-row gap-4 xl:items-end mb-6">
                                    <div class="relative grow">
                                        <label class="text-black absolute transform -translate-y-2 left-4 bg-[#FCFAF9] text-sm px-2">Address</label>
                                        <textarea name="address" rows="3" required
                                            :disabled="disabled"
                                            class="bg-transparent border py-2 border-[#C7C7C7] text-black rounded-lg block w-full p-3 resize-none"></textarea>
                                    </div>

                                    <div>
                                        <div class="mb-1 text-sm text-black">Pincode</div>
                                        <div class="input-container zip-group flex gap-1 flex-wrap">
                                        <template x-for="i in 6" :key="i">
                                            <input required type="text" maxlength="1"
                                                :disabled="disabled"
                                                class="zip input-box border border-[#C7C7C7] text-black p-2 w-10 text-center" />
                                        </template>

                                        </div>
                                    </div>

                                </div>

                                <!-- Save Button -->
                                <div class="flex justify-end">
                                    <button type="submit"
                                        :disabled="disabled"
                                        class="px-4 py-2 cursor-pointer disabled:cursor-not-allowed bg-[#9D4F2A] text-white text-sm rounded hover:bg-[#7C3E21] transition disabled:opacity-50">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>


                        <form method="dialog" class="modal-backdrop z-10">
                            <button class="text-white absolute top-0 right-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </dialog>

            </div>
        </section>
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
            const zipInputs = [...form.querySelectorAll(".zip")];

            createInputHandlers(phoneInputs, 10);
            createInputHandlers(zipInputs, 6);

            form.addEventListener("submit", (e) => {
                e.preventDefault();

                const name = document.getElementById("customer-name").value;
                const email = document.getElementById("customer-email").value;

                const phoneNumber = Array.from(phoneInputs).map(input => input.value).join('');
                const zipCode = Array.from(zipInputs).map(input => input.value).join('');



                const source =
                    form.querySelector('input[name="source"]:checked')?.value || "";

                console.log({
                    name,
                    phoneNumber,
                    email,
                    zipCode,
                    source,
                });
            });
        }

        addCustomerForm();







        function viewCustomerDetails(customer) {
            console.log(customer, "customer");
            const form = document.getElementById("customer-details-form");

            const phoneInputs = form.querySelectorAll(".phone.input-box");

            const zipInputs = form.querySelectorAll(".zip.input-box");


            createInputHandlers(phoneInputs, 10);
            createInputHandlers(zipInputs, 6);

            form.addEventListener("submit", (e) => {
                e.preventDefault();


                const phoneNumber = Array.from(phoneInputs).map(input => input.value).join('');
                const pincode = Array.from(zipInputs).map(input => input.value).join('');

                console.log({
                    phoneNumber,
                    pincode,
                });
            });

        }
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
                        if (!this.formData.purchasedFeedback.cleanlinessRating) {
                            this.errors.cleanlinessRating = "Please select an option.";
                        }
                        if (!this.formData.purchasedFeedback.designUniqueness) {
                            this.errors.designUniqueness = "Please select an option.";
                        }
                        if (!this.formData.purchasedFeedback.designPricingComparison) {
                            this.errors.designPricingComparison =
                                "Please select an option.";
                        }

                        if (Object.keys(this.errors).length === 0) {
                            this.step = 3;
                        }
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

                            console.log("Non-Purchased Feedback Data:", filteredData);
                            this.step = 4;
                        }
                    }
                },

                validateStep3() {
                    this.errors = {};
                    if (this.customerType === "purchased") {
                        if (!this.formData.purchasedFeedback.serviceSatisfaction) {
                            this.errors.serviceSatisfaction = "Please select an option.";
                        }
                        if (!this.formData.purchasedFeedback.staffFriendliness) {
                            this.errors.staffFriendliness = "Please select an option.";
                        }
                        if (!this.formData.purchasedFeedback.staffKnowledge) {
                            this.errors.staffKnowledge = "Please select an option.";
                        }
                        if (!this.formData.purchasedFeedback.staffAttentiveness) {
                            this.errors.staffAttentiveness = "Please select an option.";
                        }
                    }

                    if (Object.keys(this.errors).length === 0) {
                        // Create filtered form data for purchased
                        const filteredData = {
                            customerId: this.formData.customerId,
                            salesExecutive: this.formData.salesExecutive,
                            customerType: this.formData.customerType,
                            purchasedFeedback: this.formData.purchasedFeedback,
                        };

                        console.log("Purchased Feedback Data:", filteredData);
                        this.step = 4;
                    }
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
