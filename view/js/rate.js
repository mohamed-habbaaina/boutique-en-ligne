const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id_pro = urlParams.get('idProduct');

function fetchRate() {

    fetch(`../src/controllers/rateRouter.php?fetchRate=${id_pro}`)

        .then((response) => {
            return response.json()
        })
        .then((rate) => {
            
            const rateValue = document.querySelector("#rateValue");
            const rating = rate.avg_rate;
            const starRating = getStarRating(rating); 
            rateValue.innerHTML = starRating;
          })
}
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

  
  
  

fetchRate();

const rating = document.querySelector("#rating");
const postRateForm = document.querySelector("#postRateForm")
rating?.addEventListener("change", () => {
    const selectedRating = rating.value;

    let data = new FormData(postRateForm);
    data.append("id_pro" , id_pro);
    data.append("addRate", "ok");

    fetch("../src/controllers/rateRouter.php", {
        method: "POST",
        body: data,
    })
    .then((response) => {
        return response.text();
    })
    .then((content) => {
        fetchRate();

    })
})




