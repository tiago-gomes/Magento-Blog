<?php
 
class Inkatia_Blog_Model_Mysql4_Blog extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
    	/*
    	 * Creates a Resource Model Abstract
    	 */
        $this->_init('blog/blog', 'inkatia_blog_id');
    }
}