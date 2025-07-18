@extends('backend.layout.adminmaster')
@section('content')
@section('title')
    Sales Report
@endsection
<section class="pr-10 px-6 py-8">
    <div class="flex flex-wrap justify-between items-center gap-6 border-b border-[#C7C7C7] pb-5">

        <div class="flex gap-2 items-center">
            <a href="/dashboard">
                <svg class="h-8" xmlns="http://www.w3.org/2000/svg" width="31" height="32" viewBox="0 0 31 32"
                    fill="none">
                    <rect x="0.455882" y="0.955882" width="30.0882" height="30.0882" rx="7.54412" fill="#FCFAF9"
                        stroke="#C7C7C7" stroke-width="0.911765" />
                    <path
                        d="M9.40805 15.5903L12.8984 11.6638C13.0808 11.478 13.3458 11.4796 13.5153 11.6331C13.6849 11.7866 13.6995 12.0805 13.546 12.25L10.7033 15.4472H21.9514C22.1923 15.4472 22.3877 15.6425 22.3877 15.8834C22.3877 16.1244 22.1923 16.3197 21.9514 16.3197H10.7033L13.546 19.5168C13.6995 19.6864 13.6798 19.9749 13.5153 20.1338C13.3441 20.2992 13.0519 20.2727 12.8984 20.1031L9.40805 16.1766C9.25388 15.9611 9.27225 15.7785 9.40805 15.5903Z"
                        fill="#252C32" />
                </svg>
            </a>
            <h1 class="text-xl font-semibold">Sales Report</h1>
        </div>

        <div class="flex gap-2 items-center">
            <a href="{{ route('downloadsheet') }}"
                class="bg-[#9D4F2A] text-white px-6 py-3 rounded-sm font-medium shadow-md cursor-pointer text-sm flex gap-1 items-center">
                Example Sheet
            </a>
            <button onclick="importFile.showModal()"
                class="bg-[#9D4F2A] text-white px-6 py-3 rounded-sm font-medium shadow-md cursor-pointer text-sm flex gap-1 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5" viewBox="0 0 22 16" fill="none">
                    <path
                        d="M10.9999 0.5C12.5478 0.5 14.0981 1.08815 15.2791 2.26915C16.2815 3.27149 16.8588 4.53867 17.0105 5.84526C19.4752 6.06903 21.4031 8.13834 21.4031 10.6613C21.4031 13.3336 19.2367 15.5 16.5644 15.5H4.70958C2.43103 15.5 0.59668 13.6656 0.59668 11.3871C0.59668 9.10855 2.43103 7.27419 4.70958 7.27419H4.99688C4.78369 5.4949 5.36278 3.63459 6.72824 2.26915C7.9092 1.08815 9.45198 0.5 10.9999 0.5ZM10.9999 5.58065C10.8715 5.58016 10.7813 5.60428 10.6748 5.70161L8.0135 8.12097C7.82419 8.29085 7.7894 8.62235 7.97571 8.80896C8.15542 8.98898 8.47589 9.01068 8.66373 8.8392L10.516 7.15323V12.3548C10.516 12.6221 10.7326 12.8387 10.9999 12.8387C11.2672 12.8387 11.4838 12.6221 11.4838 12.3548V7.15323L13.3361 8.8392C13.5239 9.01068 13.8534 8.9975 14.0241 8.80896C14.1948 8.62039 14.1852 8.29405 13.9863 8.12097L11.325 5.70161C11.2559 5.63827 11.1293 5.58306 10.9999 5.58065Z"
                        fill="white" />
                </svg>

                Import
            </button>

            <dialog id="importFile" class="modal">
                <div class="modal-box p-0 max-w-2xl bg-[#FCFAF9]">
                    <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10  divide-x divide-white">
                        <div class="pe-4">
                            <img class="h-14 lg:h-16" src="{{ asset('images/logo-white.svg') }}" alt="logo">
                        </div>
                        <div class="text-lg lg:text-xl text-white font-medium uppercase">
                            Import Sales Report
                        </div>
                    </div>
                    <form action="{{ route('sales.import') }}" method="POST" enctype="multipart/form-data"
                        class="modal-backdrop z-10">
                        @csrf
                        <div
                            class="px-4 md:px-6 py-10 lg:px-12 text-[#4E5356] flex flex-col justify-center  items-center gap-8">
                            <div>
                                <input type="file" name="file" id="file" accept=".xlsx, .xls, .csv"
                                    class="file-input outline-none ring-0 focus:ring-0 focus:outline-none" required />
                            </div>
                            <button
                                class="bg-[#9D4F2A] text-white px-8 py-3 rounded-sm font-medium shadow-md cursor-pointer text-sm flex gap-1 items-center">
                                Import
                            </button>
                        </div>
                        <button type="submit" class="text-white absolute top-0 right-0 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 31 31"
                                fill="none">
                                <circle cx="15.5" cy="15.5" r="15.5" fill="black"></circle>
                                <path
                                    d="M9.39522 23L15.5 16.8462L21.6048 23L23 21.6048L16.8462 15.5L23 9.39522L21.6048 8L15.5 14.1538L9.39522 8L8 9.39522L14.1538 15.5L8 21.6048L9.39522 23Z"
                                    fill="#FCFAF9"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </dialog>
        </div>
    </div>
</section>

<section class="px-6">
    <div class="overflow-x-auto max-md:max-w-[calc(100vw-50px)] md:max-w-[calc(100vw-280px)]">
        <table class="table border-none" id="salesReportTable">
            <thead>
                <tr class="bg-black text-white text-sm">

                    <th class="px-4 py-3 text-left">Branch</th>
                    <th class="px-4 py-3 text-left">Invoice Date</th>
                    <th class="px-4 py-3 text-left">Purchase Location</th>
                    <th class="px-4 py-3 text-left">Article Code</th>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">SKU Number</th>
                    <th class="px-4 py-3 text-left">Sales ID</th>
                    <th class="px-4 py-3 text-left">Sales Person</th>
                    <th class="px-4 py-3 text-left">Invoice ID</th>
                    <th class="px-4 py-3 text-left">Gr. Weight</th>
                    <th class="px-4 py-3 text-left">PCS</th>
                    <th class="px-4 py-3 text-left">Net Chargeable</th>
                    <th class="px-4 py-3 text-left">Sales Qty</th>
                    <th class="px-4 py-3 text-left">CT Wght</th>
                    <th class="px-4 py-3 text-left">Textbox 33</th>
                    <th class="px-4 py-3 text-left">Customer ID</th>
                    <th class="px-4 py-3 text-left">Cust Name</th>
                    <th class="px-4 py-3 text-left">Cust Phone</th>
                    <th class="px-4 py-3 text-left">Delivery Name</th>
                    <th class="px-4 py-3 text-left">Sales Price</th>
                    <th class="px-4 py-3 text-left">CValue</th>
                    <th class="px-4 py-3 text-left">Stud Value</th>
                    <th class="px-4 py-3 text-left">MK Code</th>
                    <th class="px-4 py-3 text-left">Sale Calc Type</th>
                    <th class="px-4 py-3 text-left">Amt 1</th>
                    <th class="px-4 py-3 text-left">MK Rate</th>
                    <th class="px-4 py-3 text-left">MK Value</th>
                    <th class="px-4 py-3 text-left">Making Dis%</th>
                    <th class="px-4 py-3 text-left">Making Disc</th>
                    <th class="px-4 py-3 text-left">Scheme Discount</th>
                    <th class="px-4 py-3 text-left">Textbox 89</th>
                    <th class="px-4 py-3 text-left">Tax Item Group</th>
                    <th class="px-4 py-3 text-left">Tax %</th>
                    <th class="px-4 py-3 text-left">Tax Amount</th>
                    <th class="px-4 py-3 text-left">Total Amount</th>
                    <th class="px-4 py-3 text-left">Namline Amount</th>
                    <th class="px-4 py-3 text-left">Invoice Amount</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800">

            </tbody>
        </table>
    </div>
</section>

@section('scripts')
    <script src="{{ asset('js/backend/salereport.js') }}"></script>
    <script>
        window.Laravel = {
            downloadExampleSheetUrl: "{{ url('/download-example-sheet') }}"
        };
    </script>
@endsection
@endsection
