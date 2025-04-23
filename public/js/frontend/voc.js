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
        var know_about_others = $("#know_about_others").val();

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
                know_about_others: know_about_others,
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
        var jewellery = $(
            "input[name='jewelleryDesignQuestion1']:checked"
        ).val();
        var pricing = $("input[name='jewelleryDesignQuestion2']:checked").val();
        var staff = $("input[name='step3Question1']:checked").val();
        var knowledge = $("input[name='step3Question3']:checked").val();
        var assit = $("input[name='step3Question4']:checked").val();
        var nonPurchased = $("input[name='non-purchase-reason']:checked").val();
        var non_purchased_others = $("#non_purchased_others").val();

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
                spentTime: spentTime,
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
