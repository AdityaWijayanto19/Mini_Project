const hide = document.querySelector("#inputPass");
const btn_show = document.querySelector("#toggleIcon");

    if(btn_show){
        btn_show.addEventListener("click", function(){
            if (hide.type === "password") {
                hide.type = "text";         
                btn_show.classList.replace("fa-eye", "fa-eye-slash")      
            }else {
                hide.type = "password";
                btn_show.classList.replace("fa-eye-slash", "fa-eye");
            }
        });
    }
