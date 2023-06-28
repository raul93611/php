$('.delete').on('click', function (e) {
  e.preventDefault();
  if (confirm('Are you sure')) {
    const form = $('<form>');
    form.attr('method', 'POST');
    form.attr('action', $(this).attr('href'));
    form.appendTo('body').submit();
  }
});

$.validator.addMethod('dateTime', function (value, element) {
  return (value === '') || !isNaN(Date.parse(value));
}, 'Must be a valid date time');

$('#formArticle').validate({
  rules: {
    title: {
      required: true
    },
    content: {
      required: true
    },
    published_at: {
      dateTime: true
    }
  }
});

$('.publish').click(function (e) {
  const id = $(this).data('id');
  const button = $(this);
  $.ajax({
    url: '/admin/publish-article.php',
    type: 'POST',
    data: { id: id }
  }).done(function (data) {
    button.parent().html(data);
  });
});