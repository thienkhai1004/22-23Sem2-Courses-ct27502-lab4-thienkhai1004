<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
</head>
<body>

<script>
      $(function(){
            new WOW().init();
            $('#contacts').DataTable();
            $('button[name="delete-contact]').on('click', function(e){
                  var $form = $(this).closest('form');
                  e.preventDefault();
                  $('#delete-confirm').modal({
                        backdrop: 'static',
                        keyboard: false
                  })
                  .one('click', '#delete', function() {
                        $form.trigger('submit');
                  })
            })
      });
</script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>