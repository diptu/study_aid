<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($this->session->has_userdata("type") && $this->session->userdata("type") == "faculty"){
?>

    <?php anchor("Faculty","".$classroom);?>




<?php
}
else{
  redirect("Login");
}

?>
