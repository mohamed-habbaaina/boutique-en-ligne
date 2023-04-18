const formCart = document.forms['formCart'];
const displayCart = document.querySelector('.displayCart');

formCart.addEventListener('submit', async (eve) => {
    eve.preventDefault();

    let formdata = new FormData(formCart);
    let res = await fetch('./../src/model/add_cart.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            // 'Content-Type': 'application/json'
        },
        body: formdata
    });
    let response = await res.json();


    displayCart.innerHTML = response;
})