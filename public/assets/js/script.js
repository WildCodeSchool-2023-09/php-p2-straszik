const unscribeNewsletter = document.getElementById("unscribeNewsletter");

document.addEventListener("DOMContentLoaded", function() {

    unscribeNewsletter.addEventListener("submit", (event) => {
        event.preventDefault();
        fetch("/unscribeNewsletter", {
            method: "POST",
            body: new FormData(unscribeNewsletter)
        })
        .then(response => response.json())
        .then(data => {
            const unscribeNews = document.querySelector("#StateUnscribeNews");
            let errorsEmail = "";

            if(!document.getElementById("status")) {
                const affichageStateUnscribeNews = document.createElement("p");
                affichageStateUnscribeNews.setAttribute("id", "status")
                unscribeNews.appendChild(affichageStateUnscribeNews);
            }
            const statements = document.getElementById("status");

            if(data.deleteEmail) {
                statements.innerHTML= data.deleteEmail;
                document.getElementById("emailAdresse").value = "";
                
            } else if (data.emailNotExist) {
                
                statements.innerHTML= data.emailNotExist;
                
            } else if (data.errors) {
                for (const element in data.errors) {
                    errorsEmail += data.errors[element] + "<br>";
                }
                statements.innerHTML = errorsEmail
                document.getElementById("emailAdresse").value = "";
            }
        })
    });
})

