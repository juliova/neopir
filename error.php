<?php 
    if(isset($_SESSION['mensaje']) && isset($_SESSION['tipoerror'])){
        if($_SESSION['tipoerror'] != 0){
        ?>
            <div id="mensaje" class="rechazado">
                <p><?php echo $_SESSION['mensaje'] ?></p>
            </div>
        <?php
        } else {
        ?>
            <div id="mensaje" class="aprobado">
                <p><?php echo $_SESSION['mensaje'] ?></p>
            </div>
        <?php
        }
    }
    unset($_SESSION['mensaje']);
    unset($_SESSION['tipoerror']);
?>
