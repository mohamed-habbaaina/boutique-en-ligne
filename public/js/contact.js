// On récupère les éléments du DOM pour les divs et les inputs
const firstname_div = document.getElementById("firstname_div");
const lastname_div = document.getElementById("lastname_div");
const email_div = document.getElementById("email_div");
const phone_div = document.getElementById("phone_div");
const firstname_input = document.getElementById("firstname_input");
const lastname_input = document.getElementById("lastname_input");
const email_input = document.getElementById("email_input");
const phone_input = document.getElementById("phone_input");

// Fonction pour vérifier si un nom est valide (au moins 2 caractères et uniquement des lettres, des espaces, des tirets et des accents)
function isValidName(name) {
    const nameRegex = /^[A-Za-z\é\è\ê\-\ ]{2,}$/;
    return name.match(nameRegex);
}

// Fonction pour vérifier si un email est valide
function isValidEmail(email) {
    const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return email.match(emailRegex);
}

// Fonction pour vérifier si un numéro de téléphone est valide (format français)
function isValidPhone(phone) {
    const phoneRegex = /^0[1-9](\d{2}){4}$/;
    return phone.match(phoneRegex);
}

// Fonction pour vérifier si le formulaire est valide (tous les champs sont valides)
function isValidForm(firstname, lastname, email, phone) {
    return (
        isValidName(firstname) &&
        isValidName(lastname) &&
        isValidEmail(email) &&
        isValidPhone(phone)
    )
}

// On ajoute un écouteur d'événement sur l'input du prénom pour vérifier sa validité en temps réel
firstname_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidName(value)) {
        // Si le prénom est valide, on change la bordure de la div en vert
        firstname_div.style.border = 'solid 2px green';
    } else {
        // Sinon, on change la bordure de la div en rouge
        firstname_div.style.border = 'solid 2px red';
    }
})

// On ajoute un écouteur d'événement sur l'input du nom pour vérifier sa validité en temps réel
lastname_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidName(value)) {
        // Si le nom est valide, on change la bordure de la div en vert
        lastname_div.style.border = 'solid 2px green';
    } else {
        // Sinon, on change la bordure de la div en rouge
        lastname_div.style.border = 'solid 2px red';
    }
})

// On ajoute un écouteur d'événement sur l'input de l'email pour vérifier sa validité en temps réel
email_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidEmail(value)) {
        // Si l'email est valide, on change la bordure de la div en vert
        email_div.style.border = 'solid 2px green';
    } else {
        // Sinon, on change la bordure de la div en rouge
        email_div.style.border = 'solid 2px red';
    }
})

// On ajoute un écouteur d'événement sur l'input du téléphone pour vérifier sa validité en temps réel
phone_input.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidPhone(value)) {
        // Si le téléphone est valide, on change la bordure de la div en vert
        phone_div.style.border = 'solid 2px green';
    } else {
        // Sinon, on change la bordure de la div en rouge
        phone_div.style.border = 'solid 2px red';
    }
})

// On récupère l'élément du formulaire et l'élément pour afficher les messages du formulaire
const message_form = document.querySelector('#message_form');
const form_message = document.getElementById('form_message');

// On ajoute un écouteur d'événement sur la soumission du formulaire
message_form.addEventListener('submit', (event) => {
    // On empêche le comportement par défaut de la soumission du formulaire
    event.preventDefault();

    // On vérifie si le formulaire est valide
    if (isValidForm(
        firstname_input.value,
        lastname_input.value,
        email_input.value,
        phone_input.value)) {

        // Si le formulaire est valide, on crée un objet FormData avec les données du formulaire
        const formData = new FormData(message_form);

        // On envoie les données du formulaire au serveur via une requête POST en utilisant fetch
        fetch('../src/controllers/contact_router.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                console.log(response);
                if (response.status === 200) {
                    form_message.innerHTML = "Votre message à été envoyé";
                } else {
                    // Sinon, on affiche un message d'erreur
                    form_message.innerHTML = "La requête renvoie un code de status " + response.status + ".";
                }
            })
            .catch(error => {
                // En cas d'erreur lors de l'envoi de la requête, on affiche un message d'erreur dans la console
                console.error('Erreur:', error);
            });
    } else {
        // Si le formulaire n'est pas valide, on affiche un message d'erreur
        form_message.innerHTML = "Complétez les champs correctement !"
    }
});
