<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 */

/**
 * Description of formatter
 *
 * @author Parama_Fadli_Kurnia
 */
class Formatter {

    function __construct() {
        //$this->functional = new Functional();
    }

    public function postCURL($_url, $_param) {

        $data_string = json_encode($_param);
        $curl = curl_init($_url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }

    public function postJSON($_url, $_json) {

        //$data_string = json_encode($_param);
        $curl = curl_init($_url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json')
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_json);  // Insert the data

        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }
    
}
