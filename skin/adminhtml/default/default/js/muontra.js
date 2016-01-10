

Event.observe(window, 'load', function() {
    $('barcode-input').focus();

    $$('#barcode-input').invoke('observe','keypress',function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
           var mavach = $('barcode-input').value.trim();

            if(mavach.length == 10) {
                // muon sach dua vao ma doc gia
                // di den trang doc gia, sau do muon sach
                var madocgia = mavach;
                muonsach(madocgia);
            }
            else if(mavach.length == 12) {
                // tra sach dua vao ma sach
                // thuc hien tra sach va di den trang doc gia
                var matp = mavach;
                tratp(matp);
            }
            else {
                alert("Mã vạch bạn nhập không hợp lệ.Vui lòng kiểm tra lại!");
            }
        }
        else {

        }
    });

    function muonsach(madocgia) {
        $('loading-mask').show();
        var urlchitietdocgia = $('chitietdocgiaUrl').value.trim();
        new Ajax.Request(urlchitietdocgia, {
            method: 'post',
            parameters: {"madocgia":madocgia},
            onSuccess: function(data){
                var urlRedirect = data.responseText;
                if (urlRedirect == 0) {
                    alert("Mã Độc giả không tồn tại. Vui lòng kiểm tra lại!");
                }
                else {
                   window.location.href = urlRedirect;
                }
                $('loading-mask').hide();
            },
            onFailure: function(data){
                alert("Có lỗi hệ thống xảy ra. Vui lòng kiểm tra lại!");
                $('loading-mask').hide();
            }
        });
    }

    function tratp(matp) {
        $('loading-mask').show();
        var urlTraSach = $('urlTrasach').value.trim();
        new Ajax.Request(urlTraSach, {
            method: 'post',
            parameters: {"matp":matp},
            onSuccess: function(data){
                var messageResult = data.responseText;
                if (messageResult=='0') {
                    alert('Tác phẩm bạn trả không có trong danh sách tác phẩm được mượn. Vui lòng kiểm tra lại!');
                }
                else {
                    alert(messageResult);
                }
                $('loading-mask').hide();
            },
            onFailure: function(data){
               alert("Có lỗi xảy ra khi trả tác phẩm. Vui lòng kiểm tra lại!")
                $('loading-mask').hide();
            }
        });
    }
});