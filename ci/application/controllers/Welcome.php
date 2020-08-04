<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		//call CodeIgniter's default Constructor
		parent::__construct();
		
		//load database libray manually
		$this->load->database();
		
		//load Model
		$this->load->model('Welcome_Model');

		// Load base_url
		$this->load->helper('url');
	}
	
	public function index()	{
		$frameworks = $this->Welcome_Model->getrecords();
		$data['frameworks'] = $frameworks;

		$this->load->view('welcome_message',$data);
	}

	public function index2() {
		$modelresponds = $this->Welcome_Model->getrecords();
		echo json_encode($modelresponds);
	}

	public function saverecords() {
		$check = $this->Welcome_Model->checkduplicate();
		if(!$check){
			$content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=vue"));
			preg_match('/【(.*?)個工作機會/', $content, $vue);
			$content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=react"));
			preg_match('/【(.*?)個工作機會/', $content, $react);
			$content = htmlspecialchars(file_get_contents("https://www.104.com.tw/jobs/search/?keyword=angular"));
			preg_match('/【(.*?)個工作機會/', $content, $angular);

			$data = ['vue'=>$vue[1],'react'=> $react[1],'angular'=> $angular[1]];
			$modelresponds = $this->Welcome_Model->saverecords($data);
			echo json_encode($modelresponds); //null is success
		}else{
			echo json_encode('duplicate');
		}
		
	}

	public function fuck() {
		$modelresponds = $this->Welcome_Model->checkduplicate();
		echo json_encode($modelresponds);
	}
}
