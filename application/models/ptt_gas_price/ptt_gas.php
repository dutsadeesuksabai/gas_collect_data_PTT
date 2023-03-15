<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

/* class ptt_gas extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    

    private function getGasId($name){
        
        $this->db->select("*");
        $this->db->from("master_gas_id");
        $this->db->where("name",$name);
        
        $result = $this->db->get()->result();
        if(count($result)>0)
        {
            return $result[0]->gas_id;
        }
        else
        {
            $insert_data = array(
                'name' => $gas_name,
            );
            $this->db->insert('master_gas_id', $insert_data);
            return $this->db->insert_id();
        }
    }    
        
    private function insertGasData($data)
    {
        $this->db->select("*");
        $this->db->from("ptt_gas_price");
        $this->db->where("date",$data['date']);
        $this->db->where("gas_id",$data['gas_id']);
        
        $result = $this->db->get()->result();
        if(count($result)>0)
        {
           echo $data['name'] . " " . $data['date'] . " Duplicated</br>"; 
        }
        else
        {
           $this->db->insert('ptt_gas_price', $data); 
           echo "<font color=green>" .$data['name'] . " " . $data['date'] . " Success</font></br>"; 
        }
    }    
        
    public function getGasPrice() {
        // ## SOAP API ##
        $web = "https://orapiweb.pttor.com/oilservice/OilPrice.asmx?wsdl";
        $client = new SoapClient($web,
            array(
                "trace" => 1,
                "exceptions" => 0,
                "cache_wsdl" => 0)
        );

        // ## PARAMS SOAP ##    
        $params = array(
            'Language' => "en",
            'DD' => date('d'),
            'MM' => date('m'),
            'YYYY' => date('Y'),
        );
        $data = $client->GetOilPrice($params);
        $ob  = $data->GetOilPriceResult;
        $xml = new SimpleXMLElement($ob);
        
        foreach ($xml as $val) {
            $gas_name     = ($val->PRODUCT . "");
            $price_date   = date('Y-m-d', strtotime($val->PRICE_DATE));
            $current_date = date('Y-m-d');

            // Get GasId
            $id = $this->getGasId($gas_name);
            
            $data = array(
                    'gas_id' => $id,
                    'name'   => $gas_name,
                    'date'   => $current_date,
                    'price'  => $val->PRICE,
                );
            
            $this->insertGasData($data);
        }
    }

} */

class ptt_gas extends CI_Model {
        
    
    public function getGasPrice() {

        $web = "https://orapiweb.pttor.com/oilservice/OilPrice.asmx?wsdl";
        $client = new SoapClient($web,
            array(
                "trace" => 1,
                "exceptions" => 0,
                "cache_wsdl" => 0)
        );

        $params = array(
            'Language' => "en",
            'DD' => date('d'),
            'MM' => date('m'),
            'YYYY' => date('Y'),
        );

        $data = $client->GetOilPrice($params);
        $ob = $data->GetOilPriceResult;
        $xml = new SimpleXMLElement($ob);
        $this->load->database();

        // PRICE_DATE , PRODUCT ,PRICE
        foreach ($xml as $key => $val) {
            // var_dump($val);
            // exit();
            // if ($val->PRICE != '') {
            //     echo $val->PRICE_DATE . '  ' . $val->PRODUCT . '  ' . $val->PRICE . ' บาท<br>';

            // }
            $gas_name = ($val->PRODUCT . "");
            $price_date = date('Y-m-d', strtotime($val->PRICE_DATE));
            $current_date = date('Y-m-d');

            // 1 query get gas name
            $gas_data = $this->db->query("select * from master_gas_id where name = '" . $gas_name . "'")->row();
            $id = 0;

            // have a data
            if ($gas_data) {

                $id = $gas_data->id;

            } else {

                $insert_data = array(
                    'name' => $gas_name,
                );
                $this->db->insert('master_gas_id', $insert_data);
                $id = $this->db->insert_id();

            }

            // $check_name = $this->db->query("select * from ptt_gas_price where name = '" . $gas_name . "'")->row();
            $check_date = $this->db->query("select * from ptt_gas_price where date = '" . $current_date . "' AND gas_id = '" . $id . "'")->row();

            if (!$check_date) {
                $data = array(
                    'gas_id' => $id,
                    'name' => $gas_name,
                    'date' => $current_date,
                    'price' => $val->PRICE,
                );
                $this->db->insert('ptt_gas_price', $data);
                echo 'สำเร็จ ' . "</br>";
            } else {
                echo 'ข้อมูลซ้ำ ' . "</br>";
            }

            // var_dump($check_date);
            // if ($price_date != $check_date) {
            //     $data = array(
            //         'gas_id' => $id,
            //         'name' => $gas_name,
            //         'date' => $price_date,
            //         'price' => $val->PRICE,
            //     );
            //     $this->db->insert('ptt_gas_price', $data);
            //  }

            // $data = array(
            //     // 'gas_id' => $this->db->insert_id(),
            //     'name' => $val->PRODUCT . "",
            //     'date' => date('Y/m/d', strtotime($val->PRICE_DATE)),
            //     'price' => $val->PRICE,
            // );
            // $this->db->insert('ptt_gas_price', $data);

        }
    }

}     