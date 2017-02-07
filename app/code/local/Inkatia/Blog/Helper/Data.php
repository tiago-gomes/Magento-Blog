<?php

class Inkatia_Blog_Helper_Data extends Mage_Core_Helper_Abstract{

	public function _parceTinyMceText($text, $postId){
		$string = strip_tags($text);
		if (strlen($string) > 250) {
		    // truncate string
		    $stringCut = substr($string, 0, 250);
		    // make sure it ends in a word so assassinate doesn't become ass...
		    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.Mage::getBaseUrl().'/blog/post/?id='.$postId.'  ">'.$this->__("Read More"). '</a>'; 
		}
		return $string;
	}
}