<?php

class Inkatia_Blog_Block_Blog extends Mage_Core_Block_Template{
	
	public function _getModel(){
		return Mage::getModel('blog/blog');
	}
	
	public function _getCollection(){
		return Mage::getModel('blog/blog')->getCollection();
	}
	
	public function _test(){
		echo 1;
	}
}