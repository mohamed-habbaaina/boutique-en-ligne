
    <form method="post" id="regForm">
        <div id="name_form">
            <div class="input_contener">
                <input type="text" name="regFirstname" id="regFirstname" placeholder=" ">
                <label for="firstname">Firstname</label>
            </div>
            <div class="input_contener">
                <input type="text" name="regLastname" id="regLastname" placeholder=" ">
                <label for="lastname">Lastname</label>
            </div>
        </div>
        <div class="input_contener">
            <input type="text" name="regMail" id="regMail" placeholder=" ">
            <label for="email">Mail</label>
        </div>
        <div class="input_contener">
            <input type="password" name="regPassword" id="regPassword" placeholder=" ">
            <label for="password">Password</label>
        </div>
        <div class="input_contener">
            <input type="password" name="regPasswordConfirm" id="regPasswordConfirm" placeholder=" ">
            <label for="confirm">Confirm</label>
        </div>

        <div id="submit_form">
            <button type="submit" id="regBtn">Register</button>
        </div>
    </form>
    <script src="./js/auth.js"></script>