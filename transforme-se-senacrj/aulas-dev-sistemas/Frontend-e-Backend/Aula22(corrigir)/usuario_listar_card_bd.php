<?php
    // <!-- Inclui o array que simula um BD -->
    require_once("config.php");

    function getfuncaoUsuario($funcao) {
        switch ($funcao) {
            case 1:
                return 'Usuário';
            case 2:
                return 'Gerente';
            case 3:
                return 'Administrador';
            default:
                return 'Desconhecido';
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lista de Usuários (Card)</title>
    <link rel="shortcut icon" href="img/art_logo.svg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Inclui o link para a fonte Roboto da Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <!-- Inclui estilos personalizados -->
    <link rel="stylesheet" href="style.css">

    <!-- Carregar o Bootstrap JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Inclui o cabecalho dinamicamente -->
   <?php include_once("header.php"); ?>
   
    <div class="container mt-2">
        <?php
        // Verifica se há uma mensagem para exibir
        if (isset($_GET['mensagem'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    ' . $_GET['mensagem'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        ?>

        <!-- <h2>Lista de Usuários</h2> -->
        <div  class="container pt-1 mt-2 text-muted">
            <h4>Lista de Usuários</h4>
            <a href="usuario_cadastro.php" ><i class="bi bi-plus-circle"></i> Adicionar</a>
        </div>
        <!-- <div  class="container pt-1 mt-2 text-muted d-flex align-items-center justify-content-space-between">
            <div><h4>Lista de Usuários</h4></div>
            <div><a href="usuario_cadastro.php" ><i class="bi bi-plus-circle"></i> Adicionar</a></div>
        </div> -->
        <table class="table table-striped shadow-sm">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nome</th>
                    <th>email</th>
                    <th>Data Cadastro</th>
                    <th>Situação</th>
                    <th>Função</th>
                    <th>foto</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 // Acessa o array de USUÁRIOS na SESSÃO (simula uma tabela de BD)
                 //$usuarios = $_SESSION['usuariosBD']; 
                 
               $sql = "SELECT * FROM usuarios";
               $res = $conn->query($sql);
               $usuarios = $res->fetch_all(MYSQLI_ASSOC);

                    var_dump($usuario);


                    // Exibe os dados na tabela
                    foreach ($usuarios as $index => $usuario) {
                     echo "<tr>
                        <td>{$usuario['id']}</td>
                        <td>{$usuario['nome']}</td>
                        <td>{$usuario['email']}</td>
                        <td>{$usuario['dtcadastro']}</td>
                        <td>" . ($usuario['situacao'] == '1' ? 'Ativo' : 'Inativo') . "</td>
                        <td>" . getfuncaoUsuario($usuario['funcao']) . "</td>
                        <td><img src='{$usuario['foto']}' alt='foto' style='width: 50px; height: 50px;'></td>
                        <td>
                            <a href='usuario_editar.php?acao=visualizar&id=" . $usuario['id'] . "' class='btn btn-info btn-sm'>
                                <i class='bi bi-eye'></i> Ver
                            </a>
                            <a href='usuario_editar.php?acao=editar&id=" . $usuario['id'] . "' class='btn btn-warning btn-sm'>
                                <i class='bi bi-pencil'></i> Editar
                            </a>
                            <a href='usuario_bd.php?acao=excluir&id=" . $usuario['id'] . "' class='btn btn-danger btn-sm'
                            onclick=' return confirm(\"Tem certeza que deseja excluir este usuário?\")'>
                             <i class='bi bi-trash'></i> Excluir
                         </a>
                        </td>
                     </tr>";
                    }
                ?>
            </tbody>
        </table>
        <!-- justify-content-center align-items-center g-2 -->
                    
        <div class="row ">

            <!-- Acessa o array de USUÁRIOS na SESSÃO (simula uma tabela de BD) -->
             
        
            <?php foreach ($usuarios as $index => $usuario): ?> 
            
                <div class="col-md-3 m-1 ">
                    <div class="card" style="width: 18rem; ">
                    <img src= <?= $usuario['foto'] ?> class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"> <?= $usuario['nome'] ?> </h5>
                            <p class="card-text"> <?=  $usuario['email'] ?> </p>
                            <a href="usuario_editar.php?acao=visualizar&id= <?= $usuario['id'] ?> " class="btn btn-sm btn-primary bi bi-eye"> Ver</a>
                            <a href="usuario_editar.php?acao=editar&id= <?= $usuario['id'] ?> " class="btn btn-sm btn-primary bi-pencil"> Editar</a>
                            <a href="usuario_bd.php?acao=excluir&id= <?= $usuario['id'] ?> " class="btn btn-sm btn-danger bi-trash" onclick= "return confirm('Tem certeza que deseja excluir este usuário?')"> Excluir</a>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>
                    
        
            <?php foreach ($usuarios as $index => $usuario): ?> 
            
                <div class="col-md-3">
                    <a href="usuario_editar.php?id= <?= $usuario['id'] ?> " class="">
                        <img src= <?= $usuario['foto'] ?> class="card-img-top shadow" alt="..." >
                    </a>
                </div>

            <?php endforeach ?>
            
        </div>



        
</div>            


    </div>

    <!-- Inclui o rodapé dinamicamente -->
    <?php include_once('footer.php'); ?>
</body>
</html>

<!-- Exemplo de PHP alternado ao HTML -->
<!-- <?php foreach ($usuarios as $index => $usuario): ?>
    <tr>
        <td><?= $index + 1 ?></td>
        <td><?= $usuario['nome'] ?></td>
        <td><?= $usuario['email'] ?></td>
        <td><?= $usuario['dtcadastro'] ?></td>
        <td><?= $usuario['situacao'] == '1' ? 'Ativo' : 'Inativo' ?></td>
        <td><?= getfuncaoUsuario($usuario['funcao']) ?></td>
        <td><img src="<?= $usuario['foto'] ?>" alt="foto" style="width: 50px; height: 50px;"></td>
        <td>
            <a href="usuario_editar.php?id=<?= $index + 1 ?>" class="btn btn-info btn-sm">
                <i class="bi bi-eye"></i> Ver
            </a>
            <a href="usuario_editar.php?id=<?= $index + 1 ?>" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <a href="usuario_bd.php?acao=excluir&id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i> Excluir
            </a>
        </td>
    </tr>
<?php endforeach; ?> -->
