<?php
include 'connect.php';

$id = mysqli_real_escape_string($connect, $_POST['id']);
$name = mysqli_real_escape_string($connect, $_POST['name']);
$description = mysqli_real_escape_string($connect, $_POST['description']);
$developer = mysqli_real_escape_string($connect, $_POST['developer_id']);
$category = mysqli_real_escape_string($connect, $_POST['category_id']);
$image = mysqli_real_escape_string($connect, $_POST['image']);

$update = "UPDATE games set name = '$name', description = '$description', developer_id = '$developer', category_id = '$category', image_url = '$image', updated_at = 'now()' where id = '$id'";

if (mysqli_query($connect, $update)) {
    ?><script>
            alert('<?php echo "Informações editadas com sucesso"; ?>');
            window.location.href = '../manager.php';
        </script><?php
    
    
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
                }
                mysqli_close($connect);
    
    
                    ?>