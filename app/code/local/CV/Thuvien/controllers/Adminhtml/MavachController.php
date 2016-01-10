<?php
class  CV_Thuvien_Adminhtml_MavachController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction() {
        $this->loadLayout()
             ->renderLayout();
	}

    public function genarateAction()
    {
        $text = $this->getRequest()->getParam('text');
        echo "<img src='".Mage::getUrl('thuvien/mavach/genarate',array('text'=>$text))."' />";
        return;
    }

    public function processAction()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mavachtacpham.doc");
        echo "<html>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        echo "<style>body{font-size: 10pt;font-family: arial;}</style>";
        echo "<body>";
        $data = $this->getRequest()->getParams();
        $fromMv = 0;
        $toMv = 0;
        if (isset($data['mv_from']) && intval($data['mv_from'])>0) {
            $fromMv = intval($data['mv_from']) ;
        }

        if (isset($data['mv_to']) && intval($data['mv_to'])>0) {
            $toMv = intval($data['mv_to']) ;
        }
        $mvArr = array();
        if ($fromMv >0) {
            if ($toMv>$fromMv) {
                for($i=$fromMv;$i<=$toMv; $i++) {
                    $mvArr[] = $i;
                }
            }
            else {
                $mvArr[] = $fromMv;
            }
        }
        $i =0;
        echo "<table style='border:3px solid white'>";
        $isopen = true;
        for($j=0; $j<count($mvArr); $j++) {
            if($i%2==0) {
                echo "<tr>";
                $isopen = true;
            }
            $i++;
            echo "<td style='padding: 15px;'><p align='center' style='margin:0px; font-size:10pt'>THƯ VIỆN ĐCV BÙI CHU</p>";
            //echo '<img src="'.Mage::getUrl('thuvien/mavach/genarate',array('text'=>Mage::helper('thuvien')->getMaTpPopShow($mvArr[$j]))).'" style="margin:0px;"/>';
            
            echo "</td>";
            if($i%2==0) {
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
        die();
    }
}



