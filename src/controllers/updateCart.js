const formUpdatCart = document.querySelector('.formUpdatCart');
const displayMessageCart = document.querySelector('.displayMessageCart');
if(formUpdatCart){
formUpdatCart.addEventListener('submit', async (e) => {
    e.preventDefault();

    let formData = new FormData(formUpdatCart);
    let response = await fetch('./../model/updateCart.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: formData
    });
    let data = await response.json();
    console.log(data);
})
}