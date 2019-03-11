<?php
class ControllerExtensionPaymentMonero extends Controller
{
    private $error = array();
    private $settings = array();
    public function index()
    {
        $this->load->language('extension/payment/monero');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->model_setting_setting->editSetting('payment_monero', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
        }
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_edit'] = $this->language->get('text_edit');
        
        
        $data['monero_address_text'] = $this->language->get('wallet_address');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['help_total'] = $this->language->get('help_total');
        //Errors
		if (isset ($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
 
        
       
       // Values for Settings
       
        if (isset($this->request->post['payment_monero_address'])) {
            $data['payment_monero_address'] = $this->request->post['payment_monero_address'];
        } else {
            $data['payment_monero_address'] = $this->config->get('payment_monero_address');
        }
        
         if (isset($this->request->post['payment_monero_status'])) {
            $data['payment_monero_status'] = $this->request->post['payment_monero_status'];
        } else {
            $data['payment_monero_status'] = $this->config->get('payment_monero_status');
        }
        
        if (isset($this->request->post['payment_monero_wallet_rpc_host'])) {
            $data['payment_monero_wallet_rpc_host'] = $this->request->post['payment_monero_wallet_rpc_host'];
        } else {
            $data['payment_monero_wallet_rpc_host'] = $this->config->get('payment_monero_wallet_rpc_host');
        }
        
        if (isset($this->request->post['payment_monero_wallet_rpc_port'])) {
            $data['payment_monero_wallet_rpc_port'] = $this->request->post['payment_monero_wallet_rpc_port'];
        } else {
            $data['payment_monero_wallet_rpc_port'] = $this->config->get('payment_monero_wallet_rpc_port');
        }       
       

//        $data['payment_monero_address'] = isset($this->request->post['payment_monero_address']) ?
//            $this->request->post['payment_monero_address'] : $this->config->get('payment_monero_address');
//         $data['payment_monero_status'] = isset($this->request->post['payment_monero_status']) ?
//            $this->request->post['payment_monero_status'] : $this->config->get('payment_monero_status');
//         $data['payment_monero_wallet_rpc_host'] = isset($this->request->post['payment_monero_wallet_rpc_host']) ?
//            $this->request->post['payment_monero_wallet_rpc_host'] : $this->config->get('payment_monero_wallet_rpc_host');
//             $data['payment_monero_wallet_rpc_port'] = isset($this->request->post['payment_monero_wallet_rpc_port']) ?
//            $this->request->post['payement_monero_wallet_rpc_port'] : $this->config->get('payment_monero_wallet_rpc_port');

       
       
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'user_token=' . $this->session->data['user_token'], true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/payment/monero', 'user_token=' . $this->session->data['user_token'], true)
        );
        $data['action'] = $this->url->link('extension/payment/monero', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);
        
	$data['payment_monero'] = array();		
		
	if (isset($this->request->post['payment_monero_total'])) {
	    $data['payment_monero_total'] = $this->request->post['payment_monero_total'];
	} else {
	    $data['payment_monero_total'] = $this->config->get('payment_monero_total');
	}

	if (isset($this->request->post['payment_monero_order_status_id'])) {
	    $data['payment_monero_order_status_id'] = $this->request->post['payment_monero_order_status_id'];
	} else {
	    $data['payment_monero_order_status_id'] = $this->config->get('payment_monero_order_status_id');
	}

	$this->load->model('localisation/order_status');

	$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

	if (isset($this->request->post['payment_monero_geo_zone_id'])) {
	    $data['payment_monero_geo_zone_id'] = $this->request->post['payment_monero_geo_zone_id'];
	} else {
	    $data['payment_monero_geo_zone_id'] = $this->config->get('payment_monero_geo_zone_id');
	}

	$this->load->model('localisation/geo_zone');

	$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

	if (isset($this->request->post['payment_monero_status'])) {
	    $data['payment_monero_status'] = $this->request->post['payment_monero_status'];
	} else {
	    $data['payment_monero_status'] = $this->config->get('payment_monero_status');
	}

	if (isset($this->request->post['payment_monero_sort_order'])) {
	    $data['payment_monero_sort_order'] = $this->request->post['payment_monero_sort_order'];
	} else {
	    $data['payment_monero_sort_order'] = $this->config->get('payment_monero_sort_order');
	}	        
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/payment/monero', $data));
    }
   
    private function validate()
    {
        
        if (!$this->user->hasPermission('modify', 'extension/payment/monero')) {
            $this->error['warning'] = $this->language->get('error_permission');
            return false;
        }
        return true;
       
    }
    public function install()
    {
        $this->load->model('extension/payment/monero');
        $this->load->model('setting/setting');
        
        $this->model_setting_setting->editSetting('monero', $this->settings);
        $this->model_extension_payment_monero->createDatabaseTables();
    }
    public function uninstall()
    {
        $this->load->model('extension/payment/monero');
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('monero');
        $this->model_extension_payment_monero->dropDatabaseTables();
    }
}
