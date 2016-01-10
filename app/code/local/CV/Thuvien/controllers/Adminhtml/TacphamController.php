<?php
class  CV_Thuvien_Adminhtml_TacphamController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('tacpham')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Quản lý Tác phẩm'), Mage::helper('adminhtml')->__('Quản lý Tác phẩm'));
		return $this;
	}
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

    public function editAction() {

        $id     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('thuvien/tppop')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

            if (!empty($data)) {
                $model->setData($data);
            }
			/* Zend_debug::dump($model->getData()); */
            Mage::register('tppop_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('tacpham');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Quản lý Tác Phẩm'), Mage::helper('adminhtml')->__('Quản lý Tác Phẩm'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Tác Phẩm mới'), Mage::helper('adminhtml')->__('Tác Phẩm'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('thuvien/adminhtml_tacpham_edit'))
                ->_addLeft($this->getLayout()->createBlock('thuvien/adminhtml_tacpham_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('thuvien')->__('Tác Phẩm này không tồn tại'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->editAction();
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
            //Zend_debug::dump($data);die;



            $model = Mage::getModel('thuvien/tppop');
            $model->setData($data)
                  ->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());

                } else {
                    $model->setUpdateTime(now());
                }

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('thuvien')->__('Thông tin tác phẩm đã được lưu thành công.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('thuvien')->__('Không tìm thấy tác phẩm để lưu.'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('thuvien/tppop');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Tác Phẩm đã được xóa thành công'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $docgiaIds = $this->getRequest()->getParam('tppop');
        if(!is_array($docgiaIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Vui lòng chọn tác phẩm'));
        } else {
            try {
                foreach ($docgiaIds as $docgiaid) {
                    $docgia = Mage::getModel('thuvien/tppop')->load($docgiaid);
                    $docgia->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Có %d tác phẩm đã được xóa thành công', count($docgiaIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }



    public function exportCsvAction()
    {
        $fileName   = 'tacpham.csv';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_tacpham_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'tacpham.xml';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_tacpham_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }

}



