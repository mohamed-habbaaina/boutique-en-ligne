let regDisplayBtn = document.querySelector("#regDisplayBtn");
let logDisplayBtn = document.querySelector("#logDisplayBtn");
const main = document.querySelector('main');

function FetchReg() {
  fetch("register.php")
    .then((response) => {
      return response.text();
    })
    .then((form) => {
      main.innerHTML = form;
      let regBtn = document.querySelector("#regBtn");
      let regForm = document.querySelector("#regForm");
      let regPassword = document.querySelector("#regPassword");
      let regPasswordConfirm = document.querySelector("#regPasswordConfirm");
      
      // 

      function isValidName(name) {
        const nameRegex = /^[A-Za-z\é\è\ê\-\ ]{2,}$/;
        return name.match(nameRegex);
      }

      function isValidEmail(email) {
        const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        return email.match(emailRegex);
      }

      function isMatchPassword(password, passwordConfirm) {
        return password === passwordConfirm;
      }

      function isValidForm(firstname, lastname, email, password, passwordConfirm) {
        return (
          isValidName(firstname) &&
          isValidName(lastname) &&
          isValidEmail(email) &&
          isMatchPassword(password, passwordConfirm)
        )
      }

      regFirstname.addEventListener('input', (e) => {
        let value = e.target.value;
        if (isValidName(value)) {
          firstname_div.style.border = 'solid 2px green';

        } else {
          firstname_div.style.border = 'solid 2px red';
        }
      })

      regLastname.addEventListener('input', (e) => {
        let value = e.target.value;
        if (isValidName(value)) {
          lastname_div.style.border = 'solid 2px green';

        } else {
          lastname_div.style.border = 'solid 2px red';
        }
      })
      regEmail.addEventListener('input', (e) => {
        let value = e.target.value;
        if (isValidEmail(value)) {
          email_div.style.border = 'solid 2px green';
        } else {
          email_div.style.border = 'solid 2px red';
        }
      })
      
      regPassword.addEventListener('input', (e) => {
        let value = e.target.value;
        if (isMatchPassword(value, regPasswordConfirm.value)) {
          password_confirm_div.style.border = 'solid 2px green';
          password_div.style.border = 'solid 2px green'
        } else {
          password_confirm_div.style.border = 'solid 2px red';
          password_div.style.border = 'solid 2px red';
        }
      });
      
      regPasswordConfirm.addEventListener('input', (e) => {
        let value = e.target.value;
        if (isMatchPassword(value, regPassword.value)) {
          password_confirm_div.style.border = 'solid 2px green';
          password_div.style.border = 'solid 2px green'
        } else {
          password_confirm_div.style.border = 'solid 2px red';
          password_div.style.border = 'solid 2px red';
        }
      });
      // 
      regBtn.addEventListener("click", function (ev) {
        ev.preventDefault();

        if (isValidForm(
          regFirstname.value,
          regLastname.value,
          regEmail.value,
          regPassword.value,
          regPasswordConfirm.value)) {

          let data = new FormData(regForm);
          data.append("register", "ok");
          fetch("../src/controllers/userRouter.php", {
            method: "POST",
            body: data,
          })
            .then((response) => {
              return response.text();
            })
            .then((content) => {
              if(content == "Registed"){
                FetchLog();
              }
            });
        }
      });
    });
}

regDisplayBtn.addEventListener("click", function (ev) {
  ev.preventDefault();
  FetchReg();
})


function FetchLog() {
  fetch("connect.php")
    .then((response) => {
      return response.text();
    })
    .then((form) => {
      main.innerHTML = form;
      let logBtn = document.querySelector("#logBtn");
      let logForm = document.querySelector("#logForm");
      let logMsg = document.querySelector("#logMsg");
// 
  function isValidEmail(email) {
    const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return email.match(emailRegex);
  }

  logEmail.addEventListener('input', (e) => {
    let value = e.target.value;
    if (isValidEmail(value)) {
      email_div.style.border = 'solid 2px green';
    } else {
      email_div.style.border = 'solid 2px red';
    }
  })
// 
      logBtn.addEventListener("click", function (ev) {
        ev.preventDefault();
        let data = new FormData(logForm);
        data.append("login", "ok");
        fetch("../src/controllers/userRouter.php", {
          method: "POST",
          body: data,
        })
          .then((response) => {
            return response.text();
          })
          .then((content) => {
            
            if(content !== "Welcome"){
              logMsg.innerHTML = content;
            } else{
              window.location = "index.php";
            }
          });
      });
    });
}

logDisplayBtn.addEventListener("click", function (ev) {
  ev.preventDefault();
  FetchLog();
})


