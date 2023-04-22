<?php
session_start();
include 'app/connect.php';
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
  <title>Games</title>
  <link rel="stylesheet" href="styles/index.css">
</head>

<body>

  <body>

    <nav>
      <img src="images/logo.png" alt="Logotipo do site" />
      <ul>
        <li><a href="index.php">Página Inicial</a></li>
        <li><a href="manager.php">Gerenciador</a></li>
        <li class="dropdown">
          <a href="index.php">Gêneros</a>
          <div class="dropdown-content">
            <?php
            $query = "SELECT description FROM category WHERE deleted_at IS NULL order by description";
            $result = mysqli_query($connect, $query);
            while ($generos = mysqli_fetch_assoc($result)) {
              $genre = $generos["description"];
              echo "<a href='javascript:void(0);' onclick='filterGames(\"$genre\")'>$genre</a>";
            }
            ?>
          </div>
        </li>
      </ul>
    </nav>

    <main>

      <div class="banner"><img src="images/banner.png" alt=""></div>

      <div class="game-list">

      </div>
    </main>

    <main>

      <div class="game-list">
        <ul class="game" id="game-list">

        </ul>
      </div>

    </main>

    <script>
      const dropdownLinks = document.querySelectorAll('.dropdown-content a');
      const gameList = document.getElementById('game-list');
      let selectedGenre = '';

      dropdownLinks.forEach(link => {
        link.addEventListener('click', () => {
          selectedGenre = link.innerText;
          updateGameList();
        });
      });

      function updateGameList() {
        fetch('http://localhost/games/cieegames/src/app/api.php')
          .then(response => response.json())
          .then(data => {
            gameList.innerHTML = '';

            data.forEach(game => {
              if (!selectedGenre || game.category_description === selectedGenre) {
                const li = document.createElement('li');
                const div = document.createElement('div');
                const img = document.createElement('img');
                const ul = document.createElement('ul');
                const nameLi = document.createElement('li');
                const catLi = document.createElement('li')
                const descLi = document.createElement('li');
                const devLi = document.createElement('li');
                const dateLi = document.createElement('li');

                img.src = game.image_url;
                nameLi.innerText = game.name;
                descLi.innerText = game.description;
                devLi.innerText = game.developerdescription;
                dateLi.innerText = game.created_at;
                catLi.innerText = game.category_description;

                div.appendChild(img);
                ul.appendChild(nameLi);
                ul.appendChild(catLi)
                ul.appendChild(descLi);
                ul.appendChild(devLi);
                ul.appendChild(dateLi);
                div.appendChild(ul);
                li.appendChild(div);
                gameList.appendChild(li);
              }
            });
          })
          .catch(error => {
            console.error('Erro ao buscar dados da API:', error);
          });
      }

      updateGameList();
    </script>

</html>