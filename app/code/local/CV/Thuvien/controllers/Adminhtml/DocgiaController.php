<?php
class  CV_Thuvien_Adminhtml_DocgiaController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('thuvien/docgia')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Quản lý Độc Giả'), Mage::helper('adminhtml')->__('Quản lý Độc Giả'));
		return $this;
	}
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

    public function editAction() {

        $id     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('thuvien/docgia')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('docgia_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('thuvien/docgia');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Quản lý Đọc giả'), Mage::helper('adminhtml')->__('Quản lý Đọc giả'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Đọc giả mới'), Mage::helper('adminhtml')->__('Đọc giả'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit'))
                ->_addLeft($this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('thuvien')->__('Đọc giả này không tồn tại'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');

    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
            if(isset($_FILES['Hinh']['name']) && $_FILES['Hinh']['name'] != '') {
                try {

                    /* Starting upload */
                    $uploader = new Varien_File_Uploader('Hinh');

                    // Any extention would work
                    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                    $uploader->setAllowRenameFiles(false);

                    // Set the file upload mode
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders
                    //	(file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);

                    // We set media as the upload dir
                    $path = Mage::getBaseDir('media') . DS .'docgia'.DS;
                    $uploader->save($path, $_FILES['Hinh']['name'] );

                } catch (Exception $e) {

                }

                //this way the name is saved in DB
                $data['Hinh'] = 'docgia/'.$_FILES['Hinh']['name'];
            }
            else {
                unset( $data['Hinh'] );
            }

            $model = Mage::getModel('thuvien/docgia');
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
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('thuvien')->__('Thông tin Độc giả đã được lưu thành công.'));
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
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('thuvien')->__('Không tìm thấy độc giả để lưu.'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('thuvien/docgia');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Độc giả đã được xóa thành công'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
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
        $this->_redirect('*/*/index');
    }



    public function exportCsvAction()
    {
        $fileName   = 'danhsachdocgia.csv';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_docgia_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'danhsachdocgia.xml';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_docgia_grid')
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

    public function addLePhiAction()
    {
        $data = $this->getRequest()->getParams();
        $resultArr = array();

        if ( isset($data['MaDocGia']) &&  intval($data['MaDocGia']) >0)       {
                if ($data['NgayNhap']){
                   $data['NgayNhap'] = date("Y-m-d",strtotime($data['NgayNhap'])) ;
                }
                if ($data['HetHan']){
                    $data['HetHan'] = date("Y-m-d",strtotime($data['HetHan'])) ;
                }
                $lephiDocgia = Mage::getModel('thuvien/lephi');
                if(!Mage::registry('MaDocGia_Lephi')){
                    Mage::register('MaDocGia_Lephi', $data['MaDocGia']);
                }
                $lephiDocgia->setData($data)->save();
                $resultArr['success'] = 1;
                $resultArr['message'] = "Thêm lệ phí thành công!";
                $resultArr['content'] = $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_lephi_grid')->toHtml();
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resultArr));
                return;
        }
        $resultArr['success'] = 0;
        $resultArr['message'] = "Vui lòng chọn tác giả cần thêm lệ phí!";
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resultArr));
        return;
    }

    public function deleteLePhiAction()
    {
        $data = $this->getRequest()->getParams();
        $resultArr = array();
        if ( isset($data['MaDocGia']) &&  intval($data['MaDocGia']) >0 && isset($data['MaTaichanh']) &&  intval($data['MaTaichanh']) >0)       {
            $lephiDocgia = Mage::getModel('thuvien/lephi')->load($data['MaTaichanh']);
            if ($lephiDocgia->getData('MaTaichanh')) {
                $lephiDocgia->delete();
            }
            if(!Mage::registry('MaDocGia_Lephi')){
                Mage::register('MaDocGia_Lephi', $data['MaDocGia']);
            }
            $resultArr['success'] = 1;
            $resultArr['message'] = "Xóa lệ phí thành công!";
            $resultArr['content'] = $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_lephi_grid')->toHtml();
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resultArr));
            return;
        }
        $resultArr['success'] = 0;
        $resultArr['message'] = "Vui lòng chọn tác giả cần xóa lệ phí!";
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resultArr));
        return;
    }


}



