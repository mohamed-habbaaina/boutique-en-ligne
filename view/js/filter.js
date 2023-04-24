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


function postCategory() {
  const checkbox = document.querySelector('#categoryDiv input[type="checkbox"]:checked');
  let categories;
  if (checkbox) {
    categories = checkbox.getAttribute('name');
  } else {
    window.location.reload();
  }

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
      let html = "";
      product.forEach((item) => {

        const rating = item.avg_rating;
        const starRating = getStarRating(rating);

        html += `
        <div class="displayShop">
        <a href="./product.php?idProduct=${item.id_pro}"><img src="../uploads/${item.image_pro}" alt="${item.name_pro}"></a>
        <div class ="productDisplay">
            <a href="./product.php?idProduct=${item.id_pro}"><h3>${item.name_pro}</h3></a>
                <p>${item.category_pro}</p>
                <p>${item.origin_pro}</p>
                <p id="starRating">${starRating}</p>
                <p>${item.price_pro}  $ </p>
            </div>
        </div>
    `;
      });
      shop.innerHTML = html;
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
          postOrigin();

        });
      });
    });
}

function postOrigin() {
  const checkbox = document.querySelector('#originDiv input[type="checkbox"]:checked');
  const origins = checkbox ? checkbox.getAttribute('name') : null;

  let data = new FormData();
  data.append("displayOrigin", origins);
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
      let html = "";
      product.forEach((item) => {

        const rating = item.avg_rating;
        const starRating = getStarRating(rating);

        html += `
        <div class="displayShop">
        <a href="./product.php?idProduct=${item.id_pro}"><img src="../uploads/${item.image_pro}" alt="${item.name_pro}"></a>
        <div class ="productDisplay">
            <a href="./product.php?idProduct=${item.id_pro}"><h3>${item.name_pro}</h3></a>
                <p>${item.category_pro}</p>
                <p>${item.origin_pro}</p>
                <p id="starRating">${starRating}</p>
                <p>${item.price_pro}  $ </p>
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

function handleFilters() {
  const categoryCheckbox = document.querySelector('#categoryDiv input[type="checkbox"]:checked');
  const category = categoryCheckbox ? categoryCheckbox.getAttribute('name') : null;

  const originCheckbox = document.querySelector('#originDiv input[type="checkbox"]:checked');
  const origin = originCheckbox ? originCheckbox.getAttribute('name') : null;

  let data = new FormData();
  data.append("displayCategory", category);
  data.append("displayOrigin", origin);

  fetch('../src/controllers/rateRouter.php', {
    method: 'POST',
    body: data,
  })
    .then((response) => {
      return response.json();
    })
    .then((product) => {
      let shop = document.querySelector("#shop")
      let html = "";
      product.forEach((item) => {
        const rating = item.avg_rating;
        const starRating = getStarRating(rating);

        html += `
        <div class="displayShop">
        <a href="./product.php?idProduct=${item.id_pro}"><img src="../uploads/${item.image_pro}" alt="${item.name_pro}"></a>
        <div class ="productDisplay">
            <a href="./product.php?idProduct=${item.id_pro}"><h3>${item.name_pro}</h3></a>
                <p>${item.category_pro}</p>
                <p>${item.origin_pro}</p>
                <p id="starRating">${starRating}</p>
                <p>${item.price_pro}  $ </p>
            </div>
        </div>
        `;
      });
      shop.innerHTML = html;
    });
}



fetchCategory();
fetchOrigin();
