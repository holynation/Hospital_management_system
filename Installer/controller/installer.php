<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/*
| ---------------------------------------------------------------------------
| @ ALATISE OLUWASEUN a.k.a Holynation
| ---------------------------------------------------------------------------
| 
| This helps to install web app just like a real time install application
|
| ---------------------------------------------------------------------------
|     Installation Script
|		email : holynation667@gmail.com
|		phone num: +2347064625478
| ---------------------------------------------------------------------------
|
*/

 class Installer extends CI_Controller{


 	public function __construct(){
 		parent::__construct();
 	}

 	public function index(){
 		$this->install();
 	}

 	public function install(){
 		redirect(base_url().'Installer/installer.php');
 	}

}