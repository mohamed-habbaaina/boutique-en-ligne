window.addEventListener('DOMContentLoaded', e => {
const displayCart = document.querySelector('.displayCart');
let html;

fetch('./../src/model/getCart.php')
.then(response => response.json())
.then(data => {

    if(data)
    {
        // console.log(data);


        let total = 0;
        data.forEach(etem => {

            let price = etem.price_pro / 100;
            total += price * etem.quantity;
            html += `<div class="cart">
                <img src="./../uploads/${etem.image_pro}" alt="${etem.name_pro}">
                <div class="detailProduct">
                    <h3>${etem.name_pro}</h3>
                    <p>${price}</p>

                    <form action="./../src/model/updateCart.php" method="post">
                        <input type="hidden" name="id_product" value="${etem.id_pro}">
                        <input type="hidden" name="id_user" value="${etem.id_user}">
                        <input type="number" name="product_quantity" value="${etem.quantity}">
                        <input type="submit" name="update_cart" value="Quantity"/>
                    </form>

                </div>
                <div class="btn-cart">
                    <button><a href="product.php?idProduct=${etem.id_pro}">Detait</a></button>
                    <button><a href="deleteCart.php?idProduct=${etem.id_pro}">Delete</a></button>
                </div>
            </div>`;

        });

        html += `
        <div class="totalCart">
            <p>Total : ${total} Euro</p>
            <form>

            </form>
        </div>
        `
        
        displayCart.insertAdjacentHTML('beforeend', html);
    }
})
})