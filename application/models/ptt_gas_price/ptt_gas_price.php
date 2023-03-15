<?php  if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class ptt_gas_price extends CI_Model
{
    public function getGasPrice() {
        echo '123';
        // $client = new SoapClient("http://www.pttplc.com/webservice/pttinfo.asmx?WSDL",
        // array(
        // "trace"      => 1,	
        // "exceptions" => 0,
        // "cache_wsdl" => 0) 
        // );

        // $params = array(
        //   'Language' => "en",
        //   'DD' => date('d'),
        //   'MM' => date('m'),
        //   'YYYY' => date('Y')
        // );

        // $data = $client->GetOilPrice($params);
        // $ob = $data->GetOilPriceResult;
        // $xml = new SimpleXMLElement($ob);

        // // PRICE_DATE , PRODUCT ,PRICE
        // foreach ($xml  as  $key =>$val) {  

        //     if($val->PRICE != ''){
        //         echo $val->PRODUCT .'  '.$val->PRICE.' บาท<br>';
        //     }

        // }
    }
  
}
    