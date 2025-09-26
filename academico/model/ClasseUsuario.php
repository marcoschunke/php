<?php
class ClasseUsuario {
    private $codigo;
    private $nome;
    private $usuario;
    private $senha;
    private $permCreate;
    private $permRead;
    private $permUpdate;
    private $permDelete;

    // Construtor
    public function __construct($codigo = null, $nome = null, $usuario = null, $senha = null,
                                $permCreate = 0, $permRead = 0, $permUpdate = 0, $permDelete = 0) {
        $this->codigo     = $codigo;
        $this->nome       = $nome;
        $this->usuario    = $usuario;
        $this->senha      = $senha;
        $this->permCreate = $permCreate;
        $this->permRead   = $permRead;
        $this->permUpdate = $permUpdate;
        $this->permDelete = $permDelete;
    }

    // Getters e Setters
    public function getCodigo() {
        return $this->codigo;
    }
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getUsuario() {
        return $this->usuario;
    }
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getSenha() {
        return $this->senha;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getPermCreate() {
        return $this->permCreate;
    }
    public function setPermCreate($permCreate) {
        $this->permCreate = $permCreate;
    }

    public function getPermRead() {
        return $this->permRead;
    }
    public function setPermRead($permRead) {
        $this->permRead = $permRead;
    }

    public function getPermUpdate() {
        return $this->permUpdate;
    }
    public function setPermUpdate($permUpdate) {
        $this->permUpdate = $permUpdate;
    }

    public function getPermDelete() {
        return $this->permDelete;
    }
    public function setPermDelete($permDelete) {
        $this->permDelete = $permDelete;
    }

    // Método para cadastrar usuário
    public function cadastrarUsuario() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();

            $stmt = $pdo->prepare("
                INSERT INTO usuario (nome, usuario, senha, `create`, `read`, `update`, `delete`)
                VALUES (:nome, :usuario, :senha, :c, :r, :u, :d)
            ");

            $stmt->execute([
                ':nome'    => $this->nome,
                ':usuario' => $this->usuario,
                ':senha'   => $this->senha,
                ':c'       => $this->permCreate,
                ':r'       => $this->permRead,
                ':u'       => $this->permUpdate,
                ':d'       => $this->permDelete
            ]);

            echo '<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>';

        } catch (PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar: ' . $e->getMessage() . '</div>';
        }
    }

    // Método para listar usuários em HTML (tabela)
    public function listarUsuarios() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();

            $consulta = $pdo->prepare("
                SELECT codigo, nome, usuario, `create`, `read`, `update`, `delete`
                FROM usuario
                ORDER BY nome ASC
            ");
            $consulta->execute();

            echo '<div class="container section">';
            echo '<h4 class="center-align">Lista de Usuários</h4>';
            echo '<table class="highlight striped responsive-table z-depth-1">';
            echo '<thead class="blue lighten-4">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Create</th>
                        <th>Read</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead><tbody>';

            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($linha['codigo']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['nome']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['usuario']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['create']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['read']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['update']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['delete']) . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table></div>';

        } catch (PDOException $e) {
            echo '<div class="container section">
                    <div class="card-panel red lighten-4 red-text text-darken-4">
                        <i class="material-icons left">error</i>
                        Erro ao listar: ' . htmlspecialchars($e->getMessage()) . '
                    </div>
                </div>';
        }
    }

    public function listarUsuariosAcoes() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();
    
            $consulta = $pdo->prepare("
                SELECT codigo, nome, usuario, `create`, `read`, `update`, `delete`
                FROM usuario
                ORDER BY nome ASC
            ");
            $consulta->execute();
    
            echo '<div class="container section">';
            echo '<h4 class="center-align">Listar Usuários</h4>';
            echo '<table class="highlight striped responsive-table z-depth-1">';
            echo '<thead class="blue lighten-4">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Create</th>
                        <th>Read</th>
                        <th>Update</th>
                        <th>Delete</th>                        
                    </tr>
                </thead><tbody>';
    
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($linha['codigo']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['nome']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['usuario']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['create']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['read']) . '</td>';                    
                // Coluna de Ações
                echo '<td>';
                // Botão Editar
                echo '<a href="alterarUsuario.php?codigo=' . $linha['codigo'] . '" 
                          class="btn-small blue waves-effect waves-light">
                          <i class="material-icons">edit</i>
                      </a> ';
                echo '</td>';
                echo '<td>';
                // Botão Excluir
                echo '<a href="excluirUsuario.php?codigo=' . $linha['codigo'] . '" 
                          class="btn-small red waves-effect waves-light"
                          onclick="return confirm(\'Tem certeza que deseja excluir este usuário?\');">
                          <i class="material-icons">delete</i>
                      </a>';
                echo '</td>';
    
                echo '</tr>';
            }
    
            echo '</tbody></table></div>';
    
        } catch (PDOException $e) {
            echo '<div class="container section">
                    <div class="card-panel red lighten-4 red-text text-darken-4">
                        <i class="material-icons left">error</i>
                        Erro ao listar: ' . htmlspecialchars($e->getMessage()) . '
                    </div>
                </div>';
        }
    }

    // Método para atualizar usuário
    public function atualizarUsuario() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();

            $stmt = $pdo->prepare("
                UPDATE usuario 
                SET nome = :nome, 
                    usuario = :usuario, 
                    senha = :senha,
                    `create` = :c, 
                    `read`   = :r, 
                    `update` = :u, 
                    `delete` = :d
                WHERE codigo = :codigo
            ");

            $stmt->execute([
                ':nome'    => $this->nome,
                ':usuario' => $this->usuario,
                ':senha'   => $this->senha,
                ':c'       => $this->permCreate,
                ':r'       => $this->permRead,
                ':u'       => $this->permUpdate,
                ':d'       => $this->permDelete,
                ':codigo'  => $this->codigo
            ]);

            echo '<div class="card-panel green lighten-4 green-text text-darken-4">
                    <i class="material-icons left">check_circle</i>
                    Usuário atualizado com sucesso!
                    </div>';

        } catch (PDOException $e) {
            echo '<div class="card-panel red lighten-4 red-text text-darken-4">
                    <i class="material-icons left">error</i>
                    Erro ao atualizar: ' . htmlspecialchars($e->getMessage()) . '
                    </div>';
        }
    }

    // Método para excluir usuário
    public function excluirUsuario() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();

            $stmt = $pdo->prepare("DELETE FROM usuario WHERE codigo = :codigo");
            $stmt->execute([':codigo' => $this->codigo]);

            echo '<div class="card-panel green lighten-4 green-text text-darken-4">
                    <i class="material-icons left">delete</i>
                    Usuário excluído com sucesso!
                    </div>';

        } catch (PDOException $e) {
            echo '<div class="card-panel red lighten-4 red-text text-darken-4">
                    <i class="material-icons left">error</i>
                    Erro ao excluir: ' . htmlspecialchars($e->getMessage()) . '
                    </div>';
        }
    }
    
    // Método para exportar usuários para CSV
    public function baixarUsuariosCSV() {
        try {
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=usuarios.csv');
            header('Cache-Control: no-store, no-cache');
            header('Pragma: no-cache');
            header('Expires: 0');

            require_once 'Conexao.php';
            $pdo = getConexao();

            $stmt = $pdo->prepare("
                SELECT codigo, nome, usuario, `create`, `read`, `update`, `delete`
                FROM usuario
                ORDER BY nome ASC
            ");
            $stmt->execute();
            $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $out = fopen('php://output', 'w');

            if (!empty($linhas)) {
                fputcsv($out, array_keys($linhas[0])); // Cabeçalho
                foreach ($linhas as $linha) {
                    fputcsv($out, $linha);
                }
            } else {
                fputcsv($out, ['Nenhum usuário encontrado']);
            }

            fclose($out);
            exit;

        } catch (PDOException $e) {
            echo '<div class="alert alert-warning" role="alert">Não foi possível exportar os usuários!</div>';
        }
    }

    // Método para autenticar usuário
    public function autenticar() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();
    
            $stmt = $pdo->prepare("
                SELECT codigo, nome, usuario
                FROM usuario
                WHERE usuario = :usuario AND senha = :senha
                LIMIT 1
            ");
            $stmt->execute([
                ':usuario' => $this->usuario, // pega do objeto
                ':senha'   => $this->senha
            ]);
    
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($linha) {
                if (session_status() == PHP_SESSION_NONE) session_start();
                $_SESSION['usuario_codigo'] = $linha['codigo'];
                $_SESSION['usuario_nome']   = $linha['nome'];
                $_SESSION['usuario_login']  = $linha['usuario'];
                return true;
            } else {
                return false;
            }
    
        } catch (PDOException $e) {
            echo 'Erro na autenticação: ' . $e->getMessage();
            return false;
        }
    }
    

}
?>