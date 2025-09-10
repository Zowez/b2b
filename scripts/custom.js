var url = "http://localhost/e-commerce";

function registerSeller(){

    var data = $('#seller-register-form').serialize();
    $.ajax({
        type : "POST",
        url  : url + "/inc/register.php",
        data : data,
        success : function(result){

            if($.trim(result) == "empty"){
                alert("Lütfen boş alan bırakmayınız");
                document.getElementById("registerbuton").disabled = false;

            }else if($.trim(result) == "format"){
                alert("E-posta formatı hatalı");
                document.getElementById("registerbuton").disabled = false;


            }else if($.trim(result) == "match"){
                alert("Şifreler uyuşmadı");
                document.getElementById("registerbuton").disabled = false;


            }else if($.trim(result) == "already"){
                alert("Bu e-posta adına ait bir bayi zaten kayıtlı");
                document.getElementById("registerbuton").disabled = false;


            }else if($.trim(result) == "error"){
                alert("Bir hata oluştu...");
                document.getElementById("registerbuton").disabled = false;


            }else if($.trim(result) == "ok"){
                alert("Üyeliğiniz başarıyla oluştuldu... Yönetici onayından sonra aktifleştirilecektir...");
                window.location.href = url;
            }

        }
    });
}