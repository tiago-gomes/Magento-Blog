<?php
 /*
  * This controller, controles, all actions in backend for Post Actions 
 */
class Inkatia_Blog_Adminhtml_BlogController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {

        $this->loadLayout()
            ->_setActiveMenu('blog/items')
            ->_addBreadcrumb(Mage::helper('blog')->__('Items Manager'), Mage::helper('blog')->__('Item Manager'));
        return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();       
        // $this->_addContent($this->getLayout()->createBlock('admingrid/adminhtml_admingrid'));
        $this->renderLayout();
    }
 
    public function editAction()
    {
    	
        $AdmingridId     = $this->getRequest()->getParam('id');
        $AdmingridModel  = Mage::getModel('blog/blog')->load($AdmingridId);
 
        if ($AdmingridModel->getId() || $AdmingridId == 0) {
 
            Mage::register( 'blog_data', $AdmingridModel );
 
            $this->loadLayout();
            $this->_setActiveMenu('blog/items');
           
            $this->_addBreadcrumb(Mage::helper('blog')->__('Item Manager'), Mage::helper('blog')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('blog')->__('Item News'), Mage::helper('blog')->__('Item News'));

            $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_blog_edit'))
                 ->_addLeft($this->getLayout()->createBlock('blog/adminhtml_blog_edit_tabs'));
               
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
   
    public function newAction()
    {
        $this->_forward('edit');
    }
   
    public function saveAction()
    {
    	/*
    	 * Upload Files 
    	*/
    	if(isset($_FILES['featured_image']['name']) and (file_exists($_FILES['featured_image']['tmp_name']))) {
    		
		  try {
		  	
		  	$helper = Mage::Helper('blog/adminhelper');
		  	
		    $uploader = new Varien_File_Uploader('featured_image');
		    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything
		 
		    $uploader->setAllowRenameFiles(false);
		    $uploader->setFilesDispersion(false);
		    
		    // directory path
		    $path 	 = $helper->_getUploadDir();
       		
       		// change filename
    		$_FILES['featured_image']['name'] = $helper->_changeFileName($_FILES['featured_image']['name']);

    		// check image size
    		// list( $width, $height ) = $helper->_getImageSize($_FILES['featured_image']);

		    $uploader->save($path, $_FILES['featured_image']['name']);
		 
		    $data['featured_image'] = 'inkatia' . DS . 'blog' . DS . 'featured_images' . DS . $_FILES['featured_image']['name'];
		    
		  }catch(Exception $e) {
 
		  }
		  
		}
		
        if ( $this->getRequest()->getPost() ) {
            try {
            	
                $postData = $this->getRequest()->getPost();

                // preventing featured image to be deleted
                if(isset($postData['featured_image']['delete']) && $postData['featured_image']['delete'] == 1){
			        $data['featured_image'] =  '';
                }else if(isset($postData['featured_image']['delete']) && $postData['featured_image']['delete'] == 0){
			        $data['featured_image'] = $postData['featured_image']['value'];
                }else{}
                
                $AdmingridModel = Mage::getModel('blog/blog');
               
                $AdmingridModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setFeaturedImage($data['featured_image'])
                    ->setContentTinymce($postData['content_tinymce'])
                    ->setStatus($postData['status'])
                    ->setCreatedTime($postData['created_time'])
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setBlogData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setBlogData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
   
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
            	
                $AdmingridModel = Mage::getModel('blog/blog');
               
                $AdmingridModel->setId($this->getRequest()->getParam('id'))->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('blog/adminhtml_blog_grid')->toHtml()
        );
    }
}