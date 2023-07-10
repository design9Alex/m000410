
$('body').delegate('.categorySelect', 'click', function () {
  let _id = $(this).attr('data-value');
  $('#cls').val(_id);

  let getProductCategory = _getProductCategory;

  $.ajax({
    url: getProductCategory,
    type: 'post',
    data: {id: _id},
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    success: function (json) {
      $('#secCategorySelect').html(json.html);
      $('#secCategoryFirstOption').text(json.option);
      $('#cls2').val(json.val);
    },
    error: function () {
    },
    complete: function () {
    }
  })

});

$('body').delegate('.secCategorySelect', 'click', function () {
  let _id = $(this).attr('data-value');
  let _title = $(this).attr('data-title');
  $('#cls2').val(_id);
  $('#secCategoryFirstOption').text(_title);
});


$('body').delegate('.selectOption', 'click', function () {
  let _this = $(this);

  _this.parent().find('.selectOption').each(function(){
    $(this).removeClass('active');
  });
  _this.addClass('active');

});
