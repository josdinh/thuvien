<?php
class  CV_Thuvien_Adminhtml_DanhsachController extends Mage_Adminhtml_Controller_Action
{

	public function  indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function generateAction()
    {

    }

    public function prindPdfAction()
    {
        $pdf = new Zend_Pdf();
        $page = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
        $page->setFont($font, 12);

        //add a logo
        $image = Mage::getBaseDir('media').'/logo_pdf.jpg';
        if (is_file($image)) {
            $image = Zend_Pdf_Image::imageWithPath($image);
            $x = 20;
            $y = 700;
            $page->drawImage($image, $x, $y, $x + 118, $y + 112);
        }

        //add text
        $page->setFont($font, 16);
        $titre = "Ecole ";
        $page->drawText($titre, 155, $page->getHeight()-85, "UTF-8");

        //add pages to main document
        $pdf->pages[] = $page;

        //generate pdf
        $content =  $pdf->render();

        $fileName = 'details.pdf';
        //send it to the browser to download
        $this->_prepareDownloadResponse($fileName, $content);
    }
}



