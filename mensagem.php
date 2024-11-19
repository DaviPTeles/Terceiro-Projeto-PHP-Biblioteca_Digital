<?php
    if(isset($_SESSION['mensagem'])):
?>
    <?= $_SESSION['mensagem']; ?>
<?php
    unset($_SESSION["mensagem"]);
    endif;
?>