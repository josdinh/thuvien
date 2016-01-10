<?php
include "Barcode39.php";
class CV_Thuvien_MavachController extends Mage_Core_Controller_Front_Action
{
  public function test($text)
  {
      $bc = new Barcode39($text);
      $string = "D:\\xampp\\htdocs\\thuviengit\\skin\\frontend\\rwd\\thuvien\\images\\".$text.".jpg";
      $bc->draw($string);
      return;
  }

  public function wordAction()
  {
      header("Content-type: application/vnd.ms-word");
      header("Content-Disposition: attachment;Filename=document_name.doc");
      echo "<html>";
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
      echo "<body>";
      $text = array("617BC0000003","617BC0000004","617BC0000005","617BC0000006","617BC0000007","617BC0000008");
      $i =0;
      echo "<table>";
      $isopen = true;
      foreach ($text as $image) {
          if($i%3==0) {
              echo "<tr>";
              $isopen = true;
          }
          $i++;
          echo "<td><p align='center'>THƯ VIỆN ĐCV BÙI CHU</p>";
          $this->test($image);
          echo '<img src="'.Mage::getUrl('thuvien/mavach/genarate',array('text'=>'617BC0000123')).'"/>';
          echo "</td>";
          if($i%3==0) {
              echo "</tr>";
              $isopen = false;
          }
      }
      if($isopen) {
          echo "</tr>";
      }
      echo "</table>";
      echo "</body>";
      echo "</html>";
  }

    public function genarateAction()
    {
        $text = $this->getRequest()->getParam('text');
        $bc = new Barcode39($text);
        $bc->draw();
        return;
    }

    public  function indexAction()
    {
        $text = $this->getRequest()->getParam('text');
        echo "<img src='".Mage::getUrl('thuvien/mavach/genarate',array('text'=>$text))."' />";
        return;

    }

    public function pdfAction()
    {
        ini_set("default_charset", 'utf-8');
        $pdf = new Zend_Pdf();
        $page = new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);

        $page->setFont(Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA), 12);

        $page->drawText("THƯ VIỆN ĐCV BÙI CHU",80,800,'UTF-8');

        $fontPath = Mage::getBaseDir()."/lib/LinLibertineFont/fre3of9x.ttf";
        $page->setFont(Zend_Pdf_Font::fontWithPath($fontPath), 36);
        $barcodeImage = "617BC0007385";
        $page->drawText($barcodeImage,50,765);

        $page->setFont(Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA), 12);
        $page->drawText("*617BC0007385*", 100, 750);

        $pdf->pages[] = $page;

        $content =  $pdf->render();
        $fileName = 'details.pdf';
        $this->_prepareDownloadResponse($fileName, $content);



    }


}