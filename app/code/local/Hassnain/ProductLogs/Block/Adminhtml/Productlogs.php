<?php


class Hassnain_ProductLogs_Block_Adminhtml_Productlogs extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_productlogs";
	$this->_blockGroup = "productlogs";
	$this->_headerText = Mage::helper("productlogs")->__("Product Logs Manager");
	$this->_addButtonLabel = Mage::helper("productlogs")->__("Add New Log");
	parent::__construct();
	
	}

}