(function($){
	$(function(){

    $('.cmn-toggle').each(function () {
      $(this).change(function() {
        var curr_class = '.' + $(this).attr('id');
        var price = $(this).attr('data-price');
        var price_box = $('.pricing-table li.price span');

        $(curr_class).toggleClass('active');

        if (price) {
          if ($(curr_class).hasClass('active')) {
            price_box.html(parseInt(price_box.html()) + parseInt(price));
          }
          else {
            price_box.html(parseInt(price_box.html()) - parseInt(price));
          }          
        }


      });
    });
    
	}); // end of document ready
})(jQuery); // end of jQuery name space