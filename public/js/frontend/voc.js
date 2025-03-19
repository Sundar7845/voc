function storePhoneNumber() {
    let phoneInputs = document.querySelectorAll('.phone');
    let phoneNumber = '';
    phoneInputs.forEach(input => {
        phoneNumber += input.value;
    });
    document.getElementById('hiddenPhone').value = phoneNumber;
}

// Attach event listener for keyup to all inputs
document.querySelectorAll('.phone').forEach(input => {
    input.addEventListener('keyup', storePhoneNumber);
});