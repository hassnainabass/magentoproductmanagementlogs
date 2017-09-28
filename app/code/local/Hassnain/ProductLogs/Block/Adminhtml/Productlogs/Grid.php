<?php

class Hassnain_ProductLogs_Block_Adminhtml_Productlogs_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("productlogsGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("productlogs/productlogs")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("productlogs")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("user_name", array(
				"header" => Mage::helper("productlogs")->__("User Name"),
				"index" => "user_name",
				));
				$this->addColumn("product_sku", array(
				"header" => Mage::helper("productlogs")->__("Product SKU"),
				"index" => "product_sku",
				));
				$this->addColumn("product_name", array(
				"header" => Mage::helper("productlogs")->__("Product Name"),
				"index" => "product_name",
				));
					$this->addColumn('created_at', array(
						'header'    => Mage::helper('productlogs')->__('Created At'),
						'index'     => 'created_at',
						'type'      => 'datetime',
					));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_productlogs', array(
					 'label'=> Mage::helper('productlogs')->__('Remove Productlogs'),
					 'url'  => $this->getUrl('*/adminhtml_productlogs/massRemove'),
					 'confirm' => Mage::helper('productlogs')->__('Are you sure?')
				));
			return $this;
		}
			

}