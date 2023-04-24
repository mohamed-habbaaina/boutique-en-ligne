const userDisplay = document.getElementById("userDisplay");
const userDisplayBtn = document.getElementById("userDisplayBtn");
const productDisplay = document.getElementById("productDisplay");
const productDisplayBtn = document.getElementById("productDisplayBtn");
const messageDisplay = document.getElementById("messageDisplay");
const messageDisplayBtn = document.getElementById("messageDisplayBtn");
const contentDisplay = document.getElementById("contentDisplay");

// Fonction pour masquer toutes les div
function hideAll() {
    productDisplay.style.display = "none";
    userDisplay.style.display = "none";
    messageDisplay.style.display = "none";
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

messageDisplayBtn.addEventListener("click", function () {
    hideAll();
    messageDisplay.style.display = "block";
    fetchMessages();
});

function createTable(headers, content, contentKeys, BtnValue) {

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
        infoBtn.value = line[BtnValue];
        infoBtnCell.appendChild(infoBtn);
        row.appendChild(infoBtnCell);
        table.appendChild(row);

        // Création des boutons Delete
        const delBtnCell = document.createElement('td');
        if (!(line['state_pro'] === 'deleted')) {
            const delBtn = document.createElement('button');
            delBtn.classList.add('delBtn');
            delBtn.textContent = "Delete";
            delBtn.type = "submit";
            delBtn.value = line[BtnValue];
            delBtnCell.appendChild(delBtn);
        } else {
            delBtnCell.textContent = "Deleted";
            row.childNodes.forEach(cell => {
                cell.style.color = "red";
            })
            delBtnCell.style.color = "red"
        }
        row.appendChild(delBtnCell);
        table.appendChild(row);
    }
    return table;
}

function listenDelBtn(urlToGet, reloadFunction) {
    // Ajout d'écouteur d'évènement sur les bontons delete
    DelBtns = document.querySelectorAll(".delBtn");
    DelBtns.forEach(delBtn => delBtn.addEventListener("click", (event) => {
        fetch(urlToGet + event.currentTarget.value)
            .then(r => {
                if (r.ok) {
                    while (contentDisplay.firstChild) {
                        contentDisplay.removeChild(contentDisplay.firstChild);
                    }
                    responseP = document.createElement('p');
                    responseP.innerText = 'La suppression a été effectué';
                    contentDisplay.appendChild(responseP);
                    setTimeout(() => {
                        reloadFunction();
                    }, 1000);
                } else {
                    while (contentDisplay.firstChild) {
                        contentDisplay.removeChild(contentDisplay.firstChild);
                    }
                    responseP = document.createElement('p');
                    responseP.innerText = 'Un problème est survenu';
                    contentDisplay.appendChild(responseP);
                    setTimeout(() => {
                        reloadFunction();
                    }, 1000);
                }
            })
    }));
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

    // Récupération des infos
    const r = await fetch("../src/controllers/userRouter.php?fetch=user");
    const userData = await r.json();

    // Création et affichage du tableau
    headers = ['Id', 'Firsname', 'Lastname', 'Email', 'Info', 'Delete'];
    keysToDisplay = ['id_user', 'firstname', 'lastname', 'email'];
    infoBtnValue = 'id_user';
    userTable = createTable(headers, userData, keysToDisplay, infoBtnValue);
    contentDisplay.removeChild(contentDisplay.lastChild);
    contentDisplay.appendChild(userTable);

    // Ajout d'écouteur d'évènement sur les bontons info
    infoBtns = document.querySelectorAll(".infoBtn");
    infoBtns.forEach(InfoBtn => InfoBtn.addEventListener("click", (event) => {
        window.location = "./adminUserInfo.php?userId=" + event.currentTarget.value;
    }));

    listenDelBtn("../src/controllers/userRouter.php?delUser=", fetchUser);
}

async function fetchProducts() {

    loading();

    // Récupération des infos
    const r = await fetch("../src/controllers/productRouter.php?fetch=product");
    const productData = await r.json();

    // Création et affichage du tableau
    headers = ['Id', 'Name', 'Category', 'Origin', 'Price', 'Info', 'Delete'];
    keysToDisplay = ['id_pro', 'name_pro', 'category_pro', 'origin_pro', 'price_pro'];
    infoBtnValue = 'id_pro';
    productTable = createTable(headers, productData, keysToDisplay, infoBtnValue);
    contentDisplay.removeChild(contentDisplay.lastChild);
    contentDisplay.appendChild(productTable);

    // Ajout d'écouteur d'évènement sur les bonton info
    getInfoBtns = document.querySelectorAll('.infoBtn');
    getInfoBtns.forEach(infoBtn => infoBtn.addEventListener('click', (e) => {
        window.location = "./adminProductInfo.php?productId=" + e.currentTarget.value;
    }));

    listenDelBtn("../src/controllers/productRouter.php?delProduct=", fetchProducts);
}

async function fetchMessages() {

    loading();

    // Récupération des infos
    const r = await fetch("../src/controllers/adminRouter.php?fetch=messages");
    const messagesData = await r.json();

    // Création et affichage du tableau
    headers = ['Id', 'Firtname', 'Lastname', 'Date'];
    keysToDisplay = ['id_mes', 'firstname_mes', 'lastname_mes', 'date_mes'];
    infoBtnValue = 'id_mes';
    productTable = createTable(headers, messagesData, keysToDisplay, infoBtnValue);
    contentDisplay.removeChild(contentDisplay.lastChild);
    contentDisplay.appendChild(productTable);

    // Ajout d'écouteur d'évènement sur les bonton info
    getInfoBtns = document.querySelectorAll('.infoBtn');
    getInfoBtns.forEach(infoBtn => infoBtn.addEventListener('click', (e) => {
        window.location = "./adminMessagesInfo.php?messageId=" + e.currentTarget.value;
    }));

    listenDelBtn("../src/controllers/adminRouter.php?delMessage=", fetchMessages);
}   