

Event.observe(window, 'load', function() {
    $('barcode-input').focus();

    $$('#barcode-input').invoke('observe','keypress',function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
           var mavach = $('barcode-input').value;

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
        var urlchitietdocgia = $('chitietdocgiaUrl').value;
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
        new Ajax.Request(link_extendtrial, {
            method: 'post',
            parameters: {"module":modulename},
            onSuccess: function(data){
                if(data.responseText)
                {
                    $$('#row_mcore_mwmodule_'+modulename+' .value ')[0].update(data.responseText);
                    window.location.reload();
                }
                $('loading-mask').hide();
            },
            onFailure: function(data){
                var notice= $('mw_mcore_notice_'+modulename)|| "";
                if(notice.length == 0)
                {

                    $$('#row_mcore_mwmodule_'+modulename+' .value')[0].insert('<div id="mw_mcore_notice_'+modulename+'" class="mw_mcore_notice">Error occured when trying to extend trial.</div>');
                }
                else
                {
                    $('mw_mcore_notice_'+modulename+'').innerHTML = 'Error occured when trying to extend trial.';
                }
                $('loading-mask').hide();
            }
        });
    }
});