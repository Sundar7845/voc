@extends('backend.layout.adminmaster')
@section('content')
@section('title')
Customer Details
@endsection
<section class="py-8 px-6" x-data="getfeedbackData">
    <div class="flex justify-between items-center gap-6">
        <div class="flex gap-2 items-center">
            <a href="/live-user">
                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="32" viewBox="0 0 31 32" fill="none">
                    <rect x="0.455882" y="0.955882" width="30.0882" height="30.0882" rx="7.54412" fill="#FCFAF9"
                        stroke="#C7C7C7" stroke-width="0.911765" />
                    <path
                        d="M9.40805 15.5905L12.8984 11.664C13.0808 11.4783 13.3458 11.4799 13.5153 11.6333C13.6849 11.7868 13.6995 12.0807 13.546 12.2503L10.7033 15.4474H21.9514C22.1923 15.4474 22.3877 15.6427 22.3877 15.8837C22.3877 16.1247 22.1923 16.32 21.9514 16.32H10.7033L13.546 19.5171C13.6995 19.6867 13.6798 19.9751 13.5153 20.134C13.3441 20.2994 13.0519 20.2729 12.8984 20.1033L9.40805 16.1768C9.25388 15.9613 9.27225 15.7787 9.40805 15.5905Z"
                        fill="#252C32" />
                </svg>
            </a>
            <h1 class="text-xl font-semibold">Customer Details</h1>
        </div>
    </div>

    <div class="border-b border-[#C7C7C7] mt-6">
        <div class="border-b border-[#C7C7C7]-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">Previous History
        </div>
    </div>

    <div class="mt-8">
        <div class="overflow-x-auto rounded-box border border-[#C7C7C7] max-w-lg">
            <table class="table">
                <tbody>
                    <tr class="border-[#C7C7C7]">
                        <td class="border-r border-[#C7C7C7]">Previous Visit Date</td>
                        <td>{{ $customerDetails->customer_enter_time }}</td>
                    </tr>
                    <tr class="border-[#C7C7C7]">
                        <td class="border-r border-[#C7C7C7]">Duration of Visit </td>
                        <td>{{ $customerDetails->spent_time }}</td>
                    </tr>
                    <tr class="border-[#C7C7C7]">
                        <td class="border-r border-[#C7C7C7]">Purchased / Non Purchased</td>
                        <td>{{ $customerDetails->is_purchased == 1 ? 'Purchased' : 'Non Purchased' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <input type="hidden" name="customer_id" id="customer_id" value="{{ $customerDetails->customer_id }}">

    <div class="mt-10" x-data="{ openRow: null}">
        <div class="overflow-x-auto max-w-screen">
            <table class="w-full border border-[#C7C7C7] text-center" id="salesReportTable">
                <thead class="bg-black text-white text-sm">
                    <tr>
                        <th class="px-4 py-3">S.No</th>
                        <th class="px-4 py-3">DATE OF VISIT</th>
                        <th class="px-4 py-3">CUSTOMER TYPE</th>
                        <th class="px-4 py-3">VIEW FEEDBACK</th>
                        <th class="px-4 py-3">ORDER HISTORY</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @php $i = 1; @endphp
                    @foreach ($salesreport as $date => $group)
                    @php $firstItem = $group->first(); @endphp
                    <tr class="border-b border-[#C7C7C7]">
                        <td class="px-4 py-2">{{ $i }}</td>
                        <td class="px-4 py-2">{{ $date }}</td>
                        <td class="px-4 py-2">{{ count($group) > 0 ? 'Purchased' : 'Non-Purchased' }}</td>
                        <td class="px-4 py-2">
                            <button class="cursor-pointer" @click="getFeedback({{ $customerDetails->customer_id }})">Feedback</button>
                        </td>
                        <td class="px-4 py-2">
                            <button
                                class="text-sm text-[#9D4F2A] bg-transparent border border-[#9D4F2A] px-4 py-1 rounded-2xl cursor-pointer"
                                @click="openRow = openRow === {{ $i }} ? null : {{ $i }}">View
                                Details</button>
                        </td>
                    </tr>

                    <!-- Sub Table -->
                    <tr x-cloak x-show="openRow === {{ $i }}" class="bg-gray-50">
                        <td colspan="5">
                            <div class="p-4 overflow-x-auto md:max-w-[calc(100vw-340px)]">
                                <table class="w-full text-center text-xs">
                                    <thead class="bg-[#F2EDE4] text-[#313131]">
                                        <tr>
                                            <th class="p-2">Branch</th>
                                            <th class="p-2">Invoice Date</th>
                                            <th class="p-2">Purchase Location</th>
                                            <th class="p-2">Article Code</th>
                                            <th class="p-2">Name</th>
                                            <th class="p-2">SKU Number</th>
                                            <th class="p-2">Sales ID</th>
                                            <th class="p-2">Sales Person</th>
                                            <th class="p-2">Invoice ID</th>
                                            <th class="p-2">Gr. Weight</th>
                                            <th class="p-2">PCS</th>
                                            <th class="p-2">Net Chargeable</th>
                                            <th class="p-2">Sales Qty</th>
                                            <th class="p-2">CT Wght</th>
                                            <th class="p-2">Textbox 33</th>
                                            <th class="p-2">Customer ID</th>
                                            <th class="p-2">Cust Name</th>
                                            <th class="p-2">Cust Phone</th>
                                            <th class="p-2">Delivery Name</th>
                                            <th class="p-2">Sales Price</th>
                                            <th class="p-2">CValue</th>
                                            <th class="p-2">Stud Value</th>
                                            <th class="p-2">MK Code</th>
                                            <th class="p-2">Sale Calc Type</th>
                                            <th class="p-2">Amt 1</th>
                                            <th class="p-2">MK Rate</th>
                                            <th class="p-2">MK Value</th>
                                            <th class="p-2">Making Dis%</th>
                                            <th class="p-2">Making Disc</th>
                                            <th class="p-2">Scheme Discount</th>
                                            <th class="p-2">Textbox 89</th>
                                            <th class="p-2">Tax Item Group</th>
                                            <th class="p-2">Tax %</th>
                                            <th class="p-2">Tax Amount</th>
                                            <th class="p-2">Total Amount</th>
                                            <th class="p-2">Namline Amount</th>
                                            <th class="p-2">Invoice Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($group as $value)
                                        <tr class="border-t border-[#E0E0E0]">
                                            <td class="p-2">{{ $value->branch_name }}</td>
                                            <td class="p-2">{{ $value->invoice_date }}</td>
                                            <td class="p-2">{{ $value->purchase_location }}</td>
                                            <td class="p-2">{{ $value->article_code }}</td>
                                            <td class="p-2">{{ $value->name }}</td>
                                            <td class="p-2">{{ $value->sku_number }}</td>
                                            <td class="p-2">{{ $value->sales_id }}</td>
                                            <td class="p-2">{{ $value->sales_person }}</td>
                                            <td class="p-2">{{ $value->invoice_id }}</td>
                                            <td class="p-2">{{ $value->grweight }}</td>
                                            <td class="p-2">{{ $value->pcs }}</td>
                                            <td class="p-2">{{ $value->net_chargeable }}</td>
                                            <td class="p-2">{{ $value->sales_qty }}</td>
                                            <td class="p-2">{{ $value->ct_wght }}</td>
                                            <td class="p-2">{{ $value->textbox_33 }}</td>
                                            <td class="p-2">{{ $value->customer_id }}</td>
                                            <td class="p-2">{{ $value->cust_name }}</td>
                                            <td class="p-2">{{ $value->cust_phone }}</td>
                                            <td class="p-2">{{ $value->delivery_name }}</td>
                                            <td class="p-2">{{ $value->sales_price }}</td>
                                            <td class="p-2">{{ $value->cvalue }}</td>
                                            <td class="p-2">{{ $value->stud_value }}</td>
                                            <td class="p-2">{{ $value->mk_code }}</td>
                                            <td class="p-2">{{ $value->sale_calc_type }}</td>
                                            <td class="p-2">{{ $value->amt_1 }}</td>
                                            <td class="p-2">{{ $value->mk_rate }}</td>
                                            <td class="p-2">{{ $value->mk_value }}</td>
                                            <td class="p-2">{{ $value->makingdisper }}</td>
                                            <td class="p-2">{{ $value->makingdisc }}</td>
                                            <td class="p-2">{{ $value->scheme_discount }}</td>
                                            <td class="p-2">{{ $value->textbox_89 }}</td>
                                            <td class="p-2">{{ $value->tax_item_group }}</td>
                                            <td class="p-2">{{ $value->tax_per }}</td>
                                            <td class="p-2">{{ $value->tax_amount }}</td>
                                            <td class="p-2">{{ $value->total_amount }}</td>
                                            <td class="p-2">{{ $value->line_amount }}</td>
                                            <td class="p-2">{{ $value->invoice_amount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- <input type="hidden" name="customer_id" id="customer_id" value="{{ $customerDetails->customer_id }}">
    <div class="mt-8 max-h-[500px] overflow-auto border border-[#C7C7C7] rounded-box">
        <table id="salesReportTable" class="min-w-[1200px] w-full text-sm text-center border-collapse">
            <thead class="bg-black">
                <tr>
                    <th class="px-4 py-2">Branch</th>
                    <th class="px-4 py-2">Invoice Date</th>
                    <th class="px-4 py-2">Purchase Location</th>
                    <th class="px-4 py-2">Article Code</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">SKU Number</th>
                    <th class="px-4 py-2">Sales ID</th>
                    <th class="px-4 py-2">Sales Person</th>
                    <th class="px-4 py-2">Invoice ID</th>
                    <th class="px-4 py-2">Gr. Weight</th>
                    <th class="px-4 py-2">PCS</th>
                    <th class="px-4 py-2">Net Chargeable</th>
                    <th class="px-4 py-2">Sales Qty</th>
                    <th class="px-4 py-2">CT Wght</th>
                    <th class="px-4 py-2">Textbox 33</th>
                    <th class="px-4 py-2">Customer ID</th>
                    <th class="px-4 py-2">Cust Name</th>
                    <th class="px-4 py-2">Cust Phone</th>
                    <th class="px-4 py-2">Delivery Name</th>
                    <th class="px-4 py-2">Sales Price</th>
                    <th class="px-4 py-2">CValue</th>
                    <th class="px-4 py-2">Stud Value</th>
                    <th class="px-4 py-2">MK Code</th>
                    <th class="px-4 py-2">Sale Calc Type</th>
                    <th class="px-4 py-2">Amt 1</th>
                    <th class="px-4 py-2">MK Rate</th>
                    <th class="px-4 py-2">MK Value</th>
                    <th class="px-4 py-2">Making Dis%</th>
                    <th class="px-4 py-2">Making Disc</th>
                    <th class="px-4 py-2">Scheme Discount</th>
                    <th class="px-4 py-2">Textbox 89</th>
                    <th class="px-4 py-2">Tax Item Group</th>
                    <th class="px-4 py-2">Tax %</th>
                    <th class="px-4 py-2">Tax Amount</th>
                    <th class="px-4 py-2">Total Amount</th>
                    <th class="px-4 py-2">Namline Amount</th>
                    <th class="px-4 py-2">Invoice Amount</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div> -->



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
                                    <select x-model="formData.salesExecutive" @change="errors.salesExecutive = ''" class="bg-transparent border py-3 border-[#C7C7C7] text-black focus:outline-black placeholder:!text-black rounded-lg block w-full p-3" name="salesExcutiveName" id="salesExcutiveName">
                                        <option value="">Select Executive</option>
                                        <option value="146">
                                            ARUN J F (E23654)
                                        </option>
                                        <option value="90">
                                            ARUNPRASATH (E21494)
                                        </option>
                                        <option value="201">
                                            KAMESH R (E24111)
                                        </option>
                                        <option value="60">
                                            LINGESHWARAN RAMALINGAM (E19330)
                                        </option>
                                        <option value="3">
                                            MAHESWARI.B (E10411)
                                        </option>
                                        <option value="243">
                                            MUTHUKUMAR (E24421)
                                        </option>
                                        <option value="78">
                                            MUTHUSAMY KARUPUSAMY (E20988)
                                        </option>
                                        <option value="110">
                                            PANDIAN S (E22110)
                                        </option>
                                        <option value="162">
                                            PREETHIKA E (E23844)
                                        </option>
                                        <option value="230">
                                            PRIYANKA P (E24322)
                                        </option>
                                        <option value="244">
                                            R VASUMATHI (E24419)
                                        </option>
                                        <option value="152">
                                            RAGINI RAJAN (E23681)
                                        </option>
                                        <option value="22">
                                            RANGARAJ.D (E11291)
                                        </option>
                                        <option value="245">
                                            SAKTHI GURUSAMY (E24418)
                                        </option>
                                        <option value="229">
                                            SAUDHIKA (E24236)
                                        </option>
                                        <option value="25">
                                            SHANTHI R (E11495)
                                        </option>
                                        <option value="195">
                                            SONIYA G (E24080)
                                        </option>
                                        <option value="177">
                                            SRIDHAR RAMAN (E23968)
                                        </option>
                                        <option value="105">
                                            SRINIVASAN DHANDABANI (E22001)
                                        </option>
                                        <option value="262">
                                            SURESH KUMAR (E24320)
                                        </option>
                                        <option value="231">
                                            YOGA PRASANTH M (E24206)
                                        </option>
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
                                        class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                        class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                    alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
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
                                        <input type="radio"
                                            x-model="formData.nonPurchasedFeedback.reason"
                                            id="non-purchase-reason-question2" name="non-purchase-reason"
                                            value="2" class="hidden">

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
                                        <input type="radio"
                                            x-model="formData.nonPurchasedFeedback.reason"
                                            id="non-purchase-reason-question3" name="non-purchase-reason"
                                            value="3" class="hidden">

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
                                        <input type="radio"
                                            x-model="formData.nonPurchasedFeedback.reason"
                                            id="non-purchase-reason-question4" name="non-purchase-reason"
                                            value="4" class="hidden">

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
                                        <input type="radio"
                                            x-model="formData.nonPurchasedFeedback.reason"
                                            id="non-purchase-reason-question5" name="non-purchase-reason"
                                            value="5" class="hidden">

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
                                                <div x-show="formData.nonPurchasedFeedback.reason === '6'"
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

                    <div x-show="step === 3 && formData.customerType === '1'" x-cloak>
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
                            <!-- Step 3A: Purchased Customer Additional Feedback -->
                            <div>
                                <!-- Question 1 -->
                                <div class="block mb-4">1.⁠ ⁠How satisfied are you with the overall service
                                    provided by our showroom staff?
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                    <input type="radio" id="step3Question1-option1"
                                        name="step3Question1" value="{{ App\Enums\Review::EXCELLENT }}"
                                        class="hidden">
                                    <label for="step3Question1-option1"
                                        class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                    alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Question 3 -->
                                <div class="block mb-4">2.⁠ ⁠How knowledgeable was our staff in explaining
                                    products and services?</div>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                    <input type="radio" id="step3Question3-option1"
                                        name="step3Question3" value="{{ App\Enums\Review::EXCELLENT }}"
                                        class="hidden">
                                    <label for="step3Question3-option1"
                                        class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                    alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Question 4 -->
                                <div class="block mb-4">3.How would you rate the attentiveness of our staff
                                    in
                                    assisting you?</div>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                                    <input type="radio" id="step3Question4-option1"
                                        name="step3Question4" value="{{ App\Enums\Review::EXCELLENT }}"
                                        class="hidden">
                                    <label for="step3Question4-option1"
                                        class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
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
                                            class="cursor-pointer p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center">
                                            <div>
                                                <img src={{ asset('/images/icons/poor.svg') }}
                                                    alt="poor" />
                                            </div>
                                            <div>Poor</div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Continue Button -->
                                <div class="flex justify-center">
                                    <button type="submit" @click="validateStep3()"
                                        class="mt-8 main-btn">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

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



</section>
@section('scripts')
<script src="{{ asset('js/backend/liveuser.js') }}"></script>

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

    document.getElementById("getFeedbackForm").addEventListener("submit", (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        const data = {}

        formData.forEach((value, key) => {
            data[key] = value;
        });

        console.log(data);
    })


    function getFeedback(id) {
        const modal = document.getElementById("getFeedback");
        if (modal) {
            modal.showModal();
        } else {
            console.error("Modal not found!");
        }

        $("#feedbackCustomerId").val(id);
    }
</script>
@endsection
@endsection