<?php 

function check_installer(){
  
  $file = "INSTALLER_TRUE.php";
    if(file_exists($file)){
        redirect(base_url().'Installer/installer.php');
    } 
}

function get_icon(){

	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->where('id', 1);
	$ci->db->from('settings');
	$result = $CI->db->get()->row();
	return $result;

}