@extends('backend.layout.adminmaster')
@section('content')
@section('title')
    Customer Details
@endsection
<section class="py-8 px-6">
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

    <div class="border-b border-[#C7C7C7] border-[#C7C7C7] mt-6">
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

    <div class="mt-10" x-data="{ openRow: null }">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-[#C7C7C7] text-center" id="salesReportTable">
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
                            <td class="px-4 py-2">Feedback</td>
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
                                <div class="p-4">
                                    <table class="w-full table-auto text-center text-xs">
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

</section>
@section('scripts')
    <script src="{{ asset('js/backend/liveuser.js') }}"></script>
@endsection
@endsection
