<?php
echo $this->element(FRONTOFFICE.DS.'msg_flash'.DS.'message_flash.php');
?>
</br>
<?php
header("Content-Type: text/html; charset=UTF-8");
echo $content_for_layout;
?>
