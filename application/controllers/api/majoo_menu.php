<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class majoo_menu extends REST_Controller {

    function __construct()
    {
     parent::__construct();
    //   $this->load->model('Query');
    }

    public function Login_post()
    {
     

        $user_name = $this->input->post('user_name',TRUE);
        $password = md5($this->input->post('password',TRUE));

        if(isset($user_name)||isset($password)){
            $this->response(['status'=>false,'message'=>'invalid parameter']);
       
        }

        $paramlogin=['user_name'=>trim($user_name),
                     'password'=>$password];

        $cek = $this->db->get_where('users',array('user_name'=>$user_name));
        $row = $this->db->get_where('users',$paramlogin)->row();

        if($cek->num_rows()>=1){
            if($row != null){
                $result =[
                    'id' => $row->id,
                    'name' => $row->name
                ];
                $this->response(['status'=>true,'message'=>'login success','Data'=>$result]);
            }else{
                $this->response(['status'=>false,'message'=>'login failed, wrong password or username']);
            }
        }else{
        $this->response(['status'=>false,'message'=>'username not found']);
        }

    }


}

   


