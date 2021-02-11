<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Joborder extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Joborder_model','Lead_model','Buyerorder_model','Supplierpo_model'));
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
    $data['user_list'] = $this->Buyerorder_model->get_user_list();
    $data['supplierpo_list'] = $this->Joborder_model->get_active_supplierpo_list();
    $data['employee_list'] = $this->Joborder_model->get_active_employee_list();
    $data['assigned_user_lists'] = $this->Lead_model->assigned_user_lists();
    $data['joborder_list'] = $this->Joborder_model->get_joborder_list();
    $data['fbasesearch'] = 'BonQuarter';
    $financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
        $financial_year_from2 = $financial_year_to2 - 1;
        $data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
    
    $yrange = $this->input->post('ypick');
    $yr = explode('-', $yrange);
    $cmonth = date('m');
    if($cmonth=='04' || $cmonth=='05' || $cmonth=='06')
    {
      $fqtr = 'Q1';
    }
    else if($cmonth=='07' || $cmonth=='08' || $cmonth=='09')
    {
      $fqtr = 'Q2';
    }
    else if($cmonth=='10' || $cmonth=='11' || $cmonth=='12')
    {
      $fqtr = 'Q3';
    }
    else
    {
      $fqtr = 'Q4';
    }

    $data['fquartersearch'] = $fqtr;

    $this->load->view('joborder/joborder_list',$data);
  }
  public function jo_list_by_filter()
  {
    // $data['perpage'] = $perpage = 10;
    $data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
    $data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
    $data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
    $data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';

    if ($search_val != '') {
      $sc = ' AND (jo.job_order_no LIKE "%'.$search_val.'%" OR u.name LIKE "%'.$search_val.'%" OR cb.lead_name LIKE "%'.$search_val.'%" OR p.product_name LIKE "%'.$search_val.'%")';
      // $data['page'] = $page = '0';
    }
    else {
      $sc = '';
    }
    $financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
        $financial_year_from2 = $financial_year_to2 - 1;
        $data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
      //   $country_id = $this->input->post('country_id');
      //     $product_id = $this->input->post('product_id');
          $user_id = $this->input->post('user_id');

      if($user_id !='')
      {
        $uid = " AND l.lead_assigned_to = '$user_id'";
      }
      else
      {
        $uid = '';
      }
      // $data['f_l_country'] = $country_id;
          $data['f_l_user'] = $user_id;

          $fbase = $this->input->post('fbase');
        $data['fbasesearch'] = $fbase;

        if($fbase == '')
        {
          $data['purchasesearch'] = '';
        $data['drnge'] = '';
          $data['fquartersearch'] = '';
          //$data['ypick'] = '';

          $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id $uid $sc ORDER BY jo.job_order_id DESC")->result_array();
          
            $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id $uid $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
        }
        else if($fbase == 'BonQuarter')
        {
          $btn = $this->input->post('goButtonboq');
          $fqtr = $this->input->post('fquarter');
          $yrange = $this->input->post('ypick');

          $data['fquartersearch'] = $fqtr;
          $data['ypick'] = $yrange;

          if($fqtr == '') 
          {
            $yr = explode('-', $yrange);

          $fdate = $yr[0].'-04-01';
          $tdate = $yr[1].'-03-31';
          $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc ORDER BY jo.job_order_id DESC")->result_array();

            $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
          }
          else
          {
            $yr = explode('-', $yrange);
            if($fqtr=='Q1')
            {
              $fdate = $yr[0].'-04-01';
            $tdate = $yr[0].'-06-30';
            }
            else if($fqtr=='Q2')
            {
              $fdate = $yr[0].'-07-01';
            $tdate = $yr[0].'-09-30';
            }
            else if($fqtr=='Q3')
            {
              $fdate = $yr[0].'-10-01';
            $tdate = $yr[0].'-12-31';
            }
            else
            {
              $fdate = $yr[1].'-01-01';
            $tdate = $yr[1].'-03-31';
            }
            $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc ORDER BY jo.job_order_id DESC")->result_array();

            $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
          }

          $data['purchasesearch'] = '';
        $data['drnge'] = '';
          //else if()
        }
        else
        {
          $btn = $this->input->post('goButton');
        $schange = $this->input->post('searchChange');
        //echo $schange;
        $dtrange_from = $this->input->post('dtrange_from');
        $dtrange_to = $this->input->post('dtrange_to');

        if ($dtrange_from != '' && $dtrange_to != '') {
          $dtrange = $dtrange_from.' - '.$dtrange_to;
        }
        else {
          $dtrange = '';  
        }
        if($btn=='')
        {
          $dtrange='';
        }
        if($schange == '')
              $schange='';

        if($schange == '')
        {
          $data['drnge'] = '';
          $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id $uid $sc ORDER BY jo.job_order_id DESC")->result_array();

          $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id $uid $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
        }
        elseif($schange == 'today')
        {
          $data['drnge'] = '';
          
          $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') = CURDATE() $uid $sc ORDER BY jo.job_order_id DESC")->result_array();

          $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') = CURDATE() $uid $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
        }
        else if($schange == 'thisweek')
        {
          $data['drnge'] = '';
          
          $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND YEARWEEK(STR_TO_DATE(jo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $uid $sc ORDER BY jo.job_order_id DESC")->result_array();

          $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND YEARWEEK(STR_TO_DATE(jo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $uid $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
        }      
        else if($schange == 'thismonth')
        {
          $data['drnge'] = '';
          
          $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND MONTH(STR_TO_DATE(jo.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $uid $sc ORDER BY jo.job_order_id DESC")->result_array();

          $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND MONTH(STR_TO_DATE(jo.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $uid $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
        }     
        else if($schange == 'thisyear')
        {
          $data['drnge'] = '';
          $finstart = $_SESSION['finstart'];
          $finend = $_SESSION['finend'];
          
          $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $uid $sc ORDER BY jo.job_order_id DESC")->result_array();

          $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $uid $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
        }
        else
        {
          $data['drnge'] = $dtrange;
          $data['dtrange_from'] = $dtrange_from;
          $data['dtrange_to'] = $dtrange_to;
          $dr = explode(' - ', $dtrange);

          $fd = explode('/', $dr[0]);
          $td = explode('/', $dr[1]);

          $fdate = $fd[2].'-'.$fd[0].'-'.$fd[1];
          $tdate = $td[2].'-'.$td[0].'-'.$td[1];
          
          $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc ORDER BY jo.job_order_id DESC")->result_array();

          $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id AND STR_TO_DATE(jo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(jo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
        }
        //echo $schange;exit;
        $data['purchasesearch'] = $schange;
        $data['drnge'] = $dtrange;
          $data['fquartersearch'] = '';
          //$data['ypick'] = '';
      }
      }
      else
      {       
      $data['f_l_country'] = '';
          $data['f_l_user'] = '';
          $data['fbasesearch'] = '';
        $data['purchasesearch'] = '';
      $data['drnge'] = '';
      $data['fquartersearch'] = '';

      $data['joborder_list_count'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id $sc ORDER BY jo.job_order_id DESC")->result_array();

      $data['joborder_list'] = $this->db->query("SELECT jo.*,spo.buyer_order_id,spo.supplier_purchase_order_no,u.name AS display_name,v.vendor_name,cb.lead_name,p.product_name,pi.product_item FROM job_order jo,supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l, contact_book cb,products p,product_items pi,buyer_order bo,users u WHERE jo.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND l.contact_book_id = cb.contact_book_id AND u.user_id = jo.employee_id $sc ORDER BY jo.job_order_id DESC LIMIT $page, $perpage")->result_array();
    }
    $this->load->view('joborder/joborder_list_table', $data);
  }

  public function getSupplyDate()
  {
    $spid = $_POST['id'];
    $supplierpo_list = $this->Supplierpo_model->get_supplierpo_by_id($spid);
    echo date('Y/m/d', strtotime($supplierpo_list->supply_date))."|".date('Y/m/d', strtotime($supplierpo_list->supply_end_date));
  }

  public function create_joborder()
  {
    // To generate Job Order NO
    $last_id_value = $this->Joborder_model->joborder_last_id();
    $last_id_value = $this->Supplierpo_model->supplierpo_last_id();
    $financial_year_to2 = (date('m') > 3) ? date('y') +1 : date('y');
    $financial_year_from2 = $financial_year_to2 - 1;
    $finhi = $financial_year_from2.'-'.$financial_year_to2;
    if(empty($last_id_value))
    {
      $data['job_order_no'] = 'JO/'.$finhi.'/001'; 
    }else
    {
      $lno = $last_id_value->job_order_no;
      $exlno = explode('/', $lno);
      if($finhi == $exlno[1])
      {
        //$valexp = explode('-', $exlno[0]);
        $next_value = (int)$exlno[2] + 1;
        $slen = strlen($next_value);
        if($slen==1)
          $nval = '00'.$next_value;
        else if($slen==2)
          $nval = '0'.$next_value;
        else
          $nval = $next_value;
        $data['job_order_no'] = 'JO/'.$finhi.'/'.$nval;
      }
      else
      {
        $data['job_order_no'] = 'JO/'.$finhi.'/001';
      }
    }
    $data['job_order_date'] = date('Y-m-d', strtotime($this->input->post('job_order_date')));
    $data['job_order_end_date'] = date('Y-m-d', strtotime($this->input->post('job_order_end_date')));
    $spoid = $data['supplier_purchase_order_id'] = $this->input->post('supplier_purchase_order_id');
    $data['employee_id'] = $this->input->post('employee_id');
    $data['created_on'] = date('Y-m-d H:i:s');
    //$data['created_by'] = $_SESSION['user_id'];
    $data['created_by'] = 1;

    $result = $this->Joborder_model->create_joborder($data);
    if ($result) {
      $data1['status']=1;
      $data1['supplier_purchase_order_id'] = $spoid;
      $this->Joborder_model->update_spo_status_by_id($data1);


      $this->session->set_flashdata('qstage_success', 'Job Order has been created successfully.');
    }
    else
    {
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/joborder');
  }

  public function joborder_edit()
  {
    $joid = $_POST['id'];
    $data['joborder_list'] = $this->Joborder_model->get_joborder_by_id($joid);
    $this->load->view('joborder/joborder_edit',$data);
  }

  public function update_joborder()
  {
    $data['job_order_id'] = $this->input->post('job_order_id');
    $data['job_order_end_date'] = date('Y-m-d', strtotime($this->input->post('job_order_end_date')));
    $data['modified_on'] = date('Y-m-d H:i:s');
    //$data['modified_by'] = $_SESSION['user_id'];
    $data['modified_by'] = 1;

    $result = $this->Joborder_model->update_joborder($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Job Order has been updated successfully.');
    }
    else
    {
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/joborder');
  }

  public function joborder_view()
  {
    $joid = $_POST['id'];
    $data['joborder_list'] = $this->Joborder_model->get_joborder_by_id($joid);
    $data['joborder_items'] = $this->Joborder_model->get_joborder_item_by_id($joid);
    $this->load->view('joborder/joborder_view',$data);
  }

  public function joborder_print($joid)
  {   
    $data['joborder_list'] = $this->Joborder_model->get_joborder_by_id($joid);    
    $this->load->view('joborder/joborder_printview',$data);
  }

  public function joborder_process()
  {
    $joid = $_POST['id'];
    $data['joborder_list'] = $this->Joborder_model->get_joborder_by_id($joid);
    $data['joborder_process'] = $this->Joborder_model->get_joborder_process_by_id($joid);
    $this->load->view('joborder/joborder_process',$data);
  }

  public function create_joborder_process()
  {
    $data['job_order_id'] = $this->input->post('job_order_id');
    $data['process_date'] = $this->input->post('process_date');
    $data['process_type'] = $this->input->post('process_type');
    $data['quantity'] = $this->input->post('quantity');
    $data['description'] = $this->input->post('description');
    $data['created_on'] = date('Y-m-d H:i:s');
    //$data['created_by'] = $_SESSION['user_id'];
    $data['created_by'] = 1;
    $result = $this->Joborder_model->create_joborder_process($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Job Order Process has been created successfully.');
    }
    else
    {
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/joborder');

  }

  public function joborder_process_edit()
  {
    $jopid = $_POST['id'];
    $data['joborder_process_list'] = $this->Joborder_model->get_joborder_process_by_jop_id($jopid);
    $this->load->view('joborder/joborder_process_edit',$data);
  }

  public function update_joborder_process()
  {
    $data['job_order_process_id'] = $this->input->post('job_order_process_id');
    $data['quantity'] = $this->input->post('quantity');
    $data['description'] = $this->input->post('description');
    $data['modified_on'] = date('Y-m-d H:i:s');
    //$data['modified_by'] = $_SESSION['user_id'];
    $data['modified_by'] = 1;
    $result = $this->Joborder_model->update_joborder_process($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Job Order Process has been updated successfully.');
    }
    else
    {
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
    redirect('/joborder');
  }

  public function joborder_process_add()
  {
    $data['joid'] = $_POST['joid'];
    $data['pdate'] = $_POST['pdate'];
    $data['ptype'] = $_POST['ptype'];
    $this->load->view('joborder/joborder_process_add',$data);
  }

  public function joborder_inspect()
  {
    $joid = $_POST['id'];
    $data['joborder_list'] = $this->Joborder_model->get_joborder_by_id($joid);
    $data['joborder_items'] = $this->Joborder_model->get_joborder_item_by_id($joid);
    $this->load->view('joborder/joborder_inspect',$data);
  }

  public function update_joborder_inspect()
  {
    $joid = $this->input->post('job_order_id');

    $data['container_no'] = $this->input->post('container_no');
    $data['lorry_no'] = $this->input->post('lorry_no');
    $data['job_order_id'] = $joid;

    $this->Joborder_model->update_joborder_container_lorry_no($data);

    if($this->input->post('items')!='')
    {
      $item = explode(",",implode(",",$this->input->post('items')));
      $spec = explode(",",implode(",",$this->input->post('specification')));
      $tool = explode(",",implode(",",$this->input->post('tools')));
      $obser = explode(",",implode(",",$this->input->post('observation')));
      $pf = explode(",",implode(",",$this->input->post('pass_fail')));

      $subcount = count($this->input->post('items'));      
        $data2['job_order_id'] =  $joid;
      for($i=0;$i<$subcount;$i++)
      {
        if($item[$i] != ''){
          $data2['items'] = $item[$i];
          $data2['specification'] = $spec[$i];
          $data2['tools'] = $tool[$i];
          $data2['observation'] = $obser[$i];
          $data2['pass_fail'] = $pf[$i];
          $data2['job_order_item_date'] = date('Y-m-d');
          $this->Joborder_model->create_joborder_inspect($data2);
        }
      }
    }
    $this->session->set_flashdata('qstage_success', 'Job Order Inspection has been added successfully.');
    redirect('/joborder');
  }

  public function loading_joborder_document($joid)
  {
    $data['loading_type'] = $this->Joborder_model->get_active_loading_type();
    $data['joborder_list'] = $this->Joborder_model->get_joborder_by_id($joid);
    $this->load->view('joborder/joborder_loading',$data);
  }

  public function upload_loading_files()
  {
    $abspath = getcwd();
    $joid = $this->input->post('job_order_id');

    $loading_type = $this->input->post('loading_type');

    $joborder_list = $this->Joborder_model->get_joborder_by_id($joid);

    // Count total files

    $filePondArray = $_POST['filepond'];
    $numFilePondObjects = sizeof($filePondArray);

    if($numFilePondObjects > 0)
    {
      $jo_folder_path = str_replace('/', '-', $joborder_list->job_order_no)."/";

      if (!is_dir('assets/joborder/'.$jo_folder_path)) 
      {
        mkdir('./assets/joborder/' . $jo_folder_path, 0777, TRUE);
      }

      if (!is_dir('assets/joborder/'.$jo_folder_path.'/'.$loading_type)) 
      {
        mkdir('./assets/joborder/' . $jo_folder_path.'/'.$loading_type, 0777, TRUE);
      }

      $baseFileLocation = '/assets/joborder/'.$jo_folder_path.'/'.$loading_type.'/';

      //$directory = "/path/to/dir/";
      $filecount = 0;
      $files = glob($abspath.$baseFileLocation . "*");
      if ($files)
      {
        $filecount = count($files);
      }
      else
      {
        $filecount=0;
      }

      // Looping all files
      $i = 0;
      // iterate through the objects...
      for ($xx=0; $xx<$numFilePondObjects; $xx++)
      {
        $thisFilePondJSON_object = $filePondArray[$xx];
        $thisFilePondArray = json_decode($thisFilePondJSON_object, true);
        // isolate the encoded pics...
        $thisFilePondArray_picData = $thisFilePondArray['data'];
        $thisFilePondArray_numPics = sizeof($thisFilePondArray_picData);
        // iterate through pics in this object...

        $thisPic_PhotoNumber = $xx + $filecount + 1;

        $thisPic_name_temp = 'photo_' . $thisPic_PhotoNumber .'.jpg';
        $thisPic_encodedData = $thisFilePondArray_picData;
        $thisPic_decodedData = base64_decode($thisPic_encodedData);
        $thisPic_fullPathAndName = $baseFileLocation . $thisPic_name_temp; 
        file_put_contents($abspath.$thisPic_fullPathAndName, $thisPic_decodedData);
      }

      $this->session->set_flashdata('qstage_success', 'Document has been uploaded successfully...');
    }
    else
    {
      $this->session->set_flashdata('qstage_err', 'No File!');
    }
    redirect('/joborder');
  }

  public function joborder_load_doc()
  {
    $joid = $_POST['id'];
    $data['joborder_list'] = $this->Joborder_model->get_joborder_by_id($joid);
    $this->load->view('joborder/joborder_load_doc',$data);
  }

  public function joborder_inspection_print($id)
  {   
    $pdata['joborder_list'] = $this->Joborder_model->get_joborder_by_id($id);
    $pdata['joborder_items'] = $this->Joborder_model->get_joborder_item_by_id($id);    
    $this->load->view('joborder/inspect_printview',$pdata);
  }

  public function jo_complete()
  {
    $data['joid']=$_POST['id'];
    $this->load->view('joborder/jo_complete',$data);
  }

  public function completeJO(){ 
    $joid=$_POST['joid'];
    $data['is_complete'] = 1;
    $data['completed_date'] = date('Y-m-d');
    $data['job_order_id'] = $joid;
    $result = $this->Joborder_model->joborder_complete($data);
    if ($result) {
      $this->session->set_flashdata('qstage_success', 'Joborder has been Completed successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
  }

}
?>