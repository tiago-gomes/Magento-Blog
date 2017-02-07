<?php
 
class Inkatia_Blog_Block_Adminhtml_Blog_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
    	
    	$dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
    	/*
    	 *  We need to get a fix for variables, widgets and images
    	 */
    	$wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
    		array(
				'width'			=>'200px', 
				'enabled'		=> true, 
				'hidden'		=> false, 
				'use_container'	=> true, 
				'add_variables' => false, 
				'add_widgets' 	=> false,
				'add_images'	=> false,
				'files_browser_window_url'=>$this->getBaseUrl().'admin/cms_wysiwyg_images/index/'
			)
		);
        
        $form = new Varien_Data_Form();
        
        $this->setForm($form);
        
        $fieldset = $form->addFieldset('blog_form', array(
			'legend'=>Mage::helper('blog')->__('Details')
		));
       
       	 $fieldset->addField('featured_image', 'image', array(
            'label' => Mage::helper('blog')->__('Featured Image'),
            'required' => false,
            'name' => 'featured_image',
        ));
       	
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('blog')->__('Your Post Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));

        $fieldset->addField('content_tinymce', 'editor', array(
		    'name'      => 'content_tinymce',
		    'label'     => Mage::helper('blog')->__('Content'),
		    'title'     => Mage::helper('blog')->__('Content'),
		    'style'     => 'height:15em',
		    'config'    => $wysiwygConfig,
		    'state'     => 'html',
		    'wysiwyg'   => true,
		    'required'  => false,
		));
       
       $fieldset->addField('created_time', 'date', array(
       		'name'		=> 'created_time',
            'label'     => Mage::helper('blog')->__('Created Date'),
            'after_element_html' => '<small></small>',
            'tabindex' => 1,
            'class'     => 'required-entry',
            'required'  => true,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'format' => $dateFormatIso,
            'time' => true,
            'input_format' => $dateFormatIso
    	));
       
       	$fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('blog')->__('Status'),
            'name'      => 'status',
            'class'     => 'required-entry',
            'required'  => true,
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('blog')->__('Active'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('blog')->__('Inactive'),
                ),
            ),
        ));
        
        if ( Mage::getSingleton('adminhtml/session')->getBlogData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBlogData());
            Mage::getSingleton('adminhtml/session')->setBlogData(null);
        } elseif ( Mage::registry('blog_data') ) {
            $form->setValues(Mage::registry('blog_data')->getData());
        }
        
        return parent::_prepareForm();
        
    }
}