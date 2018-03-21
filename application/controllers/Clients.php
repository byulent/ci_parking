<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.03.18
 * Time: 22:15
 */

class Clients extends CI_Controller
{
    public function index(){
        $config['base_url'] = base_url().'gb';
        $config['total_rows'] = $this->db->count_all('cars');
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
        $data['cars'] = $this->parking_model->get_clients_cars($p, $config['per_page']);
        $data['i'] = $p;
        $this->load->view('clients', $data);
    }

    public function edit($id){
        $data['id'] = $id;
        $data += $this->parking_model->get_client($id);
        $data['cars'] = $this->parking_model->get_cars($id);
        $this->load->view('client', $data);
    }

    public function add(){
        $this->load->view('client');
    }

    public function add_client(){
        $rules = [
            [
                'field' => 'full_name',
                'label' => 'ФИО',
                'rules' => 'required|min_length[3]'
            ],
            [
                'field' => 'gender',
                'label' => 'Пол',
                'rules' => 'required|in_list[0,1]'
            ],
            [
                'field' => 'phone',
                'label' => 'Телефон',
                'rules' => 'required|numeric|is_unique[clients.phone]'
            ]
        ];
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('client');
        }
        else
            {
            $id = $this->parking_model->add_client();
            redirect('clients/edit/' . $id);
        }
    }

    public function save_cars($id){
        $this->parking_model->save_cars();
        if ($this->input->post('new_car'))
        {
            $rules = [
                [
                    'field' => 'new_car[label]',
                    'label' => 'Марка',
                    'rules' => 'required'
                ],
                [
                    'field' => 'new_car[model]',
                    'label' => 'Модель',
                    'rules' => 'required'
                ],
                [
                    'field' => 'new_car[reg_plate]',
                    'label' => 'Госномер',
                    'rules' => 'required|is_unique[cars.reg_plate]'
                ]
            ];
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE)
            {
                $this->edit($id);
            }
            else
                {
                $this->parking_model->add_car($id);
                redirect('clients/edit/'.$id);
            }
        }
    }

    public function save_client($id) {
        $this->parking_model->save_client($id);
        redirect('clients/edit/'.$id);
    }
}