<?php
/*
 * Creates a Form Container for AdminGrid Edit
 */
class Inkatia_Blog_Block_Adminhtml_Blog_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'blog';
        $this->_controller = 'adminhtml_blog';
 
        $this->_updateButton('save', 'label', Mage::helper('blog')->__('Save Post'));
        $this->_updateButton('delete', 'label', Mage::helper('blog')->__('Delete Post'));
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('blog_data') && Mage::registry('blog_data')->getId() ) {
            return Mage::helper('blog')->__("Edit Post '%s'", $this->htmlEscape(Mage::registry('blog_data')->getTitle()));
        } else {
            return Mage::helper('blog')->__('Create a new Post');
        }
    }
    
	protected function _prepareLayout()
    {
        // Load Wysiwyg on demand and Prepare layout
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled() && ($block = $this->getLayout()->getBlock('head'))) {
            $block->setCanLoadTinyMce(true);
        }
        parent::_prepareLayout();
    }
}