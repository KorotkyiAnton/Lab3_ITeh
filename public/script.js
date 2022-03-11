window.onbeforeunload = ()=>{
    return false;
};

window.onload = () => {
    const publisherForm = document.getElementById("selectByPublisherForm");

    publisherForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formDataPublisher = new FormData(this);

        fetch("findInDb.php", {
            method: "post",
            body: formDataPublisher
        }).then(function (response){
            return response.text();
        }).then(function (text) {
            document.getElementById("results").innerHTML = text;
        }).catch(function (error) {
            console.error(error);
        });
    })


    const authorForm = document.getElementById("selectByAuthorForm");

    authorForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formDataAuthor = new FormData(this);

        fetch("findInDb.php", {
            method: "post",
            body: formDataAuthor
        }).then(function (response){
            return response.json();
        }).then(function (json) {
            document.getElementById("results").innerHTML = json;
        }).catch(function (error) {
            console.error(error);
        });
    })


    const dateForm = document.getElementById("selectByDateForm");

    dateForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formDataDate = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "findInDb.php");
        xhr.responseType = 'document';
        xhr.send(formDataDate);

        xhr.onload = () => {
            document.getElementById("results").innerHTML = xhr.responseXML.body.innerHTML;
        }
    })
}


