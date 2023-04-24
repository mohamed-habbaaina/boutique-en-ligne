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


        input.addEventListener('change', () => {
          postFilter();

        });
      });
    });
}

function fetchOrigin() {
  fetch(`../src/controllers/rateRouter.php?fetchOrigin="ok"`)

    .then((response) => {
      return response.json()
    })
    .then((origin) => {
      const originDiv = document.getElementById('originDiv');
      origin.forEach(ori => {
        const label = document.createElement('label');
        label.setAttribute('for', ori.origin_pro);
        label.textContent = ori.origin_pro;

        const input = createCheckbox(ori.origin_pro);

        originDiv.appendChild(input);
        originDiv.appendChild(label);


        input.addEventListener('change', (event) => {
          postFilter();

        });
      });
    });
}

function postFilter() {
  const checkboxesCategory = document.querySelectorAll('#categoryDiv input[type="checkbox"]');
  const checkboxesOrigin = document.querySelectorAll('#originDiv input[type="checkbox"]');
  
  let allCategories = [];
  let allOrigins = [];

  let checkedCategories = [];
  if (checkboxesCategory.length > 0) {
    checkboxesCategory.forEach(category => {
      if (category.checked) {
        checkedCategories.push(category.getAttribute('name'));
      }
      allCategories.push(category.getAttribute('name'));
    })
  }

  let checkedOrigins = [];
  if (checkboxesOrigin.length > 0) {
    checkboxesOrigin.forEach(origin => {
      if (origin.checked) {
        checkedOrigins.push(origin.getAttribute('name'));
      }
      allOrigins.push(origin.getAttribute('name'));
    })
  }

  categoriesToDisplay = checkedCategories.length === 0 ? allCategories : checkedCategories;
  originsToDisplay = checkedOrigins.length === 0 ? allOrigins : checkedOrigins;

  let data = new FormData();
  data.append("filterCategory", categoriesToDisplay);
  data.append("filterOrigin", originsToDisplay);
  fetch('../src/controllers/rateRouter.php', {
    method: 'POST',
    body: data,

  })
    .then((response) => {
      return response.json();
    })
    .then((products) => {
      let shop = document.querySelector("#shop")
      let html = "";
      products.forEach((item) => {

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
      shop.innerHTML = html;
    });
}

function createCheckbox(value, type) {
  const input = document.createElement('input');
  input.setAttribute('type', 'checkbox');
  input.setAttribute('id', value);
  input.setAttribute('name', value);

  input.addEventListener('click', () => {
    const checkboxes = document.querySelectorAll(`#${type}Div input[type="checkbox"]`);
    checkboxes.forEach((checkbox) => {
      if (checkbox !== input) {
        checkbox.checked = false;
      }
    });
    if (type === 'category') {
      postCategory();
    } else if (type === 'origin') {
      postOrigin();
    }
  });

  return input;
}

fetchCategory();
fetchOrigin();
