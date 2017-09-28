<?php
class Hassnain_ProductLogs_Model_Observer
{

			public function beforeSave(Varien_Event_Observer $observer)
			{
				$product = $observer->getProduct();  

				$admin = Mage::getSingleton('admin/session')->getUser(); 
				$admin_username = $admin->getUsername();
				
				$new_data = json_encode($product->getData());
				$created_at = Mage::getModel('core/date')->gmtDate('Y-m-d H:i:s');
				// echo $new_data; exit; 

				$data = array(
					'user_name' => $admin_username,
					'product_sku' => $product->getSku(),
					'product_name' => $product->getName(),
					'last_data' => 'N/A',
					'new_data' => $new_data,
					'created_at' => $created_at
					);
				$log = Mage::getModel('productlogs/productlogs')->setData($data);
				
				try{
				    $id = $log->save()->getId();
				}catch(Exception $e){
				    echo $e->getMessage();
				}
			}
		
}
