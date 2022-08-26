var url = "http://proyecto-laravel.com/";

window.addEventListener("load", function () {
    // esto sirve para pasar por el like y que el cursor te cambie a la manito
    $(".btn-like").css("cursor", "pointer");
    $(".btn-dislike").css("cursor", "pointer");

    // esto es para darle like, osea para que al apretarle al corazon se ponga en rojo

    function like() {
        $(".btn-like")
            .unbind("click")
            .click(function () {
                console.log("like");
                $(this).addClass("btn-dislike").removeClass("btn-like");
                $(this).attr('src', url+'/img/redhearth.png');

                $.ajax({
                    url: url + "/like/" + $(this).data("id"),
                    type: "GET",
                    success: function (response) {
                        if (response.like) {
                            console.log("Has dado like a la foto");
                        } else {
                            console.log("Error al dar like");
                        }
                    }
                });
                dislike();
            });
    }
    like();

    // y esto va ser para cuando le haces click al corazon rojo se vuelva negro de nuevo
    function dislike() {
        $(".btn-dislike")
            .unbind("click")
            .click(function () {
                console.log("dislike");
                $(this).addClass("btn-like").removeClass("btn-dislike");
                $(this).attr('src', url+'/img/greyheat.png');

                $.ajax({
                    url: url + "/dislike/" + $(this).data("id"),
                    type: "GET",
                    success: function (response) {
                        if (response.like) {
                            console.log("Has dado dislike a la foto");
                        } else {
                            console.log("Error al dar dislike");
                        }
                    }
                });
                like();
            });
    }

    dislike();

    // Buscador 
    $('#buscador').submit(function(e){
        e.preventDefault();
         $(this).attr('action', url+'/gente/'+ $('#buscador #search').val());
         
        //  no me esta andando esta madre, ver despues, ahora wa descansar 

    });
});
