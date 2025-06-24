// Trigger on date or showroom change
$("#date").on("change", function () {
    todayRecord();
    showroom();
});

$(".done-button").on("click", function () {
    todayRecord();
    showroom();
});

function todayRecord() {
    const selectedShowrooms = $(".showroom:checked")
        .map(function () {
            return this.value;
        })
        .get();

    const date = $("#date").val();

    $.ajax({
        type: "GET",
        url: "getrecord",
        data: {
            selectedShowrooms: selectedShowrooms.length
                ? selectedShowrooms
                : [],
            date: date,
        },
        dataType: "json",
        success: function (data) {
            console.log(data);

            // $("#totalCustomer").text(data.totalcustomers);
            $("#liveCustomer").text(data.walkincustomer);
            $("#purchasedCustomer").text(data.purchasedCustomer);
            $("#nonPurchasedCustomer").text(data.nonPurchasedCustomer);
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            // Optionally show fallback values or error message to user
        },
    });
}

$(document).ready(function () {
    showroom();
});

$("#purchase").on("click", function () {
    $("#purchasevalue").val("1");
    showroom();
});

$("#nonPurchase").on("click", function () {
    $("#purchasevalue").val("0");
    showroom();
});

function showroom() {
    const selectedShowrooms = $(".showroom:checked")
        .map(function () {
            return this.value;
        })
        .get();

    const date = $("#date").val();
    const purchase = $("#purchasevalue").val();

    // Initialize new DataTable
    $("#showroomTable").DataTable({
        processing: true,
        serverSide: true,
        destroy: true, // Destroy any existing DataTable instance
        responsive: true,
        ajax: {
            url: "showroomdata",
            type: "POST",
            data: {
                selectedShowrooms: selectedShowrooms.length
                    ? selectedShowrooms
                    : [],
                date: date,
                purchase: purchase,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        },
        columns: [
            { data: "branch_name", orderable: false },
            { data: "daily_count" }, // This must exist in your Laravel data, or remove it
            { data: "name" },
            {
                data: "customer_id",
                render: function (data, type, row) {
                    return `<a href="#" class="customer-link no-underline" data-id="${row.customerid}">${data}</a>`;
                },
            },
            { data: "sales_executive_name" },
            { data: "customer_in" },
            { data: "customer_out" },
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
            { data: "is_purchased", orderable: false },
            { data: "is_scheme_redemption", orderable: false },
            { data: "is_scheme_joining", orderable: false },
        ],
    });
}
$(document)
    .off("click", ".customer-link")
    .on("click", ".customer-link", function (e) {
        e.preventDefault();

        const customerId = $(this).data("id");

        // 1. Open the modal
        const modal = document.getElementById("viewHistory");
        if (modal) modal.showModal();

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
