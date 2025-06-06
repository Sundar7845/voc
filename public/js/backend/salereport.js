$(document).ready(function () {
    $("#salesReportTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: "sales-report",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // For Laravel, adjust as needed for your backend
        },
        columns: [
            { data: "branch_name" },
            { data: "invoice_date" },
            { data: "purchase_location" },
            { data: "article_code" },
            { data: "name" },
            { data: "sku_number" },
            { data: "sales_id" },
            { data: "sales_person" },
            { data: "invoice_id" },
            { data: "grweight" },
            { data: "pcs" },
            { data: "net_chargeable" },
            { data: "sales_qty" },
            { data: "ct_wght" },
            { data: "textbox_33" },
            { data: "customer_id" },
            { data: "cust_name" },
            { data: "cust_phone" },
            { data: "delivery_name" },
            { data: "sales_price" },
            { data: "cvalue" },
            { data: "stud_value" },
            { data: "mk_code" },
            { data: "sale_calc_type" },
            { data: "amt_1" },
            { data: "mk_rate" },
            { data: "mk_value" },
            { data: "makingdisper" },
            { data: "makingdisc" },
            { data: "scheme_discount" },
            { data: "textbox_89" },
            { data: "tax_item_group" },
            { data: "tax_per" },
            { data: "tax_amount" },
            { data: "total_amount" },
            { data: "line_amount" },
            { data: "invoice_amount" },
        ],
    });
});

function downloadExampleSheet() {
    if (window.Laravel && window.Laravel.downloadExampleSheetUrl) {
        window.location.href = window.Laravel.downloadExampleSheetUrl;
    } else {
        console.error("Download URL not defined");
    }
}
