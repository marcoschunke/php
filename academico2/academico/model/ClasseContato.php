<?php
class ClasseContato {
    private $id;
    private $usuario_codigo;
    private $email;
    private $telefone;

    // Construtor
    public function __construct($id = null, $usuario_codigo = null, $email = null, $telefone = null) {
        $this->id             = $id;
        $this->usuario_codigo = $usuario_codigo;
        $this->email          = $email;
        $this->telefone       = $telefone;
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getUsuarioCodigo() {
        return $this->usuario_codigo;
    }
    public function setUsuarioCodigo($usuario_codigo) {
        $this->usuario_codigo = $usuario_codigo;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelefone() {
        return $this->telefone;
    }
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    // Create: cadastrar contato
    public function cadastrarContato() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();

            $stmt = $pdo->prepare("
                INSERT INTO contato (usuario_codigo, email, telefone)
                VALUES (:usuario_codigo, :email, :telefone)
            ");

            $stmt->execute([
                ':usuario_codigo' => $this->usuario_codigo,
                ':email'          => $this->email,
                ':telefone'       => $this->telefone
            ]);

            echo '<div class="card-panel green lighten-4">
                    <h6 class="green-text">Contato cadastrado com sucesso!</h6>
                  </div>';

        } catch (PDOException $e) {
            echo '<div class="card-panel red lighten-4">
                    <h6 class="red-text">Erro ao cadastrar: ' . htmlspecialchars($e->getMessage()) . '</h6>
                  </div>';
        }
    }

    // Read (lista simples em tabela HTML)
    public function listarContatos() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();

            $consulta = $pdo->prepare("
                SELECT `id`, `usuario_codigo`, `email`, `telefone`
                FROM `contato`
                ORDER BY `id` DESC
            ");
            $consulta->execute();

            echo '<div class="container section">';
            echo '<h4 class="center-align">Lista de Contatos</h4>';
            echo '<table class="highlight striped responsive-table z-depth-1">';
            echo '<thead class="blue lighten-4">
                    <tr>
                        <th>ID</th>
                        <th>Código do Usuário</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                    </tr>
                  </thead><tbody>';

            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($linha['id']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['usuario_codigo']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['email']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['telefone']) . '</td>';
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

    // Read com Ações (editar/excluir)
    public function listarContatosAcoes() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();

            $consulta = $pdo->prepare("
                SELECT `id`, `usuario_codigo`, `email`, `telefone`
                FROM `contato`
                ORDER BY `id` DESC
            ");
            $consulta->execute();

            echo '<div class="container section">';
            echo '<h4 class="center-align">Contatos</h4>';
            echo '<table class="highlight striped responsive-table z-depth-1">';
            echo '<thead class="blue lighten-4">
                    <tr>
                        <th>ID</th>
                        <th>Código do Usuário</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th colspan="2" class="center-align">Ações</th>
                    </tr>
                  </thead><tbody>';

            $cores = ['#E3F2FD', '#BBDEFB']; // tons de azul
            $i = 0;

            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $cor = $cores[$i % count($cores)];
                echo '<tr style="background-color:' . $cor . ';">';
                echo '<td>' . htmlspecialchars($linha['id']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['usuario_codigo']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['email']) . '</td>';
                echo '<td>' . htmlspecialchars($linha['telefone']) . '</td>';

                // Editar
                echo '<td class="center-align">
                        <a href="alterarContato.php?id=' . urlencode($linha['id']) . '"
                           class="btn-small blue waves-effect waves-light">
                           <i class="material-icons">edit</i>
                        </a>
                      </td>';

                // Excluir
                echo '<td class="center-align">
                        <a href="excluirContato.php?id=' . urlencode($linha['id']) . '"
                           class="btn-small red waves-effect waves-light"
                           onclick="return confirm(\'Tem certeza que deseja excluir este contato?\');">
                           <i class="material-icons">delete</i>
                        </a>
                      </td>';

                echo '</tr>';
                $i++;
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

    // Update: atualizar contato
    public function atualizarContato() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();

            $stmt = $pdo->prepare("
                UPDATE `contato`
                SET `usuario_codigo` = :usuario_codigo,
                    `email`          = :email,
                    `telefone`       = :telefone
                WHERE `id` = :id
            ");

            $stmt->execute([
                ':usuario_codigo' => $this->usuario_codigo,
                ':email'          => $this->email,
                ':telefone'       => $this->telefone,
                ':id'             => $this->id
            ]);

            echo '<div class="card-panel green lighten-4 green-text text-darken-4">
                    <i class="material-icons left">check_circle</i>
                    Contato atualizado com sucesso!
                  </div>';

        } catch (PDOException $e) {
            echo '<div class="card-panel red lighten-4 red-text text-darken-4">
                    <i class="material-icons left">error</i>
                    Erro ao atualizar: ' . htmlspecialchars($e->getMessage()) . '
                  </div>';
        }
    }

    // Delete: excluir contato
    public function excluirContato() {
        try {
            require_once 'Conexao.php';
            $pdo = getConexao();

            $stmt = $pdo->prepare("DELETE FROM `contato` WHERE `id` = :id");
            $stmt->execute([':id' => $this->id]);

            echo '<div class="card-panel green lighten-4 green-text text-darken-4">
                    <i class="material-icons left">delete</i>
                    Contato excluído com sucesso!
                  </div>';

        } catch (PDOException $e) {
            echo '<div class="card-panel red lighten-4 red-text text-darken-4">
                    <i class="material-icons left">error</i>
                    Erro ao excluir: ' . htmlspecialchars($e->getMessage()) . '
                  </div>';
        }
    }
}
?>