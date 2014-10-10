<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
    <h1><img style="margin-top: -5px;"  alt="Pagamento iugu Boleto" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsSAAALEgHS3X78AAAAB3RJTUUH3goHDhUjrMtNiwAAAThJREFUSMfF1jFLAzEUwPE/9WqlJw4Vi1VUdHBycBTEb9BdUERBFCc3cS50aTc/ibSTfgihOp5OLkLRwaFFXOoS4fHI8OSSM5Ah78j9ksvjXaCgNuWJrQD7wDvwGQueBSai12NBywqaAI1YWN+DXQM1IAWqQDkU9uzBdB8Ch0CSF7szYL/9OC/WAN6M2G2obFwENoBt4NKlv8ZOYiXOrgdLisJOrRNngC836UGtsAU8AgOgI+JDAY2sUKpWuCmePYl4JuJnak5Fv7Tkgb7VuGlY3L0aT1t39SFWJwtr1+0kA25UcR6IOakVOlCfYi9WJiWetN2JhR15sFcXXwOW3G+kGgLrGcvPCzCfFzv/Q3HthTizC2BswLJQZ1dxRXYOWADaHqxf5BVgNRZWV1At5vVtHbgCtviv9gOawJcGUybBdgAAAABJRU5ErkJggg==" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <a href="http://iugu.com/"><img style="margin-left: 8px;" src="view/image/payment/iugu.png" alt="Pagamento iugu"></a><br>
      <button id="mostrar_token">Configurar o Token/Esconder</button>
      <span id="token_info" class= 'help' style="display: none;"><?php echo $text_info_token; ?> </span><br>
	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	    <table class="form">
	      <tr>
	        <td id="token"><span class="required">*</span> <?php echo $entry_token; ?></td>
	        <td><input type="text" name="iugu_bankslip_token" value="<?php echo $iugu_bankslip_token; ?>" size="50%" />
	          <?php if ($error_token) { ?>
	          <span class="error"><?php echo $error_token; ?></span>
	          <?php } ?></td>
              </tr>
        <tr>
          <td><?php echo $entry_titulo; ?></td>
          <td><input type="text" name="iugu_bankslip_titulo" value="<?php if(!empty($iugu_bankslip_titulo)) { echo $iugu_bankslip_titulo; } else { echo "Boleto";} ?>" size="50%" /></td>
        </tr>
        <tr>
          <td><?php echo $entry_confirmar; ?></td>
          <td><input type="text" name="iugu_bankslip_confirmar" value="<?php if(!empty($iugu_bankslip_confirmar)) { echo $iugu_bankslip_confirmar; } else { echo "Confirmar Pagamento";} ?>" size="50%" /></td>
        </tr>
        <tr>
          <td><?php echo $entry_informativo; ?></td>
          <td><textarea name="iugu_bankslip_informativo"  rows="2" cols="80">
<?php if(!empty($iugu_bankslip_informativo)) { echo $iugu_bankslip_informativo; } else { echo "Clique no Confirmar Pagamento, para confirmar o Pedido e abrir o Boleto.";} ?></textarea>
</td>
        </tr>
	      <tr>
	        <td><?php echo $entry_order_aguardando_pagamento; ?></td>
	        <td><select name="iugu_bankslip_order_aguardando_pagamento" id="iugu_bankslip_order_aguardando_pagamento">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $iugu_bankslip_order_aguardando_pagamento) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	        </td>
	      </tr>

	      <tr>
	        <td><?php echo $entry_order_analise; ?></td>
	        <td><select name="iugu_bankslip_order_analise" id="iugu_bankslip_order_analise">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $iugu_bankslip_order_analise) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	        </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_paga; ?></td>
	        <td><select name="iugu_bankslip_order_paga" id="iugu_bankslip_order_paga">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $iugu_bankslip_order_paga) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_expirado; ?></td>
	        <td><select name="iugu_bankslip_order_expirado" id="iugu_bankslip_order_expirado">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $iugu_bankslip_order_expirado) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_reembolsado; ?></td>
	        <td><select name="iugu_bankslip_order_reembolsado" id="iugu_bankslip_order_reembolsado">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $iugu_bankslip_order_reembolsado) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_cancelada; ?></td>
	        <td><select name="iugu_bankslip_order_cancelada" id="iugu_bankslip_order_cancelada">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $iugu_bankslip_order_cancelada) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_update_status_alert; ?></td>
	        <td>
			  <select name="iugu_bankslip_update_status_alert">
	            <?php if ($iugu_bankslip_update_status_alert) { ?>
	            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
	            <option value="0"><?php echo $text_no; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_yes; ?></option>
	            <option value="0" selected="selected"><?php echo $text_no; ?></option>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_geo_zone; ?></td>
	        <td>
			  <select name="iugu_bankslip_geo_zone_id">
	            <option value="0"><?php echo $text_all_zones; ?></option>
	            <?php foreach ($geo_zones as $geo_zone) { ?>
	            <?php if ($geo_zone['geo_zone_id'] == $iugu_bankslip_geo_zone_id) { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
	            <?php } else { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
	           <?php } ?>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_status; ?></td>
	        <td>
			  <select name="iugu_bankslip_status">
	            <?php if ($iugu_bankslip_status) { ?>
	            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	            <option value="0"><?php echo $text_disabled; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_enabled; ?></option>
	            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
      <tr>
         <td>
             <?php echo $entry_cobranca; ?>
         </td>
          <td>
              <?php if($iugu_bankslip_cobranca) {
               echo "<input type='checkbox' name='iugu_bankslip_cobranca' value='1' checked >";
              } else {
               echo "<input type='checkbox' name='iugu_bankslip_cobranca' value='1'>";
              } ?>
         </td>
     </tr>
     <tr>
       <td><?php echo $entry_vencimento; ?></td>
       <td><input type="text" name="iugu_bankslip_vencimento" value="<?php if(!empty($iugu_bankslip_vencimento)) { echo $iugu_bankslip_vencimento; } else { echo 5;} ?>" size="1" /></td>
     </tr>
	      <tr>
	        <td><?php echo $entry_sort_order; ?></td>
	        <td><input type="text" name="iugu_bankslip_sort_order" value="<?php echo $iugu_bankslip_sort_order; ?>" size="1" /></td>
	      </tr>
	    </table>
      </form>
            <h4><?php echo $text_feito; ?></h4>
    </div>
  </div>
</div>
<?php echo $footer; ?>

<script>
$('#token').hover(
    function () {
      $("#info_token").html("<b>Como configurar o Token:</b> <br> <img scr ='image/iugu/token_iugu.gif'>
      <img src='image/iugu/token_iugu.gif' alt='Configurando o Token' height='535' width='1024'>
      <p><b>Passos: </b></p>
      1) Entre no seu Painel da iugu  <br>
      2) Clique em Administração -> Configurações da Conta <br>
      3) Em Adicionar API Token, escolha o tipo de Token Test = Teste e Live = Produção <br>
      4) Coloque uma descrição para o Token e Clique em Criar <br>
      5) Copie o Token Gerado e coloque no Campo Token abaixo <br><br>");
    },
    function () {
       $("#info_token").html("");
    }
);
</script>

<script>
    $(document).ready(function() {
        $("#mostrar_token").click(function() {
            $("#token_info").toggle();
        });
    });
</script>
