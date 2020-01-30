$(function() {
  $('[name="haisouhouhou"]:radio').change( function() {
    if($('[id=a]').prop('checked')){
      $('.text01').css('fontSize','12px'); 
      $('.text01').css('line-height','initial' ); 
      $('.text02').css('fontSize','0px' ); 
      $('.text02').css('line-height','0px' ); 
    } else if ($('[id=b]').prop('checked')) {
      $('.text01').css('fontSize','0px'); 
      $('.text01').css('line-height','0px' );
      $('.text02').css('fontSize','12px'); 
      $('.text02').css('line-height','initial' ); 
    } 
  });
});

$(function() {
  $('[name="siharai"]:radio').change( function() {
    if($('[value="銀行振込"]').prop('checked')){
      $('#disable1').prop('disabled', true);
      $('#disable2').prop('disabled', true);
      $('#disable3').prop('disabled', true);
      $('#disable4').prop('disabled', true);
      $('#disable5').prop('disabled', true);
      $('#disable5').css('border','2px #555 solid');
      $('#disable5').css('color','#555');
    } else if ($('[value="コンビニ・郵便局等"]').prop('checked')){
      $('#disable1').prop('disabled', true);
      $('#disable2').prop('disabled', true);
      $('#disable3').prop('disabled', true);
      $('#disable4').prop('disabled', true);
      $('#disable5').prop('disabled', true);
      $('#disable5').css('border','2px #555 solid');
      $('#disable5').css('color','#555');
    } else if ($('[value="クレジットカード"]').prop('checked')) {
      $('#disable1').prop('disabled', false);
      $('#disable2').prop('disabled', false);
      $('#disable3').prop('disabled', false);
      $('#disable4').prop('disabled', false);
      $('#disable5').prop('disabled', false);
      $('#disable5').css('border','2px #f33 solid');
      $('#disable5').css('color','#f33');
      $('#disable5').hover(
  function(e) {
    $('#disable5').css('border','2px #f99 solid');
    $('#disable5').css('color','#f99');
  },
  function(e) {
    $('#disable5').css('border','2px #f33 solid');
    $('#disable5').css('color','#f33');
  }
);
    } 
  });
});

$(function() {
     
    $('#show').click(function(e) {
        $('#popup, #layer').show();
    });
     
    $('#close, #layer').click(function(e) {
        $('#popup, #layer').hide();
    });
     
});
