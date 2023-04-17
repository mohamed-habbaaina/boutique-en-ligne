/******************* get all products **********************/
/***********************************************************/
window.addEventListener('DOMContentLoaded', async () =>{

    let shop = document.querySelector('.shop');
    const btnSuivant = document.querySelector('.btnSuivant');
    
    let response = await fetch('./../src/model/shop.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: shop
    });
    
    let data = await response.json();
    
        //! display button Page suivante return: if products < 8 => button display: none
        //   btnSuivant.style.display = data.length < 8 ? 'none' : 'block';
    
        let html = '';
    
        if(data.length > 0){
    
    
            data.forEach(item => {
                console.log(item)
                // Format rate eg: 4.666666 => 4.66 & Handled when item.avg_rating === 'null';
                let rate = item.avg_rating;
                let formatRate;
    
                if(rate){
                    formatRate = parseFloat(rate).toFixed(2)
                } else{
                    formatRate = '5'
                }
    
                html += `
                    <div class="displayShop">
                        <div class ="productDisplay">
                            <img src="../uploads/${item.image_pro}" alt="${item.name_pro}">
                            <h3>${item.name_pro}</h3>
                            <p>${item.category_pro}</p>
                            <p>${item.category_descript}</p>
                            <p>${item.origin_pro}</p>
                            <p>${item.origin_descript}</p>
                            <p>${formatRate} ###</p>
                            <p>${item.price_pro}  $ </p>
                            <button><a href="./product.php?idProduct=${item.id_pro}">Voir le produit</a></button>
                        </div>
                    </div>
                `;
    
            });
    
        } else{
    
            alert('Revenir à la page précédente !');
    
            html += `
                    <div class="displayShop">
                        <p>Revenir à la page précédente !</p>
                    </div>
                `;
        }
    
        shop.insertAdjacentHTML('beforeend', html);
    
    })
    