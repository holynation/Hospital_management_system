<?php
/*
|--------------------------------------------------------------------------
| @ Author: Alatise OLuwaseun 
|--------------------------------------------------------------------------
|  @ Type: Image Uploading Class
|  
|  @ License: Under God Almighty the King of Kings and Lord of the Lords
|  @ Appreciation : To Adetula Adewumi, Omolewa Steven , Badmus Akintoba 
|					and Akintola Sodiq
|
|
|
*/
 class ImageCreate{

		public static $pathImage;
		public static $imgFullPath;
		public static $imgSize = 5242880;
 			
/*
|--------------------------------------------------------------------------------------------------
| Image Upload Class : uploadImage($field_name,$rename_character = NULL)
|						method 
|--------------------------------------------------------------------------------------------------
|  This class function accept three(3) parameters for it operation
|  $field_name => this is the name attribute of the Input file field name.
|  $rename_character => this is the name you want to give the thumbnail created
|    			NOTE: Name will apply if {$thumb} value is set to true.
| 
|	NOTE: This will work fine for any image uploading. if no thumb is needed....
*/
 	public static function uploadImage($field_name, $rename_character = NULL){

 		// if(empty($_FILES[$field_name]['name']) == TRUE){
 		// 	echo "Please upload an Image!";
 		// 	return;
 		// }

 		//file settings setup
 		// if(empty($_FILES[$field_name]['name'])){
	 		$file = $_FILES[$field_name]['name'];
	 		$file_tmp = $_FILES[$field_name]['tmp_name'];
	 		$file_size = $_FILES[$field_name]['size'];
	 		$file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
		
	 		if($rename_character != NULL)
	 		{
	 			$file_name = $rename_character. "_" . rand(0, 99999). '_' . uniqid(' ') .'.'.$file_ext;
	 		}
	 		else
	 		{
	 			$file_name = $file;
	 		}
	 		
	 		// path for real image
	 		$upload_image = self::$pathImage . "/" . $file_name;

	 		// check image extension to upload
	 		$allowed = array('jpg', 'jpeg', 'gif', 'png');
	 		
	 		if(in_array($file_ext, $allowed) === TRUE)
	 		{
	 			if($file_size < self::$imgSize) // check image size
	 			{
	 				if(move_uploaded_file($file_tmp, $upload_image))
	 				{

	 					// setting the image properties
	 				
	 					self::$imgFullPath = $upload_image;
	 				
	 					return $file_name;
	 				}

	 				else
	 				{
	 					echo"There is an error in uploading the image!";
	 				}
	 			}
	 			else
	 			{
	 			  echo"{$file} is too large";
	 			}
	 		}
	 		else
	 		{
	 			echo"{$file} extension '{$file_ext}' is not allowed. ";
	 		}
 		// }
 	}

    public static function getImageFullPath(){
    	return self::$imgFullPath;
    }

 }
