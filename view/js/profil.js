window.onload = function () {
    let nameBtn = document.getElementById("nameDisplayBtn");
    let contactBtn = document.getElementById("contactDisplayBtn");
    let pwdBtn = document.getElementById("pwdDisplayBtn");
    let nameDiv = document.getElementById("profilNameDisplay");
    let contactDiv = document.getElementById("profilContactDisplay");
    let pwdDiv = document.getElementById("profilPwdDisplay");

    nameBtn.onclick = function () {
        nameDiv.style.display = "block";
        contactDiv.style.display = "none";
        pwdDiv.style.display = "none";
    };

    contactBtn.onclick = function () {
        nameDiv.style.display = "none";
        contactDiv.style.display = "block";
        pwdDiv.style.display = "none";
    };

    pwdBtn.onclick = function () {
        nameDiv.style.display = "none";
        contactDiv.style.display = "none";
        pwdDiv.style.display = "block";
    };
};

async function updateForm(form, idForm) {
    let data = new FormData(form);
    data.append(idForm, "ok");
    await fetch("../src/controllers/userRouter.php", {
        method: "POST",
        body: data,
    }).then((response) => {
        return response.text();
    }).then((content) => {
        profilMsg.innerHtml = content;
    });
}

document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        await updateForm(e.target, e.target.id);
        window.location.reload();
    })
})