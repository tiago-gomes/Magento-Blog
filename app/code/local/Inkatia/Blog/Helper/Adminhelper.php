<?php

class Inkatia_Blog_Helper_Adminhelper extends Mage_Core_Helper_Abstract{
	
	public function _getUploadDir(){
		return Mage::getBaseDir('media') . DS . 'inkatia' . DS . 'blog' . DS . 'featured_images' . DS ;
	}
	public function _changeFileName($filename){
		$ext 		= substr($filename, strpos($filename,'.'), strlen($filename)-1);     
    	$imageName  = md5(time()).$ext;
    	return $imageName;
	}
	public function _getImageSize($filename){
		return getimagesize($filename);
	}
}