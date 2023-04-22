<?php
session_start();
include 'connect.php';

$description = mysqli_real_escape_string($connect, $_POST['dev_description']);

$valid = "SELECT * FROM developers WHERE description = '$description' and deleted_at is null";
$valid_result = mysqli_query($connect, $valid);

if(mysqli_num_rows($valid_result) > 0) {
    ?><script>
    alert('<?php echo "Já existe uma desenvolvedora com essa descrição"; ?>');
    window.location.href='../manager.php';
    </script><?php
} else {
    $insert = "INSERT INTO developers (description, created_at) values ('$description', now())";
    if(mysqli_query($connect, $insert)){
        ?><script>
        alert('<?php echo "Desenvolvedora cadastrada com sucesso"; ?>');
        window.location.href='../manager.php';
        </script><?php
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}

mysqli_close($connect);