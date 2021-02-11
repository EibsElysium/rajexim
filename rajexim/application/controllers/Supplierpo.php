<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supplierpo extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Supplierpo_model'));
    $this->load->model(array('Vendor_model'));
    $this->load->model(array('Buyerorder_model'));
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
    $data['dtrange_from'] = '';
    $data['dtrange_to'] = '';
    $data['vendor_list'] = $this->Supplierpo_model->get_vendor_list();
    $financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
        $financial_year_from2 = $financial_year_to2 - 1;
        $data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
          $user_id = $this->input->post('user_id');

      if($user_id !='')
      {
        $uid = " AND spo.vendor_id = '$user_id'";
      }
      else
      {
        $uid = '';
      }
          $data['f_l_user'] = $user_id;

          $fbase = $this->input->post('fbase');
        $data['fbasesearch'] = $fbase;

        if($fbase == '')
        {
          $data['purchasesearch'] = '';
        $data['drnge'] = '';
          $data['fquartersearch'] = '';
          //$data['ypick'] = '';

            $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id $uid ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
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

            $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
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
            $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
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
        // $dtrange = $this->input->post('dtrange');
        if($btn=='')
        {
          $dtrange='';
        }
        if($schange == '')
              $schange='';

            if($schange == '')
        {
          $data['drnge'] = '';
          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id $uid ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
        }
        elseif($schange == 'today')
        {
          $data['drnge'] = '';
          
          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') = CURDATE() $uid ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
        }
        else if($schange == 'thisweek')
        {
          $data['drnge'] = '';
          
          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND YEARWEEK(STR_TO_DATE(spo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $uid ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
        }      
        else if($schange == 'thismonth')
        {
          $data['drnge'] = '';
          
          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND MONTH(STR_TO_DATE(spo.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $uid ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
        }     
        else if($schange == 'thisyear')
        {
          $data['drnge'] = '';
          $finstart = $_SESSION['finstart'];
          $finend = $_SESSION['finend'];
          
          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $uid ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
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
          
          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id  AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
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
        $data['f_l_user'] = '';
        $data['fbasesearch'] = 'BonQuarter';
        $data['purchasesearch'] = '';
        $data['drnge'] = '';
        //$data['fquartersearch'] = '';
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
      $data['supplierpo_list'] = $this->Supplierpo_model->get_supplierpo_list();
    }
    $this->load->view('supplierpo/supplierpo_list',$data);
  }

  public function spo_list_by_filter()
  {
    // $data['perpage'] = $perpage = 10;
    $data['perpage'] = $perpage = ($this->input->post('perpage')) ? $this->input->post('perpage') : '25';
    $data['search_val'] = $search_val = ($this->input->post('search_val')) ? $this->input->post('search_val') : '';
    $data['current_pagination_index'] = $current_pagination_index = ($this->input->post('current_pagination_index')) ? $this->input->post('current_pagination_index') : '1';
    $data['page'] = $page = ($this->input->post('pagecount')) ? $this->input->post('pagecount') : '0';

    if ($search_val != '') {
      $sc = ' AND (spo.supplier_purchase_order_no LIKE "%'.$search_val.'%" OR v.vendor_name LIKE "%'.$search_val.'%" OR p.product_name LIKE "%'.$search_val.'%" OR cb.lead_name LIKE "%'.$search_val.'%")';
      // $data['page'] = $page = '0';
    }
    else {
      $sc = '';
    }
    $data['dtrange_from'] = '';
    $data['dtrange_to'] = '';
    $data['vendor_list'] = $this->Supplierpo_model->get_vendor_list();
    $financial_year_to2 = (date('m') > 3) ? date('Y') +1 : date('Y');
    $financial_year_from2 = $financial_year_to2 - 1;
    $data['ypick'] = $financial_year_from2.'-'.$financial_year_to2;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
          $user_id = $this->input->post('user_id');

      if($user_id !='')
      {
        $uid = " AND spo.vendor_id = '$user_id'";
      }
      else
      {
        $uid = '';
      }
          $data['f_l_user'] = $user_id;

          $fbase = $this->input->post('fbase');
        $data['fbasesearch'] = $fbase;

        if($fbase == '')
        {
          $data['purchasesearch'] = '';
        $data['drnge'] = '';
          $data['fquartersearch'] = '';
          //$data['ypick'] = '';
            $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

            $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
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

            $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

            $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();
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
            $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

            $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC LIMIT $page, $perpage")->result_array();
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
        // $dtrange = $this->input->post('dtrange');
        if($btn=='')
        {
          $dtrange='';
        }
        if($schange == '')
              $schange='';

            if($schange == '')
        {
          $data['drnge'] = '';
          $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC LIMIT $page, $perpage")->result_array();
        }
        elseif($schange == 'today')
        {
          $data['drnge'] = '';
          $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') = CURDATE() $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') = CURDATE() $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC LIMIT $page, $perpage")->result_array();
        }
        else if($schange == 'thisweek')
        {
          $data['drnge'] = '';
          $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND YEARWEEK(STR_TO_DATE(spo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND YEARWEEK(STR_TO_DATE(spo.created_on, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC LIMIT $page, $perpage")->result_array();
        }      
        else if($schange == 'thismonth')
        {
          $data['drnge'] = '';
          $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND MONTH(STR_TO_DATE(spo.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND MONTH(STR_TO_DATE(spo.created_on, '%Y-%m-%d')) = MONTH(CURDATE()) $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC LIMIT $page, $perpage")->result_array();
        }     
        else if($schange == 'thisyear')
        {
          $data['drnge'] = '';
          $finstart = $_SESSION['finstart'];
          $finend = $_SESSION['finend'];
          $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$finstart."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$finend."', '%Y-%m-%d') $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC LIMIT $page, $perpage")->result_array();
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
          $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id  AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id  AND STR_TO_DATE(spo.created_on, '%Y-%m-%d') >= STR_TO_DATE('".$fdate."', '%Y-%m-%d') and STR_TO_DATE(spo.created_on, '%Y-%m-%d') <= STR_TO_DATE('".$tdate."', '%Y-%m-%d') $uid $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC LIMIT $page, $perpage")->result_array();
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
          $data['f_l_user'] = '';
          $data['fbasesearch'] = '';
          $data['purchasesearch'] = '';
          $data['drnge'] = '';
          $data['fquartersearch'] = '';
          $data['supplierpo_list_count'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC")->result_array();

          $data['supplierpo_list'] = $this->db->query("SELECT spo.*,v.vendor_name,v.phone_no,cb.lead_name,p.product_name,pi.product_item FROM supplier_purchase_order spo,vendor v,supplier_purchase_order_product spop,leads l,products p,product_items pi,buyer_order bo, contact_book cb WHERE spo.vendor_id = v.vendor_id AND spop.supplier_purchase_order_id = spo.supplier_purchase_order_id AND spop.product_item_id = pi.product_item_id AND pi.product_id = p.product_id AND spo.buyer_order_id = bo.buyer_order_id AND bo.lead_id = l.lead_id AND cb.contact_book_id = l.contact_book_id $sc GROUP BY spo.supplier_purchase_order_id ORDER BY spo.supplier_purchase_order_id DESC LIMIT $page, $perpage")->result_array();
      // $data['supplierpo_list'] = $this->Supplierpo_model->get_supplierpo_list();
    }
    $this->load->view('supplierpo/supplierpo_list_table',$data);
  }
  public function supplierpo_add()
  {
    $data['buyerpo_list'] = $this->Supplierpo_model->get_active_buyerpo_by_qty();
    $data['vendor_list'] = $this->Supplierpo_model->get_vendor_list();

    $this->load->view('supplierpo/supplierpo_add',$data);
  }

  public function getBPOProduct()
  {
    $po_id = $_POST['id'];
    $po_product = $this->Supplierpo_model->get_buyer_order_product_by_id($po_id);

    if(count($po_product)>0)
    {
      $sa = '<option value="">Select Product</option>';
      foreach ($po_product as $poprod) {
        if($poprod['supplier_quantity']<$poprod['quantity'])
          $sa.='<option value='.$poprod["buyer_order_product_id"].'>'.$poprod["product_name"].' - '.$poprod["product_item"].'</option>';
      }
    }
    else
    {
      $sa = '<option value="">Select Product</option>';
    }

    $data['bo_products'] = $sa;
    // $poid = $_POST['poid'];
    // $pid = $_POST['prodId'];
    // $data['po_product'] = $this->Supplierpo_model->get_buyer_order_product_by_id_proditemid($poid,$pid);
    $data['po_details'] = $this->Buyerorder_model->get_buyer_order_by_id($po_id);

    $this->load->view('supplierpo/spo_product_detail',$data);

  }

  public function getProduct()
  {
    //print_r($_POST);exit;
    $poid = $_POST['poid'];
    $pid = $_POST['prodId'];
    $data['po_product'] = $this->Supplierpo_model->get_buyer_order_product_by_id_proditemid($poid,$pid);
    $data['po_details'] = $this->Buyerorder_model->get_buyer_order_by_id($poid);
    $this->load->view('supplierpo/spo_product_detail',$data);
  }

  public function getBOProduct_Details_by_id()
  {
    $bo_pro_id = $this->input->post('bo_pro_id');
    $get_bop_by_id = common_select_values('*','buyer_order_product','buyer_order_product_id = "'.$bo_pro_id.'"','row');
    $bop_pending_qty = $get_bop_by_id->quantity - $get_bop_by_id->supplier_quantity;
    echo $bop_pending_qty;
  }

  public function create_supplierpo()
  {
    //print_r($_POST);exit;
     // To generate invoice no
    $last_id_value = $this->Supplierpo_model->supplierpo_last_id();
    $financial_year_to2 = (date('m') > 3) ? date('y') +1 : date('y');
    $financial_year_from2 = $financial_year_to2 - 1;
    $finhi = $financial_year_from2.'-'.$financial_year_to2;
    if(empty($last_id_value))
    {
      $data['supplier_purchase_order_no'] = 'SPO/'.$finhi.'/001'; 
    }else
    {
      $lno = $last_id_value->supplier_purchase_order_no;
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
        $data['supplier_purchase_order_no'] = 'SPO/'.$finhi.'/'.$nval;
      }
      else
      {
        $data['supplier_purchase_order_no'] = 'SPO/'.$finhi.'/001';
      }
    }
    $data['vendor_id'] = $this->input->post('vendor_id');
    $poid = $data['buyer_order_id'] = $this->input->post('buyer_order_id');
    $data['supply_date'] = date('Y-m-d');
    $data['delivery_place'] = $this->input->post('delivery_place');
    $data['total_amount'] = $this->input->post('total_amount');
    $data['terms_of_condition'] = $this->input->post('terms_of_condition');
    $data['created_on'] = date('Y-m-d H:i:s');
    //$data['created_by'] = $admindata['user_id'];
    $data['created_by'] = $_SESSION['admindata']['user_id'];;
    $data['supply_end_date'] = date('Y-m-d', strtotime($this->input->post('supply_end_date')));

    $result = $this->Supplierpo_model->create_supplierpo($data);
    if ($result) {
      $last_id_value = $this->Supplierpo_model->supplierpo_last_id();
      $last_value=$last_id_value->count_val;
      $supplierpo_id = $last_value;

      
        // $piid = explode(",",implode(",",$this->input->post('product_id')));
        $popid = explode(",",implode(",",$this->input->post('product_id'))); //buyer_order_product_id
        $qty = explode(",",implode(",",$this->input->post('quantity')));
        $rate = explode(",",implode(",",$this->input->post('rate')));
        $amount = explode(",",implode(",",$this->input->post('amount')));

        
        $subcount = count($this->input->post('product_id'));   

          $data1['supplier_purchase_order_id'] =  $supplierpo_id;
        for($i=0;$i<$subcount;$i++)
        {
          if($popid[$i] != ''){
            
            $get_bop_by_id = common_select_values('*','buyer_order_product','buyer_order_product_id = "'.$popid[$i].'"','row');
            $data1['product_item_id'] = $get_bop_by_id->product_item_id;
            $data1['buyer_order_product_id'] = $popid[$i];
            $data1['quantity'] = $qty[$i];
            $data1['rate'] = $rate[$i];
            $data1['amount'] = $amount[$i];
            $this->Supplierpo_model->create_supplierpo_product($data1);

            //$posqty = $this->Supplierpo_model->get_buyer_po_product_by_po_prod_id($poid,$pid[$i]);
            $posqty = $this->Supplierpo_model->get_buyer_order_product_by_bop_id($popid[$i]);
            $supqty = $posqty->supplier_quantity+$qty[$i];
            $data2['supplier_quantity'] = $supqty;
            //$data2['product_id'] = $pid[$i];
            //$data2['purcahse_order_id'] = $poid;
            $data2['buyer_order_product_id'] = $popid[$i];
            $this->Supplierpo_model->update_buyer_order_sup_qty($data2);
          }
        }
      

      $this->session->set_flashdata('add_success', 'Supplier PO has been created successfully.');
    }
    else{
      $this->session->set_flashdata('add_err', 'Something went wrong');
    }
    redirect('/supplierpo');
    //$this->load->view('supplierpo/printview',$pdata);
  } 

  public function supplierpo_view($id)
  {   
    $pdata['supplierpo_list'] = $this->Supplierpo_model->get_supplierpo_by_id($id);
    $pdata['supplierpo_product_details'] = $this->Supplierpo_model->get_supplierpo_product_by_id($id);
    
    $this->load->view('supplierpo/supplierpo_view',$pdata);
  }

  public function supplierpo_edit($id)
  {   
    $pdata['supplierpo_list'] = $this->Supplierpo_model->get_supplierpo_by_id($id);
    $pdata['supplierpo_product_details'] = $this->Supplierpo_model->get_supplierpo_product_by_id($id);
    
    $this->load->view('supplierpo/supplierpo_edit',$pdata);
  }

  public function update_supplierpo()
  {
    $spoid = $data['supplier_purchase_order_id'] = $this->input->post('supplier_purchase_order_id');
    $data['delivery_place'] = $this->input->post('delivery_place');
    $data['total_amount'] = $this->input->post('total_amount');
    $data['terms_of_condition'] = $this->input->post('terms_of_condition');
    $data['modified_on'] = date('Y-m-d H:i:s');
    //$data['modified_by'] = $_SESSION['user_id'];
    $data['modified_by'] = $_SESSION['admindata']['user_id'];;
    $data['supply_end_date'] = date('Y-m-d', strtotime($this->input->post('supply_end_date')));

    $result = $this->Supplierpo_model->update_supplierpo($data);
    if ($result) {

      if($this->input->post('supplier_purchase_order_product_id')!='')
      {
        $spopid = explode(",",implode(",",$this->input->post('supplier_purchase_order_product_id')));
        $rate = explode(",",implode(",",$this->input->post('rate')));
        $amount = explode(",",implode(",",$this->input->post('amount')));

        $subcount = count($this->input->post('supplier_purchase_order_product_id'));
        for($i=0;$i<$subcount;$i++)
        {
          if($spopid[$i] != ''){
            $data1['supplier_purchase_order_product_id'] = $spopid[$i];
            $data1['rate'] = $rate[$i];
            $data1['amount'] = $amount[$i];
            $this->Supplierpo_model->update_supplierpo_product($data1);
          }
        }
      }

      $this->session->set_flashdata('add_success', 'Supplier PO has been created successfully.');
    }
    else{
      $this->session->set_flashdata('add_err', 'Something went wrong');
    }
    redirect('/supplierpo');
    //$this->load->view('supplierpo/printview',$pdata);
  }

  public function spo_complete()
  {
    $data['spoid']=$_POST['id'];
    $this->load->view('supplierpo/spo_complete',$data);
  }

  public function completeSPO(){ 
    $spoid=$_POST['spoid'];
    $data['is_complete'] = 1;
    $data['completed_date'] = date('Y-m-d');
    $data['supplier_purchase_order_id'] = $spoid;
    $result = $this->Supplierpo_model->supplierpo_complete($data);
    if ($result) {

      $supplierpo_list = $this->Supplierpo_model->get_supplierpo_by_id($spoid);
      $vid = $supplierpo_list->vendor_id;
      $sedate = $supplierpo_list->supply_end_date;
      $curdate = date('Y-m-d');

      $spoedate = date_create($sedate);
      $spocdate = date_create($curdate);
      $diff=date_diff($spoedate,$spocdate);
      $ddiff = $diff->format("%a");

      $d_settings = common_select_values('*', 'dashboard_settings', '', 'row');

      if($sedate>$curdate)
      {
        $tpoints = $ddiff*$d_settings->supplier_point_before;
      }
      else if($sedate == $curdate)
      {
        $tpoints = $d_settings->supplier_point_ondate;
      }
      else
      {
        $tpoints = $ddiff*$d_settings->supplier_point_after;
      }

      $spdata['vendor_id'] = $vid;
      $spdata['supplier_purchase_order_id'] = $spoid;
      $spdata['points'] = $tpoints;

      $this->Supplierpo_model->create_supplier_points($spdata);

      $vlist = $this->Supplierpo_model->get_vendor_by_id($vid);
      $vpoints = $vlist->points;

      $totpoints = $vpoints+$tpoints;

      $this->Supplierpo_model->update_vendor_points($totpoints,$vid);

      $this->session->set_flashdata('qstage_success', 'Supplierpo has been Completed successfully.');
    }
    else{
      $this->session->set_flashdata('qstage_err', 'Something went wrong');
    }
  }

}
?>