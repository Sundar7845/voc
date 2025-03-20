function storePhoneNumber() {
    let phoneInputs = document.querySelectorAll(".phone");
    let phoneNumber = "";
    phoneInputs.forEach((input) => {
        phoneNumber += input.value;
    });
    document.getElementById("hiddenPhone").value = phoneNumber;
}

// Attach event listener for keyup to all inputs
document.querySelectorAll(".phone").forEach((input) => {
    input.addEventListener("keyup", storePhoneNumber);
});

$(document).ready(function () {
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

function viewCustomerDetails(customerId) {
    customerDetails.showModal();
    $.ajax({
        url: "/get-customer-details", // Adjust URL if needed
        type: "GET",
        data: { customer_id: customerId },
        success: function (response) {
            if (response.status === "success") {
                console.log(response.data); // Log data or display it in a modal
                $("#customerId").val(response.data.id);
                $("#name").val(response.data.name);
                $("#phone").val(response.data.phone_number);
                // Check the radio based on the gender value (M or F)
                $(
                    "input[name='gender'][value='" + response.data.gender + "']"
                ).prop("checked", true);
                $("#email").val(response.data.email);
                $("#date-of-birth").val(response.data.dob);
                $(
                    "input[name='marital-status'][value='" +
                        response.data.martial_status +
                        "']"
                ).prop("checked", true);
                $("#profession")
                    .val(response.data.profession_id)
                    .trigger("change");
                setTimeout(() => {
                    $("#qualification")
                        .val(response.data.qualfication_id)
                        .trigger("change");
                }, 500);
                $("#address").val(response.data.address);
                $("#pincode").val(response.data.pincode);
                $(
                    "input[name='source'][value='" +
                        response.data.know_about +
                        "']"
                ).prop("checked", true);
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
        var gender = $("#gender").val();
        var email = $("#email").val();
        var dob = $("#date-of-birth").val();
        var martial_status = $("#marital-status").val();
        var anniversary_date = $("#anniversary-date").val();
        var profession_id = $("#profession").val();
        var qualification = $("#qualification").val();
        var address = $("#address").val();
        var pincode = $("#pincode").val();
        var source = $("#source").val();
        $.ajax({
            url: "update-customer-details" + id, // Change this to your actual server endpoint
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                phone: phone,
                name: name,
                gender: gender,
                email: email,
                dob: dob,
                martial_status: martial_status,
                anniversary_date: anniversary_date,
                profession_id: profession_id,
                qualification: qualification,
                address: address,
                pincode: pincode,
                source: source,
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
        function updateTimer() {
            const now = new Date();
            const diff = Math.floor((now - customerEnterTime) / 1000);

            const hours = Math.floor(diff / 3600);
            const minutes = Math.floor((diff % 3600) / 60);
            const seconds = diff % 60;

            timer.textContent = `${hours} hrs ${minutes} mins ${seconds} secs`;
        }
        updateTimer();
        setInterval(updateTimer, 1000);
    });
});
