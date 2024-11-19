<?php
    if(isset($_SESSION['mensagem'])):
?>

<div>
    <?= $_SESSION['mensagem']; ?>
</div>

<?php
    unset($_SESSION["mensagem"]);
    endif;
?>