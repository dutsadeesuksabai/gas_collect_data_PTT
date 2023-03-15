<?php  if (! defined('BASEPATH')) { exit('No direct script access allowed'); }

class ptt_gas_price extends CI_Controller {
 
    function __construct() {
        parent::__construct();

    }
    public function dashboard() {
        $this->load->database();

       /*  $dash_date = $this->db->query("select * as price from ptt_gas_price where date >='$from_date' and date <='$to_date' group by gas_id order by gas_id asc")->result(); */

            $month_filter_obj = $this->db->query("
            select 
                        CAST(avg(price) AS DECIMAL(7,2)) as price,
                        min(p.price) as min,
                        max(p.price) as max, 
                        date_format(p.date, '%M %Y') as month ,
                        p.gas_id 
                    from ptt_gas_price p 
                    where current_date- interval 365 day <= p.date
                    group by p.gas_id,month 
                    order by p.gas_id,month asc
            ")->result();
            $month_filter = array();
            $mf_gas_id = 0;
            $mf_runnin_key = 0;
            foreach ($month_filter_obj as $key => $value) {
                if($mf_gas_id == 0){
                    $mf_gas_id = $value->gas_id;
                }
    
                if($value->gas_id != $mf_gas_id){
                    $mf_gas_id = $value->gas_id;
                    $month_filter[++$mf_runnin_key] = $value;
                }else{
                    $month_filter[$mf_runnin_key] = $value;
                }
            }

        $year_filter_obj = $this->db->query("
        select 
        CAST(avg(price) AS DECIMAL(7,2)) as price,
        min(p.price) as min,
        max(p.price) as max,  
        date_format(p.date, '%Y') as month ,
        p.gas_id 
        from ptt_gas_price p 
        group by p.gas_id,month 
        order by p.gas_id,month asc
        ")->result();
        $year_filter = array();
        $yf_gas_id = 0;
        $yf_runnin_key = 0;
        foreach ($year_filter_obj as $key => $value) {
            if($yf_gas_id == 0){
                $yf_gas_id = $value->gas_id;
            }

            if($value->gas_id != $yf_gas_id){
                $yf_gas_id = $value->gas_id;
                $year_filter[++$yf_runnin_key] = $value;
            }else{
                $year_filter[$yf_runnin_key] = $value;
            }
        }
        
       /*  echo json_encode($month_filter); */

        $week_data = $this->db->query("
        select * 
        from ptt_gas_price 
        where current_date- interval 7 day <= date
        group by gas_id, date 
        order by gas_id,date asc")->result();

        $week_gas = array();
        $w_gas_id = 0;
        $w_runnin_key = 0;
        foreach ($week_data as $key => $value) {
            if($w_gas_id == 0){
                $w_gas_id = $value->gas_id;
            }

            if($value->gas_id != $w_gas_id){
                $w_gas_id = $value->gas_id;
                $week_gas[++$w_runnin_key][] = $value;
            }else{
                $week_gas[$w_runnin_key][] = $value;
            }

        }
         /* echo json_encode($month_filter); */
        // exit();
        $week_most = $this->db->query("select max(price) as price from ptt_gas_price where current_date- interval 7 day <= date group by gas_id order by gas_id asc")->result();
        //echo json_encode($week_most);exit();
        $week_min = $this->db->query("select min(price) as price from ptt_gas_price where current_date- interval 7 day <= date group by gas_id order by gas_id asc")->result();
        $week_avg = $this->db->query("select CAST(avg(price) AS DECIMAL(7,2)) as price from ptt_gas_price where current_date- interval 7 day <= date group by gas_id order by gas_id asc")->result();
        //echo json_encode($week_most);exit();


        // Month
        $Monthly=$this->input->get('submit');
        $month_data = $this->db->query("
        select * from ptt_gas_price 
        where date like '%$Monthly%'
        group by gas_id, date 
        order by gas_id,date asc")->result();

        $month_gas = array();
        $m_gas_id = 0;
        $m_runnin_key = 0;
        foreach ($month_data as $key => $value) {
            if($m_gas_id == 0){
                $m_gas_id = $value->gas_id;
            }

            if($value->gas_id != $m_gas_id){
                $m_gas_id = $value->gas_id;
                $month_gas[++$m_runnin_key][] = $value;
            }else{
                $month_gas[$m_runnin_key][] = $value;
            }

        }

         //echo json_encode($month_gas);
        // exit();
        $month_most = $this->db->query("select max(price) as price from ptt_gas_price where current_date- interval 30 day <= date and date like '%$Monthly%' group by gas_id order by gas_id asc")->result();
        //echo json_encode($week_most);exit();
        $month_min = $this->db->query("select min(price) as price from ptt_gas_price where current_date- interval 30 day <= date and date like '%$Monthly%' group by gas_id order by gas_id asc")->result();
        $month_avg = $this->db->query("select CAST(avg(price) AS DECIMAL(7,2)) as price from ptt_gas_price where current_date- interval 30 day <= date and date like '%$Monthly%' group by gas_id order by gas_id asc")->result();

        // Year
        $year_data = $this->db->query("select * from ptt_gas_price where current_date- interval 365 day <= date group by gas_id, date order by gas_id,date asc")->result();

        $year_gas = array();
        $y_gas_id = 0;
        $y_runnin_key = 0;
        foreach ($year_data as $key => $value) {
            if($y_gas_id == 0){
                $y_gas_id = $value->gas_id;
            }

            if($value->gas_id != $y_gas_id){
                $y_gas_id = $value->gas_id;
                $year_gas[++$y_runnin_key][] = $value;
            }else{
                $year_gas[$y_runnin_key][] = $value;
            }

        }
         //echo json_encode($month_gas);
        // exit();
        $year_most = $this->db->query("select max(price) as price from ptt_gas_price where current_date- interval 365 day <= date group by gas_id order by gas_id asc")->result();
        //echo json_encode($week_most);exit();
        $year_min = $this->db->query("select min(price) as price from ptt_gas_price where current_date- interval 365 day <= date group by gas_id order by gas_id asc")->result();
        $year_avg = $this->db->query("select CAST(avg(price) AS DECIMAL(7,2)) as price from ptt_gas_price where current_date- interval 365 day <= date group by gas_id order by gas_id asc")->result();


        $year_gas = array();
        $y_gas_id = 0;
        $y_runnin_key = 0;
        foreach ($year_data as $key => $value) {
            if($y_gas_id == 0){
                $y_gas_id = $value->gas_id;
            }

            if($value->gas_id != $y_gas_id){
                $y_gas_id = $value->gas_id;
                $year_gas[++$y_runnin_key][] = $value;
            }else{
                $year_gas[$y_runnin_key][] = $value;
            }

        }


        $data = array(
/*           'from_date' => $from_date,
            'to_date' => $to_date,
            'dash_date' => $dash_date, */
            'year_filter' => $year_filter,
            'month_filter' => $month_filter,
            'week_gas' => $week_gas,
            'week_most' => $week_most,
            'week_min' => $week_min,
            'week_avg' => $week_avg,
            'month_gas' => $month_gas,
            'month_most' => $month_most,
            'month_min' => $month_min,
            'month_avg' => $month_avg,
            'year_gas' => $year_gas,
            'year_most' => $year_most,
            'year_min' => $year_min,
            'year_avg' => $year_avg,
        );
        $this->load->view('dashboard', $data);
    }
    public function index() {
        echo 'databest';
    }
    public function test() {

        //echo 'a';
        // $CI = &get_instance();
        // $CI->load->database();

        // // เงื่อนไขการดึงงานของพนักงานขับรถ
        // // ดึงงานที่ destination code เดียวกัน
        // // และอยู่ใน TO เดียวกัน
        // $CI->db->select('t.*');
        // $CI->db->from('dx_transport t');
        // $CI->db->where_not_in('t.to_status', array(-1, 4));
        // $result = $CI->db->get()->result();
        // var_dump($result);
    }

    public function pttGasPrice() {
        $this->load->model('ptt_gas_price/ptt_gas');
        $this->ptt_gas->getGasPrice();
        // $data = array(
        //        'name' => 'PRODUCT',
        //        'price'=>'PRICE'
        //    );
        // $this->database()->insert('ptt_gas_price', $data);
    }


}