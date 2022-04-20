  $(document).ready(function(){


        const visible_Arrow = document.querySelector(".toTOP")
        
        document.addEventListener("scroll", function() {
            if(scrollY > 0){
                visible_Arrow.style.display = "block"
                document.querySelector(".barra-menu").style.background = "#00000099"

               
            }
            else{

                visible_Arrow.style.display = "none"
            }

        })

        visible_Arrow.addEventListener("click", ()=>{
            //scroll suave
            $('html, body').animate({scrollTop:0}, 'slow'); //slow, medium, fast
        })
        
// esse evento corresponde ao clicar nos itens do navbar fechando o menu mobile
        $(".evtClick").click( () =>{
            const fechar_list = document.querySelector('.nav-list')
            const fechar_menu = document.querySelector('.mobile-menu')

           
            fechar_list.classList.remove('active')
            fechar_menu.classList.remove('active')

            document.querySelectorAll('.nav-list li').forEach(el => {
                el.style.animation = ""
            })

        })  
    
});