/******************* get all products **********************/
/***********************************************************/
window.addEventListener('DOMContentLoaded', async () =>{

    let shop = document.querySelector('.shop');
    const btnSuivant = document.querySelectorAll('.next_button');
    
    let response = await fetch('./../src/model/shop.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: shop
    });
    
    let data = await response.json();
    
        // display button Page suivante return: if products < 8 => button display: none
          btnSuivant[0].style.display = data.length < 8 ? 'none' : 'block';
          btnSuivant[1].style.display = data.length < 8 ? 'none' : 'block';

    
        let html = '';
    
        if(data.length > 0){
    
            data.forEach(item => {
                
                console.log(data);
                const rating = item.avg_rating;
                const starRating = getStarRating(rating); 
                let price = item.price_pro /100 ;
                price = price.toFixed(2);
                console.log(item)
                html += `
                    <div class="displayShop">
                    <a href="./product.php?idProduct=${item.id_pro}"><img src="../uploads/${item.image_pro}" alt="${item.name_pro}"></a>
                    <div class ="productDisplay">
                        <a href="./product.php?idProduct=${item.id_pro}"><h3>${item.name_pro}</h3></a>
                            <p>${item.description_pro}</p>
                            <p>${item.category_pro}</p>
                            
                            <p>${item.origin_pro}</p>
                            
                            <p class="starRating">${starRating}</p>
                            <p class="priceShop">${price}  $ </p>
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
    
    function getStarRating(rating) {
        const maxRating = 5; 
        const fullStarCount = Math.floor(rating);
        const halfStarCount = Math.round(rating - fullStarCount); 
        const emptyStarCount = maxRating - fullStarCount - halfStarCount;
        let starRating = '';
        
        if (fullStarCount >= 1) {
            for (let i = 0; i < fullStarCount; i++) {
                starRating += '<i class="fas fa-star"></i>';
            }
            
            for (let i = 0; i < halfStarCount; i++) {
                starRating += '<i class="fas fa-star-half-alt"></i>';
            }
            
            for (let i = 0; i < emptyStarCount; i++) {
                starRating += '<i class="far fa-star"></i>';
            }
        }
      
        return starRating;
      }

