<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/contact.css">
</head>

<body>

    <?php require_once("./includes/header.php"); ?>

    <main>

        <section id="contact_section">
            <div id="contact_form_img">
            </div>
            <div id="contact_form">
                <h3>Formulaire de contact</h3>
                <h4 id="form_message"></h4>
                <form action="" methode="post">
                    <div id="name_form">
                        <div class="input_container" id="firstname_div">
                            <input type="text" name="contact_firstname" id="firstname_input" placeholder=" ">
                            <label for="firstname_input">Prénom</label>
                        </div>
                        <div class="input_container" id="lastname_div">
                            <input type="text" name="contact_lastname" id="lastname_input" placeholder=" ">
                            <label for="lastname_input">Nom</label>
                        </div>
                    </div>
                    <div class="input_container" id="email_div">
                        <input type="text" name="contact_email" id="email_input" placeholder=" ">
                        <label for="email_input">Email</label>
                    </div>
                    <div class="input_container" id="phone_div">
                        <input type="tel" name="contact_phone" id="phone_input" placeholder=" ">
                        <label for="phone_input">Téléphone</label>

                    </div>
                    <div class="textarea_container">
                        <textarea name="contact_content" id="message_content" cols="30" rows="10" placeholder=" "></textarea>
                        <label for="message_content">Votre message...</label>
                    </div>
                    <div id="submit_form">
                        <button type="submit">Envoyer</button>
                    </div>
                </form>
            </div>
        </section>

        <?php require_once("./includes/footer.php"); ?>
    </main>

    <script src="./js/contact.js"></script>
</script>

</body>

</html>