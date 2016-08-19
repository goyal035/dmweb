<?php
//App::uses('Component', 'Controller');
class CustomComponent extends Component {
    function prd($data) {
        echo "<pre>";
        print_r($data);
        exit;
    }

    function uploadImage($newImg, $destination='images/users/', $prefix="user", $oldImg=""){
    	if($newImg){
    		$allowedTypes = array('jpg','jpeg','png');
    		$ext = strtolower(pathinfo($newImg['name'], PATHINFO_EXTENSION));
    		if (in_array($ext, $allowedTypes)) {
			    $imgName = uniqid($prefix.'_').".".$ext;
			    if(copy($newImg['tmp_name'],$destination.$imgName)){
			    	$this->deleteOldImage($destination.$oldImg);
			    	return	$imgName;
			    }else{
			    	return false;
			    }
			}else{
				return false;
			}    			
    	}    	
    }

    function deleteOldImage($url){
    	if(file_exists($url)){
    		if(unlink($url)){
    			return true;
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
    }
}