    var url = "http://localhost/";
    function mesajgonder() {
        var deger = $("#iletisimformu").serialize();
        $.ajax({
            type : "POST",
            url : url+"inc/mesajgonder.php",
            data : deger,
            success : function (sonuc) {
                    if ($.trim(sonuc) == "bos"){
                        swal("Hata", "lütfen tüm alanları doldurun.", "error");
                    }else if ($.trim(sonuc) == "format"){
                        swal("Hata", "E-posta formatı yanlış", "error");
                    }else if ($.trim(sonuc) == "hata"){
                        swal("Hata", "Sistem hatası oldu", "error");
                    }else if($.trim(sonuc) == "basarili"){
                        swal("Başarılı", "Mesajınızı aldım. En kısa sürede dönüş yapacağım..", "success");
                        $("input[name=isim]").val('');
                        $("input[name=eposta]").val('');
                        $("input[name=konu]").val('');
                        $("textarea[name=mesaj]").val('');
                    }
            }
        });
    }

    function yorumyap() {
        var deger = $("#yorumformu").serialize();
        $.ajax({
            type : "POST",
            url  : url+"/inc/yorumyap.php",
            data : deger,
            success : function (sonuc) {
                if ($.trim(sonuc) == "bos"){
                    swal("Hata", "lütfen tüm alanları doldurun.", "error");
                }else if ($.trim(sonuc) == "format"){
                    swal("Hata", "E-posta formatı yanlış", "error");
                }else if ($.trim(sonuc) == "hata"){
                    swal("Hata", "Sistem hatası oldu", "error");
                }else if($.trim(sonuc) == "basarili"){
                    swal("Başarılı", "Yorumunuzu aldım. En kısa sürede yayınlayacağım..", "success");
                    $("input[name=adsoyad]").val('');
                    $("input[name=eposta]").val('');
                    $("input[name=website]").val('');
                    $("textarea[name=yorum]").val('');
                }
            }
        });

    }
    
    function aboneol() {
        var deger = $("#aboneformu").serialize();
        $.ajax({
            type    : "POST",
            url     : url+"inc/aboneol.php",
            data    : deger,
            success : function (sonuc) {
                if ($.trim(sonuc) == "bos"){
                    swal("Hata", "lütfen tüm alanları doldurun.", "error");
                }else if ($.trim(sonuc) == "format"){
                    swal("Hata", "e-posta formamtı yanlış.", "error");
                }else if ($.trim(sonuc) == "hata"){
                    swal("Hata", "sistemyonetim hatası oldu.", "error");
                }else if ($.trim(sonuc) == "basarili"){
                    swal("Başarılı", "abone olduğunuz için teşekkürler.", "success");
                    $("input[name = eposta]").val('');
                }else if ($.trim(sonuc) == "var"){
                    swal("Hata", "Görünüşe göre abone listemize kayıtlıymışsınız. Söz veriyoruz sizi habersiz bırakmayacağız.", "error");
                }
            }
        });
    }
