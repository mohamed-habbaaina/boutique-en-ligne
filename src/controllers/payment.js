
const formPayment = document.forms['formPayment'];
const displayMessagePayment = document.querySelector('.displayMessagePayment');

formPayment.addEventListener('submit', async (e) => {
    e.preventDefault();

    let formData = new FormData(formPayment);

    if(confirm('Confirm'))
    {
        let res = await fetch('./../src/model/payment.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        });

        let response = await res.json();

        console.log(response);
        if(response === true)
        {
            displayMessagePayment.innerHTML = 'confirm confir confirm !!!';

            setTimeout(() => window.location = './shop.php' , 1500);
        } else
        {
            displayMessagePayment.innerHTML = response
        }
    }
})