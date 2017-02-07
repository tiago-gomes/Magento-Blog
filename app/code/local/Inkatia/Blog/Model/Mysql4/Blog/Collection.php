<?php
 
class Inkatia_Blog_Model_Mysql4_Blog_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
    	/*
    	 * creates a Abstract Core Resource Collection
    	 */
        //parent::__construct();
        $this->_init('blog/blog');
    }
}