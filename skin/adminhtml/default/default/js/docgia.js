
    function addLp(addLephiUrl,maDocGia){
        var SoTien = $('SoTien').getValue();

        if(SoTien =="" || parseInt(SoTien) < 0) {
            alert("Vui lòng nhập chính xác số tiền!");
            return;
        }

        var NgayNhap = $('NgayNhap').getValue();
        if(NgayNhap == "") {
            alert("Vui lòng nhập ngày nhập!");
            return;
        }

        var MaLyDo = $('MaLyDo').getValue();
        var MaGhiChu = $('MaGhiChu').getValue();
        var HetHan = $('HetHan').getValue();

        $('loading-mask').show();
        new Ajax.Request(addLephiUrl, {
            method: 'post',
            parameters: {'SoTien':SoTien, 'NgayNhap':NgayNhap, 'MaLyDo':MaLyDo,'MaGhiChu':MaGhiChu,'HetHan':HetHan,'MaDocGia':maDocGia},
            onSuccess: function (data) {
               var resultArr = JSON.parse(data.responseText);
                if(resultArr.success == 1) {
                    $('lephidocgiaGrid').remove();
                    $('docgia_tabs_lephi_section_content').insert(resultArr.content);
                    alert(resultArr.message);
                    clearFrmLePhiDocGia();
                }
                else {
                    alert(resultArr.message);
                }
                $('loading-mask').hide();
            },
            onFailure: function (data) {
                alert('Error occured when trying to rend key.');
                $('loading-mask').hide();
            }
        });

    }

    function deleteLephi(deleteLephiUrl,ma_tai_chanh,ma_doc_gia) {
        
        $('loading-mask').show();
        new Ajax.Request(deleteLephiUrl, {
            method: 'post',
            parameters: {'MaTaichanh':ma_tai_chanh, 'MaDocGia':ma_doc_gia},
            onSuccess: function (data) {
                var resultArr = JSON.parse(data.responseText);
                if(resultArr.success == 1) {
                    $('lephidocgiaGrid').remove();
                    $('docgia_tabs_lephi_section_content').insert(resultArr.content);
                    alert(resultArr.message);
                    clearFrmLePhiDocGia();
                }
                else {
                    alert(resultArr.message);
                }
                $('loading-mask').hide();
            },
            onFailure: function (data) {
                alert('Error occured when trying to rend key.');
                $('loading-mask').hide();
            }
        });
    }

    function clearFrmLePhiDocGia(){
        $('SoTien').setValue("");
        $('NgayNhap').setValue("");
        $('HetHan').setValue("");
        $('MaLyDo').setValue(1);
        $('MaGhiChu').setValue(1);
    }