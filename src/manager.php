<?php
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
    <title>Gerenciador - Games</title>
    <link rel="stylesheet" href="styles/index.css">

    <style>
        .modals {
            margin-top: 30px;
            padding: 10px;
        }

        .tabela-games {
            font-family: sans-serif;
            width: 95%;
            margin: auto;
            background-color: white;
            margin-top: 30px;
        }

        tr {
            border: solid 1px black;
            font-weight: bold;
        }

        th {
            border: solid 1px black;
            text-align: start;
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;

        }
    </style>

</head>

<body>
    <nav>
        <img src="images/logo.png" alt="Logotipo do sistema" />
        <ul>
            <li><a href="index.php">Página Inicial</a></li>
            <li><a href="#">Gerenciador</a></li>
            <li class="dropdown">
        <a href="index.php">Gêneros</a>
        <div class="dropdown-content">
          <?php
          $query = "SELECT description FROM category WHERE deleted_at IS NULL order by description";
          $result = mysqli_query($connect, $query);
          while ($generos = mysqli_fetch_assoc($result)) {
            $genre = $generos["description"];
            echo "<a href='#'>$genre</a>";
          }
            ?>
        </div>
      </li>
        </ul>
    </nav>

    <main>

        <div class="modals">
            <!---CADASTRO DE JOGOS--->
            <div class="new-game">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#cadastromodal">
                    Cadastrar novo jogo
                </button>

                <!-- Modal -->
                <div class="modal top fade" id="cadastromodal" tabindex="-1" data-mdb-backdrop="static" aria-labelledby="exampcadastromodal" aria-hidden="true" data-mdb-keyboard="false">
                    <div class="modal-dialog modal-xl ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cadastro de novo jogo</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">


                                <form method="POST" action="app/insert_game.php">
                                    <fIeldset>

                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form">
                                                    <label class="form-label" for="form6Example1">Titulo do jogo</label>
                                                    <input type="text" name="name" id="form6Example1" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form">
                                                    <label class="form-label" for="form6Example2">Data de lançamento</label>
                                                    <input type="date" name="date" id="date" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form">
                                            <label for="floatingSelect">Gênero</label>
                                            <select class="form-select" name="category_id" id="floatingSelect" aria-label="Floating label select example">
                                                <?php
                                                $select2 = "select id, description from category where deleted_at is null";
                                                $category = mysqli_query($connect, $select2);
                                                while ($generos = mysqli_fetch_array($category)) { ?>
                                                    <option value="<?php echo $generos['id'] ?>"><?php echo $generos["description"] ?></option>

                                                <?php } ?>

                                            </select>

                                        </div>



                                        <div class="form">
                                            <label for="floatingSelect">Desenvolvedora</label>
                                            <select class="form-select" name="developer_id" id="floatingSelect" aria-label="Floating label select example">
                                                <?php
                                                $select3 = "select id, description from developers where deleted_at is null";
                                                $developer = mysqli_query($connect, $select3);
                                                while ($dev = mysqli_fetch_array($developer)) { ?>
                                                    <option value="<?php echo $dev['id'] ?>"><?php echo $dev["description"] ?></option>

                                                <?php } ?>

                                            </select>



                                            <div class="form mb-4">
                                                <label class="form-label" for="form6Example7">Descrição</label>
                                                <textarea class="form-control" name="description" id="form6Example7" rows="6"></textarea>
                                            </div>

                                            <div class="form mb-4">
                                                <label class="form-label" for="form6Example5">Imagem</label>
                                                <input type="text" placeholder="Colar URL da imagem" name="image" id="form6Example5" class="form-control" />
                                            </div>


                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-success btn-block mb-4">Salvar</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!---CADASTRO DE GêNERO--->
            <div class="new-category">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-mdb-toggle="modal" data-mdb-target="#modalgenero">
                    Cadastrar Gênero
                </button>

                <!-- Modal -->
                <div class="modal top fade" id="modalgenero" tabindex="-1" aria-labelledby="modalgenero" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
                    <div class="modal-dialog  ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalgenero">Cadastro de gênero</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" action="app/insert_category.php">

                                    <div class="form-outline mb-4">
                                        <input type="text" name="category_description" id="form4Example1" class="form-control" />
                                        <label class="form-label" for="form4Example1">Digite o gênero a ser cadastrado:</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Salvar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CADASTRO DE DESENVOLVEDORA -->
            <div class="new-dev">
                <button type="button" class="btn btn-info" data-mdb-toggle="modal" data-mdb-target="#devmodal">
                    Cadastrar desenvolvedora
                </button>

                <!-- Modal -->
                <div class="modal top fade" id="devmodal" tabindex="-1" aria-labelledby="devmodal" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
                    <div class="modal-dialog  ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="devmodal">Cadastro de desenvolvedora</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="app/insert_developer.php">

                                    <div class="form-outline mb-4">
                                        <input type="text" name="dev_description" id="form4Example1" class="form-control" />
                                        <label class="form-label" for="form4Example1">Nome:</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Salvar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <!-- Modal de EDITAR JOGO -->
        <div class="edit-game">


            <div class="modal fade" id="exampleModal" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> >
                <div class="modal-dialog modal-xl ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar jogo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">



                            <form method="POST" action="app/edit-game.php">
                                <fIeldset>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form">
                                                <label class="form-label" for="form6Example1">Titulo do jogo</label>
                                                <input type="text" name="name" id="name" class="form-control" required />
                                                <input type="hidden" name="id" id="id" value="">
                                            </div>
                                        </div>
                                        <div class="col">

                                        </div>

                                        <div class="form">
                                            <label for="floatingSelect">Gênero</label>
                                            <select class="form-select" name="category_id" id="category" aria-label="Floating label select example">
                                                <?php
                                                $select2 = "select id, description from category where deleted_at is null order by description";
                                                $category = mysqli_query($connect, $select2);
                                                while ($generos = mysqli_fetch_array($category)) { ?>
                                                    <option value="<?php echo $generos['id'] ?>"><?php echo $generos["description"] ?></option>

                                                <?php } ?>

                                            </select>

                                        </div>



                                        <div class="form">
                                            <label for="floatingSelect">Desenvolvedora</label>
                                            <select class="form-select" name="developer_id" id="developer" aria-label="Floating label select example">
                                                <?php
                                                $select3 = "select id, description from developers where deleted_at is null order by description";
                                                $developer = mysqli_query($connect, $select3);
                                                while ($dev = mysqli_fetch_array($developer)) { ?>
                                                    <option value="<?php echo $dev['id'] ?>"><?php echo $dev["description"] ?></option>

                                                <?php } ?>

                                            </select>



                                            <div class="form mb-4">
                                                <label class="form-label" for="form6Example7">Descrição</label>
                                                <textarea class="form-control" name="description" id="description" rows="6"></textarea>
                                            </div>

                                            <div class="form mb-4">
                                                <label class="form-label" for="form6Example5">Imagem</label>
                                                <input type="text" placeholder="Colar URL da imagem" name="image" id="image" class="form-control" />
                                            </div>


                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-primary btn-block mb-4">Salvar</button>
                                        </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>



        </div>

        <!-- TABELA -->
        <div class="tabela-games">
            <table class="table table-sm table-striped table-hover">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descrição</th>
                        <th>Gênero</th>
                        <th>Desenvolvedora</th>
                        <th>Data de Lançamento</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $querygames = "SELECT games.id, games.name, games.description, games.image_url, DATE_FORMAT(games.created_at, '%d/%m/%Y') as 'created_at', category.id as 'category_id', dev.description as 'devdescription', category.description as 'categorydescription', dev.id as 'dev_id' FROM games left join developers dev on games.developer_id = dev.id left join category on games.category_id = category.id where games.deleted_at is null order by games.created_at desc";
                    $games = mysqli_query($connect, $querygames);
                    while ($game_data = mysqli_fetch_assoc($games)) {

                        echo "<tr>";
                        echo "<td>" . $game_data["name"] . "</td>";
                        echo "<td>" . $game_data["description"] . "</td>";
                        echo "<td>" . $game_data["categorydescription"] . "</td>";
                        echo "<td>" . $game_data["devdescription"] . "</td>";
                        echo "<td>" . $game_data["created_at"] . "</td>";
                    ?>

                        <!-- Botão de Edit--->
                        <td> <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?php echo $game_data['name'] ?>" data-bs-whateverdescription="<?php echo $game_data['description'] ?>" data-bs-whateverdevdescription="<?php echo $game_data['dev_id'] ?>" data-bs-whateverid="<?php echo $game_data['id'] ?>" data-bs-whatevercategory="<?php echo $game_data['category_id'] ?>" data-bs-whateverimage="<?php echo $game_data['image_url'] ?>">



                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z' />
                                </svg>
                            </button>
                        </td>




                        <!-- Botão de delete--->
                        <td>
                            <a class='btn btn-sm btn-danger' onclick="return confirm('Tem certeza?')" href='app/delete_game.php?id=<?php echo $game_data['id']; ?>' ;>


                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                                </svg>
                            </a>
                        </td>
                    <?php
                    }
                    ?>








                </tbody>




            </table>
    </main>






</body>

<script>
    const exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const name = button.getAttribute('data-bs-whatever')
        const description = button.getAttribute('data-bs-whateverdescription')
        const category = button.getAttribute('data-bs-whatevercategory')
        const developer = button.getAttribute('data-bs-whateverdevdescription')
        const image = button.getAttribute('data-bs-whateverimage')
        const id = button.getAttribute('data-bs-whateverid')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        const modalTitle = exampleModal.querySelector('.modal-title')
        const modalBodyInputname = exampleModal.querySelector('#name')
        const modalBodyInputdescription = exampleModal.querySelector('#description')
        const modalBodyInputcategory = exampleModal.querySelector('#category')
        const modalBodyInputdeveloper = exampleModal.querySelector('#developer')
        const modalBodyInputid = exampleModal.querySelector('#id')
        const modalBodyInputimage = exampleModal.querySelector('#image')


        modalTitle.textContent = ` Editar Jogo: ${name}`
        modalBodyInputname.value = name
        modalBodyInputdescription.value = description
        modalBodyInputcategory.value = category
        modalBodyInputdeveloper.value = developer
        modalBodyInputid.value = id
        modalBodyInputimage.value = image

    })
</script>