<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<style>
.c {
  text-align: center;
}

.bar {
  width:425px;
}

h2 {
  font-size: 16px;
  font-weight: 400;
  margin: 0px 0px 0px 0px;
}

h3 {
  font-size: 14px;
  font-weight: 400;
  margin: 0px 0px 0px 0px;
}
h5{
  font-size: 12px;
  margin: 0px 0px 0px 0px;
}
</style>

<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if(!empty($this->session->data['boleto'])){
        $boleto = $this->session->data['boleto'];
        $barcodel = $boleto['barcodel'];
        $barcode = $boleto['barcode'];
        $url = $boleto['url'];
        $total = $boleto['total']; ?>
        <h1> Boleto criado com sucesso</h1>
        <h2>Pague o Boleto para confirmar o Pagamento</h2>
        <br><br>
        <div class="bar">
          <h3 class="c">Use este código de barras para pagamentos no bankline</h3>
          <h5 class="c"><?php echo $barcodel; ?></h5>
          <img src="<?php echo $barcode; ?>">
        </div>
        <h3>Valor a Pagar <?php echo $total; ?></h3>
        <a href="<?php echo $url; ?>" rel='nofollow' target='_blank'><img src="image/iugu/imprimir-boleto.png"></a>
        <br><br>
        <?php unset($this->session->data['boleto']);
    } else { ?>
        <h1><?php echo $heading_title; ?></h1>
    <?php } ?>
  <?php echo $text_message; ?>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>
