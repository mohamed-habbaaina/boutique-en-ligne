const firstname_div = document.getElementById("firstname_div");
const lastname_div = document.getElementById("lastname_div");
const email_div = document.getElementById("email_div");
const phone_div = document.getElementById("phone_div");
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

function isValidForm(firstname, lastname, email, phone) {
    return (
        isValidName(firstname) &&
        isValidName(lastname) &&
        isValidEmail(email) &&
        isValidPhone(phone)
    )
}

firstname_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidName(value)) {
        firstname_div.style.border = 'solid 1px green';
        console.log(firstname_input.value);
    } else {
        firstname_div.style.border = 'solid 1px red';
    }
})

lastname_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidName(value)) {
        lastname_div.style.border = 'solid 1px green';
    } else {
        lastname_div.style.border = 'solid 1px red';
    }
})

email_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidEmail(value)) {
        email_div.style.border = 'solid 1px green';
    } else {
        email_div.style.border = 'solid 1px red';
    }
})

phone_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidPhone(value)) {
        phone_div.style.border = 'solid 1px green';
    } else {
        phone_div.style.border = 'solid 1px red';
    }
})

const form = document.querySelector('form');
const form_message = document.getElementById('form_message');

console.log(firstname_input.value);
console.log(lastname_input.value);
console.log(email_input.value);
console.log(phone_input.value);

form.addEventListener('submit', (event) => {
    event.preventDefault();

    if (isValidForm(
        firstname_input.value,
        lastname_input.value,
        email_input.value,
        phone_input.value)) {

        const formData = new FormData(form);

        fetch('../src/controllers/contact_control.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (response.ok) {
                    console.log(response);
                    form_message.innerHTML = "Votre message à bien été envoyé";
                } else {
                    form_message.innerHTML = "Une erreur s'est produite";
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
    } else {
        form_message.innerHTML = "Complétez les champs correctement !"
    }
});
