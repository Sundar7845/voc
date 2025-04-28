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

    <div class="border-b border-[#C7C7C7] mt-6">
        <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">Previous History</div>
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
                    <tr class="border-[#C7C7C7]">
                        <td class="border-r border-[#C7C7C7]">Sales Data (All in table)</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
