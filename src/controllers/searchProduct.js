//********************* Search bar **********************/
//***************************************************** */

const searchForm = document.forms['searchForm'];
let search = document.forms['searchForm']['search'];

let resultDisplay = document.querySelector('#displayResult');

// PreventDefault de form.
searchForm.addEventListener('submit', e => {

    e.preventDefault();
})
searchForm.addEventListener('input', async (e) => {

    // Remove display
    resultDisplay.innerHTML = '';


    let articleSearch = search.value;

    // if minimum 2 character
    if(articleSearch.length > 1){

        let search = await fetch('./../src/model/homeSearch.php?search=' + articleSearch);

        let data = await search.json();
        
        let html = '';

        resultDisplay.innerHTML = '';

        // Display link Db
        data.forEach(item => {
            html += `
                <li class=""><a href="./product.php?idProduct=${item.id_pro}">${item.name_pro}</a></li>
            `
        });
        
        resultDisplay.insertAdjacentHTML('beforeend', html);


    }

})