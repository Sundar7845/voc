var baseurl = window.location.origin;

// Spent time timer function
function startTimers() {
    const timers = document.querySelectorAll('[id^="timers-"]');

    timers.forEach((timer) => {
        const customerEnterTime = new Date(timer.dataset.enterTime);

        function updateTimer() {
            const now = new Date();
            const diff = Math.floor((now - customerEnterTime) / 1000);

            const hours = Math.floor(diff / 3600);
            const minutes = Math.floor((diff % 3600) / 60);
            const seconds = diff % 60;

            const timeText = `${hours} hrs ${minutes} mins ${seconds} secs`;
            timer.textContent = timeText;

            // Update hidden input field
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
}

document.addEventListener("DOMContentLoaded", function () {
    startTimers();
});

$(".liveuser-done-button").on("click", todayLiveUserRecord);

function todayLiveUserRecord() {
    const selectedShowrooms = $(".liveusershowroom:checked")
        .map(function () {
            return this.value;
        })
        .get();

    $.ajax({
        type: "GET",
        url: "getliveuserrecord",
        data: {
            selectedShowrooms: selectedShowrooms.length
                ? selectedShowrooms
                : [],
        },
        dataType: "json",
        success: function (data) {
            $("#liveuser").empty();
            $("#no-record").empty();

            const branchesData = data.branchesData;

            if (!branchesData || branchesData.length === 0) {
                const notfound = `<img class="img-fluid" src='${baseurl}/images/empty.gif' style="max-width:320px;mix-blend-mode:hard-light;">`;
                $("#no-record").append(notfound);
                return;
            }

            // Group by branch name
            const groupedData = {};
            branchesData.forEach((item) => {
                if (!groupedData[item.branch_name]) {
                    groupedData[item.branch_name] = [];
                }
                groupedData[item.branch_name].push(item);
            });

            Object.entries(groupedData).forEach(
                ([branchName, customers], index) => {
                    const swiperId = `swiper-${index}`;
                    let html = `
                    <div class="space-y-4">
                        <div class="swiper my-slider" id="${swiperId}">
                            <div class="flex gap-2 mb-5">
                                <div class="border-b border-[#C7C7C7] mt-6 flex-grow">
                                    <div class="border-b-3 border-[#9D4F2A] max-w-fit pe-10 font-medium pb-2">
                                        ${branchName}
                                    </div>
                                </div>
                                <div class="flex gap-1 items-end relative top-2">
                                    <button class="swiper-prev rotate-180 disabled:opacity-25 cursor-pointer disabled:cursor-none">←</button>
                                    <button class="swiper-next disabled:opacity-25 cursor-pointer disabled:cursor-none">→</button>
                                </div>
                            </div>
                            <div class="swiper-wrapper">
                    `;

                    customers.forEach((item) => {
                        html += `
                        <div class="swiper-slide bg-white max-w-52">
                            <div class="bg-[#FFEDD9] overflow-hidden rounded-lg">
                                <div class="text-[#4E5356] space-y-1 bg-white rounded-lg border border-[#EEE6E2] p-6">
                                    <div class="flex gap-1 items-center">
                                        <span class="w-2 h-2 rounded-full bg-green-500 block"></span>
                                        <span class="text-md">${item.daily_count ?? ""}</span>
                                    </div>
                                    <div class="text-xl font-semibold">${item.name}</div>
                                    <div class="mt-4">
                                        <a href="/customer/${item.customer_id}" class="px-4 py-2 block text-center border cursor-pointer border-gray-300 shadow-md w-full rounded-md text-[#9D4F2A] bg-white hover:bg-[#9D4F2A] hover:text-white">View Details</a>
                                    </div>
                                </div>
                                <div class="text-sm py-2 px-6 text-[#ED3333]">
                                    <span id="timers-${item.customer_id}" data-enter-time="${item.customer_enter_time}" data-customer-id="${item.customer_id}">Loading...</span>
                                    <input type="hidden" name="spent_time_${item.customer_id}" id="spent_timer_${item.customer_id}" value="">
                                </div>
                            </div>
                        </div>
                        `;
                    });

                    html += `
                            </div>
                        </div>
                    </div>
                    `;

                    $("#liveuser").append(html);

                    new Swiper(`#${swiperId}`, {
                        slidesPerView: 2,
                        spaceBetween: 10,
                        navigation: {
                            nextEl: `#${swiperId} .swiper-next`,
                            prevEl: `#${swiperId} .swiper-prev`,
                        },
                        breakpoints: {
                            768: { slidesPerView: 3 },
                            1024: { slidesPerView: 4 },
                        },
                    });
                }
            );

            // ✅ Now start the timers after content is added to DOM
            startTimers();
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        },
    });
}
