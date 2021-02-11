<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller 

{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('excel');

		$this->load->model(array('Vendor_model'));

		$admindata = $this->session->userdata('admindata');

	      if ($admindata['user_id']>0)

	      {

	          //do something

	      }else{

	          redirect('login'); //if session is not there, redirect to login page

	      } 

		date_default_timezone_set("Asia/Kolkata");

	}



	public function index()

	{

		$data['vendor_type_list'] = $this->Vendor_model->get_active_vendor_type_list();

		$data['vendor_category_list'] = $this->Vendor_model->get_active_vendor_category_list();

		$data['product_lists'] = $this->Vendor_model->get_active_product_list();

		


		$data['f_v_st'] = '';

		if($_SERVER['REQUEST_METHOD'] == 'POST')

    	{

    		$category_id = $this->input->post('category_id');

      		///$product_id = $this->input->post('product_id');

      		$type_id = $this->input->post('type_id');

      		$status_filt = $this->input->post('vendor_st_filt');

      		if ($status_filt != '') {
      			$st_filt_query = "AND v.status = '$status_filt'";
      		}
      		else {
      			$st_filt_query = "";
      		}
			if($category_id !='')

			{

				$vcid = " AND v.vendor_category_id = '$category_id'";

			}

			else

			{

				$vcid = '';

			}



			if($type_id !='')

			{

				$vtid = " AND v.vendor_type_id = '$type_id'";

			}

			else

			{

				$vtid = '';

			}



			/*if($product_id !='')

			{

				$pid = " AND pc.product_id = '$product_id'";

			}

			else

			{

				$pid = '';

			}*/

			$data['f_l_category'] = $category_id;

      		//$data['f_l_product'] = $product_id;

      		$data['f_l_type'] = $type_id;

      		$data['f_v_st'] = $status_filt;
      		$data['vendor_list'] = $this->db->query("SELECT v.*,vt.vendor_type,vc.vendor_category FROM vendor v, vendor_type vt, vendor_category vc WHERE v.vendor_type_id = vt.vendor_type_id AND v.vendor_category_id = vc.vendor_category_id AND v.status!=2 $vcid $vtid $st_filt_query ORDER BY v.vendor_id DESC")->result_array();

    	}

    	else

    	{    		

			$data['f_l_category'] = '';

      		//$data['f_l_product'] = '';

      		$data['f_l_type'] = '';

			$data['vendor_list'] = $this->Vendor_model->get_vendor_list();

		}



		//$data['vendor_list'] = $this->Vendor_model->get_vendor_list();

		$this->load->view('vendor/vendor_list', $data);

	}

	public function vendor_list_by_filter()
	{
		// $data['perpage'] = $perpage = 10;
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';

		if ($search_val != '') {
			$sc = ' AND (v.email_id LIKE "%'.$search_val.'%" OR v.vendor_name LIKE "%'.$search_val.'%" OR vt.vendor_type LIKE "%'.$search_val.'%" OR vc.vendor_category LIKE "%'.$search_val.'%")';
		}
		else {
			$sc = '';
		}

		$data['vendor_type_list'] = $this->Vendor_model->get_active_vendor_type_list();

		$data['vendor_category_list'] = $this->Vendor_model->get_active_vendor_category_list();

		$data['product_lists'] = $this->Vendor_model->get_active_product_list();

		$data['f_v_st'] = '';

		if($_SERVER['REQUEST_METHOD'] == 'POST')
    	{
    		$category_id = $this->input->post('category_id');

      		$type_id = $this->input->post('type_id');

      		$status_filt = $this->input->post('vendor_st_filt');

      		if ($status_filt != '') {
      			$st_filt_query = "AND v.status = '$status_filt'";
      		}
      		else {
      			$st_filt_query = "";
      		}
			if($category_id !='')

			{

				$vcid = " AND v.vendor_category_id = '$category_id'";

			}

			else

			{

				$vcid = '';

			}



			if($type_id !='')

			{

				$vtid = " AND v.vendor_type_id = '$type_id'";

			}

			else

			{

				$vtid = '';

			}


			$data['f_l_category'] = $category_id;

      		$data['f_l_type'] = $type_id;

      		$data['f_v_st'] = $status_filt;
      		$data['vendor_list_count'] = $this->db->query("SELECT v.*,vt.vendor_type,vc.vendor_category FROM vendor v, vendor_type vt, vendor_category vc WHERE v.vendor_type_id = vt.vendor_type_id AND v.vendor_category_id = vc.vendor_category_id AND v.status!=2 $vcid $vtid $st_filt_query $sc ORDER BY v.vendor_id DESC")->result_array();

      		$data['vendor_list'] = $this->db->query("SELECT v.*,vt.vendor_type,vc.vendor_category FROM vendor v, vendor_type vt, vendor_category vc WHERE v.vendor_type_id = vt.vendor_type_id AND v.vendor_category_id = vc.vendor_category_id AND v.status!=2 $vcid $vtid $st_filt_query $sc ORDER BY v.vendor_id DESC LIMIT $page, $perpage")->result_array();

    	}

    	else

    	{    		

			$data['f_l_category'] = '';

      		$data['f_l_type'] = '';

			// $data['vendor_list'] = $this->Vendor_model->get_vendor_list();
			$data['vendor_list_count'] = $this->db->query("SELECT v.*,vt.vendor_type,vc.vendor_category FROM vendor v, vendor_type vt, vendor_category vc WHERE v.vendor_type_id = vt.vendor_type_id AND v.vendor_category_id = vc.vendor_category_id AND v.status!=2 $sc ORDER BY v.vendor_id DESC")->result_array();

			$data['vendor_list'] = $this->db->query("SELECT v.*,vt.vendor_type,vc.vendor_category FROM vendor v, vendor_type vt, vendor_category vc WHERE v.vendor_type_id = vt.vendor_type_id AND v.vendor_category_id = vc.vendor_category_id AND v.status!=2 $sc ORDER BY v.vendor_id DESC LIMIT $page, $perpage")->result_array();

		}

		$this->load->view('vendor/vendor_list_table', $data);

	}

	public function vendor_add()

	{

		$data['vendor_type_list'] = $this->Vendor_model->get_active_vendor_type_list();

		$data['addresstypes'] = common_select_values('*','address_type','status = 0', 'result');
		// print_r($data['addresstypes']);
		// die();
		$data['vendor_category_list'] = $this->Vendor_model->get_active_vendor_category_list();

		$data['product_list'] = $this->Vendor_model->get_active_product_list();

		$this->load->view('vendor/vendor_add', $data);

	}



	public function checkUniqueVendor()

	{

		$exp = $_POST['value'];

		$qstage = $this->Vendor_model->checkUniqueVendor($exp);

		//echo count($exporter);

		if($qstage){ echo 1; }else{ echo 0; }

	}

	public function checkUniqueVendorEmail()

	{

		$exp = $_POST['value'];
		
		$qstage = $this->Vendor_model->checkUniqueVendorEmail($exp);

		if(count($qstage) > 0){ echo 1; }else{ echo 0; }

	}

	public function create_vendor()

	{

		$data['vendor_category_id'] = $this->input->post('vendor_category_id');

		$data['vendor_type_id'] = $this->input->post('vendor_type_id');

		$data['vendor_name'] = $this->input->post('vendor_name');

		$data['gst_no'] = $this->input->post('gst_no');

		$data['phone_no'] = $this->input->post('phone_no');

		$data['email_id'] = $this->input->post('email_id');

		$data['website'] = $this->input->post('website');

		$address_type = $this->input->post('address_type');
		// print_r($address_type);
		// die();
		$street = $this->input->post('street');

		$city = $this->input->post('city');

		$state = $this->input->post('state');

		$country = $this->input->post('country');

		$postal_code = $this->input->post('postal_code');

		$data['created_on'] = date('Y-m-d H:i:s');

    	$data['created_by'] = $admindata['user_id'];

    	$result = $this->Vendor_model->create_vendor($data);

    	$contact_person_name = $this->input->post('contact_person_name');

		$contact_person_email = $this->input->post('contact_person_email');

		$contact_person_phone = $this->input->post('contact_person_phone');


		

    	if ($result) {

    		$last_id_value = $this->Vendor_model->last_vendor_id();

			$last_value=$last_id_value->vendor_id;
			for ($i=0; $i < count($contact_person_name); $i++) { 
				$vendor_id = $last_value;
				$cont_per = $contact_person_name[$i];
				$cont_per_email = $contact_person_email[$i];
				$cont_per_phone = $contact_person_phone[$i];

				$add_vendor_contact_info = $this->Vendor_model->add_vendor_contact_info($vendor_id,$cont_per,$cont_per_email,$cont_per_phone);
			}

			for ($j=0; $j < count($address_type); $j++) { 

				$this->Vendor_model->add_vendor_address($last_value,$address_type[$j],$street[$j],$city[$j],$state[$j],$country[$j],$postal_code[$j]);
			}

			$venprod['vendor_id'] = $last_value;

			$vprod = explode(",",implode(',', $this->input->post('vendor_product')));

			$subcount = count($vprod); 

			for($i=0;$i<$subcount;$i++)

			{

				$venprod['product_id'] = $vprod[$i];

				$this->Vendor_model->create_vendor_product($venprod);

			}

    	}


    	$this->session->set_flashdata('qstage_success', 'Vendor has been added successfully.');

    	redirect('/vendor/index');

	}



	public function vendor_change_status()

	{

		$qsid = $this->input->post('id');

		$status = $this->input->post('status');



		$result = $this->Vendor_model->vendor_change_status($qsid, $status);

		if($result){ echo 1; }else{ echo 0; }

	}



	public function vendor_view($vid)

	{

		$data['vendor_details'] = $this->Vendor_model->get_vendor_by_id($vid);

		$data['vendor_product_details'] = $this->Vendor_model->get_vendor_product_by_id($vid);

		$data['vendor_contact_person_info'] = common_select_values('*','vendor_contact_person','status = 0','result');
		$this->load->view('vendor/vendor_view', $data);

	}	



	public function vendor_edit($vid)

	{

		$data['vendor_type_list'] = $this->Vendor_model->get_active_vendor_type_list();

		$data['vendor_category_list'] = $this->Vendor_model->get_active_vendor_category_list();

		$data['product_list'] = $this->Vendor_model->get_active_product_list();

		$data['vendor_details'] = $this->Vendor_model->get_vendor_by_id($vid);

		$data['vendor_product_details'] = $this->Vendor_model->get_vendor_product_by_id($vid);

		$data['addresstypes'] = common_select_values('*','address_type','status = 0', 'result');

		$data['vendor_addresses'] = common_select_values('*','vendor_address','status = 0 AND vendor_id = "'.$vid.'"', 'result');

		$data['vendor_contact_person_info'] = common_select_values('*','vendor_contact_person','vendor_id = "'.$vid.'"','result');

		$this->load->view('vendor/vendor_edit', $data);

	}



	public function checkUniqueVendorEdit()

	{

		$exp = $_POST['value'];

		$vid = $_POST['vid'];

		$qstage = $this->Vendor_model->checkUniqueVendorEdit($exp,$vid);

		if($qstage){ echo 1; }else{ echo 0; }

	}



	public function update_vendor()

	{

		$venid = $data['vendor_id'] = $this->input->post('vendor_id');

		$data['vendor_category_id'] = $this->input->post('vendor_category_id');

		$data['vendor_type_id'] = $this->input->post('vendor_type_id');

		$data['vendor_name'] = $this->input->post('vendor_name');

		$data['gst_no'] = $this->input->post('gst_no');

		$data['phone_no'] = $this->input->post('phone_no');

		$data['email_id'] = $this->input->post('email_id');

		$data['website'] = $this->input->post('website');

		$data['street'] = '';

		$data['city'] = '';

		$data['state'] = '';

		$data['country'] = '';

		$data['postal_code'] = '';

		$data['modified_on'] = date('Y-m-d H:i:s');

    	$data['modified_by'] = $admindata['user_id'];

    	$result = $this->Vendor_model->update_vendor($data);

    	$contact_person_name = $this->input->post('contact_person_name');

		$contact_person_email = $this->input->post('contact_person_email');

		$contact_person_phone = $this->input->post('contact_person_phone');

		$vendor_contact_person_id = $this->input->post('vendor_contact_person_id');

		$del_vendor_contact_person_id = $this->input->post('del_vendor_contact_person_id');

		$ven_addr_id = $this->input->post('vendor_address_id');

		$address_type = $this->input->post('address_type');

		$street = $this->input->post('street');

		$city = $this->input->post('city');

		$state = $this->input->post('state');

		$country = $this->input->post('country');

		$postal_code = $this->input->post('postal_code');



		if($del_vendor_contact_person_id != '') {
			$exp_del_cont_per_id = explode(',', $del_vendor_contact_person_id);
			for ($i=0; $i < count($exp_del_cont_per_id); $i++) { 
				$rmv_ven_cont_per_id = $this->Vendor_model->rmv_ven_cont_per_id($exp_del_cont_per_id[$i]);
			}
		}
		$del_vendor_address_id = $this->input->post('del_ven_addr_id');
		if($del_vendor_address_id != '') {
			$exp_del_addr_id = explode(',', $del_vendor_address_id);
			for ($k=0; $k < count($exp_del_addr_id); $k++) { 
				$rmv_ven_addr_id = $this->Vendor_model->rmv_ven_addr_id($exp_del_addr_id[$k]);
			}
		}
    	if ($result) {

    		for ($j=0; $j < count($ven_addr_id); $j++) { 
    			if ($ven_addr_id[$j] == 0) {
    				$this->Vendor_model->add_vendor_address($venid,$address_type[$j],$street[$j],$city[$j],$state[$j],$country[$j],$postal_code[$j]);
    			}
    			else {
    				$this->Vendor_model->update_vendor_address($ven_addr_id[$j],$venid,$address_type[$j],$street[$j],$city[$j],$state[$j],$country[$j],$postal_code[$j]);
    			}
    		}

    		for ($i=0; $i < count($contact_person_name); $i++) { 
    			if($vendor_contact_person_id[$i] == 0){
					$vendor_id = $venid;
					$cont_per = $contact_person_name[$i];
					$cont_per_email = $contact_person_email[$i];
					$cont_per_phone = $contact_person_phone[$i];

					$add_vendor_contact_info = $this->Vendor_model->add_vendor_contact_info($vendor_id,$cont_per,$cont_per_email,$cont_per_phone);
				}
				else {
					$ven_cont_per_id = $vendor_contact_person_id[$i];
					$vendor_id = $venid;
					$cont_per = $contact_person_name[$i];
					$cont_per_email = $contact_person_email[$i];
					$cont_per_phone = $contact_person_phone[$i];

					$update_vendor_contact_info = $this->Vendor_model->update_vendor_contact_info($ven_cont_per_id,$vendor_id,$cont_per,$cont_per_email,$cont_per_phone);
				}

			}

    		$this->Vendor_model->delete_vendor_product_by_id($venid);

			$venprod['vendor_id'] = $venid;

			$vprod = explode(",",implode(',', $this->input->post('vendor_product')));

			$subcount = count($vprod); 

			for($i=0;$i<$subcount;$i++)

			{

				$venprod['product_id'] = $vprod[$i];

				$this->Vendor_model->create_vendor_product($venprod);

			}

    	}

    	$this->session->set_flashdata('qstage_success', 'Vendor has been updated successfully.');

    	redirect('/vendor/index');

	}



	public function vendor_delete()

	{

		$data['vid']=$_POST['id'];

		$this->load->view('vendor/vendor_delete',$data);

	}



	public function delete(){ 

		$eid=$_POST['field'];

		$result = $this->Vendor_model->vendor_delete($eid);

		if ($result) {

		  $this->session->set_flashdata('qstate_success', 'Vendor has been Deleted successfully.');

		}

		else{

		  $this->session->set_flashdata('qstage_err', 'Something went wrong');

		}

	}



}

?>