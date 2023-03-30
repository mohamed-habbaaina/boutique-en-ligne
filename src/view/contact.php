<section id="contact_section">
    <div id="contact_form_img">
        <img src="" alt="">
    </div>
    <div id="contact_form">
        <h3>Formulaire de contact</h3>
        <form action="" methode="post">
            <div id="name_form">
                <div class="input_contener">
                    <input type="text" name="firstname" id="firstname" placeholder=" ">
                    <label for="firstname">Prénom</label>
                </div>
                <div class="input_contener">
                    <input type="text" name="lastname" id="lastname" placeholder=" ">
                    <label for="lastname">Nom</label>
                </div>
            </div>
            <div class="input_contener">
                <input type="text" name="email" id="email" placeholder=" ">
                <label for="email">Email</label>
            </div>
            <div class="input_contener">
                <input type="tel" name="phone" id="phone" placeholder=" ">
                <label for="phone">Téléphone</label>
            </div>
            <div class="textarea_contener">
                <textarea name="content" id="message_content" cols="30" rows="10" placeholder="Votre message..."></textarea>
            </div>
            <div id="submit_form">
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </div>
</section>

<style>
    #name_form {
        display: flex;
        flex-direction: row;
    }

    .input_contener {
        border: solid 1px #111;
        padding: 5px;
        margin-top: 20px;
        position: relative;
        height: 3.5rem;
        border-radius: 3px;
    }

    #name_form .input_contener {
        width: 100%;
    }

    #name_form .input_contener:first-child {
        margin-right: 10px;
    }

    #name_form .input_contener:last-child {
        margin-left: 10px;
    }

    h3 {
        text-align: center;
    }

    input {
        position: absolute;
        bottom: 1rem;
        border: none;
        width: 95%;
    }

    label {
        display: block;
        color: #999;
        position: absolute;
        margin: 8px;
        bottom: 1rem;
        transform: translate(0, 0);
        transition: all 0.2s ease-out;
    }

    input:focus {
        outline: none;
    }

    input:focus+label,
    input:not(:placeholder-shown)+label {
        color: #111;
        transform: translate(0.25rem, -1.3rem);
        font-size: 0.8rem;
    }

    #contact_section {
        display: flex;
        flex-direction: row;
        border: solid red;
        width: 500px;
    }

    #contact_form_img {
        width: 30%;
        border: solid;
    }

    #contact_form {
        width: 70%;
        padding: 20px;
    }

    #message_content {
        outline: none;
        margin-top: 20px;
        width: 100%;
        resize: none;
    }

    #submit_form button {
        float: right;
        margin-top: 20px;
        width: 100%;
    }
</style>