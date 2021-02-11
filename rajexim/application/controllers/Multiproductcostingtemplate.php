<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Multiproductcostingtemplate extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Multiproductcostingtemplate_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
	}

	public function checkUniqueTemplateName()
	{
		$exp = $_POST['value'];
		$qstage = $this->Multiproductcostingtemplate_model->checkUniqueTemplateName($exp);	

		if(count($qstage) > 0){ echo 1; }else{ echo 0; }
	}

	public function index()
	{
		$data['multi_product_costing_template_list'] = $this->Multiproductcostingtemplate_model->get_multi_product_costing_template_list();
		$this->load->view('multiproductcostingtemplate/multi_product_costing_template_list', $data);
	}

	public function create_multi_product_costing_template()
	{
		//print_r($_POST);exit;

		$mpctid = $this->input->post('multi_product_costing_template_id');
		if($mpctid=='')
		{
			$data['multi_product_costing_template'] = $this->input->post('multi_product_costing_template');
			$data['created_on'] = date('Y-m-d H:i:s');
	   		$data['created_by'] = $_SESSION['admindata']['user_id'];
	   		$this->Multiproductcostingtemplate_model->create_multi_product_costing_template($data);

	   		$last_id = $this->Multiproductcostingtemplate_model->get_multi_product_costing_template_last_id();

	   		$mpctid = $last_id->multi_product_costing_template_id;

		}

		$mpctcnt = explode(",",implode(",",$this->input->post('multi_product_costing_type')));
		//echo count($mpctcnt);
		$inpmat = $this->input->post('multi_product_costing_type_id_math');
		for($s=0;$s<count($mpctcnt);$s++)
		{
			if (array_key_exists($s, $inpmat))
			{
				//echo $s.' Exist<br><br>';
			}
			else
			{
				$inpmat[$s]=array();
				//array_push($this->input->post('multi_product_costing_type_id_math')[$s],array());
				//echo $s.' Not Exist<br><br>';
			}
		}
		ksort($inpmat);
array_walk($inpmat, 'ksort');
//print_r($inpmat);
		$tmpArr = array();
    foreach ($inpmat as $key => $sub) {
    	//print_r($key);
      $tmpArr[] = implode(',', $sub);
    }
//print_r($tmpArr);
//echo "<br><br>";
//print_r(explode(",",$tmpArr));
//echo "<br><br>";
		$sno = explode(",",implode(",",$this->input->post('stage_no')));
		$mpctype = explode(",",implode(",",$this->input->post('multi_product_costing_type')));
		$isedi = explode(",",implode(",",$this->input->post('is_edit')));
		$isdisp = explode(",",implode(",",$this->input->post('is_display')));
		$maction = explode(",",implode(",",$this->input->post('math_action')));
		//$inprice = explode(",",implode(",",$this->input->post('in_price')));
		$mpctidm = $tmpArr;
		$mpctidm1 = explode(",",implode(",",$this->input->post('multi_product_costing_type_id_math1')));
		$mpctidm_1 = explode(",",implode(",",$this->input->post('multi_product_costing_type_id_math_1')));
		$isnopg = explode(",",implode(",",$this->input->post('is_nop_greater')));
//echo "<br><br>".print_r($mpctidm)."<br><br>";
		$subcount = count($this->input->post('stage_no')); 
		for($i=0;$i<$subcount;$i++)
		{
			$data1['multi_product_costing_template_id'] = $mpctid;
			$data1['stage_no'] = $sno[$i];
			$data1['multi_product_costing_type'] = $mpctype[$i];
			$data1['is_edit'] = $isedi[$i];
			$data1['is_display'] = $isdisp[$i];
			$data1['math_action'] = $maction[$i];
			if($data1['math_action']!='Division(/)')
			{
				$data1['multi_product_costing_type_id_math'] = $mpctidm[$i];
				$data1['multi_product_costing_type_id_math_1'] = '';
				$data1['is_nop_greater']=0;
			}
			else
			{
				$data1['multi_product_costing_type_id_math'] = $mpctidm1[$i];
				$data1['multi_product_costing_type_id_math_1'] = $mpctidm_1[$i];
				$data1['is_nop_greater'] = $isnopg[$i];
			}
			$data1['created_on'] = date('Y-m-d H:i:s');
		   	$data1['created_by'] = $_SESSION['admindata']['user_id'];
			//print_r($data1);
			//echo "<br><br>";
			//$result = $this->Multiproductcostingtemplate_model->create_multi_product_costing_type($data1);
			$pcstage = $this->Multiproductcostingtemplate_model->get_multi_product_costing_type_by_mpc_template_id_stage_no($mpctid,$sno[$i]);
			if(count($pcstage)>0)
			{
				$this->Multiproductcostingtemplate_model->update_multi_product_costing_template_type($data1,$pcstage->multi_product_costing_type_id);
			}
			else
			{
				$this->Multiproductcostingtemplate_model->create_multi_product_costing_template_type($data1);
			}
		}
			//exit;

		if(!$this->input->post('gobutton'))
		{
			$productcc = $this->Multiproductcostingtemplate_model->get_multi_product_costing_template_type_by_template_id($mpctid);
			if(count($productcc)>0)
			{
			  $st = '<option value="">Choose</option>';
			  foreach ($productcc as $prod) {
			    $st.='<option value='.$prod["multi_product_costing_type_id"].'>'.$prod["multi_product_costing_type"].'</option>';
				}
			}
			else
			{
			  $st = '<option value="">No Type Available</option>';
			}
			echo $st."|".$mpctid;
		}
		else
		{
			$this->session->set_flashdata('qstage_success', 'Multi Product Costing Template has been added successfully.');
      		redirect('/multiproductcostingtemplate');
		}
	}

	public function multi_product_costing_template_edit()
	{
		$pctid = $_POST['value'];
		$data['multi_product_costing_template'] = $this->Multiproductcostingtemplate_model->get_multi_product_costing_template_by_id($pctid);
		$data['multi_product_costing_type_list'] = $this->Multiproductcostingtemplate_model->multi_product_costing_type_by_template_id($pctid);

		$this->load->view('multiproductcostingtemplate/multi_product_costing_template_edit', $data);
	}

}
?>