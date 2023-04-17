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
    fetch("../src/controllers/userRouter.php?fetchUser=test")
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
            infoBtn.type="submit";
            infoBtn.value = user.id_user;
            infoBtnCell.appendChild(infoBtn);
            row.appendChild(infoBtnCell);

            return row;
        });
        rows.forEach(row => table.appendChild(row));

        // Ajouter le tableau au document
        document.body.appendChild(table);

        getInfoBtn = document.querySelectorAll(".infoBtn");
            

            getInfoBtn.forEach(getInfo => getInfo.addEventListener("click" , (event)=>{
                
                    window.location = "./adminUserInfo.php?userId=" + event.currentTarget.value;
                 
                }));
    })

        

}