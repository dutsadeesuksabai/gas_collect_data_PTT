<?php defined('BASEPATH') || exit('No direct script access allowed');

class job extends CI_Controller {

  function __construct() {
    parent::__construct();

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
  public function index() {
    $this->load->model('appapi/job_model');
    $this->job_model->search();
  }
  public function updateStatus() {
    $this->load->model('appapi/job_model');
    $this->job_model->updateStatus();
  }

  public function jobReturn() {
    $this->load->model('appapi/job_model');
    $this->job_model->jobReturn();
  }
  public function jobReturnSave() {
    $this->load->model('appapi/job_model');
    $this->job_model->jobReturnSave();
  }

  public function pttGasPrice() {
    $this->load->model('appapi/gas_price');
    $this->gas_price->pttGasPrice();
  }

  public function get_problem_remark() {
    $this->load->database();
    $query = "SELECT id, name as title FROM dx_job_failed_status ORDER BY weight";
    $result = $this->db->query($query)->result();

    dx_json_output(200,
      array(
        'success' => true,
        'data' => $result,
        'message' => 'ok',
      )
    );
  }
}