/******************* Validate Image ****************/
/***************************************************/

const formAddProduct = document.forms['addProduct'];
const displayMessage = document.getElementById('displayMessage');
let image = formAddProduct['image'];
let validImage = false;

image.addEventListener('change', e => {

    let file = e.target.files[0];
    let fileName = file.name;
    let fileSize = file.size;
    let fileType = file.type.toLowerCase();
    const fileExtention = fileName.split('.');
    const typeImagePermit = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/jpg'];
    let small = image.nextElementSibling;

    // validate size
    if(fileSize < 2000000)
    {
        // validate double extensions.
        if(fileExtention.length === 2)
        {
            // validate type.
            if(typeImagePermit.includes(fileType))
            {
                small.innerHTML = 'Image valide !';
                small.style.color = 'green';

                validImage = true // validate image

            } else
            {
                small.innerHTML = 'Please upload an image !';
                small.style.color = 'red';   
            }
        } else{
            small.innerHTML = 'Please upload an image !';
            small.style.color = 'red';
        }

    } else
    {
        small.innerHTML = 'The maximum allowed size is 2 MB !';
        small.style.color = 'red';
    }
})

/********************** Fetch API **************************/
/***********************************************************/

formAddProduct.addEventListener('submit', async e => {
    e.preventDefault();
     let formData = new FormData(formAddProduct);

    if(validImage)
    {
        let response = await fetch('../src/model/add_product.php', {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
            //   'Content-Type': 'application/json'
            },
            body: formData
        });

        let data = await response.json();

        displayMessage.innerHTML = data;
        displayMessage.style.color = 'orange';

    }
})