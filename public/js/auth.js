



$(document).ready(function(){
    $('#myLoginForm input[type="text"]').blur(function(){
        if(!$(this).val()){
            $(this).addClass("error");
        } else{
            $(this).removeClass("error");
        }
    });
    $('#myLoginForm input[type="password"]').blur(function(){
        if(!$(this).val()){
            $(this).addClass("error");
        } else{
            $(this).removeClass("error");
        }
    });
});
function login_via_ajax(redirect_url){
    var login_url=$('#login_url').val();
    var email =$('#email').val();
    var password =$('#password').val();
    var national_id =$('#national_id').val();
    $.ajax({
        method: "POST",
        url: login_url,
        data:{email:email, password:password, national_id:national_id}
      })
        // .done(function( msg ) {
        //     // var json = JSON.parse(msg);
        //     // $.each(json, function (index, value)
        //     // {
        //         // if (index === 'success')
        //         // {
        //             $("html").html(msg);
        //             // alert(value);
        //         //  window.location.href = redirect_url;
        //         // }else{
        //         //     alert(value);
        //         // }
        //         // });
          
        // });

}

function signin_via_email(sign_inOption) {
    var i;
    var x = document.getElementsByClassName("tab__content");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    document.getElementById(sign_inOption).style.display = "block";

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  }




