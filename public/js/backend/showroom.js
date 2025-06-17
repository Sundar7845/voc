$(document).ready(function () {
    showroom();
});

function showroom() {
    const selectedShowrooms = $(".showroom:checked")
        .map(function () {
            return this.value;
        })
        .get();

    const date = $("#date").val();

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
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        },
        columns: [
            { data: "branch_name", orderable: false }, // <- comes from addColumn in Laravel
            { data: "daily_count" }, // Optional if you plan to support this
            { data: "name" },
            { data: "sales_executive_name" },
            { data: "customer_in_out" }, // <- comes from addColumn in Laravel
            { data: "spent_time" },
            { data: "is_purchased", orderable: false }, // <- also from addColumn in Laravel
        ],
    });
}

// Trigger on date or showroom change
$("#date").on("change", showroom);
$(".done-button").on("click", showroom);
