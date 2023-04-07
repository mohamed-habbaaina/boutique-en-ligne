let regDisplayBtn = document.querySelector("#regDisplayBtn");
let logDisplayBtn = document.querySelector("#logDisplayBtn");

function FetchReg() {
  fetch("register.php")
    .then((response) => {
      return response.text();
    })
    .then((form) => {
      formDisplay.innerHTML = form;
      let regBtn = document.querySelector("#regBtn");
      let regForm = document.querySelector("#regForm");
      let regMsg = document.querySelector("#regMsg");
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

      function isMatchPassword(password) {
        return password === regPassword.value;
      }

      function isMatchPasswordConfirm(passwordConfirm) {
        return passwordConfirm === regPasswordConfirm.value;
      }

      function isValidForm(firstname, lastname, email, password, passwordConfirm) {
        return (
          isValidName(firstname) &&
          isValidName(lastname) &&
          isValidEmail(email) &&
          isMatchPassword(password) &&
          isMatchPasswordConfirm(passwordConfirm)
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
      regPasswordConfirm.addEventListener('input', (e) => {
        let value = e.target.value;
        if (isMatchPassword(value)) {
          password_confirm_div.style.border = 'solid 2px green';
          password_div.style.border = 'solid 2px green'
        } else {
          password_confirm_div.style.border = 'solid 2px red';
          password_div.style.border = 'solid 2px red';
        }
      });

      regPassword.addEventListener('input', (e) => {
        let value = e.target.value;
        if (isMatchPasswordConfirm(value)) {
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
              regMsg.innerHTML = content;
              console.log(data);
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
      formDisplay.innerHTML = form;
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
            logMsg.innerHTML = content;
          });
      });
    });
}

logDisplayBtn.addEventListener("click", function (ev) {
  ev.preventDefault();
  FetchLog();
})


