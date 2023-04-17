// Sélection des élements
const forms = document.querySelectorAll('form');

// Écouter les évènements
forms.forEach(form => form.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    console.log(formData);
    fetch("../src/controllers/userRouter.php", {
        method: 'POST',
        body: formData
    })
}))