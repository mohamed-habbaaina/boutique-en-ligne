<section id="contact_section">
    <div id="contact_form_img">
        <img src="" alt="">
    </div>
    <div id="contact_form">
        <h3>Register</h3>
        <h4 id="form_message"></h4>
        <form method="post" id="regForm">
            <div id="name_form">
                <div class="input_container">
                    <input type="text" name="regFirstname" id="regFirstname" placeholder=" ">
                    <label for="regFirstname">Firstname</label>
                </div>
                <div class="input_container">
                    <input type="text" name="regLastname" id="regLastname" placeholder=" ">
                    <label for="regLastname">Lastname</label>
                </div>
            </div>
            <div class="input_container">
                <input type="text" name="regMail" id="regMail" placeholder=" ">
                <label for="regEmail">Mail</label>
            </div>
            <div class="input_container">
                <input type="password" name="regPassword" id="regPassword" placeholder=" ">
                <label for="regPassword">Password</label>
            </div>
            <div class="input_container">
                <input type="password" name="regPasswordConfirm" id="regPasswordConfirm" placeholder=" ">
                <label for="regPasswordConfirm">Confirm</label>
            </div>

            <div id="submit_form">
                <button type="submit" id="regBtn">Register</button>
            </div>
        </form>
    </div>
</section>
<script src="./js/auth.js"></script>