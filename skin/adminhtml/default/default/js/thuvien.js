Event.observe(window, 'load', function() {
  if($$('.thuvien-adminhtml-quydinh-edit').length) {
        $$('.form-buttons .scalable.delete').each(function(d){
            d.setStyle({'display':'none'});
        });
    }

    if($$('.thuvien-adminhtml-quydinh-index').length) {
        $$('.form-buttons .scalable.add').each(function(d){
            d.setStyle({'display':'none'});
        });
    }

});