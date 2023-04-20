window.addEventListener('DOMContentLoaded', async e => {
const displayCart = document.querySelector('.displayCart');

let html = '';

let response = await fetch('./../src/model/getCart.php')

    let data = await response.json()

    // check if cart is't empty.
    if(data != 'empty id_cart')
    {

        let id_cart;
        let total = 0;
        data.forEach(item => {

            id_cart = item.id_cart;

            
            let price = item.price_pro / 100;
            let totalProduct = price * item.quantity;
            total += price * item.quantity;
            html += `<div class="cart">
                        <p class="displayMessageCart"></p>
                        <a href="product.php?idProduct=${item.id_pro}"><img src="./../uploads/${item.image_pro}" alt="${item.name_pro}"></a>
                        <div class="detailProduct">
                        <a href="product.php?idProduct=${item.id_pro}"><h3>${item.name_pro}</h3></a>
                            <p>${price} Euro</p>

                            <form action="./../src/model/updateCart.php" method="post">
                                <input type="hidden" name="id_product" value="${item.id_pro}">
                                <input type="hidden" name="id_user" value="${item.id_user}">
                                <input type="number" name="product_quantity" value="${item.quantity}">
                                <input type="submit" name="update_cart" value="Quantity"/>
                            </form>
                            <p>${totalProduct.toFixed(2)} Euro</p>
                        </div>
                        <div class="btn-cart">
                            <button><a href="../src/model/deleteCart.php?idProduct=${item.id_pro}">Delete</a></button>
                        </div>
                    </div>`;

        });

        html += `
        <div class="totalCart">
            <p>Total : ${total.toFixed(2)} Euro</p>
        </div>

        <div class="paymentCart">
            <form action="./payment.php" method="post">
                <input type="hidden" name="id_cart" value="${id_cart}">
                <input type="hidden" name="total" value="${total.toFixed(2)}">
                <input type="submit" name="payment_cart" value="Passé Commande"/>
            </form>
        </div>
        `
        
        displayCart.insertAdjacentHTML('beforeend', html);
    }
    else
    {
        displayCart.innerHTML = 'Votre Panier est vide !';
    }
})
