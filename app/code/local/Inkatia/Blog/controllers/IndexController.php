<?php
/*
 * This controller, controlles all actions in frontend
 */
class Inkatia_Blog_IndexController extends Mage_Core_Controller_Front_Action{
	
	public function indexAction(){
		$this->loadLayout();
        $this->renderLayout();
	}
}