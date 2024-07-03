<?php
    class Image {
        
        public function imageToBase64($img){
            $imgToStr = file_get_contents($img);
            $strTo64 = base64_encode($imgToStr);
            return $strTo64;
        }

    }
    $exportedImage = var_export(new Image(), true);
?>