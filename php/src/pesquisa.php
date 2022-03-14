<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> 

   
  </head>
  <body>

  <?php
   
      $pesquisa = $_POST['busca'] ?? '';

    include "conexao.php";

    $sql = "SELECT * FROM pessoas WHERE nome LIKE'%$pesquisa%'";

    $dados = mysqli_query($conn, $sql);

   ?>

    <div class="container">
        <div class="row">
            <div class="col">
             <h1>Pesquisar</h1>
             <nav class="navbar navbar-light bg-light">
              <div class="container-fluid">
               <form class="d-flex" action='pesquisa.php' method="POST">
                  <input class="form-control me-2" type="search" placeholder="Nome" aria-label="Search" name="busca" autofocus>
                  <button class="btn btn-outline-success" type="submit">Pesquisar</button>
               </form>
              </div>
             </nav>

             <table class="table table-hover">
             <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Endereço</th>
                      <th scope="col">Telefone</th>
                      <th scope="col">Email</th>
                      <th scope="col">Data de Nascimento</th>
                      <th scope="col">Funções</th>
                    </tr>
             </thead>
                <tbody>

                <?php

                    while ($linha = mysqli_fetch_assoc($dados) ) {
                      $cod_pessoa = $linha['cod_pessoa'];
                      $nome = $linha['nome'];
                      $endereco = $linha['endereco'];
                      $telefone = $linha['telefone'];
                      $email = $linha['email'];
                      $data_nascimento = $linha['data_nascimento'];
                      $data_nascimento = mostra_data($data_nascimento);

                      echo "<tr>
                              <th scope='row'>$nome</th>
                              <td>$endereco</td>
                              <td>$telefone</td>
                              <td>$email</td>
                              <td>$data_nascimento</td>
                              <td width=150px>
                                  <a href='cadastro_edit.php?id=$cod_pessoa' class='btn btn-success btn-sm'>Editar</a>
                                  <a href='#' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#confirma'
                                  onclick=" .'"' ."pegar_dados($cod_pessoa, '$nome')" .'"' .">Excluir</a>
                              </td>
                          </tr>";
                      }
                  ?>
                              <!-- onclick="pegar_dados($id, '$nome')" O SEGREDO ESTÁ AQUI! SERÁ? -->
                    
                </tbody>
             </table>

             <a href="index.php" class="btn btn-info">Voltar para o início</a>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="excluir_script.php" method="POST">
           <p>Deseja realmente excluir <b id="nome_pessoa">Nome da pessoa</b>?</p> 
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
              <input type="hidden" name="nome" id="nome_pessoa_1" value="">
              <input type="hidden" name="id" id="cod_pessoa" value="">
              <input type="submit" class="btn btn-danger"value="Sim">
            </form>
          </div>
        </div>
      </div>
    </div>
    

    <script type="text/javascript">
      function pegar_dados(id, nome) {
        document.getElementById('nome_pessoa').innerHTML = nome;
        document.getElementById('nome_pessoa_1').value = nome;
        document.getElementById('cod_pessoa').value = id;
      }
    </script>                  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>