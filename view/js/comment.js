function fetchComment() {

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id_pro = urlParams.get('idProduct');

    fetch(`../src/controllers/commentRouter.php?fetchComment=${id_pro}`)

        .then((response) => {
            return response.json()
        })
        .then((comments) => {

            const commentSection = document.getElementById('comment-section');
            commentSection.innerHTML = '';

            getRole()
                .then(userInfo => {

                    comments.forEach(comment => {
                        const postDate = new Date(comment.date);
                        const currentDate = new Date();


                        const diff = currentDate.getTime() - postDate.getTime();


                        if (diff >= 31536000000) {
                            result = Math.floor(diff / 31536000000) + ' year(s) ago';
                        } else if (diff >= 2592000000) {
                            result = Math.floor(diff / 2592000000) + ' month(s) ago';
                        } else if (diff >= 86400000) {
                            result = Math.floor(diff / 86400000) + ' day(s) ago';
                        } else if (diff >= 3600000) {
                            result = Math.floor(diff / 3600000) + ' hour(s) ago';
                        } else if (diff >= 60000) {
                            result = Math.floor(diff / 60000) + ' minute(s) ago';
                        } else {
                            result = 'just now';
                        }

                        const commentDiv = document.createElement('div');
                        // commentDiv.className = "comment_div";

                        commentDiv.innerHTML = `
                            <p>${result}</p>
                            <p>by ${comment.firstname}</p>
                            <p>${comment.text}</p>           
                        `;
                        if (userInfo.user.role === 'admin') {
                            commentDiv.innerHTML += `
                                <button value="${comment.id}" class="remove_button">
                                    remove
                                </button>
                            `
                        }
                        commentDiv.innerHTML += `<hr>`

                        commentSection.appendChild(commentDiv);
                    });
                    document.querySelectorAll('.remove_button').forEach(button => {
                        button.addEventListener('click', async (e) => {
                            await fetch(`../src/controllers/adminRouter.php?delComment=${e.target.value}`);
                            window.location.reload();
                        })
                    });
                });

        })
}

async function getRole() {
    r = await fetch(`../src/controllers/userRouter.php?sessionInfo=`);
    userInfo = await r.json();
    return userInfo;
}

fetchComment();

let addCommentForm = document.querySelector("#addCommentForm");
let addCommentBtn = document.querySelector("#addCommentBtn");

addCommentBtn.addEventListener("click", function (ev) {
    ev.preventDefault();
    let data = new FormData(addCommentForm);
    data.append("addCommentBtn", addCommentBtn.value);
    data.append("addComment", "add");
    fetch("../src/controllers/commentRouter.php", {
        method: "POST",
        body: data
    })
        .then((response) => {
            return response.text();
        })
        .then((content) => {
            commentText.value = "";
            fetchComment();

        })
})