<?php
class  CV_Thuvien_Adminhtml_TacphamcomController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('thuvien')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Quản lý tác phẩm'), Mage::helper('adminhtml')->__('Quản lý tác phẩm'));
		return $this;
	}
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

    public function editAction() {

        $id     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('thuvien/tpcom')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('tpcom_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('thuvien');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Quản lý Tác Phẩm'), Mage::helper('adminhtml')->__('Quản lý Tác Phẩm'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Tác Phẩm mới'), Mage::helper('adminhtml')->__('Tác Phẩm'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('thuvien/adminhtml_tacphamcom_edit'))
                ->_addLeft($this->getLayout()->createBlock('thuvien/adminhtml_tacphamcom_edit_tabs'));

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
           Mage::log($data);

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
                    $path = Mage::getBaseDir('media') . DS .'tacpham'.DS.'hinhanh'.DS;
                    $uploader->save($path, $_FILES['Hinh']['name'] );

                } catch (Exception $e) {

                }

                //this way the name is saved in DB
                $data['Hinh'] = 'tacpham/hinhanh/'.$_FILES['Hinh']['name'];
            }
            else {
                unset( $data['Hinh'] );
            }

            if(isset($_FILES['BanMem']['name']) && $_FILES['BanMem']['name'] != '') {
                try {

                    /* Starting upload */
                    $uploader = new Varien_File_Uploader('BanMem');

                    // Any extention would work
                    $uploader->setAllowedExtensions(array('docx','doc','pdf','xls','xlsx'));
                    $uploader->setAllowRenameFiles(false);

                    // Set the file upload mode
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders
                    //	(file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);

                    // We set media as the upload dir
                    $path = Mage::getBaseDir('media') . DS .'tacpham'.DS.'banmem'.DS;
                    $uploader->save($path, $_FILES['BanMem']['name'] );

                } catch (Exception $e) {

                }

                //this way the name is saved in DB
                $data['BanMem'] = 'tacpham/banmem/'.$_FILES['BanMem']['name'];
            }
            else {
                unset( $data['BanMem'] );
            }



            $model = Mage::getModel('thuvien/tpcom');
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
                //save dichgia to listtacgia
                if(isset($data['tacgiakhac_ids'])) {
                    $tacgiakhac = Mage::helper('adminhtml/js')->decodeGridSerializedInput($data['tacgiakhac_ids']);
                    $tmpTacgia = Mage::getModel('thuvien/tmptacgia')->getCollection()->addFieldToFilter('MaTpCom',$model->getData('MaTpCom'));
                    if ($tmpTacgia->getSize())
                    {
                        foreach($tmpTacgia as $row)
                        {
                            $row->delete();
                        }
                    }

                    if (count($tacgiakhac)) {
                        foreach ($tacgiakhac as $key => $value) {
                            if ($key != $data['MaKyHieuTg']) {
                                Mage::getModel('thuvien/tmptacgia')->setData('MaTpCom', $model->getData('MaTpCom'))->setData('MaListTG', $key)->save();
                            }
                        }
                    }
                }

                // save tacgia to listdichgia
                if(isset($data['tacgiakhac_ids'])) {
                    $dichgia = Mage::helper('adminhtml/js')->decodeGridSerializedInput($data['dichgia_ids']);
                    $tmpdichgia = Mage::getModel('thuvien/tmpdichgia')->getCollection()->addFieldToFilter('MaTpCom',$model->getData('MaTpCom'));
                    if ($tmpdichgia->getSize())
                    {
                        foreach($tmpdichgia as $row)
                        {
                            $row->delete();
                        }
                    }

                    if (count($dichgia)) {
                        foreach ($dichgia as $key => $value) {
                            Mage::getModel('thuvien/tmpdichgia')->setData('MaTpCom', $model->getData('MaTpCom'))->setData('MaListDG', $key)->save();
                        }
                    }
                }

                //save cungtacpham
                if (isset($data['cungtp_ids'])) {
                    $cungtacpham = Mage::helper('adminhtml/js')->decodeGridSerializedInput($data['cungtp_ids']);
                    $cungtp = Mage::getModel('thuvien/tppop')->getCollection()->addFieldToFilter('MaTpCom',$model->getData('MaTpCom'));
                    if ($cungtp->getSize()) {
                        foreach($cungtp as $row) {
                            $row->setData('MaTpCom',0)->save();
                        }
                    }

                    if (count($cungtacpham)) {
                        foreach ($cungtacpham as $key => $value) {
                            $tppopDetail = Mage::getModel('thuvien/tppop')->load($key);
                            $tppopDetail->setData('MaTpCom', $model->getData('MaTpCom'))->save();
                        }
                    }
                }


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

    public function tacgiakhacAction(){

        $this->loadLayout();
        $this->getLayout()->getBlock('tacpham.tacgiakhac.grid')
            ->setListTG($this->getRequest()->getPost('tgkhac', null));
        $this->renderLayout();
    }


    public function tacgiakhacGridAction(){

        $this->loadLayout();
        $this->getLayout()->getBlock('tacpham.tacgiakhac.grid')
            ->setListTG($this->getRequest()->getPost('tgkhac', null));
        $this->renderLayout();
    }

    // grid dich gia
    public function dichgiaAction(){

        $this->loadLayout();
        $this->getLayout()->getBlock('dichgia.grid')
            ->setListDichgia($this->getRequest()->getPost('dichgia', null));
        $this->renderLayout();
    }

    public function dichgiagridAction(){

        $this->loadLayout();
        $this->getLayout()->getBlock('dichgia.grid')
            ->setListDichgia($this->getRequest()->getPost('dichgia', null));
        $this->renderLayout();
    }


    // grid dich gia
    public function cungtpAction(){

        $this->loadLayout();
        $this->getLayout()->getBlock('cungtp.grid')
            ->setListCungtp($this->getRequest()->getPost('cungtp', null));
        $this->renderLayout();
    }

    public function cungtpgridAction(){
        $this->loadLayout();
        $this->getLayout()->getBlock('cungtp.grid')
            ->setListCungtp($this->getRequest()->getPost('cungtp', null));
        $this->renderLayout();
    }

    /**
     * articles grid in the catalog page
     * @access public
     * @return void
     *
     */


    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('thuvien/tpcom');

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
        $docgiaIds = $this->getRequest()->getParam('tpcom');
        if(!is_array($docgiaIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Vui lòng chọn tác phẩm'));
        } else {
            try {
                foreach ($docgiaIds as $docgiaid) {
                    $docgia = Mage::getModel('thuvien/tpcom')->load($docgiaid);
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
        $fileName   = 'tacphamcom.csv';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_tacphamcom_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'tacphamcom.xml';
        $content    = $this->getLayout()->createBlock('thuvien/adminhtml_tacphamcom_grid')
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



