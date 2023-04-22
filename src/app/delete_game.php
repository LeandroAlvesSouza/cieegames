<?php

include 'connect.php';

$id = $_GET['id'];
$valid = "SELECT id from games where id = '$id'";
$query = mysqli_query($connect, $valid);
$row = mysqli_num_rows($query);

if($row == 1){

    $delete = "UPDATE games set deleted_at = NOW() where id = $id";

    if(mysqli_query($connect, $delete)){

    

    ?><script>
    alert('<?php echo "Jogo deletado com sucesso!"; ?>');
    window.location.href='../manager.php';
    </script><?php
}else
{
    ?><script>
        alert('<?php echo "Falha ao deletar usuário"; ?>');
        window.location.href='../manager.php';
        </script><?php
}
}