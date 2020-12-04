<?php
	class Image_Upload_Model{
		private $conn;
		
		public function __construct(){
			$database = new Database();
			$db = $database->getConnection();
			$this->conn = $db;
		}
		
		//Get a single suburb 
		public function getProperty($property_id){
			try{
				$query = "SELECT * FROM properties
						  WHERE property_id = '$property_id'";
				$result = $this->conn->query($query);
				$row = $result->fetch(PDO::FETCH_ASSOC);
								
				$property = new Property();
				$property->setPropertyID($row['property_id']);
				$property->setPropertyType($row['property_type']);
				$property->setPropertyStatus($row['property_status']);
				$property->setPropertyID($row['street_no']);
				$property->setPropertyID($row['street_name']);
				$property->setPropertyID($row['num_bathrooms']);
				$property->setPropertyID($row['num_beds']);
				$property->setPropertyID($row['num_garages']);
				$property->setPropertyID($row['num_lounges']);
				$property->setPropertyID($row['air_con']);
				$property->setPropertyID($row['pool']);
				$property->setPropertyID($row['cottage']);
				$property->setPropertyID($row['price']);
				
				return $property;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function uploadImage(){
			if(isset($_POST['submit'])){
			
			// File upload configuration
			//$targetDir = "uploads/";
			$targetDir = "public/images/properties/uploads/";
			$allowTypes = array('jpg','png','jpeg','gif');
			//$allowWidth = 1920;
			//$allowHeight = 1200;
			$allowWidth = 1280;
			$allowHeight = 1024;
			
			$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = $errorUploadDimension = '';
				if(!empty(array_filter($_FILES['files']['name']))){
					$fileNameArr = array_filter($_FILES['files']['name']);
					foreach($fileNameArr as $key=>$val){
						$imageNo = 'Image '.($key + 1);
						$imageInfo = getimagesize($_FILES["files"]["tmp_name"][$key]);
						$imageWidth = $imageInfo[0];
						$imageHeight = $imageInfo[1];
						
						if(($imageWidth >= $allowWidth) && ($imageHeight >= $allowHeight)){
							// File upload path
							$fileName = rand().'_'.basename($_FILES['files']['name'][$key]);
							$targetFilePath = $targetDir . $fileName;
							$property_id = isset($_POST['property']) ? $_POST['property']:"";
							// Check whether file type is valid
							$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
							if(in_array($fileType, $allowTypes)){
								// Upload file to server
								if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
									if(($imageWidth > $allowWidth) || ($imageHeight > $allowHeight)){
										//Thumbnail creation
										$fileNameThumb = rand().'_'.basename($_FILES['files']['name'][$key]);
										$thumbnail = $targetDir.$fileNameThumb;
										list($width,$height) = getimagesize($targetFilePath);
										$thumb_create = imagecreatetruecolor($allowWidth,$allowHeight);
										switch($fileType){
											case 'jpg':
												$source = imagecreatefromjpeg($targetFilePath);
												break;
											case 'jpeg':
												$source = imagecreatefromjpeg($targetFilePath);
												break;
							
											case 'png':
												$source = imagecreatefrompng($targetFilePath);
												break;
											case 'gif':
												$source = imagecreatefromgif($targetFilePath);
												break;
											default:
												$source = imagecreatefromjpeg($targetFilePath);
										}
							
										imagecopyresized($thumb_create,$source,0,0,0,0,$allowWidth,$allowHeight,$width,$height);
										switch($fileType){
											case 'jpg' || 'jpeg':
												imagejpeg($thumb_create,$thumbnail,100);
												break;
											case 'png':
												imagepng($thumb_create,$thumbnail,100);
												break;
							
											case 'gif':
												imagegif($thumb_create,$thumbnail,100);
												break;
											default:
												imagejpeg($thumb_create,$thumbnail,100);
										}
										@unlink($targetFilePath);
										$targetFilePath = $thumbnail;
									}
									
									
									// Image db insert sql
									$insertValuesSQL .= "('$property_id', '".$targetFilePath."', NOW()),";
								}else{
									$errorUpload .= $imageNo.'('.$_FILES['files']['name'][$key].'), ';
								}
							}else{
								$errorUploadType .= $imageNo.'('.$_FILES['files']['name'][$key].'), ';
							}
						}else{
							$errorUploadDimension .= $imageNo.'('.$_FILES['files']['name'][$key].'), ';
						}
					}
					
					
					if($errorUpload){
						$errorMsg .= '<br/>Upload Error: '.$errorUpload;
					}
					if($errorUploadType){
						$errorMsg .= '<br/>File Type Error: '.$errorUploadType;
					}
					if($errorUploadDimension){
						$errorMsg .= '<br/>Required resolution is 1920px width and 1200px height: '.$errorUploadDimension;
					}
					
					if(!empty($insertValuesSQL)){
						$insertValuesSQL = trim($insertValuesSQL,',');
						// Insert image file name into database
						$insert = $this->conn->query("INSERT INTO property_images (property_id, image_location, upload_date) VALUES $insertValuesSQL");
						if($insert){
							$altype = !empty($errorMsg)?'alert-warning':'alert-success';
							$statusMsg = array(
								'type' => $altype,
								'msg' => 'Images are uploaded successfully.'.$errorMsg
							);
						}else{
							$statusMsg = array(
								'type' => 'alert-danger',
								'msg' => 'Sorry, there was an error uploading your images.'.$errorMsg
							);
						}
					}else{
						$statusMsg = array(
							'type' => 'alert-danger',
							'msg' => 'Sorry, there was an error uploading your images.'.$errorMsg
						);
					}
				}else{
					$statusMsg = array(
						'type' => 'alert-danger',
						'msg' => 'Please select a file to upload.'
					);
				}
				
				// Display status message
				return $statusMsg;
			}
		}
	
	}
?>