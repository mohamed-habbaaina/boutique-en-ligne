/******************* get all products **********************/
/***********************************************************/
window.addEventListener('DOMContentLoaded', async () =>{

    let shop = document.querySelector('.shop');
    const btnSuivant = document.querySelector('#btn_suivant');
    
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
          btnSuivant.style.display = data.length < 8 ? 'none' : 'block';
    
        let html = '';
    
        if(data.length > 0){
    
            data.forEach(item => {
                
                const rating = item.avg_rating;
                const starRating = getStarRating(rating); 
                
                html += `
                    <div class="displayShop">
                        <div class ="productDisplay">
                        <a href="./product.php?idProduct=${item.id_pro}"><img src="../uploads/${item.image_pro}" alt="${item.name_pro}"></a>
                        <a href="./product.php?idProduct=${item.id_pro}"><h3>${item.name_pro}</h3></a>
                            <p>${item.category_pro}</p>
                            <p>${item.category_descript}</p>
                            <p>${item.origin_pro}</p>
                            <p>${item.origin_descript}</p>
                            <p class="starRating">${starRating}</p>
                            <p>${item.price_pro}  $ </p>
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
  
        for (let i = 0; i < fullStarCount; i++) {
          starRating += '<i class="fas fa-star"></i>';
        }
      
        for (let i = 0; i < halfStarCount; i++) {
          starRating += '<i class="fas fa-star-half-alt"></i>';
        }
      
        for (let i = 0; i < emptyStarCount; i++) {
          starRating += '<i class="far fa-star"></i>';
        }
      
        return starRating;
      }

