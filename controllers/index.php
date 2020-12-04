<?php
	class Index extends Controller{
		public function __construct(){
			parent::__construct();
		}
		
		public function index(){								
			$this->view->render('index/inc/header');
			$this->view->render('index/index');
			$this->view->render('index/inc/footer');
		}
		
		public function homeSearch(){
			
			// Get search term
			$searchTerm = $_GET['term'];
			
			// Get matched data from the database
			$conditions = array(
				'keywords' => $searchTerm
			);
			$conditions['limit'] = 25;
			$searchData = $this->model->getRows($conditions);
			
			$proMunCitSubData = array();
			
			if(!empty($searchData)){
				foreach($searchData as $row){
					$data['type'] = $row['type'];
					$data['id'] = $row['global_id'];
					$data['value'] = $row['global_name_1'].', '.$row['global_name_2'];
					$data['global_name_1'] = $row['global_name_1'];
					$data['global_name_2'] = $row['global_name_2'];
					$global_name_2_label = !empty($row['global_name_2'])?' in '.$row['global_name_2']:'';
					$data['label'] = '<a href="javascript:void(0);"><span>'.$row['global_name_1'].'</span>'.$global_name_2_label.'</a>';
					array_push($proMunCitSubData, $data);
				}
			}
			
			// Return results as json encoded array
			echo json_encode($proMunCitSubData);
			die;
		}
		
		public function getProvince(){
			if(!empty($_POST['municipality'])){
				$municipality = $_POST['municipality'];
				$province = $this->model->getProvince($municipality);
				if($province){
					$response = array(
						'status' => 1,
						'province_name' => $province
					);
				}else{
					$response = array(
						'status' => 0,
						'province_name' => ''
					);
				}
				
				echo json_encode($response);
			}
			die;
		}
		
	}