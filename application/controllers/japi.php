<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * author : Parama Fadli Kurnia
 */

class Japi extends CI_Controller {

    // constructor
    function __construct() {
        parent::__construct();
        //$this->load->helper('url');
        $this->load->library('formatter');
    }

    function register(){
        $request_body = file_get_contents('php://input');
        $jsonData = (array)json_decode($request_body);
        
        $userName = $jsonData["user_name"];
        $userEmail = $jsonData["user_email"];
        
        $params= array(
           "user_name" => $userName,
           "user_email" => $userEmail,
        );
        $url = MAIN_API.'/register';
        $result = $this->formatter->postCURL($url, $params);
        $this->output->set_content_type('application/json')->set_output($result);
    }

    function buyItems(){
        $request_body = file_get_contents('php://input');
        //$jsonData = json_decode($request_body); 
        $jsonData = (array)json_decode($request_body); 
        $signKey = $jsonData["signature_key"];
        $payType = $jsonData["payment_type"];
        $Amount = $jsonData["gross_amount"];
        $currency = $jsonData["currency"];
        $items = (array)$jsonData["items"];
        
        $params= array(
           "signature_key" => $signKey,
           "payment_type" => $payType,
           "gross_amount" => $Amount,
           "currency" => $currency,
           "items" => $items
        );
        
        $url = MAIN_API.'/sales/insert';
        $result = $this->formatter->postCURL($url, $params);
        $this->output->set_content_type('application/json')->set_output($result);
    }
    
}

?>
