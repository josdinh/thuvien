<?php
class  CV_Thuvien_Adminhtml_KhosachController extends Mage_Adminhtml_Controller_Action
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
        $model  = Mage::getModel('thuvien/khosach')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('khosach_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('vanphong');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Kho sách'), Mage::helper('adminhtml')->__('Kho sách'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Kho sách'), Mage::helper('adminhtml')->__('Kho sách mới'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('thuvien/adminhtml_khosach_edit'))
                ->_addLeft($this->getLayout()->createBlock('thuvien/adminhtml_khosach_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('thuvien')->__('Không tồn tại kho sách'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');

    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('thuvien/khosach');
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
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('thuvien')->__('Thông tin kho sách đã được lưu trữ thành công.'));
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
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('thuvien')->__('Không lưu được thông tin kho sách.'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('thuvien/khosach');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Kho sách đã được xóa thành công'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $theloaiIds = $this->getRequest()->getParam('khosach');
        if(!is_array($theloaiIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Vui lòng chọn kho sách'));
        } else {
            try {
                foreach ($theloaiIds as $theloaiid) {
                    $theloai = Mage::getModel('thuvien/khosach')->load($theloaiid);
                    $theloai->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Có %d kho sách đã được xóa thành công', count($theloaiIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

    public function exportCsvAction()
    {
        $fileName   = 'khosach.csv';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_khosach_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'khosach.xml';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_khosach_grid')
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



