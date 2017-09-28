<?php

class Hassnain_ProductLogs_Adminhtml_ProductlogsController extends Mage_Adminhtml_Controller_Action
{
		protected function _isAllowed()
		{
		//return Mage::getSingleton('admin/session')->isAllowed('productlogs/productlogs');
			return true;
		}

		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("productlogs/productlogs")->_addBreadcrumb(Mage::helper("adminhtml")->__("Productlogs Manager"),Mage::helper("adminhtml")->__("Product Logs Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Product Logs"));
			    $this->_title($this->__("Manager Productlogs"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Product Logs"));
				$this->_title($this->__("Product Logs"));
			    $this->_title($this->__("Edit Log"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("productlogs/productlogs")->load($id);
				if ($model->getId()) {
					Mage::register("productlogs_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("productlogs/productlogs");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Productlogs Manager"), Mage::helper("adminhtml")->__("Productlogs Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Productlogs Description"), Mage::helper("adminhtml")->__("Productlogs Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("productlogs/adminhtml_productlogs_edit"))->_addLeft($this->getLayout()->createBlock("productlogs/adminhtml_productlogs_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("productlogs")->__("Log does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Product Logs"));
		$this->_title($this->__("Product Logs"));
		$this->_title($this->__("New Log"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("productlogs/productlogs")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("productlogs_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("productlogs/productlogs");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Productlogs Manager"), Mage::helper("adminhtml")->__("Productlogs Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Productlogs Description"), Mage::helper("adminhtml")->__("Productlogs Description"));


		$this->_addContent($this->getLayout()->createBlock("productlogs/adminhtml_productlogs_edit"))->_addLeft($this->getLayout()->createBlock("productlogs/adminhtml_productlogs_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("productlogs/productlogs")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Productlogs was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setProductlogsData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setProductlogsData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("productlogs/productlogs");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Log was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("productlogs/productlogs");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Log(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'productlogs.csv';
			$grid       = $this->getLayout()->createBlock('productlogs/adminhtml_productlogs_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'productlogs.xml';
			$grid       = $this->getLayout()->createBlock('productlogs/adminhtml_productlogs_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
