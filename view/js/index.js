function fetchRate() {

    fetch(`../src/controllers/rateRouter.php?mostLiked="ok"`)

        .then((response) => {
            return response.json()
        })
        .then((rates) => {

           
            const container = document.querySelector('.grid-container');
            container.innerHTML = ''; // clear previous contents of container
            rates.forEach((product) => {
              const div = document.createElement('div');
              const rating = product.rate_avg;
              const starRating = getStarRating(rating); 
              
              div.classList.add('gridProduct');
              div.innerHTML = `
                <div class="productImg">
                    <img src="./../uploads/${product.image_pro}" alt="${product.name_pro}">
                </div>
                <div class=">productTitle">
                    <h3>${product.name_pro}</h3>
                </div>
                <div class="productInfo">
                    <div class=">productPrice">
                        <p id="productPrice">${product.price_pro} €</p>
                    </div>
                    <div class=">productOrigin">${product.origin_pro}</div>
                    <div class=">productCategory">${product.category_pro}</div>
                    <div class=">productWeight" id="starRating">${starRating}</div>
                    <div class="seeMore">
                        <a href="product.php?idProduct=${product.id_pro}">see more...</a>
                    </div>
                </div>

              `;
              container.appendChild(div);
            });
          });
           
            
            
}
fetchRate();

function getStarRating(rating) {
    const maxRating = 5; // maximum rating for the star system
    const fullStarCount = Math.floor(rating); // number of full stars
    const halfStarCount = Math.round(rating - fullStarCount); // number of half stars
    const emptyStarCount = maxRating - fullStarCount - halfStarCount; // number of empty stars
    let starRating = '';
  
    // add full stars
    for (let i = 0; i < fullStarCount; i++) {
      starRating += '<i class="fas fa-star"></i>';
    }
  
    // add half stars
    for (let i = 0; i < halfStarCount; i++) {
      starRating += '<i class="fas fa-star-half-alt"></i>';
    }
  
    // add empty stars
    for (let i = 0; i < emptyStarCount; i++) {
      starRating += '<i class="far fa-star"></i>';
    }
  
    return starRating;
  }