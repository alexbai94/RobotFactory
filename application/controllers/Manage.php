<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends Application
{
    function __construct()
	{
            parent::__construct();
            $this->load->model('ApikeyModel');
            $this->load->model('RobotsModel');
        }
     public function index()
     {
         // Gets all robots
         $robots = $this->RobotsModel->all();
         $this->data['robots'] = $robots;
         $this->data['pagebody'] ='Manage';
         $this->render();  
     }
     
     //reboots factory to default
     public function reboot(){
         $context=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        ); 
         $apiKey = $this->ApikeyModel->getKey();
         $url = 'http://umbrella.jlparry.com/work/rebootme?key='.$apiKey[0]['apikey'];
         $response = file_get_contents($url,false, stream_context_create($context));
         //$response = file_get_contents('http://umbrella.jlparry.com/work/rebootme?key=2cc5e1',false, stream_context_create($context));
         $data = explode(" ",$response);
         if(strtolower($data[0])=="ok"){
             $this->ApikeyModel->truncateDb();
             echo 1;//return ok
         }
         else{
            echo 0;//return error
         }
     }
     
     //register factory with server
     public function register(){
         $context=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        ); 
         $pName = $this->input->post('pName');
         $sToken = $this->input->post('sToken');
         $url = 'https://umbrella.jlparry.com/work/registerme/'.$pName.'/'.$sToken;
         //parse response into array
         $response = file_get_contents($url,false, stream_context_create($context));
         //$response = file_get_contents('https://umbrella.jlparry.com/work/registerme/papaya/247843',false, stream_context_create($context));
         $data = explode(" ",$response);
         $key = $this->ApikeyModel->getKey();
         if(strtolower($data[0])=="ok"){//check if response is ok
            if(sizeof($key)>0){//check if a key exists in db
               $key = $data[1];//set response val as key
               $this->ApikeyModel->updateKey($key);
            }
            else{//a key does not exist in db
               $key = $data[1];
               $this->ApikeyModel->addKey($key);
            }
            echo 1;//return ok
         }
         else{
            echo 0;//return error
         }
     }
}