const firstname_input = document.getElementById("firstname_input");
const lastname_input = document.getElementById("lastname_input");
const email_input = document.getElementById("email_input");
const phone_input = document.getElementById("phone_input");

function isValidName(name) {
    const nameRegex = /^[A-Za-z\é\è\ê\-\ ]{2,}$/;
    return name.match(nameRegex);
}

function isValidEmail(email) {
    const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return email.match(emailRegex);
}

function isValidPhone(phone) {
    const phoneRegex = /^0[1-9](\d{2}){4}$/;
    return phone.match(phoneRegex);
}

firstname_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidName(value)) {
        firstname_input.style.border = 'solid 1px green';
    } else {
        firstname_input.style.border = 'solid 1px red';
    }
})

lastname_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidName(value)) {
        lastname_input.style.border = 'solid 1px green';
    } else {
        lastname_input.style.border = 'solid 1px red';
    }
})

email_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidEmail(value)) {
        email_input.style.border = 'solid 1px green';
    } else {
        email_input.style.border = 'solid 1px red';
    }
})

phone_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidPhone(value)) {
        phone_input.style.border = 'solid 1px green';
    } else {
        phone_input.style.border = 'solid 1px red';
    }
})