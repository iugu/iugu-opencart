<?php
class ControllerPaymentIuguBankslip extends Controller {

    private $error = array();
    public function index() {
        //Carregando a linaguem
        $this->load->language('payment/iugu_bankslip');

        $this->document->setTitle($this->language->get('heading_title_main'));
        //Carregando o Model
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->model_setting_setting->editSetting('iugu_bankslip', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        //Linguagem
        $this->data['heading_title'] = $this->language->get('heading_title_modulo');
        $this->data['text_feito'] = $this->language->get('text_feito');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_all_zones'] = $this->language->get('text_all_zones');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_info_token'] = $this->language->get('text_info_token');

        $this->data['entry_token'] = $this->language->get('entry_token');
        $this->data['entry_order_status'] = $this->language->get('entry_order_status');
        $this->data['entry_order_aguardando_pagamento'] = $this->language->get('entry_order_aguardando_pagamento');
        $this->data['entry_order_analise'] = $this->language->get('entry_order_analise');
        $this->data['entry_order_paga'] = $this->language->get('entry_order_paga');
        $this->data['entry_order_expirado'] = $this->language->get('entry_order_expirado');
        $this->data['entry_order_cancelada'] = $this->language->get('entry_order_cancelada');
        $this->data['entry_order_reembolsado'] = $this->language->get('entry_order_reembolsado');
        $this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_update_status_alert'] = $this->language->get('entry_update_status_alert');
        $this->data['entry_vencimento'] = $this->language->get('entry_vencimento');
        $this->data['entry_cobranca'] = $this->language->get('entry_cobranca');
        $this->data['entry_titulo'] = $this->language->get('entry_titulo');
        $this->data['entry_confirmar'] = $this->language->get('entry_confirmar');
        $this->data['entry_informativo'] = $this->language->get('entry_informativo');
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        //Erro Permissão
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }
        //Erro Token
        if (isset($this->error['token'])) {
            $this->data['error_token'] = $this->error['token'];
        } else {
            $this->data['error_token'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'text' => $this->language->get('text_home'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'text' => $this->language->get('text_payment'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('payment/iugu_bankslip', 'token=' . $this->session->data['token'], 'SSL'),
            'text' => $this->language->get('heading_title'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('payment/iugu_bankslip', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        //Salvando os dados da Configuração
        if (isset($this->request->post['iugu_bankslip_token'])) {
            $this->data['iugu_bankslip_token'] = $this->request->post['iugu_bankslip_token'];
        } else {
            $this->data['iugu_bankslip_token'] = $this->config->get('iugu_bankslip_token');
        }

        if (isset($this->request->post['iugu_bankslip_vencimento'])) {
            $this->data['iugu_bankslip_vencimento'] = $this->request->post['iugu_bankslip_vencimento'];
        } else {
            $this->data['iugu_bankslip_vencimento'] = $this->config->get('iugu_bankslip_vencimento');
        }

        if (isset($this->request->post['iugu_bankslip_cobranca'])) {
            $this->data['iugu_bankslip_cobranca'] = $this->request->post['iugu_bankslip_cobranca'];
        } else {
            $this->data['iugu_bankslip_cobranca'] = $this->config->get('iugu_bankslip_cobranca');
        }

        if (isset($this->request->post['iugu_bankslip_titulo'])) {
            $this->data['iugu_bankslip_titulo'] = $this->request->post['iugu_bankslip_titulo'];
        } else {
            $this->data['iugu_bankslip_titulo'] = $this->config->get('iugu_bankslip_titulo');
        }


        if (isset($this->request->post['iugu_bankslip_confirmar'])) {
            $this->data['iugu_bankslip_confirmar'] = $this->request->post['iugu_bankslip_confirmar'];
        } else {
            $this->data['iugu_bankslip_confirmar'] = $this->config->get('iugu_bankslip_confirmar');
        }

        if (isset($this->request->post['iugu_bankslip_informativo'])) {
            $this->data['iugu_bankslip_informativo'] = $this->request->post['iugu_bankslip_informativo'];
        } else {
            $this->data['iugu_bankslip_informativo'] = $this->config->get('iugu_bankslip_informativo');
        }

        if (isset($this->request->post['iugu_bankslip_update_status_alert'])) {
            $this->data['iugu_bankslip_update_status_alert'] = $this->request->post['iugu_bankslip_update_status_alert'];
        } else {
            $this->data['iugu_bankslip_update_status_alert'] = $this->config->get('iugu_bankslip_update_status_alert');
        }

        if (isset($this->request->post['iugu_bankslip_order_aguardando_pagamento'])) {
            $this->data['iugu_bankslip_order_aguardando_pagamento'] = $this->request->post['iugu_bankslip_order_aguardando_pagamento'];
        } else {
            $this->data['iugu_bankslip_order_aguardando_pagamento'] = $this->config->get('iugu_bankslip_order_aguardando_pagamento');
        }

        if (isset($this->request->post['iugu_bankslip_order_analise'])) {
            $this->data['iugu_bankslip_order_analise'] = $this->request->post['iugu_bankslip_order_analise'];
        } else {
            $this->data['iugu_bankslip_order_analise'] = $this->config->get('iugu_bankslip_order_analise');
        }

        if (isset($this->request->post['iugu_bankslip_order_paga'])) {
            $this->data['iugu_bankslip_order_paga'] = $this->request->post['iugu_bankslip_order_paga'];
        } else {
            $this->data['iugu_bankslip_order_paga'] = $this->config->get('iugu_bankslip_order_paga');
        }

        if (isset($this->request->post['iugu_bankslip_order_expirado'])) {
            $this->data['iugu_bankslip_order_expirado'] = $this->request->post['iugu_bankslip_order_expirado'];
        } else {
            $this->data['iugu_bankslip_order_expirado'] = $this->config->get('iugu_bankslip_order_expirado');
        }

        if (isset($this->request->post['iugu_bankslip_order_cancelada'])) {
            $this->data['iugu_bankslip_order_cancelada'] = $this->request->post['iugu_bankslip_order_cancelada'];
        } else {
            $this->data['iugu_bankslip_order_cancelada'] = $this->config->get('iugu_bankslip_order_cancelada');
        }

        if (isset($this->request->post['iugu_bankslip_order_reembolsado'])) {
            $this->data['iugu_bankslip_order_nao_efetivado'] = $this->request->post['iugu_bankslip_order_reembolsado'];
        } else {
            $this->data['iugu_bankslip_order_reembolsado'] = $this->config->get('iugu_bankslip_order_reembolsado');
        }

        if (isset($this->request->post['iugu_bankslip_order_status_id'])) {
            $this->data['iugu_bankslip_order_status_id'] = $this->request->post['iugu_bankslip_order_status_id'];
        } else {
            $this->data['iugu_bankslip_order_status_id'] = $this->config->get('iugu_bankslip_order_status_id');
        }

        //Carregando o Model dos Status
        $this->load->model('localisation/order_status');
        //Buscando os Status
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['iugu_bankslip_geo_zone_id'])) {
            $this->data['iugu_bankslip_geo_zone_id'] = $this->request->post['iugu_bankslip_geo_zone_id'];
        } else {
            $this->data['iugu_bankslip_geo_zone_id'] = $this->config->get('iugu_bankslip_geo_zone_id');
        }

        //Carregando o Model Geo Zone
        $this->load->model('localisation/geo_zone');
        //Buscando as Geo Zones
        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['iugu_bankslip_status'])) {
            $this->data['iugu_bankslip_status'] = $this->request->post['iugu_bankslip_status'];
        } else {
            $this->data['iugu_bankslip_status'] = $this->config->get('iugu_bankslip_status');
        }

        if (isset($this->request->post['iugu_bankslip_sort_order'])) {
            $this->data['iugu_bankslip_sort_order'] = $this->request->post['iugu_bankslip_sort_order'];
        } else {
            $this->data['iugu_bankslip_sort_order'] = $this->config->get('iugu_bankslip_sort_order');
        }

        //Configuração da view
        $this->template = 'payment/iugu_bankslip.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
        //Carregando a view
        $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
    }

    //Função rodada ao instalar o iugu Boleto
    public function install() {
        //Criando a coluna para o ID do Cliente da IUGU
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "customer` LIKE 'iugu_customer_id'");
        if (!$query->num_rows) {
            $this->db->query("ALTER TABLE `" . DB_PREFIX . "customer` ADD (`iugu_customer_id` varchar(32),`iugu_cartao_id` varchar(32))");
        }

        //Criando a coluna para o ID do Pedido da IUGU
        $query1 = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "order` LIKE 'iugu_order_id'");
        if (!$query1->num_rows) {
            $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD (`iugu_order_id` varchar(32),`iugu_subscription_id` varchar(32))");
        }

        //Criando a coluna assinatura_iugu e assinatura_iugu_identificador em Produto
        $query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'assinatura_iugu'");
        if (!$query->num_rows) {
            $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD (`assinatura_iugu` varchar(6),`assinatura_iugu_identificador` varchar(45))");
        }
    }

    //Validando o Token e Permissão
    private function validate() {
        if (!$this->user->hasPermission('modify', 'payment/iugu_bankslip')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['iugu_bankslip_token']) {
            $this->error['token'] = $this->language->get('error_token');
        }

        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
