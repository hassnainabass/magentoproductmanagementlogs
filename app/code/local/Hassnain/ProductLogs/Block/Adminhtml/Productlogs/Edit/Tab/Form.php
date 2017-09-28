<?php
class Hassnain_ProductLogs_Block_Adminhtml_Productlogs_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("productlogs_form", array("legend"=>Mage::helper("productlogs")->__("Log information")));

				
						$fieldset->addField("user_name", "text", array(
						"label" => Mage::helper("productlogs")->__("User Name"),
						"name" => "user_name",
						));
					
						$fieldset->addField("product_sku", "text", array(
						"label" => Mage::helper("productlogs")->__("Product SKU"),
						"name" => "product_sku",
						));
					
						$fieldset->addField("product_name", "text", array(
						"label" => Mage::helper("productlogs")->__("Product Name"),
						"name" => "product_name",
						));
					
						$fieldset->addField("last_data", "textarea", array(
						"label" => Mage::helper("productlogs")->__("Last Data"),
						"name" => "last_data",
						));
					
						$fieldset->addField("new_data", "textarea", array(
						"label" => Mage::helper("productlogs")->__("New Data"),
						"name" => "new_data",
						));
					
						$dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(
							Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
						);

						$fieldset->addField('created_at', 'date', array(
						'label'        => Mage::helper('productlogs')->__('Created At'),
						'name'         => 'created_at',
						'time' => true,
						'image'        => $this->getSkinUrl('images/grid-cal.gif'),
						'format'       => $dateFormatIso
						));

				if (Mage::getSingleton("adminhtml/session")->getProductlogsData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getProductlogsData());
					Mage::getSingleton("adminhtml/session")->setProductlogsData(null);
				} 
				elseif(Mage::registry("productlogs_data")) {
				    $form->setValues(Mage::registry("productlogs_data")->getData());
				}
				return parent::_prepareForm();
		}
}
