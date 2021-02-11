<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* ************************************************************************************
		Purpose : To handle all Product functions
		Date    : 04-02-2020 
***************************************************************************************/
class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Setting_model', 'Product_model', 'Lead_model'));
		$admindata = $this->session->userdata('admindata');
	      if ($admindata['user_id']>0)
	      {
	          //do something
	      }else{
	          redirect('login'); //if session is not there, redirect to login page
	      } 
		date_default_timezone_set("Asia/Kolkata");
		
	}
	// To list product details
	public function index()					
	{	
		$data['email_lists'] = $this->Setting_model->email_list();
		$data['industry_lists'] = $this->Setting_model->industry_list();
		$data['f_letter_val'] = ($this->input->post('letter_val')) ? $this->input->post('letter_val') : 'all';
		$data['f_industry_id'] = ($this->input->post('industry')) ? $this->input->post('industry') : '';
    	// $data['product_lists'] = $this->Product_model->product_list($data['f_letter_val'], $data['f_industry_id']);

    	$data['product_costing_category_list'] = $this->Product_model->get_product_costing_category_list();

		$this->load->view('product/product_list', $data);
	}
	public function product_list_by_filter()
	{
		//$data['perpage'] = $perpage = 10;
		$data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
		$data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
		$data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
		$data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';

		$data['f_letter_val'] = ($this->input->post('letter_val')) ? $this->input->post('letter_val') : 'all';
		$data['f_industry_id'] = ($this->input->post('industry')) ? $this->input->post('industry') : '';
		$data['product_lists_count'] = $this->Product_model->product_list_count($data['f_letter_val'], $data['f_industry_id'],$search_val);
    	$data['product_lists'] = $this->Product_model->product_list($data['f_letter_val'], $data['f_industry_id'],$search_val,$page,$perpage);

    	$this->load->view('product/product_list_table', $data);
	}
	// To save product details
	public function product_save()
	{
		$product_costing_category_list = $this->Product_model->get_product_costing_category_list();
		$industry_id  = ($this->input->post('industry_id')) ? $this->input->post('industry_id') : '';
		$product_name = ($this->input->post('product_name')) ? $this->input->post('product_name') : '';
		$description  = ($this->input->post('description')) ? $this->input->post('description') : '';
		$for_lead = $this->input->post('for_lead');
		$for_vendor = $this->input->post('for_vendor');
		// To get auto increment ID
		$product_ID = $this->Product_model->product_next_auto_id();
		$insert_columns = 'industry_id, product_name, description, for_lead, for_vendor, created_on, created_by';
		$insert_values  = '';
		$insert_values = "'".$industry_id."', '".$product_name."', '".$description."', '".$for_lead."' , '".$for_vendor."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
		$insert_result = $this->Product_model->product_save($insert_columns, 'products',  $insert_values);
		$prd_emails   = (!empty($this->input->post('prd_email'))) ? $this->input->post('prd_email') : '';
		if($insert_result && !empty($product_ID) && $product_ID->AUTO_INCREMENT > 0 && !empty($prd_emails))
		{	
			$insert_columns = 'product_id, email_detail_id, created_on, created_by';
			foreach ($prd_emails as $key => $prd_email) 
			{
				 $insert_values = '';
				 $insert_values = "'".$product_ID->AUTO_INCREMENT."', '".$prd_email."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
				 $insert_result = $this->Product_model->product_emails_save($insert_columns, 'product_emails',  $insert_values);

			}
		}

		if(count($product_costing_category_list)>0)
		{
			for($i=0;$i<count($product_costing_category_list);$i++)
			{
				$pccid = $this->input->post('product_costing_category_id'.$i);
				if($pccid!='')
				{
					$data['product_id'] = $product_ID->AUTO_INCREMENT;
					$data['product_costing_category_id'] = $pccid;
					$data['product_costing_type_id'] = implode(',', $this->input->post('product_costing_type_id'.$i));

					$this->Product_model->create_product_costing_product_mapping($data);
				}
			}
		}

		$this->session->set_flashdata('prd_success', 'Product has been created successfully...');
		redirect('Products');     
	}

	// To change product status
	public function product_status_change()
	{
		$data['product_id'] = $this->input->post('id');
	    $data['status'] = $this->input->post('status');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Product_model->product_status_change($data);
	    return ($result) ? 1 : 0;
	}
	// To get product edit
	public function product_view()
	{
		$product_id = $this->input->post('val');
		$data['product_details'] = $this->Product_model->product_by_id($product_id);
		$data['product_emails'] = $this->Product_model->product_emails_by_id($product_id);
		$data['product_users'] = $this->Product_model->product_users_by_id($product_id);

		$data['pcp_mapping'] = $this->Product_model->get_product_costing_product_mapping_by_pid($product_id);

		$this->load->view('product/product_view',$data);
	}
	// To get product edit
	public function product_edit()
	{
		$product_id = $this->input->post('val');
		$data['product_details'] = $this->Product_model->product_by_id($product_id);
		$data['product_emails'] = $this->Product_model->product_emails_by_id($product_id);
		$data['email_lists'] = $this->Setting_model->email_list();
		$data['industry_lists'] = $this->Setting_model->industry_list();

    	$data['product_costing_category_list'] = $this->Product_model->get_product_costing_category_list();

		$this->load->view('product/product_edit',$data);
	}
	// To check product name unique
	public function product_unique()
	{
		$product = $this->input->post('value');
		$industry_id = $this->input->post('industry_id');
	    $result = $this->Product_model->product_unique($product, $industry_id);
	    if(!empty($result)){ $result = 1;}else{ $result = 0; }
	    echo  $result;
	}
	// To save product details
	public function product_update()
	{
		$product_costing_category_list = $this->Product_model->get_product_costing_category_list();
		$data['product_id'] = $this->input->post('product_id');
		$data['industry_id'] = $this->input->post('industry_id');
		$data['product_name'] = $this->input->post('product_name');
		$data['description'] = $this->input->post('description');
		$data['for_lead'] = $this->input->post('for_lead');
		$data['for_vendor'] = $this->input->post('for_vendor');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Product_model->product_update($data);
	    $prd_emails = $this->input->post('prd_email');
	    // To get product emails
	    $product_emails = $this->Product_model->product_email_ID_only_by_id($data['product_id']);
	    $edit_emails = array();
	      if(!empty($product_emails))
	      {  
	         foreach ($product_emails as $key => $product_email) {
	            $edit_emails[] = $product_email->email_detail_id;
	         }
	      }
	      if(!empty($prd_emails) && !empty($edit_emails))
	      {
	      		$array_1 = '';
	      		$array_2 = '';
	      		if( count($edit_emails) > count($prd_emails))
	      		{
	      			$array_1 = $edit_emails;
	      			$array_2 = $prd_emails;
	      		}
	      		else{
	      			$array_1 = $prd_emails;
	      			$array_2 = $edit_emails;
	      		}
	      		$email_diff_val = array_merge(array_diff($array_1, $array_2), array_diff($array_2, $array_1));
	      		if(!empty($email_diff_val))
	      		{
	      			$insert_columns = 'product_id, email_detail_id, created_on, created_by';
					foreach ($email_diff_val as $key => $email_diff) 
					{
						// To check email id exists for product
						$check_email_ID = $this->Product_model->product_email_ID_existby_product_id($data['product_id'], $email_diff);
						if(!empty($check_email_ID))
						{
							// To delete the record
							$prd_email_delete = $this->Product_model->product_email_ID_delete_by_id($check_email_ID->product_email_id);
						}else{

							$insert_values = '';
						 	$insert_values = "'".$data['product_id']."', '".$email_diff."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
						 	$insert_result = $this->Product_model->product_emails_save($insert_columns, 'product_emails',  $insert_values);
						}
						 
					}
	      		}

	      }

	      else
	      {
	      	if(!empty($prd_emails))
			{	
				$insert_columns = 'product_id, email_detail_id, created_on, created_by';
				foreach ($prd_emails as $key => $prd_email) 
				{
					 $insert_values = '';
					 $insert_values = "'".$data['product_id']."', '".$prd_email."', date('Y-m-d H:i:s'), '".$_SESSION['admindata']['user_id']."' ";
					 $insert_result = $this->Product_model->product_emails_save($insert_columns, 'product_emails',  $insert_values);

				}
			}
	      }

	      $this->Product_model->delete_product_costing_product_mapping_by_pid($data['product_id']);
	      $pid = $data['product_id'];
		if(count($product_costing_category_list)>0)
		{
			for($i=0;$i<count($product_costing_category_list);$i++)
			{
				$pccid = $this->input->post('product_costing_category_id'.$i);
				if($pccid!='')
				{
					$data['product_id'] = $pid;
					$data['product_costing_category_id'] = $pccid;
					$data['product_costing_type_id'] = implode(',', $this->input->post('product_costing_type_id'.$i));

					$this->Product_model->create_product_costing_product_mapping($data);
				}
			}
		}
	    
		$this->session->set_flashdata('prd_success', 'Product has been updated successfully...');
		redirect('Products');     
	}
	// To delete product
	public function product_delete()
	{
		$data['product_id'] = $this->input->post('product_id');
	    $data['status'] = 2;
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Product_model->product_status_change($data);
	    // To delete product emails
	    $product_delete = $this->Product_model->product_email_ID_delete_by_product_id($data['product_id']);
	    if($result)
	    {
	         $this->session->set_flashdata('prd_success', 'Product has been deleted successfully...');
	    }else{
	        $this->session->set_flashdata('prd_err', 'Could not delete product!');
	    }
	   redirect('Products');     
	}
	// To list product item
	public function product_item_list()
	{
		$data['container_list'] = $this->Product_model->get_container_list();
		$data['product_item_lists'] = $this->Product_model->product_item_list();
		$data['product_lists'] = $this->Product_model->product_list_for_items('all', '');
		$this->load->view('product_item/product_item_list', $data);
	}
	// To get industry by product id
	public function industry_by_product_id()
	{
		$prd_id = $this->input->post('prd');
		$prd_details = $this->Lead_model->product_industry_by_product_id($prd_id);
		$option = '';
		if(!empty($prd_details))
		{
			$option .= $prd_details->industry_id.'|'.$prd_details->industry_name;
		}

		echo $option; die;
	}
	// To check product item name unique
	public function product_item_unique()
	{
		$product_item = $this->input->post('value');
		$product = $this->input->post('product_name');

	    $result = $this->Product_model->product_item_unique($product_item, $product);
	    if(!empty($result)){ $result = 1;}else{ $result = 0; }
	    echo  $result;
	}
	// To save product item details save
	public function product_item_save()
	{
		//print_r($_POST);exit;
		$product_id  = $this->input->post('product_name');
		$industry_id = $this->input->post('industry_id');
		$created_by  = $_SESSION['admindata']['user_id'];
		$created_on  = date('Y-m-d H:i:s');
		$product_items  = $this->input->post('product_item');
		$product_items_spec  = $this->input->post('product_item_spec');
		$product_items_cont  = $this->input->post('product_item_cont');
		$insert_columns = 'product_id, industry_id, container_id, product_item, product_item_spec, created_on, created_by';
	
		if(!empty($product_items))
		{
			foreach ($product_items as $key => $product_item) {

				$insert_values  = '';
				$insert_values = "'".$product_id."', '".$industry_id."', '".$product_items_cont[$key]."', '".$product_item."', '".$product_items_spec[$key]."', '".$created_on."', '".$created_by."'";
				$insert_result = $this->Product_model->product_item_save($insert_columns, 'product_items',  $insert_values);
			}
		}
		$this->session->set_flashdata('prd_item_success', 'Product Item has been created successfully...');
		redirect('product_item_list');     
	}
	// To change product item change status
	public function product_item_status_change()
	{
		$data['product_item_id'] = $this->input->post('id');
	    $data['status'] = $this->input->post('status');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Product_model->product_item_status_change($data);
	    return ($result) ? 1 : 0;
	}
	// To get product item edit
	public function product_item_edit()
	{
		$product_item_id = $this->input->post('val');
		$data['container_list'] = $this->Product_model->get_container_list();
		$data['product_lists'] = $this->Product_model->product_list_for_items('all', '');
		$data['prd_item_details'] = $this->Product_model->product_item_by_id($product_item_id);
		$this->load->view('product_item/product_item_edit',$data);
	}
	// To update product item details
	public function product_item_update()
	{
		$product_item_id = $this->input->post('product_item_id');
		$data['product_id'] = $this->input->post('product_name');
		$data['industry_id'] = $this->input->post('industry_id');
		$data['product_item'] = $this->input->post('product_item');
		$data['product_item_spec'] = $this->input->post('product_item_spec');
		$data['container_id'] = $this->input->post('product_item_cont');
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Product_model->product_item_update($data, $product_item_id);
	    $this->session->set_flashdata('prd_item_success', 'Product Item has been updated successfully...');
		redirect('product_item_list');     
	}
	// To delete product item dettails
	public function product_item_delete()
	{
		$data['product_item_id'] = $this->input->post('prd_item_id');
	    $data['status'] = 2;
	    $data['modified_by'] = $_SESSION['admindata']['user_id'];
	    $data['modified_on'] = date('Y-m-d H:i:s');
	    $result = $this->Product_model->product_item_status_change($data);
	    // To delete product emails
	    //$product_delete = $this->Product_model->product_email_ID_delete_by_product_id($data['product_id']);
	   $this->session->set_flashdata('prd_item_success', 'Product Item has been deleted successfully...');
	   redirect('product_item_list');     

	}

	public function product_staging()
	{
	   $piid = $_POST['value'];
	   $data['product_costing_stage'] = $this->Product_model->get_product_costing_stage_by_piid($piid);
	   $data['product_unit'] = $this->Product_model->get_product_unit();
	   $data['product_item'] = $this->Product_model->get_product_item_by_id($piid);

	   $this->load->view('product_item/product_costing_stage', $data);
	}

	public function create_product_costing_stage()
	{
		//print_r($_POST);exit;
		$product_item_id = $this->input->post('product_item_id');
		$sno = explode(",",implode(",",$this->input->post('stage_no')));
		$sname = explode(",",implode(",",$this->input->post('stage_name')));
		$uval = explode(",",implode(",",$this->input->post('unit_value')));
		$sstage = explode(",",implode(",",$this->input->post('sub_stage')));
		$inkg = explode(",",implode(",",$this->input->post('in_kg')));
		//$inprice = explode(",",implode(",",$this->input->post('in_price')));
		$puid = explode(",",implode(",",$this->input->post('product_unit_id')));
		//$dstatus = explode(",",implode(",",$this->input->post('data_status')));
		$subcount = count($this->input->post('stage_no')); 
		for($i=0;$i<$subcount;$i++)
		{
			if($sname[$i] != ''){

				$data['product_item_id'] = $product_item_id;
				$data['stage_no'] = $sno[$i];
				$data['stage_name'] = $sname[$i];
				$data['unit_value'] = $uval[$i];
				$data['sub_stage'] = $sstage[$i];
				$data['in_kg'] = $inkg[$i];
				//$data['in_price'] = $inprice[$i];
				$data['product_unit_id'] = $puid[$i];
				//$data['data_status'] = $dstatus[$i];
				$data['in_price'] = 0;
				$data['data_status'] = 0;
				$data['created_on'] = date('Y-m-d H:i:s');
	    		$data['created_by'] = $admindata['user_id'];
				$data['modified_on'] = date('Y-m-d H:i:s');
	    		$data['modified_by'] = $admindata['user_id'];

				$pcstage = $this->Product_model->get_product_costing_stage_by_prod_item_id_stage_no($product_item_id,$sno[$i]);
				if(count($pcstage)>0)
				{
					$this->Product_model->update_product_costing_stage($data,$pcstage->product_costing_stage_id);
				}
				else
				{
					$this->Product_model->create_product_costing_stage($data);
				}

				
	    		//$result = $this->Productcostingtype_model->create_product_costing_type($data);
			}
		}

		if(!$this->input->post('gobutton'))
		{
			$productcc = $this->Product_model->get_product_costing_stage_by_piid($product_item_id);
			if(count($productcc)>0)
			{
			  $st = '<option value="">Choose</option>';
			  foreach ($productcc as $prod) {
			    $st.='<option value='.$prod["product_costing_stage_id"].'>'.$prod["stage_sku_name"].'</option>';
				}
			}
			else
			{
			  $st = '<option value="">No Stage Available</option>';
			}
			echo $st;
		}
		else
		{
			$this->session->set_flashdata('prd_item_success', 'Product Costing Stage has been added successfully.');
      		redirect('/product_item_list');
		}
	}

	public function getSubStageValue()
	{
		$ssval = $_POST['ssval'];
		$productcosting_stage_list = $this->Product_model->getSubStageValue($ssval);
		echo $productcosting_stage_list->in_kg.'||'.$productcosting_stage_list->product_unit_id;
	}

	public function display_name()
	{
	   $piid = $_POST['value'];
	   $data['display_name_list'] = $this->Product_model->get_display_name_by_piid($piid);
	   $data['product_item'] = $this->Product_model->get_product_item_by_id($piid);

	   $this->load->view('product_item/display_name', $data);
	}

	public function create_display_name()
	{
		$product_item_id = $this->input->post('product_item_id');
		$sno = explode(",",implode(",",$this->input->post('display_name')));
		$subcount = count($this->input->post('display_name')); 

		$this->Product_model->delete_display_name_by_piid($product_item_id);

		for($i=0;$i<$subcount;$i++)
		{
			if($sno[$i] != ''){

				$data['product_item_id'] = $product_item_id;
				$data['display_name'] = $sno[$i];

				$this->Product_model->create_display_name($data);
			}
		}
		$this->session->set_flashdata('prd_item_success', 'Display Name has been added successfully.');
      	redirect('/product_item_list');
	}
}
?>