<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	/* This file holds common functions used all over site 
	*
	*
	*/

	/* return array of menu where (id of menu = menu_id) */
	function getMenu($admin_menu_item, $id = 0)
	{
		$arr_menu = array();
		foreach($admin_menu_item as $menu_item)
			$menu_item->menu_id == $id ? $arr_menu[] = $menu_item : '';
		return $arr_menu;
	}
	
	
	/* show a complete page with header + navbar + pagename + footer for admin */
	function showPage($page_name, $data)
	{
		$instance_name = & get_instance();
		$instance_name->load->view("admin/header", $data);
		$instance_name->load->view("admin/navbar", $data);
		$instance_name->load->view("admin/{$page_name}", $data);
		$instance_name->load->view("admin/footer", $data);
	}
	
	
	/* show a login page with header + login form */
	function showLogin($page_name, $data)
	{
		$instance_name = & get_instance();
		$instance_name->load->view("admin/header_login", $data);
		$instance_name->load->view("admin/login", $data);
	}
	
	
	/* create a breadcrumb menu */
	function createBreadCrumb($id)
	{
		$instance_name = & get_instance();
		$menu_name = null;
		while($id > 0)
		{
			if($arr_menu_info = $this->front_menu->getMenuInfo($id))
			{
				$menu_name = anchor(site_url('admin/pages/'.$arr_menu_info->id), $arr_menu_info->menu_name) . ' / ' . $menu_name;
				$id = $arr_menu_info->menu_id;
			}
			else
			{
				break;
			}
		}
		return substr_replace($menu_name, "", -3);
	}
	
	
	/* show postfix after number lik - st, rd, th etc */
	function show_ordinal($num) 
	{
		$the_num = (string) $num;
		$last_digit = substr($the_num, -1, 1);
		switch($last_digit) 
		{
			case "1":
				$the_num.="st";
				break;
			case "2":
				$the_num.="nd";
				break;
			case "3":
				$the_num.="rd";
				break;
			default:
				$the_num.="th";
		}
		return $the_num;
	}
	
	
	/* create date array between two dates in strtotime format*/
	function createDateArray($start_dt, $end_dt)
	{
		$arr_dates = array();
		$arr_dates[] = $start_dt = strtotime($start_dt);
		while(1)
		{ 
			$start_dt = strtotime("+1 day", $start_dt);
			if($start_dt <= strtotime($end_dt))
			{
				$arr_dates[] = $start_dt;
			}
			else
			{
				break;
			}
		}
		return $arr_dates;
	}
?>