const productDisplayBtn = document.getElementById("productDisplayBtn");
const productDisplay = document.getElementById("productDisplay");
const userDisplayBtn = document.getElementById("userDisplayBtn");
const userDisplay = document.getElementById("userDisplay");
const commentDisplayBtn = document.getElementById("commentDisplayBtn");
const commentDisplay = document.getElementById("commentDisplay");

// Fonction pour masquer toutes les div
function hideAll() {
    productDisplay.style.display = "none";
    userDisplay.style.display = "none";
    commentDisplay.style.display = "none";
}

hideAll();


// Masquage initial de toutes les div

// Gestion des événements de clic sur les boutons
productDisplayBtn.addEventListener("click", function () {
    hideAll();
    productDisplay.style.display = "block";
    fetchProduct();
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

function fetchUser() {
    fetch("../src/controllers/userRouter.php?fetch=user")
        .then((response) => {
            return response.json()
        })
        .then((content) => {
            // Créer le tableau HTML
            const table = document.createElement('table');

            // Ajouter l'en-tête du tableau
            const headerRow = document.createElement('tr');
            const headers = ['Firstname', 'Lastname', 'Email'];
            headers.forEach(header => {
                const th = document.createElement('th');
                th.textContent = header;
                headerRow.appendChild(th);
            });
            table.appendChild(headerRow);

            // Ajouter chaque ligne de données au tableau
            const rows = content.map(user => {
                const row = document.createElement('tr');

                const firstnameCell = document.createElement('td');
                firstnameCell.textContent = user.firstname;
                row.appendChild(firstnameCell);

                const lastnameCell = document.createElement('td');
                lastnameCell.textContent = user.lastname;
                row.appendChild(lastnameCell);

                const emailCell = document.createElement('td');
                emailCell.textContent = user.email;
                row.appendChild(emailCell);

                const infoBtnCell = document.createElement('td');
                const infoBtn = document.createElement('button');

                infoBtn.classList.add('infoBtn');
                infoBtn.textContent = "Info";
                infoBtn.type = "submit";
                infoBtn.value = user.id_user;
                infoBtnCell.appendChild(infoBtn);
                row.appendChild(infoBtnCell);

                return row;
            });
            rows.forEach(row => table.appendChild(row));


            // Ajouter le tableau au document
            document.body.appendChild(table);

            getInfoBtn = document.querySelectorAll(".infoBtn");


            getInfoBtn.forEach(getInfo => getInfo.addEventListener("click", (event) => {
                console.log("clique ok : " + event.currentTarget.value);
                window.location = "./adminUserInfo.php?userId=" + event.currentTarget.value;

            }));
        })
}

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
        infoBtn.value = infoBtnValue;
        infoBtnCell.appendChild(infoBtn);
        row.appendChild(infoBtnCell);
        table.appendChild(row);
    }
    return table;
}

async function fetchProduct() {

    // Récupération des infos en bdd
    const r = await fetch("../src/controllers/productRouter.php?fetch=product");
    const productData = await r.json();
    
    // Création et affichage du tableau
    headers = ['id', 'name', 'category', 'price'];
    keysToDisplay = ['id_pro', 'name_pro', 'category_pro', 'price_pro'];
    infoBtnValue = 'id_pro';
    productTable = createTable(headers, productData, keysToDisplay, infoBtnValue);
    document.body.appendChild(productTable);

    // Ajout d'écouteur d'évènement sur les bonton info
    getInfoBtns = document.getElementsByClassName('infoBtn');
    getInfoBtns.forEach(infoBtn => infoBtn.addEventListener('click', (e) => {
        window.location = "./adminProductInfo.php?productId=" + e.currentTarget.value;
    }));
}