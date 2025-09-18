var url = "http://localhost/e-commerce";

function registerSeller() {

    document.getElementById("registerButton").disabled = true;


    var data = $('#seller-register-form').serialize();
    $.ajax({
        type: "POST",
        url: url + "/inc/register.php",
        data: data,
        success: function (result) {

            if ($.trim(result) == "empty") {
                alert("Lütfen boş alan bırakmayınız");
                document.getElementById("registerButton").disabled = false;

            } else if ($.trim(result) == "format") {
                alert("E-posta formatı hatalı");
                document.getElementById("registerButton").disabled = false;


            } else if ($.trim(result) == "match") {
                alert("Şifreler uyuşmadı");
                document.getElementById("registerButton").disabled = false;


            } else if ($.trim(result) == "already") {
                alert("Bu e-posta adına ait bir bayi zaten kayıtlı");
                document.getElementById("registerButton").disabled = false;


            } else if ($.trim(result) == "error") {
                alert("Bir hata oluştu...");
                document.getElementById("registerButton").disabled = false;


            } else if ($.trim(result) == "ok") {
                alert("Üyeliğiniz başarıyla oluştuldu... Yönetici onayından sonra aktifleştirilecektir...");
                window.location.href = url;
            }

        }
    });
}



function loginSeller() {

    document.getElementById("loginButton").disabled = true;


    var data = $("#seller-login-form").serialize();
    $.ajax({
        type: "POST",
        url: url + "/inc/login.php",
        data: data,
        success: function (result) {



            if ($.trim(result) == "empty") {
                alert('Boş alan bırakmayınız');
                document.getElementById("loginButton").disabled = false;
            } else if ($.trim(result) == "error") {
                alert('Bayi kodu, e-posta veya şifre yanlış');
                document.getElementById("loginButton").disabled = false;

            } else if ($.trim(result) == "passive") {
                alert('Üyeliğiniz pasif durumdadır');
                document.getElementById("loginButton").disabled = false;

            } else if ($.trim(result) == "ok") {
                alert('Başarıyla giriş yaptınız, yönlendiriliyorsunuz...');
                window.location.href = url;
            }
        }
    })

}

function accountupdate() {


    document.getElementById("accountbtn").disabled = true;


    var data = $("#accountform").serialize();
    $.ajax({
        type: "POST",
        url: url + "/inc/profileupdate.php",
        data: data,
        success: function (result) {
            if ($.trim(result) == "empty") {
                alert("Lütfen boş alan bırakmayınız");
                document.getElementById("accountbtn").disabled = false;

            } else if ($.trim(result) == "format") {
                alert("E-posta formatı hatalı");
                document.getElementById("accountbtn").disabled = false;


            } else if ($.trim(result) == "already") {
                alert("Bu e-posta adına ait bir bayi zaten kayıtlı");
                document.getElementById("accountbtn").disabled = false;


            } else if ($.trim(result) == "error") {
                alert("Bir hata oluştu...");
                document.getElementById("accountbtn").disabled = false;


            } else if ($.trim(result) == "ok") {
                alert("Profiliniz başarıyla güncellendi...");
                window.location.reload();
            }

        }
    });

}


function updateSettings() {

    document.getElementById("update-settings-button").disabled = true;

    var data = $("#settingsform").serialize();

    $.ajax({
        type: "POST",
        url: url + "/inc/settingsupdate.php",
        data: data,
        success: function (result) {
            

            if ($.trim(result) == "empty") {
                alert("Lütfen boş alan bırakmayınız");
                document.getElementById("update-settings-button").disabled = false;

            } else if ($.trim(result) == "format") {
                alert("E-posta formatı hatalı");
                document.getElementById("update-settings-button").disabled = false;

            } else if ($.trim(result) == "already") {
                alert("Bu e-posta adına ait bir kullanıcı zaten kayıtlı");
                document.getElementById("update-settings-button").disabled = false;

            } else if ($.trim(result) == "error") {
                alert("Bir hata oluştu...");
                document.getElementById("update-settings-button").disabled = false;

            } else if ($.trim(result) == "ok") {
                alert("Bilgiler başarıyla güncellendi");
                window.location.reload();
            } else if ($.trim(result) == "password_mismatch") {
                alert("Şifreler uyuşmuyor");
                document.getElementById("update-settings-button").disabled = false;
            } else if ($.trim(result) == "current_empty") {
                alert("Mevcut şifre boş bırakılamaz");
                document.getElementById("update-settings-button").disabled = false;
            } else if ($.trim(result) == "current_wrong") {
                alert("Mevcut şifre yanlış");
                document.getElementById("update-settings-button").disabled = false;
            }
        }
    });
}

function addressbtn(){

   
    document.getElementById("addressbutton").disabled = true;

    var data = $("#addressform").serialize();
    $.ajax({
        type : "POST",
        url  : url + "/inc/addressupdate.php",
        data : data,
        success : function(result){

            if($.trim(result) == "empty"){
                alert("Lütfen boş alan bırakmayınız");
                document.getElementById("addressbutton").disabled = false;

            }else if($.trim(result) == "error"){
                alert("Bir hata oluştu...");
                document.getElementById("addressbutton").disabled = false;


            }else if($.trim(result) == "ok"){
                alert("Adresiniz başarıyla güncellendi");
                window.location.href = url + "/profile.php?process=address";
            }

        }
    });

}


function addressaddbtn(){

    
     document.getElementById("addressaddbutton").disabled = true;
 
     var data = $("#addressaddform").serialize();
     $.ajax({
         type : "POST",
         url  : url + "/inc/addressaddbutton.php",
         data : data,
         success : function(result){
 
             if($.trim(result) == "empty"){
                 alert("Lütfen boş alan bırakmayınız");
                 document.getElementById("addressaddbutton").disabled = false;
 
             }else if($.trim(result) == "error"){
                 alert("Bir hata oluştu...");
                 document.getElementById("addressaddbutton").disabled = false;
 
             }else if($.trim(result) == "ok"){
                 alert("Adresiniz başarıyla eklendi");
                 window.location.reload();
             }
 
         }
     });
 
 }

 function banktransfersaddbtn(){

    
     document.getElementById("banktransfersaddbutton").disabled = true;
 
 
     var data = $("#banktransfersaddform").serialize();
     $.ajax({
         type : "POST",
         url  : url + "/inc/banktransfersadd.php",
         data : data,

         
         success : function(result){
            console.log("Raw result:", $.trim(result));
             if($.trim(result) == "empty"){
                 alert("Lütfen boş alan bırakmayınız");
                 document.getElementById("banktransfersaddbutton").disabled = false;
 
             }else if($.trim(result) == "error"){
                 alert("Bir hata oluştu...");
                 document.getElementById("banktransfersaddbutton").disabled = false;
 
 
             }else if($.trim(result) == "number"){
                alert("Havale tutarı sayısal ifade olmalıdır...");
                document.getElementById("banktransfersaddbutton").disabled = false;


            }else if($.trim(result) == "ok"){
                 alert("Havale bildiriminiz gönderildi, yönetici kontrolünden sonra tarafınıza ulaşım sağlanacaktır");
                 window.location.href = url + "/profile.php?process=banktransfersadd";
             }
 
         }
     });
 
 }