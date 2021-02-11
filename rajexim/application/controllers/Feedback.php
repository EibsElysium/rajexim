<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time',259200);

class Feedback extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
		$this->load->model(array('Feedback_model'));
		$admindata = $this->session->userdata('admindata');
	      /*if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } */
		date_default_timezone_set("Asia/Kolkata");
	}

  public function order_feedback($ono)
  {
    $po_details = $this->Feedback_model->get_buyerorder_by_feedback_status($ono);
    if(count($po_details)>0)
    {
      $podetails = $data['buyer_order_details'] = $this->Feedback_model->get_buyer_order_by_id($po_details->buyer_order_id);
      $this->load->view('feedback/order_feedback',$data);
    }
    /*else
    {
    	//echo "else";exit;
      $this->load->view('feedback/404');
  	}*/
  }

  public function save_feedback()
  {
    $data['buyer_order_id'] = $this->input->post('poid');
    $data['work_followup'] = $this->input->post('work_followup');
    $data['staff_approach'] = $this->input->post('staff_approach');
    $data['timely_delivery'] = $this->input->post('timely_delivery');
    $data['quality'] = $this->input->post('quality');
    $data['suggestion'] = $this->input->post('suggestion');
    $data['created_on'] = date('Y-m-d H:i:s');
    $data['created_by'] = 0;

    $this->Feedback_model->create_order_feedback($data);

    redirect('feedback/thankyou');
  }

  public function thankyou()
  {
    $this->load->view('feedback/thankyou');
  }

}
?>