let regDisplayBtn = document.querySelector("#regDisplayBtn");
let logDisplayBtn = document.querySelector("#logDisplayBtn");

async function FetchReg() {
    await fetch("register.php")
      .then((response) => {
        return response.text();
      })
      .then((form) => {
        formDisplay.innerHTML = form;
        let regBtn = document.querySelector("#regBtn");
        let regForm = document.querySelector("#regForm");
        console.log(regForm);
        regBtn.addEventListener("click", function (ev) {
          ev.preventDefault();
          let data = new FormData(regForm);
          data.append("register", "ok");
          fetch("../src/controllers/user_controller.php", {
            method: "POST",
            body: data,
          })
            .then((response) => {
              return response.text();
            })
            .then((content) => {
              formDisplay.textContent = content;
              console.log(data);
            });
        });
      });
  }

regDisplayBtn.addEventListener("click", function (ev){
    ev.preventDefault();
    FetchReg();
})


async function FetchLog() {
await fetch("connect.php")
    .then((response) => {
    return response.text();
    })
    .then((form) => {
    formDisplay.innerHTML = form;
    let logBtn = document.querySelector("#logBtn");
    let logForm = document.querySelector("#logForm");
    logBtn.addEventListener("click", function (ev) {
        ev.preventDefault();
        let data = new FormData(logForm);
        data.append("login", "ok");
        fetch("../src/controllers/user_controller.php", {
        method: "POST",
        body: data,
        })
        .then((response) => {
            return response.text();
        })
        .then((content) => {
            formDisplay.textContent = content;
            redirectProfil()
        });
    });
    });
}

logDisplayBtn.addEventListener("click", function (ev){
    ev.preventDefault();
    FetchLog();
})