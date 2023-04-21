function fetchCategory() {
    fetch(`../src/controllers/rateRouter.php?fetchCategory="ok"`)

        .then((response) => {
            return response.json()
        })
        .then((category) => {
            const categoryDiv = document.getElementById('categoryDiv');
            category.forEach(cat => {
                const label = document.createElement('label');
                label.setAttribute('for', cat.category_pro);
                label.textContent = cat.category_pro;

                const input = createCheckbox(cat.category_pro);

                categoryDiv.appendChild(input);
                categoryDiv.appendChild(label);


                input.addEventListener('change', (event) => {
                    postCategory();

                });
            });
        });
}

function createCheckbox(category) {
    const input = document.createElement('input');
    input.setAttribute('type', 'checkbox');
    input.setAttribute('id', category);
    input.setAttribute('name', category);

    input.addEventListener('click', () => {

        const checkboxes = document.querySelectorAll('#categoryDiv input[type="checkbox"]');
        checkboxes.forEach((checkbox) => {
            if (checkbox !== input) {
                checkbox.checked = false;
            }
        });
        postCategory();
    });

    return input;
}

function postCategory() {
    const checkbox = document.querySelector('#categoryDiv input[type="checkbox"]:checked');
    const categories = checkbox ? checkbox.getAttribute('name') : null;

    let data = new FormData();
    data.append("displayCategory", categories);
    fetch('../src/controllers/rateRouter.php', {
        method: 'POST',
        body: data,

    })
        .then((response) => {
            return response.json();
        })
        .then((product) => {
            console.log(product)
            let shop = document.querySelector("#shop")
            let html = ""; // Initialiser la variable html avec une chaîne vide
            product.forEach((item) => {
        
                const rating = item.avg_rating;
                const starRating = getStarRating(rating);
        
                html += `
                    <div class="displayShop">
                        <div class ="productDisplay">
                            <img src="../uploads/${item.image_pro}" alt="${item.name_pro}">
                            <h4>${item.name_pro}</h4>
                            <p>${item.category_pro}</p>
                            <p>${item.category_descript}</p>
                            <p>${item.origin_pro}</p>
                            <p>${item.origin_descript}</p>
                            <p id="starRating">${starRating}</p>
                            <p>${item.price_pro}  $ </p>
                            <button><a href="./product.php?idProduct=${item.id_pro}">Voir le produit</a></button>
                        </div>
                    </div>
                `;
            });
            shop.innerHTML = html; // Ajouter le contenu de html à l'élément shop
        });
}     
        
        
        
        
fetchCategory();
