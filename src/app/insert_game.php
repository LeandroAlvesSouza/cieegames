<?php
session_start();
include 'connect.php';


$name = mysqli_real_escape_string($connect, $_POST['name']);
$description = mysqli_real_escape_string($connect, $_POST['description']);
$developer = mysqli_real_escape_string($connect, $_POST['developer_id']);
$category = mysqli_real_escape_string($connect, $_POST['category_id']);
$image = mysqli_real_escape_string($connect, $_POST['image']);
$date = mysqli_real_escape_string($connect, $_POST['date']);


$valid = "SELECT name from games where name = '$name' and deleted_at is null";
$valid_result = mysqli_query($connect, $valid);


if (mysqli_num_rows($valid_result) > 0) {
?><script>
        alert('<?php echo "Já existe uma jogo com esse nome cadastrado"; ?>');
        window.location.href = '../manager.php';
    </script><?php
            } else {
                $insert = "INSERT INTO games (name, description, developer_id, category_id, image_url, created_at) values ('$name', '$description', '$developer', '$category', '$image', '$date');";

                if (mysqli_query($connect, $insert)) {
                ?><script>
            alert('<?php echo "Jogo cadastrado com sucesso"; ?>');
            window.location.href = '../manager.php';
        </script><?php


                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
                }
                mysqli_close($connect);
            }

                    ?>