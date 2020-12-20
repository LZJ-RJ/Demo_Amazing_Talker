require('./bootstrap');

jQuery(function($){
    if($('.languages').length){
        $('.languages').select2();
    }
})
