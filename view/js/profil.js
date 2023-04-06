let updateBtn = document.querySelector("#profilBtn");


updateBtn.addEventListener("click", function (ev) {
    ev.preventDefault();
    update()
});

function update() {
    let data = new FormData(updateForm);
    data.append("update", "ok");
    fetch("../src/controllers/userRouter.php", {
        method: "POST",
        body: data,
    })
        .then((response) => {
            return response.text();
        })
        .then((content) => {
            formDisplay.textContent = content;
            
        });
}