<div class="content">
  <div id="aviso_pagamento"></div>
  <p><?php echo $text_description; ?></p>
</div>
<div class="buttons">
  <div class="right">
    <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" />
  </div>
</div>
<script type="text/javascript">
$('#button-confirm').bind('click', function() {
    $(this).after("<?php echo $text_wait; ?>");
    $('#button-confirm').hide();
    $.ajax({
    type: 'GET',
            contentType :'application/x-www-form-urlencoded; charset=utf-8',
            dataType: 'text',
            timeout: 26000,
            url: 'index.php?route=payment/iugu_bankslip/confirm',
            complete: function() {
               $('.attention').remove();
            },
            success: function(data) {
                if (data == 5) {
                    $("#aviso_pagamento").html("<?php echo $text_erro_pagamento; ?>");
                    $('#button-confirm').show();
                } else {
                    window.location = data;
                }
            },
            error: function(){
                $("#aviso_pagamento").html("<?php echo $text_erro_pagamento; ?>");
                $('#button-confirm').show();
            }
    });
});
</script>
