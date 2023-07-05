
$("body").delegate('.delInquiry', 'click', function () {
  let _id = $(this).attr('data-id');
  let delInquiryUri = '/delInquiry';

  $.ajax({
    url: delInquiryUri,
    type: 'post',
    data: {id: _id},
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    success: function (json) {
      if(json.re == '1'){
        $('#pd_'+json.id).remove();
      }
    },
    error: function () {
    },
    complete: function () {
    }
  });

});



$(function(){
  $('#re-rand-img').click(function(){
    $('#rand-img').attr('src','getCaptcha?name=contact?'+new Date().getTime());
  }).trigger('click');
});

$(function(){
  $("#contactForm").validate({
    //errorClass:'error font-16 mt-2',
    errorElement: 'span',
    ignore: [],
    rules: {
      'contact[name]': {required: true},
      'contact[county]': {required: true},
      'contact[company]': {required: true},
      'contact[phone]': {required: true},
      'contact[email]': {required: true , email:true},
      'contact[subject]': {required: true},
      'contact[content]': {required: true},

      'contact[verification]': {
        required: true ,
      },

    },
    messages: {},
    success: function (error) {},
    submitHandler: function(form){
      $('button[type="submit"]').attr('disabled',true);
      form.submit();
    },
    invalidHandler: function (ev, validator) {
    },
    errorPlacement: function(error, element) {
    },
    highlight: function(element){
      if($(element).hasClass('selectpicker')){
        $(element).parents('.bootstrap-select').css({'border': '1px solid #ff0000'});
      }else{
        $(element).css({'border': '1px solid #ff0000'});
      }
    },
    unhighlight: function(element){
      if($(element).hasClass('selectpicker')){
        $(element).parents('.bootstrap-select').css({'border': ''});
      }else{
        $(element).css({'border': ''});
      }
    },
  });
});
