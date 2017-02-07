<?php
/*
 * This controller, controlles all actions in frontend
 */
class Inkatia_Blog_PostController extends Mage_Core_Controller_Front_Action{
	
	public function indexAction(){
		
		// before we render our layout let's check if our data exists
		$id = $this->getRequest()->getParam('id');
		if( is_numeric($id) ){
			
			$item = Mage::getModel('blog/blog');
			$item->load($id)->getData();
			
			if($item['status']==1){
				$this->loadLayout();
        		$this->renderLayout();
			}else{
				$this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
			    $this->getResponse()->setHeader('Status','404 File not found');
			
			    $this->_redirect('blog/');
			}
			
		}else{
			$this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
			$this->getResponse()->setHeader('Status','404 File not found');
			$this->_redirect('blog/');
		}

	}

}