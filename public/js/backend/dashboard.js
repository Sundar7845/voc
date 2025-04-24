// Trigger on date or showroom change
$("#date").on("change", todayRecord);
$(".done-button").on("click", todayRecord);

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
            $("#totalCustomer").text(data.totalcustomers);
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
