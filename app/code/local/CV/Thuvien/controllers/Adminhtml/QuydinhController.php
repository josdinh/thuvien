<?php
class  CV_Thuvien_Adminhtml_QuydinhController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('vanphong')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Quy định Thư Viện'), Mage::helper('adminhtml')->__('Quy định Thư Viện'));
		return $this;
	}
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

    public function editAction() {

        $id     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('thuvien/tvquydinh')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('quydinh_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('vanphong');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Quy định Thự Viện'), Mage::helper('adminhtml')->__('Quy định Thự Viện'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Quy định Thự Viện mới'), Mage::helper('adminhtml')->__('Quy định Thự Viện mới'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('thuvien/adminhtml_quydinh_edit'))
                ->_addLeft($this->getLayout()->createBlock('thuvien/adminhtml_quydinh_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('thuvien')->__('Quy định thư viện không tồn tại'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');

    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('thuvien/tvquydinh');
            $model->setData($data)
                  ->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());

                    if($model->getStatus()==2)
                    {
                        $model->setActiveDate(now());
                        $domain = $model->getMagentoUrl();
                        $extension =  $model->getExtension();
                        $rendkey = 	Mage::helper('thuvien')->getKey($extension,$domain);
                        $model->setKeyActive($rendkey);
                    }
                    else
                        $model->setKeyActive("");


                } else {
                    $model->setUpdateTime(now());
                }

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('thuvien')->__('Các quy định của thư viện đã được lưu trữ thành công.'));
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
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('thuvien')->__('Không lưu được quy định thư viện.'));
        $this->_redirect('*/*/');
    }

   /* public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('thuvien/docgia');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Độc giả đã được xóa thành công'));
                $this->_redirect('**');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('**edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('**');
    }*/

    /*public function massDeleteAction() {
        $docgiaIds = $this->getRequest()->getParam('docgia');
        if(!is_array($docgiaIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Vui lòng chọn Độc giả'));
        } else {
            try {
                foreach ($docgiaIds as $docgiaid) {
                    $docgia = Mage::getModel('thuvien/docgia')->load($docgiaid);
                    $docgia->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Có %d Độc giả đã được xóa thành công', count($docgiaIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('**index');
    }*/



    public function exportCsvAction()
    {
        $fileName   = 'quydinhthuvien.csv';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_quydinh_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'quydinhthuvien.xml';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_quydinh_grid')
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



