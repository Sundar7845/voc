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

    document.getElementById("hiddenPhoneNumber").value = phoneNumber;
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
                console.log(response.data); // Log data or display it in a modal
                    
                // Update Alpine's maritalStatus variable
                const maritalStatusWrapper = document.querySelector('[x-ref="maritalStatusWrapper"]');
                Alpine.$data(maritalStatusWrapper).maritalStatus = response.data.martial_status.toString();

                console.log("marriage status",response.data.martial_status)

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
                setTimeout(() => {
                    $("#qualification")
                        .val(response.data.qualfication_id)
                        .trigger("change");
                }, 500);
                $("#address").val(response.data.address);
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

                storeDetailsPhoneNumber();
                storePincode();
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
        var martial_status = $("input[name='marital-status']:checked").val();
        var know_about = $("input[name='source']:checked").val();
        var anniversary_date = $("#anniversary-date").val();
        var profession_id = $("#profession").val();
        var qualification_id = $("#qualification").val();
        var address = $("#address").val();
        var pincode = $("#hiddenPincode").val();
        var source = $("#source").val();
        var phone = $("#hiddenPhoneNumber").val();
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
                qualification_id: qualification_id,
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

            $("#spent_time").val(timer.textContent);
        }
        updateTimer();
        setInterval(updateTimer, 1000);
    });
});
