function storePhoneNumber() {
    let phoneInputs = document.querySelectorAll(".phone");
    let phoneNumber = "";
    phoneInputs.forEach((input) => {
        phoneNumber += input.value;
    });
    document.getElementById("hiddenPhone").value = phoneNumber;
}

function storeDetailsPhoneNumber() {
    let phoneInputs = document.querySelectorAll(".phone_number");
    let phoneNumber = "";
    phoneInputs.forEach((input) => {
        phoneNumber += input.value;
    });

    $("#hiddenPhoneNumber").val(phoneNumber);
}

function storePincode() {
    let pincodeInputs = document.querySelectorAll(".zip");
    let pincode = "";
    pincodeInputs.forEach((input) => {
        pincode += input.value;
    });

    document.getElementById("hiddenPincode").value = pincode;
}
// Attach event listener for keyup to all inputs
document.querySelectorAll(".phone").forEach((input) => {
    input.addEventListener("keyup", storePhoneNumber);
});

// Attach event listener for keyup to all inputs
document.querySelectorAll(".phone_number").forEach((input) => {
    input.addEventListener("keyup", storeDetailsPhoneNumber);
});
// Attach event listener for keyup to all inputs
document.querySelectorAll(".zip").forEach((input) => {
    input.addEventListener("keyup", storePincode);
});

$(document).ready(function () {
    // Check for post-reload click trigger
    const customerIdToClick = sessionStorage.getItem(
        "clickViewDetailsForCustomer"
    );
    if (customerIdToClick) {
        sessionStorage.removeItem("clickViewDetailsForCustomer"); // Clear after use
        const btn = document.getElementById(
            `viewDetailsBtn-${customerIdToClick}`
        );
        if (btn) {
            btn.click();
        }
    }
    // Handle form submission via AJAX
    $("#add-customer-form").submit(function (e) {
        var phone = $("#hiddenPhone").val();
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            url: "customer-add", // Change this to your actual server endpoint
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                phone: phone,
            },
            dataType: "json",
            success: function (response) {
                console.log(response);

                let bgColor =
                    response.status == "success"
                        ? "linear-gradient(to right, #00b09b, #96c93d)"
                        : "linear-gradient(to right, #ff416c, #ff4b2b)"; // Green for success, red for error

                Toastify({
                    text: response.message,
                    className: response.status ? "success" : "error",
                    close: true,
                    duration: 3000,
                    style: {
                        background: bgColor,
                    },
                }).showToast();
                if (response.status == "success") {
                    // 👇 Set this to auto-click after reload
                    sessionStorage.setItem(
                        "clickViewDetailsForCustomer",
                        response.customerId
                    );
                    window.location.reload();
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);

                Toastify({
                    text: "An error occurred while submitting the form.",
                    className: "error",
                    close: true,
                    duration: 3000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
            },
        });
    });
});

function viewCustomerDetails(customerId) {
    const form = document.getElementById("customer-details-form");
    const phoneInputs = form.querySelectorAll(".phone_number.input-box");
    const zipInputs = form.querySelectorAll(".zip.input-box");
    createInputHandlers(phoneInputs, 10);
    createInputHandlers(zipInputs, 6);

    customerDetails.showModal();
    $.ajax({
        url: "/get-customer-details", // Adjust URL if needed
        type: "GET",
        data: { customer_id: customerId },
        success: function (response) {
            if (response.status === "success") {
                setTimeout(() => {
                    storeDetailsPhoneNumber();
                    storePincode();
                }, 500);
                console.log(response.data); // Log data or display it in a modal

                // Safely get marital status as a string, fallback to empty string if null
                const maritalStatus =
                    response.data.martial_status !== null
                        ? response.data.martial_status.toString()
                        : "";

                // Then update Alpine's variable only if maritalStatusWrapper is available
                const maritalStatusWrapper = document.querySelector(
                    '[x-ref="maritalStatusWrapper"]'
                );
                if (
                    maritalStatusWrapper &&
                    Alpine.$data(maritalStatusWrapper)
                ) {
                    Alpine.$data(maritalStatusWrapper).maritalStatus =
                        maritalStatus;
                    console.log("marriage status", maritalStatus);
                }

                $("#customerId").val(response.data.id);
                $("#name").val(response.data.name);
                // ✅ Fill phone number into individual boxes
                const phoneNumber = response.data.phone_number.split("");
                $(".phone_number").each(function (index) {
                    $(this).val(phoneNumber[index] || ""); // Ensure it doesn't break if fewer than 10 digits
                });

                // Check the radio based on the gender value (M or F)
                $(
                    "input[name='gender'][value='" + response.data.gender + "']"
                ).prop("checked", true);
                $("#email").val(response.data.email);
                $("#date-of-birth").val(response.data.dob);
                $("#anniversary-date").val(response.data.anniversary_date);
                $(
                    "input[name='marital-status'][value='" +
                        response.data.martial_status +
                        "']"
                ).prop("checked", true);
                $(
                    "input[name='source'][value='" +
                        response.data.know_about +
                        "']"
                ).prop("checked", true);
                $("#profession")
                    .val(response.data.profession_id)
                    .trigger("change");
                $("#address").val(response.data.address);
                // $("#address2").val(response.data.address_line_1);
                // ✅ Fill phone number into individual boxes
                const pincode = response.data.pincode.split("");
                $(".zip").each(function (index) {
                    $(this).val(pincode[index] || ""); // Ensure it doesn't break if fewer than 10 digits
                });
                $(
                    "input[name='source'][value='" +
                        response.data.know_about +
                        "']"
                ).prop("checked", true);
                if (response.data.know_about == "others") {
                    $("#others").parent().addClass("md:col-span-2");

                    // Remove the inline "display: none;" style from the div wrapping the textarea
                    $("#know_about_others")
                        .closest("div[style]")
                        .removeAttr("style");

                    $("#know_about_others").text(
                        response.data.know_about_others
                    );
                }
                if (response.data.know_about == "referred") {
                    $("#referred").parent().addClass("md:col-span-2");

                    // Remove the inline "display: none;" style from the div wrapping the textarea
                    $("#reference").closest("div[style]").removeAttr("style");

                    $("#reference").text(response.data.reference);
                }
            } else {
                alert("No details found!");
            }
        },
        error: function () {
            alert("Something went wrong. Please try again.");
        },
    });
}

//CUSOMTER UPDATE
$(document).ready(function () {
    // Handle form submission via AJAX
    $("#customer-details-form").submit(function (e) {
        e.preventDefault(); // Prevent default form submission
        var id = $("#customerId").val();
        var name = $("#name").val();
        var gender = $("input[name='gender']:checked").val();
        var email = $("#email").val();
        var dob = $("#date-of-birth").val();
        var martial_status = $("input[name='marital-status']:checked").val();
        var know_about = $("input[name='source']:checked").val();
        var anniversary_date = $("#anniversary-date").val();
        var profession_id = $("#profession").val();
        var address = $("#address").val();
        var address2 = $("#address2").val();
        var pincode = $("#hiddenPincode").val();
        var source = $("#source").val();
        var phone = $("#hiddenPhoneNumber").val();
        var know_about_others = $("#know_about_others").val();
        var reference = $("#reference").val();

        $.ajax({
            url: "update-customer-details/" + id, // Change this to your actual server endpoint
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                phone: phone,
                name: name,
                gender: gender,
                email: email,
                know_about: know_about,
                dob: dob,
                martial_status: martial_status,
                anniversary_date: anniversary_date,
                profession_id: profession_id,
                address: address,
                address2: address2,
                pincode: pincode,
                source: source,
                know_about_others: know_about_others,
                reference: reference,
            },
            dataType: "json",
            success: function (response) {
                console.log(response);

                let bgColor =
                    response.status == "success"
                        ? "linear-gradient(to right, #00b09b, #96c93d)"
                        : "linear-gradient(to right, #ff416c, #ff4b2b)"; // Green for success, red for error

                Toastify({
                    text: response.message,
                    className: response.status ? "success" : "error",
                    close: true,
                    duration: 3000,
                    style: {
                        background: bgColor,
                    },
                }).showToast();

                window.location.reload();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);

                Toastify({
                    text: "An error occurred while submitting the form.",
                    className: "error",
                    close: true,
                    duration: 3000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
            },
        });
    });
});

//Spent time
document.addEventListener("DOMContentLoaded", function () {
    const timers = document.querySelectorAll('[id^="timer-"]');

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
                `#spent_time_${timer.dataset.customerId}`
            );
            if (spentTimeInput) {
                spentTimeInput.value = timeText;
            }
        }
        updateTimer();
        setInterval(updateTimer, 1000);
    });
});

function getFeedback(id) {
    const modal = document.getElementById("getFeedback");
    if (modal) {
        modal.showModal();
    } else {
        console.error("Modal not found!");
    }

    $("#feedbackCustomerId").val(id);
}
//CUSOMTER UPDATE
$(document).ready(function () {
    // Handle form submission via AJAX
    $("#getFeedbackForm").submit(function (e) {
        e.preventDefault(); // Prevent default form submission
        var id = $("#feedbackCustomerId").val();
        var spentTime = $("#spent_time_" + id).val();
        var salesExcutiveName = $("#salesExcutiveName").val();
        var customerType = $("input[name='customerType']:checked").val();
        var scheme = $("input[name='scheme-redemption']:checked").val() ?? 0;
        var jewellery = $(
            "input[name='jewelleryDesignQuestion1']:checked"
        ).val();
        var pricing = $("input[name='jewelleryDesignQuestion2']:checked").val();
        var staff = $("input[name='step3Question1']:checked").val();
        var knowledge = $("input[name='step3Question3']:checked").val();
        var assit = $("input[name='step3Question4']:checked").val();
        var nonPurchased =
            $("input[name='non-purchase-reason']:checked").val() ?? 0;
        var non_purchased_others = $("#non_purchased_others").val();

        if (customerType === 3) {
            var schemejoining = $(
                "input[id='schemejoining-customer']:checked"
            ).val();
        }
        $.ajax({
            url: "feedback/" + id, // Change this to your actual server endpoint
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                salesExcutiveName: salesExcutiveName,
                customerType: customerType,
                jewellery: jewellery,
                pricing: pricing,
                staff: staff,
                knowledge: knowledge,
                assit: assit,
                nonPurchased: nonPurchased,
                non_purchased_others: non_purchased_others,
                scheme: scheme,
                spentTime: spentTime,
                schemejoining: schemejoining,
            },
            dataType: "json",
            success: function (response) {
                console.log(response);

                let bgColor =
                    response.status == "success"
                        ? "linear-gradient(to right, #00b09b, #96c93d)"
                        : "linear-gradient(to right, #ff416c, #ff4b2b)"; // Green for success, red for error

                Toastify({
                    text: response.message,
                    className: response.status ? "success" : "error",
                    close: true,
                    duration: 3000,
                    style: {
                        background: bgColor,
                    },
                }).showToast();

                window.location.reload();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);

                Toastify({
                    text: "An error occurred while submitting the form.",
                    className: "error",
                    close: true,
                    duration: 3000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
            },
        });
    });
});

function viewHistory(id) {
    const modal = document.getElementById("viewHistory");
    if (modal) {
        modal.showModal();
    }

    $.irunthajax({
        url: "/get-passed-history/" + id,
        type: "GET",
        data: { customerId: id },
        success: function (response) {
            console.log(response);

            // Get customer info from first report
            const firstEntry = Object.values(response.response)[0];
            const firstReport = firstEntry[0]; // First report in the first entry
            const customerId = firstReport?.customer?.customer_id ?? "";
            const customerName = firstReport?.customer?.name ?? "";
            const customerPhone = firstReport?.customer?.phone_number ?? "";
            $("#customer-id").text(customerId);
            $("#customer-name").text(customerName);
            $("#customer-phone").text(customerPhone);

            if (response.status === "success") {
                let historyTableHtml = "";
                let serial = 1;
                let rowIndex = 1;

                for (const [visitDate, reports] of Object.entries(
                    response.response
                )) {
                    const customerType =
                        reports.length > 0 ? "Purchased" : "Non-Purchased";

                    const walkinCustomerId =
                        reports[0]?.walkin_customer?.id ?? null;

                    const feedback = `
                            <button class="cursor-pointer" onclick="getFeedbackDetail(${walkinCustomerId})">
                                Feedback
                            </button>`;

                    historyTableHtml += `
                        <tr class="border-b border-[#C7C7C7]">
                            <td class="px-4 py-2">${serial++}</td>
                            <td class="px-4 py-2">${visitDate}</td>
                            <td class="px-4 py-2">${customerType}</td>
                            <td class="px-4 py-2">${feedback}</td>
                            <td class="px-4 py-2">
                                <button 
                                    class="text-sm text-[#9D4F2A] bg-transparent border border-[#9D4F2A] px-4 py-1 rounded-2xl cursor-pointer"
                                    @click="openRow = openRow === ${rowIndex} ? null : ${rowIndex}">
                                    View Details
                                </button>
                            </td>
                        </tr>

                        <tr x-show="openRow === ${rowIndex}" x-cloak class="bg-gray-50">
                            <td colspan="5">
                                <div class="p-4 overflow-x-auto max-w-3xl">
                                    <table class="table text-center text-xs">
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
                                        <tbody>`;

                    for (const report of reports) {
                        historyTableHtml += `
                            <tr class="border-t border-[#E0E0E0]">
                                <td class="p-2">${report.branch_name}</td>
                                <td class="p-2">${report.invoice_date}</td>
                                <td class="p-2">${report.purchase_location}</td>
                                <td class="p-2">${report.article_code}</td>
                                <td class="p-2">${report.name}</td>
                                <td class="p-2">${report.sku_number}</td>
                                <td class="p-2">${report.sales_id}</td>
                                <td class="p-2">${report.sales_person}</td>
                                <td class="p-2">${report.invoice_id}</td>
                                <td class="p-2">${report.grweight}</td>
                                <td class="p-2">${report.pcs}</td>
                                <td class="p-2">${report.net_chargeable}</td>
                                <td class="p-2">${report.sales_qty}</td>
                                <td class="p-2">${report.ct_wght}</td>
                                <td class="p-2">${report.textbox_33}</td>
                                <td class="p-2">${report.customer?.customer_id}</td>
                                <td class="p-2">${report.cust_name}</td>
                                <td class="p-2">${report.cust_phone}</td>
                                <td class="p-2">${report.delivery_name}</td>
                                <td class="p-2">${report.sales_price}</td>
                                <td class="p-2">${report.cvalue}</td>
                                <td class="p-2">${report.stud_value}</td>
                                <td class="p-2">${report.mk_code}</td>
                                <td class="p-2">${report.sale_calc_type}</td>
                                <td class="p-2">${report.amt_1}</td>
                                <td class="p-2">${report.mk_rate}</td>
                                <td class="p-2">${report.mk_value}</td>
                                <td class="p-2">${report.makingdisper}</td>
                                <td class="p-2">${report.makingdisc}</td>
                                <td class="p-2">${report.scheme_discount}</td>
                                <td class="p-2">${report.textbox_89}</td>
                                <td class="p-2">${report.tax_item_group}</td>
                                <td class="p-2">${report.tax_per}</td>
                                <td class="p-2">${report.tax_amount}</td>
                                <td class="p-2">${report.total_amount}</td>
                                <td class="p-2">${report.line_amount}</td>
                                <td class="p-2">${report.invoice_amount}</td>
                            </tr>`;
                    }

                    historyTableHtml += `
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>`;
                    rowIndex++;
                }

                // Inject HTML
                $("#history").html(historyTableHtml);
                // Alpine.discoverUninitializedComponents(() => {
                Alpine.initTree(modal);
                // });
            }
        },
        error: function () {
            alert("Something went wrong. Please try again.");
        },
    });
}

function getFeedbackDetail(id) {
    const modal = document.getElementById("getFeedbackdetail");
    if (modal) {
        modal.showModal();
    } else {
        console.error("Modal not found!");
    }

    $("#feedbackCustomerId").val(id);

    $.ajax({
        url: "/getfeedback/" + id, // Change this to your actual server endpoint
        type: "GET",
        data: {
            id: id,
        },
        dataType: "json",
        success: function (response) {
            // Assuming response.jewellery_review contains 1, 2, 3, or 4
            let jewelleryReviewValue =
                response.walkin_customer.jewellery_review;
            let pricingReviewValue = response.walkin_customer.pricing_review;
            let staffReviewValue = response.walkin_customer.staff_review;
            let knowledgeReviewValue = response.walkin_customer.service_review;
            let assitReviewValue = response.walkin_customer.assit_review;

            $(
                "input[name='jewelleryDesignQuestion1'][value='" +
                    jewelleryReviewValue +
                    "']"
            ).prop("checked", true);
            $(
                "input[name='jewelleryDesignQuestion2'][value='" +
                    pricingReviewValue +
                    "']"
            ).prop("checked", true);
            $(
                "input[name='salesExecutiveQuestion1'][value='" +
                    staffReviewValue +
                    "']"
            ).prop("checked", true);
            $(
                "input[name='salesExecutiveQuestion2'][value='" +
                    knowledgeReviewValue +
                    "']"
            ).prop("checked", true);
            $(
                "input[name='salesExecutiveQuestion3'][value='" +
                    assitReviewValue +
                    "']"
            ).prop("checked", true);
        },
        error: function (xhr, status, error) {},
    });
}

$(document).ready(function () {
    bdaylist(); // Initialize birthday list on page load
    anniversaeylist(); // Initialize anniversary list on page load
    // Bind the change event correctly
    $(document).on("change", "#date", function () {
        console.log("Date changed:", $(this).val()); // ✅ Test log
        customerList();
    });
    $(document).on("change", "#bdaydate", function () {
        console.log("Date changed:", $(this).val()); // ✅ Test log
        bdaylist();
    });
    $(document).on("change", "#anniversarydate", function () {
        console.log("Date changed:", $(this).val()); // ✅ Test log
        anniversaeylist();
    });

    function bdaylist() {
        const bdaydate = $("#bdaydate").val();
        bdaytable = $("#customerBdayListTable").DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            ordering: false, // Disable sorting for all columns
            ajax: {
                url: "voc",
                data: {
                    type: "birthday",
                    bdaydate: $("#bdaydate").val(),
                },
            },
            columns: [
                { data: "branch_name" },
                { data: "name" },
                { data: "phone_number" },
                { data: "dob" },
                { data: "action" },
            ],
        });
    }

    function anniversaeylist() {
        const anniversarydate = $("#anniversarydate").val();
        anniversaryTable = $("#anniversaryListTable").DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            ordering: false, // Disable sorting for all columns
            ajax: {
                url: "voc",
                data: {
                    type: "anniversary",
                    anniversarydate: anniversarydate,
                },
            },
            columns: [
                { data: "branch_name" },
                { data: "name" },
                { data: "phone_number" },
                { data: "anniversary_date" },
                { data: "action" },
            ],
        });
    }

    function customerList() {
        const date = $("#date").val();

        $("#customerListTable").DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            ajax: {
                url: "voc",
                type: "GET",
                data: {
                    date: date,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            },
            columns: [
                {
                    data: "branch_name",
                    orderable: false,
                },
                {
                    data: "daily_count",
                }, // This must exist in your Laravel data, or remove it
                {
                    data: "name",
                },
                {
                    data: "phone_number",
                },
                {
                    data: "customer_id",
                    render: function (data, type, row) {
                        return `<a href="#" class="customer-link no-underline text-blue-600" data-id="${row.customerid}">${data}</a>`;
                    },
                },
                {
                    data: "sales_executive_name",
                },
                {
                    data: "customer_in",
                },
                {
                    data: "customer_out",
                },
                {
                    data: "spent_time",
                    render: function (data, type, row) {
                        if (!data || data === "-") return "-";

                        const parts = data.split(":"); // "HH:MM:SS"
                        const hours = parseInt(parts[0]) || 0;
                        const minutes = parseInt(parts[1]) || 0;
                        const seconds = parseInt(parts[2]) || 0;

                        return `${hours} hours ${minutes} mins ${seconds} secs`;
                    },
                },
                {
                    data: "know_about_others",
                    orderable: false,
                },
                {
                    data: "reference",
                    orderable: false,
                },
                {
                    data: "is_purchased",
                    orderable: false,
                },
                {
                    data: "is_scheme_redemption",
                    orderable: false,
                },
                {
                    data: "is_scheme_joining",
                    orderable: false,
                },
            ],
        });
    }

    // Let Alpine initialize before fetching data
    setTimeout(function () {
        customerList();
    }, 500);

    window.openBdayRemarkModal = function (btn, id) {
        // Set hidden input
        document.getElementById("bdaycustomerId").value = id;

        // Get the data-row attribute from the clicked button
        var rowData = btn.getAttribute("data-row"); // this is a JSON string

        // Parse JSON to object
        var row = JSON.parse(rowData);

        // Set the remark input value
        document.getElementById("bdayremark").value = row.birthday_remarks;

        // Open modal
        document.getElementById("addbdayremark").showModal();
    };

    $("#add-bday-remark-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "/add-birthday-remark",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);

                document.getElementById("addbdayremark").close();
                // Reset form
                $("#add-bday-remark-form")[0].reset();

                // Reload DataTable
                bdaytable.ajax.reload(null, false);

                Toastify({
                    text: response.message,
                    close: true,
                    duration: 3000,
                    style: {
                        background:
                            "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                }).showToast();
            },
            error: function () {
                Toastify({
                    text: "Something went wrong!",
                    close: true,
                    duration: 3000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
            },
        });
    });

    window.openAnniversaryRemarkModal = function (btn, id) {
        // Set hidden input
        document.getElementById("anniversarycustomerId").value = id;

        // Get the data-row attribute from the clicked button
        var rowData = btn.getAttribute("data-row"); // this is a JSON string

        // Parse JSON to object
        var row = JSON.parse(rowData);

        // Set the remark input value
        document.getElementById("anniversaryremark").value = row.anniversary_remarks;

        // Open modal
        document.getElementById("addanniversaryremark").showModal();
    };

    $("#add-anniversary-remark-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "/add-anniversary-remark",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);

                document.getElementById("addanniversaryremark").close();
                // Reset form
                $("#add-anniversary-remark-form")[0].reset();

                // Reload DataTable
                bdaytable.ajax.reload(null, false);

                Toastify({
                    text: response.message,
                    close: true,
                    duration: 3000,
                    style: {
                        background:
                            "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                }).showToast();
            },
            error: function () {
                Toastify({
                    text: "Something went wrong!",
                    close: true,
                    duration: 3000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
            },
        });
    });
});

$(document)
    .off("click", ".customer-link")
    .on("click", ".customer-link", function (e) {
        e.preventDefault();

        const customerId = $(this).data("id");
        // $('[x-data="getfeedbackData"]').removeAttr("style");

        // 1. Open the modal
        const modal = document.getElementById("viewHistory");

        if (modal) {
            modal.showModal();
        }

        // 2. Call a function to fetch and display the history
        viewHistory(customerId);
    });

function viewHistory(id) {
    const modal = document.getElementById("viewHistory");
    if (modal) {
        modal.showModal();
    }

    $.ajax({
        url: "/get-passed-history/" + id,
        type: "GET",
        data: { customerId: id },
        success: function (response) {
            if (response.status === "success") {
                $("#customer-id").text(response.customer.customer_id);
                $("#customer-name").text(response.customer.name);
                $("#customer-phone").text(response.customer.phone_number);
                let historyTableHtml = "";
                let serial = 1;
                let rowIndex = 1;

                for (const [visitDate, reports] of Object.entries(
                    response.response
                )) {
                    const customerType =
                        reports.length > 0 ? "Purchased" : "Non-Purchased";

                    const walkinCustomerId =
                        reports[0]?.walkin_customer?.id ?? null;

                    const feedback = `
                            <button class="cursor-pointer" onclick="getFeedbackDetail(${walkinCustomerId})">
                                Feedback
                            </button>`;

                    historyTableHtml += `
                        <tr class="border-b border-[#C7C7C7]">
                            <td class="px-4 py-2">${serial++}</td>
                            <td class="px-4 py-2">${visitDate}</td>
                            <td class="px-4 py-2">${customerType}</td>
                            <td class="px-4 py-2">${feedback}</td>
                            <td class="px-4 py-2">
                                <button 
                                    class="text-sm text-[#9D4F2A] bg-transparent border border-[#9D4F2A] px-4 py-1 rounded-2xl cursor-pointer"
                                    @click="openRow = openRow === ${rowIndex} ? null : ${rowIndex}">
                                    View Details
                                </button>
                            </td>
                        </tr>

                        <tr x-show="openRow === ${rowIndex}" x-cloak class="bg-gray-50">
                            <td colspan="5">
                                <div class="p-4 overflow-x-auto max-w-3xl">
                                    <table class="table text-center text-xs">
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
                                        <tbody>`;

                    for (const report of reports) {
                        historyTableHtml += `
                            <tr class="border-t border-[#E0E0E0]">
                                <td class="p-2">${report.branch_name}</td>
                                <td class="p-2">${report.invoice_date}</td>
                                <td class="p-2">${report.purchase_location}</td>
                                <td class="p-2">${report.article_code}</td>
                                <td class="p-2">${report.name}</td>
                                <td class="p-2">${report.sku_number}</td>
                                <td class="p-2">${report.sales_id}</td>
                                <td class="p-2">${report.sales_person}</td>
                                <td class="p-2">${report.invoice_id}</td>
                                <td class="p-2">${report.grweight}</td>
                                <td class="p-2">${report.pcs}</td>
                                <td class="p-2">${report.net_chargeable}</td>
                                <td class="p-2">${report.sales_qty}</td>
                                <td class="p-2">${report.ct_wght}</td>
                                <td class="p-2">${report.textbox_33}</td>
                                <td class="p-2">${report.customer?.customer_id}</td>
                                <td class="p-2">${report.cust_name}</td>
                                <td class="p-2">${report.cust_phone}</td>
                                <td class="p-2">${report.delivery_name}</td>
                                <td class="p-2">${report.sales_price}</td>
                                <td class="p-2">${report.cvalue}</td>
                                <td class="p-2">${report.stud_value}</td>
                                <td class="p-2">${report.mk_code}</td>
                                <td class="p-2">${report.sale_calc_type}</td>
                                <td class="p-2">${report.amt_1}</td>
                                <td class="p-2">${report.mk_rate}</td>
                                <td class="p-2">${report.mk_value}</td>
                                <td class="p-2">${report.makingdisper}</td>
                                <td class="p-2">${report.makingdisc}</td>
                                <td class="p-2">${report.scheme_discount}</td>
                                <td class="p-2">${report.textbox_89}</td>
                                <td class="p-2">${report.tax_item_group}</td>
                                <td class="p-2">${report.tax_per}</td>
                                <td class="p-2">${report.tax_amount}</td>
                                <td class="p-2">${report.total_amount}</td>
                                <td class="p-2">${report.line_amount}</td>
                                <td class="p-2">${report.invoice_amount}</td>
                            </tr>`;
                    }

                    historyTableHtml += `
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>`;
                    rowIndex++;
                }

                // Inject HTML
                $("#history").html(historyTableHtml);
                // Alpine.discoverUninitializedComponents(() => {
                Alpine.initTree(modal);
                // });
            }
        },
        error: function () {
            alert("Something went wrong. Please try again.");
        },
    });
}

function getFeedbackDetail(id) {
    const modal = document.getElementById("getFeedbackdetail");
    if (modal) {
        modal.showModal();
    } else {
        console.error("Modal not found!");
    }

    $("#feedbackCustomerId").val(id);

    $.ajax({
        url: "/getfeedback/" + id, // Change this to your actual server endpoint
        type: "GET",
        data: {
            id: id,
        },
        dataType: "json",
        success: function (response) {
            // Assuming response.jewellery_review contains 1, 2, 3, or 4
            let jewelleryReviewValue =
                response.walkin_customer.jewellery_review;
            let pricingReviewValue = response.walkin_customer.pricing_review;
            let staffReviewValue = response.walkin_customer.staff_review;
            let knowledgeReviewValue = response.walkin_customer.service_review;
            let assitReviewValue = response.walkin_customer.assit_review;

            $(
                "input[name='jewelleryDesignQuestion1'][value='" +
                    jewelleryReviewValue +
                    "']"
            ).prop("checked", true);
            $(
                "input[name='jewelleryDesignQuestion2'][value='" +
                    pricingReviewValue +
                    "']"
            ).prop("checked", true);
            $(
                "input[name='salesExecutiveQuestion1'][value='" +
                    staffReviewValue +
                    "']"
            ).prop("checked", true);
            $(
                "input[name='salesExecutiveQuestion2'][value='" +
                    knowledgeReviewValue +
                    "']"
            ).prop("checked", true);
            $(
                "input[name='salesExecutiveQuestion3'][value='" +
                    assitReviewValue +
                    "']"
            ).prop("checked", true);
        },
        error: function (xhr, status, error) {},
    });
}
