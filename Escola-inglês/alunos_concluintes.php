<?php
/**
 * ============================================================================
 * PROJETO: Sistema de Alunos Concluintes - Curso de Inglês (Profª Inês)
 * ============================================================================
 * OBJETIVOS REALIZADOS:
 * 1. Conexão segura com o Banco de Dados MySQL (Driver MySQLi).
 * 2. Consulta e exibição dos alunos e suas 4 notas modulares em tabela HTML.
 * 3. Cálculo dinâmico da Média Final de cada estudante.
 * 4. Desafio 1: Campo de busca/pesquisa para filtrar alunos por nome.
 * 5. Desafio 2: Exibição de Ranking ordenado pela média final (Maior -> Menor).
 * 6. Estilização CSS moderna, agradável e responsiva com tema acadêmico.
 * ============================================================================
 */

// ----------------------------------------------------------------------------
// PASSO 1: Configuração das credenciais do Banco de Dados MySQL
// ----------------------------------------------------------------------------
$servername = "localhost"; // Endereço do servidor MySQL (local)
$username   = "root";      // Usuário padrão do MySQL no XAMPP / USBWebserver
$password   = "";          // Senha padrão (geralmente vazia no XAMPP ou 'usbw' no USBWebserver)
$dbname     = "school";    // Nome do Banco de Dados criado para a escola

// ----------------------------------------------------------------------------
// PASSO 2: Criação da instância de conexão usando MySQLi
// ----------------------------------------------------------------------------
$conexao = new mysqli($servername, $username, $password, $dbname);

// Verificar se houve falha na conexão com o banco de dados
if ($conexao->connect_error) {
    // Caso ocorra erro, interrompe a execução e exibe a mensagem de falha
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

// Configurar o charset para UTF-8 para garantir acentuação correta dos nomes
$conexao->set_charset("utf8");

// ----------------------------------------------------------------------------
// PASSO 3: Captura dos parâmetros do formulário (Busca e Ordenação)
// ----------------------------------------------------------------------------
// Captura o termo digitado no campo de busca de forma segura (sanitizado)
$termoBusca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

// Captura a opção de ordenação selecionada (padrão: 'ranking' por média)
$ordenacao = isset($_GET['ordem']) ? $_GET['ordem'] : 'ranking';

// ----------------------------------------------------------------------------
// PASSO 4: Construção da consulta SQL com cálculo de média e filtros
// ----------------------------------------------------------------------------
// A SQL calcula a média diretamente na consulta: (nota1 + nota2 + nota3 + nota4) / 4
$sql = "SELECT idalunoconcluinte, nome, nota1, nota2, nota3, nota4, 
               ((nota1 + nota2 + nota3 + nota4) / 4) AS media 
        FROM alunoconcluinte";

// Aplicar filtro de busca por nome, caso o usuário tenha digitado algo
if (!empty($termoBusca)) {
    // Utiliza a instrução LIKE para encontrar nomes que contenham o termo
    $termoSeguro = $conexao->real_escape_string($termoBusca);
    $sql .= " WHERE nome LIKE '%$termoSeguro%'";
}

// Aplicar a ordenação solicitada pelo usuário (Desafio de Ranking)
if ($ordenacao === 'nome') {
    $sql .= " ORDER BY nome ASC";
} elseif ($ordenacao === 'codigo') {
    $sql .= " ORDER BY idalunoconcluinte ASC";
} else {
    // Padrão (Ranking): Ordena pela média da maior para a menor
    $sql .= " ORDER BY media DESC, nome ASC";
}

// Executar a instrução SQL no banco de dados
$resultado = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos Concluintes - Inglês | Profª Inês</title>
    <!-- Importação da fonte Google Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Importação dos ícones Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* -------------------------------------------------------------------
           ESTILIZAÇÃO CSS PERSONALIZADA (DESIGN MODERNO E ACADÊMICO)
           ------------------------------------------------------------------- */
        :root {
            --primary-color: #0284c7;   /* Azul Celeste Principal */
            --primary-dark: #0369a1;    /* Azul Escuro */
            --accent-color: #f59e0b;   /* Dourado para Ranking/Troféu */
            --bg-color: #f0f9ff;       /* Fundo suave azulado */
            --card-bg: #ffffff;        /* Fundo branco dos cards */
            --text-color: #1e293b;     /* Cor dos textos principais */
            --border-color: #e2e8f0;   /* Cor das bordas */
            --success-bg: #dcfce7;     /* Fundo verde aprovado */
            --success-text: #15803d;   /* Texto verde aprovado */
            --danger-bg: #fee2e2;      /* Fundo vermelho reprovado */
            --danger-text: #b91c1c;    /* Texto vermelho reprovado */
            --border-radius: 12px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
            padding: 30px 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 950px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.08);
            overflow: hidden;
            border-top: 6px solid var(--primary-color);
        }

        /* Cabeçalho da Página */
        header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: #ffffff;
            padding: 30px 25px;
            text-align: center;
            position: relative;
        }

        header h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        header p {
            font-size: 14px;
            opacity: 0.92;
            margin-top: 6px;
            font-weight: 300;
        }

        .content {
            padding: 25px 30px;
        }

        /* Painel de Filtros e Busca */
        .control-panel {
            background-color: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 18px 20px;
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            justify-content: space-between;
        }

        .search-form {
            display: flex;
            flex: 1;
            min-width: 280px;
            gap: 10px;
        }

        .input-group {
            position: relative;
            flex: 1;
        }

        .input-group i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .input-group input {
            width: 100%;
            padding: 11px 15px 11px 40px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .input-group input:focus {
            border-color: var(--primary-color);
        }

        .btn-search {
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 11px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-search:hover {
            background-color: var(--primary-dark);
        }

        .btn-clear {
            background-color: #e2e8f0;
            color: #475569;
            text-decoration: none;
            padding: 11px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.2s;
        }

        .btn-clear:hover {
            background-color: #cbd5e1;
        }

        .sort-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sort-group label {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        .sort-group select {
            padding: 10px 14px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-color);
            outline: none;
            cursor: pointer;
            background-color: #ffffff;
        }

        /* Estilização da Tabela de Resultados */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 14px 12px;
            border-bottom: 2px solid var(--border-color);
            text-align: center;
        }

        th.text-left, td.text-left {
            text-align: left;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--border-color);
            text-align: center;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        /* Posição no Ranking / Destaques do Top 3 */
        .rank-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            font-weight: 700;
            font-size: 12px;
        }

        .rank-1 { background-color: #fef08a; color: #a16207; border: 1px solid #fde047; } /* Ouro */
        .rank-2 { background-color: #e2e8f0; color: #475569; border: 1px solid #cbd5e1; } /* Prata */
        .rank-3 { background-color: #ffedd5; color: #9a3412; border: 1px solid #fed7aa; } /* Bronze */
        .rank-default { background-color: #f1f5f9; color: #64748b; } 

        /* Badges de Média Aprovado / Reprovado */
        .media-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 13px;
            display: inline-block;
        }

        .media-aprovado {
            background-color: var(--success-bg);
            color: var(--success-text);
        }

        .media-reprovado {
            background-color: var(--danger-bg);
            color: var(--danger-text);
        }

        .no-results {
            text-align: center;
            padding: 30px;
            color: #64748b;
            font-size: 15px;
        }

        .no-results i {
            font-size: 36px;
            margin-bottom: 10px;
            color: #94a3b8;
            display: block;
        }

        /* Rodapé Informativo */
        footer {
            text-align: center;
            margin-top: 25px;
            color: #64748b;
            font-size: 13px;
        }

        footer span {
            font-weight: 600;
            color: var(--primary-dark);
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Cabeçalho Principal -->
        <header>
            <h1><i class="fa-solid fa-graduation-cap"></i> Alunos Concluintes - Curso de Inglês</h1>
            <p>Relatório Oficial de Notas e Ranking Modular | Professora Inês</p>
        </header>

        <div class="content">
            <!-- Painel de Filtros e Busca (Desafios com IA) -->
            <div class="control-panel">
                <!-- Formulário de Busca por Nome -->
                <form action="alunos_concluintes.php" method="GET" class="search-form">
                    <div class="input-group">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="busca" placeholder="Pesquisar aluno por nome..." value="<?php echo htmlspecialchars($termoBusca); ?>">
                    </div>
                    <button type="submit" class="btn-search">
                        <i class="fa-solid fa-filter"></i> Filtrar
                    </button>
                    <?php if (!empty($termoBusca) || $ordenacao !== 'ranking'): ?>
                        <a href="alunos_concluintes.php" class="btn-clear">
                            <i class="fa-solid fa-xmark"></i> Limpar
                        </a>
                    <?php endif; ?>
                </form>

                <!-- Formulário de Ordenação/Ranking -->
                <form action="alunos_concluintes.php" method="GET" class="sort-group" id="sortForm">
                    <!-- Preserva a busca ao alterar a ordenação -->
                    <?php if (!empty($termoBusca)): ?>
                        <input type="hidden" name="busca" value="<?php echo htmlspecialchars($termoBusca); ?>">
                    <?php endif; ?>
                    <label for="ordem"><i class="fa-solid fa-arrow-down-wide-short"></i> Ordenar por:</label>
                    <select name="ordem" id="ordem" onchange="document.getElementById('sortForm').submit();">
                        <option value="ranking" <?php echo ($ordenacao === 'ranking') ? 'selected' : ''; ?>>Ranking (Maior Média)</option>
                        <option value="nome" <?php echo ($ordenacao === 'nome') ? 'selected' : ''; ?>>Nome (A-Z)</option>
                        <option value="codigo" <?php echo ($ordenacao === 'codigo') ? 'selected' : ''; ?>>Código (ID)</option>
                    </select>
                </form>
            </div>

            <!-- Tabela de Resultados -->
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60px;">Rank</th>
                            <th style="width: 70px;">Cód.</th>
                            <th class="text-left">Nome do Aluno</th>
                            <th>Módulo 1</th>
                            <th>Módulo 2</th>
                            <th>Módulo 3</th>
                            <th>Módulo 4</th>
                            <th>Média Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Verificar se a consulta SQL retornou registros
                        if ($resultado && $resultado->num_rows > 0) {
                            $posicao = 1; // Contador para a posição no Ranking
                            
                            // Percorre cada registro retornado do Banco de Dados MySQL (usando fetch_assoc)
                            while ($linha = $resultado->fetch_assoc()) {
                                $id = $linha['idalunoconcluinte'];
                                $nome = $linha['nome'];
                                $n1 = number_format($linha['nota1'], 1, ',', '.');
                                $n2 = number_format($linha['nota2'], 1, ',', '.');
                                $n3 = number_format($linha['nota3'], 1, ',', '.');
                                $n4 = number_format($linha['nota4'], 1, ',', '.');
                                $mediaNum = floatval($linha['media']);
                                $mediaFormatada = number_format($mediaNum, 1, ',', '.');

                                // Determina o estilo do selo de Posição no Ranking (Top 3)
                                $rankClass = "rank-default";
                                if ($ordenacao === 'ranking' && empty($termoBusca)) {
                                    if ($posicao == 1) $rankClass = "rank-1";
                                    elseif ($posicao == 2) $rankClass = "rank-2";
                                    elseif ($posicao == 3) $rankClass = "rank-3";
                                }

                                // Determina a classe de destaque da média (Aprovado >= 7.0)
                                $mediaClass = ($mediaNum >= 7.0) ? "media-aprovado" : "media-reprovado";

                                echo "<tr>";
                                echo "<td><span class='rank-badge {$rankClass}'>{$posicao}º</span></td>";
                                echo "<td>#{$id}</td>";
                                echo "<td class='text-left'><strong>" . htmlspecialchars($nome) . "</strong></td>";
                                echo "<td>{$n1}</td>";
                                echo "<td>{$n2}</td>";
                                echo "<td>{$n3}</td>";
                                echo "<td>{$n4}</td>";
                                echo "<td><span class='media-badge {$mediaClass}'>{$mediaFormatada}</span></td>";
                                echo "</tr>";

                                $posicao++; // Incrementa a posição
                            }
                        } else {
                            // Mensagem caso nenhum aluno seja encontrado na busca
                            echo "<tr><td colspan='8' class='no-results'>";
                            echo "<i class='fa-solid fa-user-slash'></i>";
                            echo "Nenhum aluno encontrado com o termo '<strong>" . htmlspecialchars($termoBusca) . "</strong>'.";
                            echo "</td></tr>";
                        }

                        // Fechar a conexão com o banco de dados
                        $conexao->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Rodapé da Aplicação -->
    <footer>
        <p>&copy; 2026 Escola de Idiomas | Desenvolvido por Filipe Berlanga</p>
    </footer>

</body>
</html>
