const productDisplayBtn = document.getElementById("productDisplayBtn");
const productDisplay = document.getElementById("productDisplay");
const userDisplayBtn = document.getElementById("userDisplayBtn");
const userDisplay = document.getElementById("userDisplay");
const commentDisplayBtn = document.getElementById("commentDisplayBtn");
const commentDisplay = document.getElementById("commentDisplay");
const contentDisplay = document.getElementById("contentDisplay");

// Fonction pour masquer toutes les div
function hideAll() {
    productDisplay.style.display = "none";
    userDisplay.style.display = "none";
    commentDisplay.style.display = "none";
}

// Masquage initial de toutes les div
hideAll();

// Gestion des événements de clic sur les boutons
productDisplayBtn.addEventListener("click", function () {
    hideAll();
    productDisplay.style.display = "block";
    fetchProducts();
});

userDisplayBtn.addEventListener("click", function () {
    hideAll();
    userDisplay.style.display = "block";
    fetchUser();
});

commentDisplayBtn.addEventListener("click", function () {
    hideAll();
    commentDisplay.style.display = "block";
});

function createTable(headers, content, contentKeys, infoBtnValue) {

    // Création de la table
    const table = document.createElement('table');

    // Création des en-têtes
    const headerRow = document.createElement('tr');
    for (header of headers) {
        const th = document.createElement('th');
        th.textContent = header;
        headerRow.appendChild(th);
    }
    table.appendChild(headerRow);

    // Création des lignes
    for (line of content) {
        const row = document.createElement('tr');
        for (key of contentKeys) {
            const td = document.createElement('td');
            td.innerText = line[key];
            row.appendChild(td);
        }

        // Création des boutons Info
        const infoBtnCell = document.createElement('td');
        const infoBtn = document.createElement('button');
        infoBtn.classList.add('infoBtn');
        infoBtn.textContent = "Info";
        infoBtn.type = "submit";
        infoBtn.value = line[infoBtnValue];
        infoBtnCell.appendChild(infoBtn);
        row.appendChild(infoBtnCell);
        table.appendChild(row);
    }
    return table;
}

function loading() {
    while (contentDisplay.firstChild) {
        contentDisplay.removeChild(contentDisplay.firstChild);
    }
    loadingP = document.createElement('p');
    loadingP.innerText = 'Loading...'
    contentDisplay.appendChild(loadingP);
}

async function fetchUser() {

    loading();

    // Récupération des infos en bdd
    const r = await fetch("../src/controllers/userRouter.php?fetch=user");
    const userData = await r.json();

    // Création et affichage du tableau
    headers = ['Id', 'Firsname', 'Lastname', 'Email'];
    keysToDisplay = ['id_user', 'firstname', 'lastname', 'email'];
    infoBtnValue = 'id_user';
    userTable = createTable(headers, userData, keysToDisplay, infoBtnValue);
    contentDisplay.removeChild(contentDisplay.lastChild);
    contentDisplay.appendChild(userTable);

    // Ajout d'écouteur d'évènement sur les bonton info
    getInfoBtn = document.querySelectorAll(".infoBtn");
    getInfoBtn.forEach(getInfo => getInfo.addEventListener("click", (event) => {
        window.location = "./adminUserInfo.php?userId=" + event.currentTarget.value;

    }));
}

async function fetchProducts() {

    loading();

    // Récupération des infos en bdd
    const r = await fetch("../src/controllers/productRouter.php?fetch=product");
    const productData = await r.json();

    // Création et affichage du tableau
    headers = ['id', 'name', 'category', 'price'];
    keysToDisplay = ['id_pro', 'name_pro', 'category_pro', 'price_pro'];
    infoBtnValue = 'id_pro';
    productTable = createTable(headers, productData, keysToDisplay, infoBtnValue);
    contentDisplay.removeChild(contentDisplay.lastChild);
    commentDisplay.appendChild(productTable);

    // Ajout d'écouteur d'évènement sur les bonton info
    getInfoBtns = document.querySelectorAll('.infoBtn');
    getInfoBtns.forEach(infoBtn => infoBtn.addEventListener('click', (e) => {
        window.location = "./adminProductInfo.php?productId=" + e.currentTarget.value;
    }));
}