<?php

class Inkatia_Blog_Block_Pagination extends Mage_Core_Block_Template{
	
	protected $_myCollection;

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()
            ->createBlock('page/html_pager', 'my.pager')
            ->setCollection($this->getMyCollection());

        $this->setChild('pager', $pager);
        $this->getMyCollection()->load();
        
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    protected function getMyCollection()
    {
        if (is_null($this->_myCollection)) {
            $this->_myCollection = Mage::getModel('blog/blog')->getCollection();
        }

        return $this->_myCollection;
    }
    
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