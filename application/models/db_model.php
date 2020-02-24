<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author : Parama Fadli Kurnia
 */

class Db_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function addPenjualan($transactionData, $transactionDetails, $updateDate) {
        $this->db->trans_start();
        
        // insert data penjualan
        $this->db->insert('penjualan', $transactionData);
        $insert_id = $this->db->insert_id();

        // insert detail penjualan
        $itemDetails = array();
        foreach ($transactionDetails as $row) {
            $itemDetails[] = array(
                'TransactionID' => $insert_id,
                'NamaItem' => $row->Item,
                'Quantity' => $row->Qty,
                'HargaSatuan' => $row->HargaSatuan,
                'SubTotal' => $row->SubTotal,
                'TglJamUpdate' => $updateDate
            );
        }
        $this->db->insert_batch('penjualandetil', $itemDetails);
 
        // set transaction complete
        $this->db->trans_complete();

        // check insert data status
        $transactionStatus = "";
        if ($this->db->trans_status() === FALSE) {
            $transactionStatus = "error";
            $this->db->trans_rollback();
        } else {
            $transactionStatus = "success";
            $this->db->trans_commit();
        }
        return $transactionStatus;
    }

}
