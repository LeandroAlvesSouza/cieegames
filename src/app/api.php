<?php

include 'connect.php';

$sql = "select games.name, games.description, games.image_url, DATE_FORMAT(games.created_at, '%d/%m/%Y') as 'created_at', category.description as 'category_description', developers.description as 'developerdescription' from games left join category on games.category_id = category.id left join developers on games.developer_id = developers.id where games.deleted_at is null order by games.created_at desc";

$result = $connect->query($sql);

$games = array();

if ($result->num_rows > 0) {
 
  while($row = $result->fetch_assoc()) {
    $game = array(
      'name' => $row['name'],
      'description' => $row['description'],
      'image_url' => $row['image_url'],
      'created_at' => $row['created_at'],
      'category_description' => $row['category_description'],
      'developerdescription' => $row['developerdescription']
    );
    array_push($games, $game);
  }
} else {
  echo "0 results";
}

$connect->close();

header('Content-Type: application/json');
echo json_encode($games);

?>