@extends('backend.layout.adminmaster')
@section('content')
@section('title')
    Dashboard
@endsection
<section class="py-8 px-6">
    <div class="flex flex-wrap justify-between items-center gap-6">
        <h1 class="text-xl font-semibold">Showroom</h1>

        <div class="flex flex-wrap gap-4 items-center">
            <div x-data="{ open: false }" class="relative flex gap-1 items-center">
                <div class="text-sm font-medium">Date:</div>
                <!-- Input field to trigger the date picker -->
                <input x-ref="dateInput" x-init="$refs.dateInput.value = new Date().toISOString().split('T')[0]" type="date" id="date" name="date"
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
        <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">List</div>
    </div>

    <section class="py-6">
        <div class="overflow-x-auto max-md:max-w-[calc(100vw-50px)] md:max-w-[calc(100vw-280px)]">
            <table class="table border-none" id="showroomTable">
                <thead>
                    <tr class="bg-black text-white text-sm">

                        <th class="px-4 py-3">Branch</th>
                        <th class="px-4 py-3">Token No</th>
                        <th class="px-4 py-3">Customer Name</th>
                        <th class="px-4 py-3">Sales Executive</th>
                        <th class="px-4 py-3">Customer In / Out</th>
                        <th class="px-4 py-3">Spent Time</th>
                        <th class="px-4 py-3">Purchased / Non Purchased</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">

                </tbody>
            </table>
        </div>
    </section>

</section>
@section('scripts')
    <script src="{{ asset('js/backend/showroom.js') }}"></script>
@endsection
@endsection
