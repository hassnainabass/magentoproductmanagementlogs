<?php
	
class Hassnain_ProductLogs_Block_Adminhtml_Productlogs_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "productlogs";
				$this->_controller = "adminhtml_productlogs";
				$this->_updateButton("save", "label", Mage::helper("productlogs")->__("Save Log"));
				$this->_updateButton("delete", "label", Mage::helper("productlogs")->__("Delete Log"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("productlogs")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("productlogs_data") && Mage::registry("productlogs_data")->getId() ){

				    return Mage::helper("productlogs")->__("Edit Log '%s'", $this->htmlEscape(Mage::registry("productlogs_data")->getId()));

				} 
				else{

				     return Mage::helper("productlogs")->__("Add Log");

				}
		}
}