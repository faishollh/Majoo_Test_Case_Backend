<?php
class Penjualan extends CI_Controller
{
    public function Index(){

        $data['Title'] = 'Omzet Monthly';

        $this->load->model('Penjualan_model','penjualan');

        $this->load->library('pagination');

        $config['base_url'] = 'http://localhost/majoo/index.php/api/penjualan/index';

        $config['total_rows'] = 30;
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['Data']=$this->penjualan->getOmzetMonthly($config['per_page'] ,$data['start']);


    }
}