<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * author : Parama Fadli Kurnia
 */

class Apis extends CI_Controller {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('db_model');
    }

    function storeTransaction() {
        $request_body = file_get_contents('php://input');
        $jsonData = (array)json_decode($request_body);
        
        $customerName = $jsonData["NamaPelanggan"];
        $createdDate = $jsonData["Tanggal"];
        $createdHour = $jsonData["Jam"];
        $totalTransaction = $jsonData["Total"];
        $totalPaid = $jsonData["BayarTunai"];
        $totalReturn = $jsonData["Kembali"];
        $transactionDetails = $jsonData["DetilPenjualan"];
        $updateDate = date('Y-m-d');

        $transactionData = array(
            'Tanggal' => $createdDate,
            'Jam' => $createdHour,
            'NamaPelanggan' => $customerName,
            'Total' => $totalTransaction,
            'BayarTunai' => $totalPaid,
            'Kembali' => $totalReturn,
            'TglJamUpdate' => $updateDate
        );
        
        $transactionStatus = $this->db_model->addPenjualan($transactionData, 
                $transactionDetails, $updateDate);
        $statusCode = 0;
        $message = "";
        if($transactionStatus=="success"){
            $statusCode = 200;
            $message = "transaction data inserted successfuly";
        }else{
            $statusCode = 412;
            $message = "failed insert transaction data";
        }

        $data = array();
        $data["status"] = $transactionStatus;
        $data["code"] = $statusCode;
        $data["message"] = $message;
        $result = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($result);
    }

}

?>