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
                                class="liveusershowroom form-checkbox rounded border-gray-300 text-blue-600" />
                            <span x-text="item" class="text-sm"></span>
                        </label>
                    </template>
                </div>

                <!-- Done Button -->
                <div class="p-2 border-t border-[#C7C7C7] text-center">
                    <button @click="logSelected(); open = false"
                        class="liveuser-done-button bg-amber-700 text-white px-4 py-1 rounded-md cursor-pointer">Done</button>
                </div>
            </div>
        </div>
    </div>
    <div id="no-record" style="display:flex;align-items:center;justify-content:center;">

    </div>
    @if ($groupedData->isEmpty())
        <div class="text-center" id="empty-cart-image" style="display:flex;align-items:center;justify-content:center;">
            <img src="{{ asset('images/empty.gif') }}" alt="alternative_text" class="nodata" style="width:320px; mix-blend-mode: hard-light;">
        </div>
    @else
        <div id="liveuser">

            @foreach ($groupedData as $branchName => $customers)
                <div class="space-y-4">
                    <div class="swiper my-slider">
                        <div class="flex gap-2 mb-5">
                            <div class="border-b border-[#C7C7C7] mt-6 flex-grow">
                                <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">
                                    {{ $branchName }}
                                </div>
                            </div>
                            <div class="flex gap-1 items-end relative top-2">
                                <button
                                    class="swiper-prev rotate-180 disabled:opacity-25 cursor-pointer disabled:cursor-none">
                                    <!-- left arrow SVG -->
                                </button>
                                <button class="swiper-next disabled:opacity-25 cursor-pointer disabled:cursor-none">
                                    <!-- right arrow SVG -->
                                </button>
                            </div>
                        </div>

                        <div class="swiper-wrapper">
                            @foreach ($customers as $item)
                                <div class="swiper-slide bg-white max-w-52">
                                    <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                        <div
                                            class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                            <div class="flex gap-1 items-center">
                                                <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                                <span class="text-md">{{ $item->daily_count ?? '' }}</span>
                                            </div>
                                            <div class="text-xl font-semibold">{{ $item->name }}</div>
                                            <div class="mt-4">
                                                <a href="/customer/{{ $item->customer_id }}"
                                                    class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View
                                                    Details</a>
                                            </div>
                                        </div>

                                        <div class="text-sm py-2 px-6 text-[#ED3333]">
                                            <span id="timers-{{ $item->id }}"
                                                data-enter-time="{{ $item->customer_enter_time }}"
                                                data-customer-id="{{ $item->id }}">Loading...</span>
                                            <input type="hidden" name="spent_time_{{ $item->id }}"
                                                id="spent_timer_{{ $item->id }}" value="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</section>
@section('scripts')
    <script src="{{ asset('js/backend/liveuser.js') }}"></script>
@endsection
@endsection
