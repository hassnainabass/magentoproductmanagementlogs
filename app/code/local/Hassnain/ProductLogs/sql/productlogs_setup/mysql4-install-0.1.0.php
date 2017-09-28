<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
CREATE TABLE product_logs (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_name varchar(50) DEFAULT NULL,
  product_sku varchar(50) DEFAULT NULL,
  product_name varchar(300) DEFAULT NULL,
  last_data text DEFAULT NULL,
  new_data text DEFAULT NULL,
  created_at datetime DEFAULT NULL,
  PRIMARY KEY (id)
);
		
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 