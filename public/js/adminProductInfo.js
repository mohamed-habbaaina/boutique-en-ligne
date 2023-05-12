// Sélection des élements
const forms = document.querySelectorAll('form');

// Écouter les évènements
forms.forEach(form => form.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(form);    
    
    fetch("../src/controllers/productRouter.php", {
        method: 'POST',
        body: formData
    }).then(r => {
        if (r.ok) {
            const main = document.querySelector('main');
            main.innerText = "updating..."
            setTimeout(() => {
                window.location.reload();
            },1500);
        }
    })
}))