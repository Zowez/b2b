var url = "http://localhost/e-commerce";

function registerSeller(){

    document.getElementById("registerButton").disabled = true;

    
    var data = $('#seller-register-form').serialize();
    $.ajax({
        type : "POST",
        url  : url + "/inc/register.php",
        data : data,
        success : function(result){

            if($.trim(result) == "empty"){
                alert("Lütfen boş alan bırakmayınız");
                document.getElementById("registerButton").disabled = false;

            }else if($.trim(result) == "format"){
                alert("E-posta formatı hatalı");
                document.getElementById("registerButton").disabled = false;


            }else if($.trim(result) == "match"){
                alert("Şifreler uyuşmadı");
                document.getElementById("registerButton").disabled = false;


            }else if($.trim(result) == "already"){
                alert("Bu e-posta adına ait bir bayi zaten kayıtlı");
                document.getElementById("registerButton").disabled = false;


            }else if($.trim(result) == "error"){
                alert("Bir hata oluştu...");
                document.getElementById("registerButton").disabled = false;


            }else if($.trim(result) == "ok"){
                alert("Üyeliğiniz başarıyla oluştuldu... Yönetici onayından sonra aktifleştirilecektir...");
                window.location.href = url;
            }

        }
    });
}



function loginSeller(){

    document.getElementById("loginButton").disabled = true;


    var data = $("#seller-login-form").serialize();
    $.ajax({
        type : "POST",
        url  : url + "/inc/login.php",
        data : data,
        success : function(result){

            console.log("Raw result:", result);
            
            if($.trim(result) == "empty"){
                alert('Boş alan bırakmayınız');
                document.getElementById("loginButton").disabled = false;
            }else if($.trim(result) == "error"){
                alert('Bayi kodu, e-posta veya şifre yanlış');
                document.getElementById("loginButton").disabled = false;

            }else if($.trim(result) == "passive"){
                alert('Üyeliğiniz pasif durumdadır');
                document.getElementById("loginButton").disabled = false;

            }else if($.trim(result) == "ok"){
                alert('Başarıyla giriş yaptınız, yönlendiriliyorsunuz...');
                window.location.href = url;
            }
        }
    })

}