<?php

require_once(DIR_SYSTEM . 'library/iugu/Iugu.php');

class ControllerPaymentIuguBankslip extends Controller {

    public function confirm() {
      //5 = Falha no Pagamento
      $this->log->write('Pagamento iugu Boleto - Dentro do confirm()');

      //Carregando os models e linguagem
      $this->load->model('checkout/order');
      $this->load->model('account/customer');
      $this->load->model('payment/iugu_bankslip');
      $this->language->load('payment/iugu_bankslip');

      //Dados do Pedido
      $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
      $cliente = $this->model_account_customer->getCustomer($order_info['customer_id']);
      $produtos = $this->cart->getProducts();

      //Token de Segurança
      Iugu::setApiKey($this->config->get('iugu_bankslip_token'));

      //Montando Dados
      $name = trim($order_info['payment_firstname']) . ' ' . trim($order_info['payment_lastname']);
      $email = trim($order_info['email']);

      //Produtos
      foreach ($produtos as $product) {
          $options_names = '';
          foreach ($product['option'] as $option) {
              $options_names .= ' - ' . $option['name'] . ': ' . $option['option_value'];
          }
          //Até 80 caracteres para a descrição do Produto
          $description = mb_substr($product['name'] . $options_names, 0, 80, 'UTF-8');
          if (($this->currency->format($product['price'], $order_info['currency_code'], false, false) * 100) >= 1) {
              $item[] = array(
                  'description' => $description,
                  'quantity' => $product['quantity'],
                  'price_cents' => $this->currency->format($product['price'], $order_info['currency_code'], false, false) * 100
              );
          }
      }

      $desconto = 0;
      $taxa_extra = $this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $order_info['currency_code'], false, false) * 100;
      if ($taxa_extra >= 1) {
          $item[] = array(
              'description' => $this->language->get('text_extra_amount'),
              'quantity' => 1,
              'price_cents' => $taxa_extra
          );
      } else {
          $desconto = abs($taxa_extra);
      }

      $this->log->write('Pagamento iugu Boleto - Dados adicionados');

      //PASSO 1
      //Criando Cliente
      //Verificando se existe o cliente cadastrado
      if (empty($cliente['iugu_customer_id'])) {
          //Criando Cliente na iugu
          $this->log->write('Pagamento iugu Boleto - Criando cliente');
          $cliente = Iugu_Customer::create(Array(
                      "email" => $email,
                      "name" => $name
          ));

          //Adicionando cliente ao Banco de Dados
          if (!empty($cliente['id'])) {
              $this->log->write('Pagamento iugu Boleto - Adicionando referência do cliente ao Banco. ID = ' . $cliente['id']);
              $this->db->query("UPDATE `" . DB_PREFIX . "customer`
              SET iugu_customer_id= '" . $cliente['id'] . "'
              WHERE customer_id = '" . $order_info['customer_id'] . "' ");
              $this->log->write('Pagamento iugu Boleto - Adicionado iugu_customer_id');
          }
      } else {
          $cliente['id'] = $cliente['iugu_customer_id'];
      }

      //Passo 2
      //Criando Boleto
      $this->log->write('Pagamento iugu Boleto - Criando o Boleto');

      if($this->config->get('iugu_bankslip_cobrança') == 1) {
        $cobranca = 'false';
      }else {
        $cobranca= 'true';
      }

      $p = Iugu_Invoice::create(Array(
        "email" => $email,
        "due_date" => date('Y-m-d', strtotime("+".$this->config->get('iugu_bankslip_vencimento')." days")),
        "items" => $item,
        "return_url" =>  $this->url->link('checkout/success', '', 'SSL'),
        "expired_url" =>  $this->url->link('checkout/success', '', 'SSL'),
        "notification_url" =>  $this->url->link('payment/iugu_bankslip/callback', '', 'SSL'),
        "discount_cents" => $desconto,
        "customer_id" => $cliente['id'],
        "ignore_due_email" => $cobranca
      ));

      //Verificando se Boleto foi criado com sucesso
      if ((!empty($p['id'])) and ( !empty($p['secure_url']))) {
        $this->log->write('Pagamento iugu Boleto - Boleto Criado com sucesso');
        $url = $p['secure_url'].'.pdf?bs=true';
        $boleto = array(
          'url' => $url,
          'total' => 'R$ '.number_format($this->currency->format($order_info['total'], $order_info['currency_code'], false, false), 2, ',', ''),
          'barcodel' =>$p['bank_slip']->digitable_line,
          'barcode' => $p['bank_slip']->barcode
        );

        $pagamento  = "
            Se não tiver pago, abra o Boleto abaixo para pagar<br>
            <a href='$url' rel='nofollow' target='_blank'><img src='image/iugu/imprimir-boleto.png'></a>
        ";

        //Confirmando Pedido
        $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('iugu_bankslip_order_aguardando_pagamento'), $pagamento, true);
        $this->db->query("UPDATE `" . DB_PREFIX . "order` SET iugu_order_id = '" . $p['id'] . "' WHERE order_id = '" . (int) $this->session->data['order_id'] . "'");

        //Adicionando dados do Boleto na sessão, para ser usado no Confirmar
        $this->session->data['boleto'] = $boleto;
        $this->log->write('Pagamento iugu Boleto - Retornando URL do Sucesso');
        echo $this->url->link('checkout/iugu_success');
      } else {
        $this->log->write('Pagamento iugu Boleto - Criação da Fatura falhou');
        echo 5;
      }
    }
    protected function index() {
        $this->language->load('payment/iugu_bankslip');
        $this->data['button_confirm'] = $this->config->get('iugu_bankslip_confirmar');
        $this->data['text_description'] = $this->config->get('iugu_bankslip_informativo');
        $this->data['text_wait'] = $this->language->get('text_wait');
        $this->data['text_erro_pagamento'] = $this->language->get('text_erro_pagamento');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/iugu_bankslip.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/iugu_bankslip.tpl';
        } else {
            $this->template = 'default/template/payment/iugu_bankslip.tpl';
        }
        $this->render();
    }

    //Mudando o Histórico do Pedido
    public function callback() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') and ( !empty($_POST["data"]))) {
            $dados = $_POST["data"];
            $this->log->write('Pagamento iugu Boleto - Entrou no callback(). <br>ID do Pedido ' . $dados['id'] . ' Status ' . $dados['status']);
            $this->load->model('payment/iugu_bankslip');
            //Buscando o Pedido com base no ID do Pedido da IUGU
            $order = $this->model_payment_iugu_bankslip->getOrder($dados['id']);
            if (!empty($order)) {
                $this->log->write('Pedido retornado com sucesso - Status ID ' . $order['order_status_id']);
                $update_status_alert = false;
                if ($this->config->get('iugu_bankslip_update_status_alert')) {
                    $update_status_alert = true;
                }
                //Mudando o Histórico do Pedido com base no Status retornado pela IUGU
                switch ($dados['status']) {
                    case 'paid':
                        if ($order['order_status_id'] != $this->config->get('iugu_bankslip_order_paga')) {
                            $this->model_payment_iugu_bankslip->update($dados['id'], $this->config->get('iugu_bankslip_order_paga'), '', $update_status_alert);
                            $this->log->write('Histórico do Pedido mudado - paid');
                        }
                        break;
                    case 'canceled':
                        if ($order['order_status_id'] != $this->config->get('iugu_bankslip_order_cancelada')) {
                            $this->model_payment_iugu_bankslip->update($dados['id'], $this->config->get('iugu_bankslip_order_cancelada'), '', $update_status_alert);
                            $this->log->write('Histórico do Pedido mudado - canceled');
                        }
                        break;
                    case 'payment_in_progress':
                        if ($order['order_status_id'] != $this->config->get('iugu_bankslip_order_analise')) {
                            $this->model_payment_iugu_bankslip->update($dados['id'], $this->config->get('iugu_bankslip_order_analise'), '', false);
                            $this->log->write('Histórico do Pedido mudado - payment_in_progress');
                        }
                        break;
                    case 'expired':
                        if ($order['order_status_id'] != $this->config->get('iugu_bankslip_order_expirado')) {
                            $this->model_payment_iugu_bankslip->update($dados['id'], $this->config->get('iugu_bankslip_order_expirado'), '', $update_status_alert);
                            $this->log->write('Histórico do Pedido mudado - expired');
                        }
                        break;
                    case 'refunded':
                        if ($order['order_status_id'] != $this->config->get('iugu_bankslip_order_reembolsado')) {
                            $this->model_payment_iugu_bankslip->update($dados['id'], $this->config->get('iugu_bankslip_order_reembolsado'), '', $update_status_alert);
                            $this->log->write('Histórico do Pedido mudado - refunded');
                        }
                        break;
                }
            }
        }
    }
}
