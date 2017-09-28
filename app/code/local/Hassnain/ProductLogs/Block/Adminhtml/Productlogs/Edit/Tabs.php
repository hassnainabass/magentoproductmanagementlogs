<?php
class Hassnain_ProductLogs_Block_Adminhtml_Productlogs_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("productlogs_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("productlogs")->__("Log Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("productlogs")->__("Log Information"),
				"title" => Mage::helper("productlogs")->__("Log Information"),
				"content" => $this->getLayout()->createBlock("productlogs/adminhtml_productlogs_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
