@extends('backend.layout.adminmaster')
@section('content')
@section('title')
    Live User
@endsection
<section class="py-8 px-6">
    <div class="flex flex-wrap justify-between items-center gap-6">

        <h1 class="text-xl font-semibold">Live User</h1>

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
    @foreach ($branches as $item)
        <div class="space-y-4">

            <div class="swiper my-slider">
                <div class="flex gap-2 mb-5">
                    <div class="border-b border-[#C7C7C7] mt-6 flex-grow">
                        <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">
                            {{ $item->branch_name }}
                        </div>
                    </div>
                    <div class="flex gap-1 items-end relative top-2">
                        <button class="swiper-prev rotate-180 disabled:opacity-25 cursor-pointer disabled:cursor-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect x="-0.400159" y="0.400159" width="23.2092" height="23.2092" rx="5.59984"
                                    transform="matrix(-1 0 0 1 23.2094 0)" stroke="black" stroke-width="0.800318" />
                                <path
                                    d="M9.72563 18.2996C9.7977 18.3679 9.89564 18.4066 9.99798 18.4071C10.0488 18.4076 10.0991 18.3983 10.146 18.3798C10.1928 18.3613 10.2351 18.334 10.2703 18.2996L16.6925 12.2648C16.7286 12.2313 16.7572 12.1915 16.7768 12.1476C16.7963 12.1036 16.8064 12.0565 16.8064 12.0089C16.8064 11.9612 16.7963 11.9141 16.7768 11.8702C16.7572 11.8262 16.7286 11.7864 16.6925 11.7529L10.2703 5.7168C10.235 5.68133 10.1925 5.65289 10.1452 5.63319C10.098 5.61348 10.047 5.60291 9.99532 5.6021C9.94364 5.60129 9.89231 5.61026 9.84439 5.62847C9.79647 5.64669 9.75294 5.67377 9.71639 5.70812C9.67984 5.74247 9.65102 5.78337 9.63163 5.8284C9.61225 5.87343 9.60271 5.92166 9.60357 5.97023C9.60443 6.0188 9.61568 6.0667 9.63665 6.1111C9.65762 6.1555 9.68788 6.19548 9.72563 6.22866L15.8754 12.0089L9.72563 17.7878C9.68972 17.8213 9.66123 17.8612 9.64179 17.9051C9.62235 17.949 9.61234 17.9961 9.61234 18.0437C9.61234 18.0913 9.62235 18.1384 9.64179 18.1823C9.66123 18.2262 9.68972 18.2661 9.72563 18.2996Z"
                                    fill="black" />
                            </svg>
                        </button>
                        <button class="swiper-next disabled:opacity-25 cursor-pointer disabled:cursor-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect x="-0.400159" y="0.400159" width="23.2092" height="23.2092" rx="5.59984"
                                    transform="matrix(-1 0 0 1 23.2094 0)" stroke="black" stroke-width="0.800318" />
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
                                    <span class="text-md">{{ $item->daily_count }}</span>
                                </div>
                                <div class="text-xl font-semibold">{{ $item->name }}</div>
                                <div class="mt-4">
                                    <a href="/customer/001"
                                        class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                        Details</a>
                                </div>
                            </div>
                            {{-- <div class="text-sm py-2 px-6 text-[#ED3333]">20 mins 56 secs</div> --}}

                            <div class="text-sm py-2 px-6 text-[#ED3333]">
                                <span id="timers-{{ $item->id }}"
                                    data-enter-time="{{ $item->customer_enter_time }}"
                                    data-customer-id="{{ $item->id }}">Loading...</span>
                                <input type="hidden" name="spent_time_{{ $item->id }}"
                                    id="spent_timer_{{ $item->id }}" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</section>
<script>
    // Spent time
    document.addEventListener("DOMContentLoaded", function () {
        const timers = document.querySelectorAll('[id^="timers-"]');

        timers.forEach((timer) => {
            const customerEnterTime = new Date(timer.dataset.enterTime);
            console.log(customerEnterTime);

            function updateTimer() {
                const now = new Date();
                const diff = Math.floor((now - customerEnterTime) / 1000);

                const hours = Math.floor(diff / 3600);
                const minutes = Math.floor((diff % 3600) / 60);
                const seconds = diff % 60;

                const timeText = `${hours} hrs ${minutes} mins ${seconds} secs`;
                timer.textContent = timeText;

                // Update the corresponding hidden input field
                const spentTimeInput = document.querySelector(
                    `#spent_timer_${timer.dataset.customerId}`
                );
                if (spentTimeInput) {
                    spentTimeInput.value = timeText;
                }
            }

            updateTimer();
            setInterval(updateTimer, 1000);
        });
    });
</script>

@endsection
