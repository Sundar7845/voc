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

                let bgColor = response.status
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
