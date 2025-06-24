@extends('backend.layout.adminmaster')
@section('content')
@section('title')
    Dashboard
@endsection
<section class="py-8 px-6">
    <div class="flex flex-wrap justify-between items-center gap-6">
        <h1 class="text-xl font-semibold">Dashboard</h1>

        <div class="flex flex-wrap gap-4 items-center">
            <div x-data="{ open: false }" class="relative flex gap-1 items-center">
                <div class="text-sm font-medium">Date:</div>
                <!-- Input field to trigger the date picker -->
                <input x-ref="dateInput" x-init="const yesterday = new Date(Date.now() - 86400000);
                const formattedYesterday = yesterday.toISOString().split('T')[0];
                $refs.dateInput.value = formattedYesterday;
                $refs.dateInput.max = formattedYesterday;" type="date" id="date" name="date"
                    class="w-full px-4 py-2 border text-sm cursor-pointer border-gray-300 rounded-md bg-white"
                    x-on:click="open = true; $nextTick(() => $refs.dateInput.showPicker())" />

            </div>

            <div x-data="showroomSelect()" class="relative w-64">
                <!-- Toggle Button -->
                <button @click="open = !open"
                    class="w-full px-4 py-2 border text-sm cursor-pointer border-gray-300 rounded-md bg-white text-left flex justify-between items-center">
                    <span>Showroom</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transform transition-transform duration-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false; logSelected()" x-transition
                    class="absolute z-10 mt-2 w-full bg-white rounded-md shadow-lg border border-[#C7C7C7] overflow-hidden">
                    <!-- Search -->
                    <div class="border-b border-[#C7C7C7]">
                        <input type="search" x-model="search" placeholder="Search Showroom"
                            class="w-full px-3 py-2 bg-gray-100 border-0 outline-0  text-sm" />
                    </div>

                    <!-- Checkboxes -->
                    <div class="h-36  overflow-y-auto p-2 space-y-2 accent-black">
                        <template x-for="(item, index) in filteredItems" :key="index">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" :value="item" :checked="selected.includes(item)"
                                    @change="toggleSelection(item)"
                                    class="showroom form-checkbox rounded border-gray-300 text-blue-600" />
                                <span x-text="item" class="text-sm"></span>
                            </label>
                        </template>
                    </div>

                    <!-- Done Button -->
                    <div class="p-2 border-t border-[#C7C7C7] text-center">
                        <button @click="logSelected(); open = false"
                            class="done-button bg-amber-700 text-white px-4 py-1 rounded-md cursor-pointer">Done</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="border-b border-[#C7C7C7] mt-6">
        <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">Today</div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 mt-8 gap-4 xl:gap-6">
        <div class="bg-white border border-gray-200 rounded-lg px-4 py-6 space-y-2">
            <div class="text-sm font-medium uppercase text-[#71717A]">Total cx</div>
            <div class="flex justify-between items-center">
                <div class="font-semibold text-lg" id="totalCustomer">{{ $totalcustomers }}</div>
                <div>
                    <svg class="h-10" xmlns="http://www.w3.org/2000/svg" width="44" height="44"
                        viewBox="0 0 44 44" fill="none">
                        <rect width="44" height="44" rx="8" fill="#81DCFB" />
                        <path
                            d="M34.8782 18.9794C34.4361 14.9278 32.8531 11.7478 30.4218 10.0252L30.4034 10.0123C28.4466 8.72446 25.4539 8.04756 21.5069 8H21.4917C17.5446 8.04758 14.5517 8.72446 12.5951 10.0123L12.5767 10.0252C10.1453 11.7477 8.56222 14.9278 8.12036 18.9794C7.88199 21.1864 7.99793 23.4181 8.466 25.5882C8.46817 25.5991 8.47033 25.6099 8.4725 25.6185C8.51151 25.7937 8.55051 25.9667 8.59385 26.1397C9.18977 28.5412 10.1909 30.5686 11.4911 31.9981L11.4997 32.0078C12.6103 33.1215 14.0004 33.9163 15.525 34.3109C17.472 34.8267 19.4851 35.0549 21.4994 34.9889C21.6327 34.99 21.766 34.9911 21.8981 34.9911C23.7802 35.0257 25.658 34.7975 27.4759 34.312C28.9993 33.9173 30.3895 33.1226 31.5012 32.0089L31.5099 31.9992C32.809 30.5675 33.8101 28.5424 34.4071 26.1408C34.9791 23.7987 35.1393 21.3755 34.8782 18.9794ZM9.39976 19.1189C9.80065 15.4426 11.1908 12.5879 13.3133 11.0796C15.0599 9.93342 17.8131 9.33006 21.4992 9.28572C25.1841 9.33005 27.9385 9.93339 29.6851 11.0796C31.8066 12.589 33.1967 15.4437 33.5986 19.1189L33.5997 19.1178C33.7189 20.2229 33.7438 21.3356 33.6734 22.4451L27.9481 18.5947C27.6869 18.4184 27.3359 18.4574 27.1192 18.6866L23.2523 22.79L15.8369 18.5166C15.5844 18.3717 15.2659 18.4139 15.0589 18.6193L9.5103 24.1577C9.25676 22.4904 9.21989 20.7958 9.39976 19.1189ZM30.5583 31.1319C28.8886 32.8944 25.8429 33.7594 21.5078 33.7032H21.4905C17.1542 33.7594 14.1098 32.8944 12.4399 31.1319C11.2384 29.8062 10.3314 27.8738 9.80595 25.679L15.6211 19.8768L26.9015 26.3763C27.2103 26.5536 27.6036 26.4487 27.7813 26.1417C27.959 25.8335 27.8539 25.441 27.5462 25.2636L24.3985 23.4492L27.6827 19.9642L33.527 23.8968C33.1239 26.8163 32.0763 29.4569 30.5583 31.1319ZM21.7658 19.1804C23.2306 19.1804 24.5514 18.2991 25.1126 16.9486C25.6727 15.5981 25.3629 14.0432 24.327 13.0096C23.2912 11.9759 21.7331 11.6667 20.38 12.2257C19.0256 12.7858 18.1436 14.1039 18.1436 15.5657C18.1458 17.5606 19.7666 19.1782 21.7658 19.1804ZM21.7658 13.2365C22.7106 13.2365 23.5611 13.8041 23.923 14.6746C24.2838 15.545 24.0834 16.5463 23.4159 17.2124C22.7485 17.8784 21.7452 18.0785 20.8729 17.7173C20.0007 17.3572 19.4319 16.5073 19.4319 15.5656C19.433 14.2788 20.4775 13.2375 21.7658 13.2365Z"
                            fill="black" />
                    </svg>
                </div>

            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg px-4 py-6 space-y-2">
            <div class="text-sm font-medium uppercase text-[#71717A]">live</div>
            <div class="flex justify-between items-center">
                <div class="font-semibold text-lg" id="liveCustomer">{{ $walkincustomer }}</div>
                <div>
                    <svg class="h-10" xmlns="http://www.w3.org/2000/svg" width="44" height="44"
                        viewBox="0 0 44 44" fill="none">
                        <rect width="44" height="44" rx="8" fill="#C89FFF" />
                        <path
                            d="M34.8782 19.9794C34.4361 15.9278 32.8531 12.7478 30.4218 11.0252L30.4034 11.0123C28.4466 9.72446 25.4539 9.04756 21.5069 9H21.4917C17.5446 9.04758 14.5517 9.72446 12.5951 11.0123L12.5767 11.0252C10.1453 12.7477 8.56222 15.9278 8.12036 19.9794C7.88199 22.1864 7.99793 24.4181 8.466 26.5882C8.46817 26.5991 8.47033 26.6099 8.4725 26.6185C8.51151 26.7937 8.55051 26.9667 8.59385 27.1397C9.18977 29.5412 10.1909 31.5686 11.4911 32.9981L11.4997 33.0078C12.6103 34.1215 14.0004 34.9163 15.525 35.3109C17.472 35.8267 19.4851 36.0549 21.4994 35.9889C21.6327 35.99 21.766 35.9911 21.8981 35.9911C23.7802 36.0257 25.658 35.7975 27.4759 35.312C28.9993 34.9173 30.3895 34.1226 31.5012 33.0089L31.5099 32.9992C32.809 31.5675 33.8101 29.5424 34.4071 27.1408C34.9791 24.7987 35.1393 22.3755 34.8782 19.9794ZM9.39976 20.1189C9.80065 16.4426 11.1908 13.5879 13.3133 12.0796C15.0599 10.9334 17.8131 10.3301 21.4992 10.2857C25.1841 10.33 27.9385 10.9334 29.6851 12.0796C31.8066 13.589 33.1967 16.4437 33.5986 20.1189L33.5997 20.1178C33.7189 21.2229 33.7438 22.3356 33.6734 23.4451L27.9481 19.5947C27.6869 19.4184 27.3359 19.4574 27.1192 19.6866L23.2523 23.79L15.8369 19.5166C15.5844 19.3717 15.2659 19.4139 15.0589 19.6193L9.5103 25.1577C9.25676 23.4904 9.21989 21.7958 9.39976 20.1189ZM30.5583 32.1319C28.8886 33.8944 25.8429 34.7594 21.5078 34.7032H21.4905C17.1542 34.7594 14.1098 33.8944 12.4399 32.1319C11.2384 30.8062 10.3314 28.8738 9.80595 26.679L15.6211 20.8768L26.9015 27.3763C27.2103 27.5536 27.6036 27.4487 27.7813 27.1417C27.959 26.8335 27.8539 26.441 27.5462 26.2636L24.3985 24.4492L27.6827 20.9642L33.527 24.8968C33.1239 27.8163 32.0763 30.4569 30.5583 32.1319ZM21.7658 20.1804C23.2306 20.1804 24.5514 19.2991 25.1126 17.9486C25.6727 16.5981 25.3629 15.0432 24.327 14.0096C23.2912 12.9759 21.7331 12.6667 20.38 13.2257C19.0256 13.7858 18.1436 15.1039 18.1436 16.5657C18.1458 18.5606 19.7666 20.1782 21.7658 20.1804ZM21.7658 14.2365C22.7106 14.2365 23.5611 14.8041 23.923 15.6746C24.2838 16.545 24.0834 17.5463 23.4159 18.2124C22.7485 18.8784 21.7452 19.0785 20.8729 18.7173C20.0007 18.3572 19.4319 17.5073 19.4319 16.5656C19.433 15.2788 20.4775 14.2375 21.7658 14.2365Z"
                            fill="black" />
                    </svg>
                </div>

            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg px-4 py-6 space-y-2" id="purchase">
            <div class="text-sm font-medium uppercase text-[#71717A]">purchase</div>
            <div class="flex justify-between items-center">
                <div class="font-semibold text-lg" id="purchasedCustomer">{{ $purchasedCustomer }}</div>
                <div>
                    <svg class="h-10" xmlns="http://www.w3.org/2000/svg" width="44" height="44"
                        viewBox="0 0 44 44" fill="none">
                        <rect width="44" height="44" rx="8" fill="#E6906E" />
                        <path
                            d="M34.8782 19.9794C34.4361 15.9278 32.8531 12.7478 30.4218 11.0252L30.4034 11.0123C28.4466 9.72446 25.4539 9.04756 21.5069 9H21.4917C17.5446 9.04758 14.5517 9.72446 12.5951 11.0123L12.5767 11.0252C10.1453 12.7477 8.56222 15.9278 8.12036 19.9794C7.88199 22.1864 7.99793 24.4181 8.466 26.5882C8.46817 26.5991 8.47033 26.6099 8.4725 26.6185C8.51151 26.7937 8.55051 26.9667 8.59385 27.1397C9.18977 29.5412 10.1909 31.5686 11.4911 32.9981L11.4997 33.0078C12.6103 34.1215 14.0004 34.9163 15.525 35.3109C17.472 35.8267 19.4851 36.0549 21.4994 35.9889C21.6327 35.99 21.766 35.9911 21.8981 35.9911C23.7802 36.0257 25.658 35.7975 27.4759 35.312C28.9993 34.9173 30.3895 34.1226 31.5012 33.0089L31.5099 32.9992C32.809 31.5675 33.8101 29.5424 34.4071 27.1408C34.9791 24.7987 35.1393 22.3755 34.8782 19.9794ZM9.39976 20.1189C9.80065 16.4426 11.1908 13.5879 13.3133 12.0796C15.0599 10.9334 17.8131 10.3301 21.4992 10.2857C25.1841 10.33 27.9385 10.9334 29.6851 12.0796C31.8066 13.589 33.1967 16.4437 33.5986 20.1189L33.5997 20.1178C33.7189 21.2229 33.7438 22.3356 33.6734 23.4451L27.9481 19.5947C27.6869 19.4184 27.3359 19.4574 27.1192 19.6866L23.2523 23.79L15.8369 19.5166C15.5844 19.3717 15.2659 19.4139 15.0589 19.6193L9.5103 25.1577C9.25676 23.4904 9.21989 21.7958 9.39976 20.1189ZM30.5583 32.1319C28.8886 33.8944 25.8429 34.7594 21.5078 34.7032H21.4905C17.1542 34.7594 14.1098 33.8944 12.4399 32.1319C11.2384 30.8062 10.3314 28.8738 9.80595 26.679L15.6211 20.8768L26.9015 27.3763C27.2103 27.5536 27.6036 27.4487 27.7813 27.1417C27.959 26.8335 27.8539 26.441 27.5462 26.2636L24.3985 24.4492L27.6827 20.9642L33.527 24.8968C33.1239 27.8163 32.0763 30.4569 30.5583 32.1319ZM21.7658 20.1804C23.2306 20.1804 24.5514 19.2991 25.1126 17.9486C25.6727 16.5981 25.3629 15.0432 24.327 14.0096C23.2912 12.9759 21.7331 12.6667 20.38 13.2257C19.0256 13.7858 18.1436 15.1039 18.1436 16.5657C18.1458 18.5606 19.7666 20.1782 21.7658 20.1804ZM21.7658 14.2365C22.7106 14.2365 23.5611 14.8041 23.923 15.6746C24.2838 16.545 24.0834 17.5463 23.4159 18.2124C22.7485 18.8784 21.7452 19.0785 20.8729 18.7173C20.0007 18.3572 19.4319 17.5073 19.4319 16.5656C19.433 15.2788 20.4775 14.2375 21.7658 14.2365Z"
                            fill="black" />
                    </svg>
                </div>

            </div>
        </div>
        <input type="hidden" name="purchase" value="" id="purchasevalue">

        <div class="bg-white border border-gray-200 rounded-lg px-4 py-6 space-y-2" id="nonPurchase">
            <div class="text-sm font-medium uppercase text-[#71717A]">non-purchase</div>
            <div class="flex justify-between items-center">
                <div class="font-semibold text-lg" id="nonPurchasedCustomer">{{ $nonPurchasedCustomer }}</div>
                <div>
                    <svg class="h-10" xmlns="http://www.w3.org/2000/svg" width="44" height="44"
                        viewBox="0 0 44 44" fill="none">
                        <rect width="44" height="44" rx="8" fill="#64D9A0" />
                        <path
                            d="M34.8782 19.9794C34.4361 15.9278 32.8531 12.7478 30.4218 11.0252L30.4034 11.0123C28.4466 9.72446 25.4539 9.04756 21.5069 9H21.4917C17.5446 9.04758 14.5517 9.72446 12.5951 11.0123L12.5767 11.0252C10.1453 12.7477 8.56222 15.9278 8.12036 19.9794C7.88199 22.1864 7.99793 24.4181 8.466 26.5882C8.46817 26.5991 8.47033 26.6099 8.4725 26.6185C8.51151 26.7937 8.55051 26.9667 8.59385 27.1397C9.18977 29.5412 10.1909 31.5686 11.4911 32.9981L11.4997 33.0078C12.6103 34.1215 14.0004 34.9163 15.525 35.3109C17.472 35.8267 19.4851 36.0549 21.4994 35.9889C21.6327 35.99 21.766 35.9911 21.8981 35.9911C23.7802 36.0257 25.658 35.7975 27.4759 35.312C28.9993 34.9173 30.3895 34.1226 31.5012 33.0089L31.5099 32.9992C32.809 31.5675 33.8101 29.5424 34.4071 27.1408C34.9791 24.7987 35.1393 22.3755 34.8782 19.9794ZM9.39976 20.1189C9.80065 16.4426 11.1908 13.5879 13.3133 12.0796C15.0599 10.9334 17.8131 10.3301 21.4992 10.2857C25.1841 10.33 27.9385 10.9334 29.6851 12.0796C31.8066 13.589 33.1967 16.4437 33.5986 20.1189L33.5997 20.1178C33.7189 21.2229 33.7438 22.3356 33.6734 23.4451L27.9481 19.5947C27.6869 19.4184 27.3359 19.4574 27.1192 19.6866L23.2523 23.79L15.8369 19.5166C15.5844 19.3717 15.2659 19.4139 15.0589 19.6193L9.5103 25.1577C9.25676 23.4904 9.21989 21.7958 9.39976 20.1189ZM30.5583 32.1319C28.8886 33.8944 25.8429 34.7594 21.5078 34.7032H21.4905C17.1542 34.7594 14.1098 33.8944 12.4399 32.1319C11.2384 30.8062 10.3314 28.8738 9.80595 26.679L15.6211 20.8768L26.9015 27.3763C27.2103 27.5536 27.6036 27.4487 27.7813 27.1417C27.959 26.8335 27.8539 26.441 27.5462 26.2636L24.3985 24.4492L27.6827 20.9642L33.527 24.8968C33.1239 27.8163 32.0763 30.4569 30.5583 32.1319ZM21.7658 20.1804C23.2306 20.1804 24.5514 19.2991 25.1126 17.9486C25.6727 16.5981 25.3629 15.0432 24.327 14.0096C23.2912 12.9759 21.7331 12.6667 20.38 13.2257C19.0256 13.7858 18.1436 15.1039 18.1436 16.5657C18.1458 18.5606 19.7666 20.1782 21.7658 20.1804ZM21.7658 14.2365C22.7106 14.2365 23.5611 14.8041 23.923 15.6746C24.2838 16.545 24.0834 17.5463 23.4159 18.2124C22.7485 18.8784 21.7452 19.0785 20.8729 18.7173C20.0007 18.3572 19.4319 17.5073 19.4319 16.5656C19.433 15.2788 20.4775 14.2375 21.7658 14.2365Z"
                            fill="black" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="border-b border-[#C7C7C7] mt-6">
        <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2"> Showroom List</div>
    </div>

    <section class="py-6">
        <div class="overflow-x-auto max-md:max-w-[calc(100vw-50px)] md:max-w-[calc(100vw-280px)]">
            <table class="table border-none" id="showroomTable">
                <thead>
                    <tr class="bg-black text-white text-sm">

                        <th class="px-4 py-3">Branch</th>
                        <th class="px-4 py-3">Token No</th>
                        <th class="px-4 py-3">Customer Name</th>
                        <th class="px-4 py-3">Customer ID</th>
                        <th class="px-4 py-3">Sales Executive</th>
                        <th class="px-4 py-3">Customer In Time</th>
                        <th class="px-4 py-3">Customer Out Time</th>
                        <th class="px-4 py-3">Spent Time</th>
                        <th class="px-4 py-3">Purchased / Non Purchased</th>
                        <th class="px-4 py-3">Scehme Redemption</th>
                        <th class="px-4 py-3">Scehme Payment</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">

                </tbody>
            </table>
        </div>
    </section>

    {{-- modal --}}

    <dialog id="viewHistory" class="modal">
        <div class="modal-box p-0 max-w-4xl min-h-60 bg-[#FCFAF9]">
            <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10 divide-x divide-white">
                <div class="pe-4">
                    <img class="h-14 lg:h-16" src="{{ asset('/images/logo-white.svg') }}" alt="logo" />
                </div>
                <div class="text-lg lg:text-xl text-white font-medium uppercase">
                    Passed History
                </div>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 31 31"
                        fill="none">
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
                        <div class="flex gap-4 items-center bg-[#9D4F2A] p-4 lg:px-10  divide-x divide-white">
                            <div class="pe-4">
                                <img class="h-14 lg:h-16" src={{ asset('/images/logo-white.svg') }} alt="logo" />
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
                                        name="jewelleryDesignQuestion1" value="{{ App\Enums\Review::EXCELLENT }}"
                                        class="hidden">
                                    <label for="jewelleryDesignQuestion1-option1"
                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                        <div>
                                            <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent"
                                                width="40" />
                                        </div>
                                        <div>Excellent</div>
                                    </label>

                                    <div>
                                        <input type="radio" id="jewelleryDesignQuestion1-option2"
                                            name="jewelleryDesignQuestion1" value="{{ App\Enums\Review::GOOD }}"
                                            class="hidden">

                                        <label for="jewelleryDesignQuestion1-option2"
                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                            <div>
                                                <img src={{ asset('/images/icons/good.svg') }} alt="good"
                                                    width="40" />
                                            </div>
                                            <div>Good</div>
                                        </label>
                                    </div>

                                    <div>
                                        <input type="radio" id="jewelleryDesignQuestion1-option3"
                                            name="jewelleryDesignQuestion1" value="{{ App\Enums\Review::AVERAGE }}"
                                            class="hidden">

                                        <label for="jewelleryDesignQuestion1-option3"
                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                            <div>
                                                <img src={{ asset('/images/icons/average.svg') }} alt="average"
                                                    width="40" />
                                            </div>
                                            <div>Average</div>
                                        </label>
                                    </div>

                                    <div>
                                        <input type="radio" id="jewelleryDesignQuestion1-option4"
                                            name="jewelleryDesignQuestion1" value="{{ App\Enums\Review::POOR }}"
                                            class="hidden">

                                        <label for="jewelleryDesignQuestion1-option4"
                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                            <div>
                                                <img src={{ asset('/images/icons/poor.svg') }} alt="poor"
                                                    width="40" />
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
                                        name="jewelleryDesignQuestion2" value="{{ App\Enums\Review::EXCELLENT }}"
                                        class="hidden">
                                    <label for="jewelleryDesignQuestion2-option1"
                                        class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                        <div>
                                            <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent"
                                                width="40" />
                                        </div>
                                        <div>Excellent</div>
                                    </label>

                                    <div>
                                        <input type="radio" id="jewelleryDesignQuestion2-option2"
                                            name="jewelleryDesignQuestion2" value="{{ App\Enums\Review::GOOD }}"
                                            class="hidden">

                                        <label for="jewelleryDesignQuestion2-option2"
                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                            <div>
                                                <img src={{ asset('/images/icons/good.svg') }} alt="good"
                                                    width="40" />
                                            </div>
                                            <div>Good</div>
                                        </label>
                                    </div>

                                    <div>
                                        <input type="radio" id="jewelleryDesignQuestion2-option3"
                                            name="jewelleryDesignQuestion2" value="{{ App\Enums\Review::AVERAGE }}"
                                            class="hidden">

                                        <label for="jewelleryDesignQuestion2-option3"
                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                            <div>
                                                <img src={{ asset('/images/icons/average.svg') }} alt="average"
                                                    width="40" />
                                            </div>
                                            <div>Average</div>
                                        </label>
                                    </div>

                                    <div>
                                        <input type="radio" id="jewelleryDesignQuestion2-option4"
                                            name="jewelleryDesignQuestion2" value="{{ App\Enums\Review::POOR }}"
                                            class="hidden">

                                        <label for="jewelleryDesignQuestion2-option4"
                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                            <div>
                                                <img src={{ asset('/images/icons/poor.svg') }} alt="poor"
                                                    width="40" />
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
                                            name="salesExecutiveQuestion1" value="{{ App\Enums\Review::EXCELLENT }}"
                                            class="hidden">
                                        <label for="salesExecutiveQuestion1-option1"
                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent"
                                                    width="40" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id="salesExecutiveQuestion1-option2"
                                                name="salesExecutiveQuestion1" value="{{ App\Enums\Review::GOOD }}"
                                                class="hidden">

                                            <label for="salesExecutiveQuestion1-option2"
                                                class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good"
                                                        width="40" />
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
                                                    <img src={{ asset('/images/icons/average.svg') }} alt="average"
                                                        width="40" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id="salesExecutiveQuestion1-option4"
                                                name="salesExecutiveQuestion1" value="{{ App\Enums\Review::POOR }}"
                                                class="hidden">

                                            <label for="salesExecutiveQuestion1-option4"
                                                class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor"
                                                        width="40" />
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
                                            name="salesExecutiveQuestion2" value="{{ App\Enums\Review::EXCELLENT }}"
                                            class="hidden">
                                        <label for="salesExecutiveQuestion2-option1"
                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent"
                                                    width="40" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id="salesExecutiveQuestion2-option2"
                                                name="salesExecutiveQuestion2" value="{{ App\Enums\Review::GOOD }}"
                                                class="hidden">

                                            <label for="salesExecutiveQuestion2-option2"
                                                class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good"
                                                        width="40" />
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
                                                    <img src={{ asset('/images/icons/average.svg') }} alt="average"
                                                        width="40" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id="salesExecutiveQuestion2-option4"
                                                name="salesExecutiveQuestion2" value="{{ App\Enums\Review::POOR }}"
                                                class="hidden">

                                            <label for="salesExecutiveQuestion2-option4"
                                                class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor"
                                                        width="40" />
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
                                            name="salesExecutiveQuestion3" value="{{ App\Enums\Review::EXCELLENT }}"
                                            class="hidden">
                                        <label for="salesExecutiveQuestion3-option1"
                                            class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                            <div>
                                                <img src={{ asset('/images/icons/excellent.svg') }} alt="excellent"
                                                    width="40" />
                                            </div>
                                            <div>Excellent</div>
                                        </label>

                                        <div>
                                            <input type="radio" id="salesExecutiveQuestion3-option2"
                                                name="salesExecutiveQuestion3" value="{{ App\Enums\Review::GOOD }}"
                                                class="hidden">

                                            <label for="salesExecutiveQuestion3-option2"
                                                class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                <div>
                                                    <img src={{ asset('/images/icons/good.svg') }} alt="good"
                                                        width="40" />
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
                                                    <img src={{ asset('/images/icons/average.svg') }} alt="average"
                                                        width="40" />
                                                </div>
                                                <div>Average</div>
                                            </label>
                                        </div>

                                        <div>
                                            <input type="radio" id="salesExecutiveQuestion3-option4"
                                                name="salesExecutiveQuestion3" value="{{ App\Enums\Review::POOR }}"
                                                class="hidden">

                                            <label for="salesExecutiveQuestion3-option4"
                                                class="cursor-pointer !h-full p-3 border bg-white shadow rounded-lg text-center grid gap-2 justify-items-center content-center !aspect-square">
                                                <div>
                                                    <img src={{ asset('/images/icons/poor.svg') }} alt="poor"
                                                        width="40" />
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 31 31"
                        fill="none">
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
    <script src="{{ asset('js/backend/dashboard.js') }}"></script>
@endsection
@endsection
