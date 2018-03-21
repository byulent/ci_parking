<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: root
 * Date: 03.03.18
 * Time: 20:24
 */

class Parking extends CI_Controller
{
    public function index($client_id = 0) {
        $config['base_url'] = base_url().'gb';
        $config['total_rows'] = $this->db->where(['status' => 1])->count_all_results('cars');
        $config['per_page'] = 6;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2))? $this->uri->segment(2) : NULL;
        $p = ($page*$config['per_page'] == 0) ? NULL : ($page-1)*$config['per_page'];
        $data['parked'] = $this->parking_model->get_parked($p, $config['per_page']);
        $data['clients'] = $this->parking_model->get_clients();
        if($client_id > 0) {
            $data['selected']['client'] = $client_id;
            $data['cars'] = $this->parking_model->get_cars($client_id);
        }
        $data['i'] = $p;
        $this->load->view('parking', $data);
    }

    public function _remap($p, $params=[]){
        if(is_numeric($p)) $this->index($p);
        else call_user_func_array(array($this, $p), $params);
    }

    public function park(){
        $this->parking_model->park();
        redirect('parking');
    }

    public function unpark($id){
        $this->parking_model->unpark($id);
        redirect('parking');
    }
}