
<?php 
if(array_key_exists('id', $_GET)){
$data['users']->userUpdateForm($_GET['id']);	
}else{
$data['users']->userUpdateForm();	
}
 ?>
