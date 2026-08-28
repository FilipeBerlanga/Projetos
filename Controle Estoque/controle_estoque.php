<?php
/**
 * Projeto: Madeira e Cia Ltda. - Sistema de Controle e Gestão de Estoque (v2)
 * Disciplina: Desenvolvimento Web / Programação Web II
 * Arquivo: controle_estoque_v2.php
 */

// --- BANCO DE DADOS EM MEMÓRIA (ARRAYS MULTIDIMENSIONAIS) ---
$produtosOriginal = [
    ["id" => 101, "nome" => "Viga de Cambará Aparelhada (4m)", "categoria" => "Madeiras", "preco" => 125.50, "quantidade" => 8],
    ["id" => 102, "nome" => "Tábua de Pinus Tratada (3m)", "categoria" => "Madeiras", "preco" => 48.90, "quantidade" => 25],
    ["id" => 103, "nome" => "Verniz Marítimo Premium (3.6L)", "categoria" => "Acabamentos", "preco" => 94.90, "quantidade" => 4],
    ["id" => 104, "nome" => "Parafuso Sextavado ZB 1/4 x 3 (C/100)", "categoria" => "Ferragens", "preco" => 32.80, "quantidade" => 45],
    ["id" => 105, "nome" => "Cola de Contato Extra Cascola (1kg)", "categoria" => "Adesivos", "preco" => 42.00, "quantidade" => 9],
    ["id" => 106, "nome" => "Chapa de MDF Cru 15mm (2.75x1.85m)", "categoria" => "Placas", "preco" => 189.90, "quantidade" => 3],
    ["id" => 107, "nome" => "Ripas de Cedrinho para Telhado (3m)", "categoria" => "Madeiras", "preco" => 14.20, "quantidade" => 60],
    ["id" => 108, "nome" => "Seladora Concentrada para Madeira (900ml)", "categoria" => "Acabamentos", "preco" => 38.50, "quantidade" => 12]
];

// --- DECLARAÇÃO DE FUNÇÕES CUSTOMIZADAS (BACKEND) ---

/**
 * Função com Retorno (Float): Calcula o valor financeiro total acumulado no estoque
 */
function calcularValorTotalEstoque(array $listaProdutos): float {
    $valorTotal = 0.0;
    foreach ($listaProdutos as $produto) {
        $valorTotal += $produto["preco"] * $produto["quantidade"];
    }
    return $valorTotal;
}

/**
 * Função com Retorno (Array): Filtra a lista de produtos com base no limite de estoque crítico
 */
function filtrarProdutosPorEstoqueCritico(array $listaProdutos, int $limiteCritico): array {
    $produtosFiltrados = [];
    foreach ($listaProdutos as $produto) {
        if ($produto["quantidade"] <= $limiteCritico) {
            $produtosFiltrados[] = $produto;
        }
    }
    return $produtosFiltrados;
}

/**
 * Função com Retorno (Array): Filtra produtos por categoria específica
 */
function filtrarProdutosPorCategoria(array $listaProdutos, string $categoriaSelecionada): array {
    if (empty($categoriaSelecionada) || $categoriaSelecionada === "todas") {
        return $listaProdutos;
    }
    $produtosFiltrados = [];
    foreach ($listaProdutos as $produto) {
        if ($produto["categoria"] === $categoriaSelecionada) {
            $produtosFiltrados[] = $produto;
        }
    }
    return $produtosFiltrados;
}

/**
 * Função sem Retorno (Void): Renderiza diretamente as badges com status do estoque
 */
function exibirBadgeStatus(int $quantidade, int $limiteCritico): void {
    if ($quantidade <= $limiteCritico) {
        echo "<span class='badge badge-critico'>Crítico (Repor)</span>";
    } elseif ($quantidade <= ($limiteCritico * 2)) {
        echo "<span class='badge badge-alerta'>Atenção (Médio)</span>";
    } else {
        echo "<span class='badge badge-estavel'>Estável (OK)</span>";
    }
}

// --- CONTROLE DE FLUXO E PROCESSAMENTO DE REQUISIÇÕES (POST) ---
$limiteAlerta = 10; // Valor padrão para limite crítico
$categoriaFiltro = "todas";
$mensagemAlerta = "";
$produtosExibidos = $produtosOriginal;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização e validação das entradas
    if (isset($_POST["txtLimite"])) {
        $limiteInput = trim($_POST["txtLimite"]);
        if (is_numeric($limiteInput) && intval($limiteInput) >= 0) {
            $limiteAlerta = intval($limiteInput);
        } else {
            $mensagemAlerta = "Limite de alerta inválido. Usando valor padrão (10).";
        }
    }
    
    if (isset($_POST["cmbCategoria"])) {
        $categoriaFiltro = htmlspecialchars(trim($_POST["cmbCategoria"]));
    }

    // Aplicação sucessiva de filtros baseados nas funções desenvolvidas
    $produtosExibidos = filtrarProdutosPorCategoria($produtosOriginal, $categoriaFiltro);
    
    // Se o usuário clicar no botão específico de visualizar "Somente Críticos"
    if (isset($_POST["btnApenasCriticos"])) {
        $produtosExibidos = filtrarProdutosPorEstoqueCritico($produtosExibidos, $limiteAlerta);
    }
}

// Cálculos estatísticos do estoque atual
$valorTotalGeral = calcularValorTotalEstoque($produtosOriginal);
$totalItensGeral = count($produtosOriginal);
$itensCriticosAtualmente = count(filtrarProdutosPorEstoqueCritico($produtosOriginal, $limiteAlerta));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madeira & Cia Ltda. | Gestão de Estoque</title>
    <!-- Importação de Fonte Moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32; /* Verde Floresta/Madeira */
            --primary-dark: #1b5e20;
            --accent-color: #8d6e63; /* Marrom Madeira */
            --bg-color: #f5f5f5;
            --card-bg: #ffffff;
            --text-color: #333333;
            --border-radius: 12px;
            --transition-speed: 0.3s;
            
            /* Cores de Alerta de Estoque */
            --color-critico: #c62828;
            --color-alerta: #ef6c00;
            --color-estavel: #2e7d32;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            background-image: radial-gradient(rgba(46, 125, 50, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 30px 20px;
        }

        .container {
            width: 100%;
            max-width: 950px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border-top: 8px solid var(--primary-color);
            margin-bottom: 30px;
        }

        header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        header h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        header p {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
        }

        /* Painel de Indicadores (Dashboard) */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 30px 30px 10px 30px;
            width: 100%;
            max-width: 950px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            padding: 20px;
            border-left: 5px solid var(--primary-color);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card.alerta {
            border-left-color: var(--color-alerta);
        }

        .stat-card.financas {
            border-left-color: var(--accent-color);
        }

        .stat-card h3 {
            font-size: 13px;
            text-transform: uppercase;
            color: #777;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-card .value {
            font-size: 24px;
            font-weight: 700;
            color: #222;
        }

        /* Formulário de Filtros */
        .filter-panel {
            padding: 25px 30px;
            background: #fdfdfd;
            border-bottom: 1px solid #f0f0f0;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 13px;
            color: #555;
        }

        input[type="number"], select {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color var(--transition-speed);
            background-color: #fff;
        }

        input[type="number"]:focus, select:focus {
            border-color: var(--primary-color);
        }

        .button-group {
            display: flex;
            gap: 10px;
            min-width: 320px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-speed);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-accent {
            background-color: #ffebee;
            color: var(--color-critico);
            border: 1px solid #ffcdd2;
            flex: 1.2;
        }

        .btn-accent:hover {
            background-color: var(--color-critico);
            color: white;
        }

        /* Tabela de Produtos */
        .table-container {
            padding: 0 30px 30px 30px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: left;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            padding: 14px 16px;
            font-size: 13px;
            border-bottom: 2px solid #e2e8f0;
            text-transform: uppercase;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #334155;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        /* Badges de Status */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-critico {
            background-color: #ffebee;
            color: var(--color-critico);
        }

        .badge-alerta {
            background-color: #fff3e0;
            color: var(--color-alerta);
        }

        .badge-estavel {
            background-color: #e8f5e9;
            color: var(--color-estavel);
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        /* Área de Alerta de Mensagens */
        .alert-bar {
            background-color: #fff9db;
            border-left: 5px solid #fcc419;
            color: #664d03;
            padding: 12px 30px;
            font-size: 13px;
            font-weight: 600;
        }

        /* Seção Reflexiva Estilizada (Seguindo o Modelo do PDF) */
        .reflection-card {
            width: 100%;
            max-width: 950px;
            background: #ffffff;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
            border-left: 6px solid var(--accent-color);
            margin-bottom: 30px;
        }

        .reflection-card h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }

        .reflection-card p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 12px;
            text-align: justify;
        }

        .reflection-card ol {
            padding-left: 20px;
            font-size: 14px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .reflection-card li {
            margin-bottom: 8px;
        }

        /* Rodapé */
        footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Dashboard Estatístico Superior -->
    <div class="dashboard-grid">
        <div class="stat-card">
            <h3>Total de Produtos Cadastrados</h3>
            <div class="value"><?php echo $totalItensGeral; ?> itens</div>
        </div>
        <div class="stat-card alerta">
            <h3>Itens em Alerta de Crítico (<= <?php echo $limiteAlerta; ?>)</h3>
            <div class="value" style="color: var(--color-critico);"><?php echo $itensCriticosAtualmente; ?> produtos</div>
        </div>
        <div class="stat-card financas">
            <h3>Financeiro Total em Estoque</h3>
            <div class="value" style="color: var(--primary-dark);">R$ <?php echo number_format($valorTotalGeral, 2, ',', '.'); ?></div>
        </div>
    </div>

    <!-- Container Principal do Formulário e da Tabela -->
    <div class="container">
        <header>
            <h1>Madeira & Cia Ltda.</h1>
            <p>Controle Inteligente de Estoque — Promoção e Monitoramento Dinâmico</p>
        </header>

        <!-- Barra de Mensagem caso ocorra algum erro ou aviso -->
        <?php if (!empty($mensagemAlerta)): ?>
            <div class="alert-bar">
                <?php echo $mensagemAlerta; ?>
            </div>
        <?php endif; ?>

        <!-- Painel de Filtros Baseado em POST -->
        <div class="filter-panel">
            <form action="" method="post" class="filter-form">
                <div class="filter-group">
                    <label for="txtLimite">Limite para Estoque Crítico:</label>
                    <input type="number" id="txtLimite" name="txtLimite" min="1" max="100" value="<?php echo $limiteAlerta; ?>" required>
                </div>

                <div class="filter-group">
                    <label for="cmbCategoria">Filtrar por Categoria:</label>
                    <select id="cmbCategoria" name="cmbCategoria">
                        <option value="todas" <?php echo ($categoriaFiltro == "todas") ? 'selected' : ''; ?>>Todas as Categorias</option>
                        <option value="Madeiras" <?php echo ($categoriaFiltro == "Madeiras") ? 'selected' : ''; ?>>Madeiras</option>
                        <option value="Acabamentos" <?php echo ($categoriaFiltro == "Acabamentos") ? 'selected' : ''; ?>>Acabamentos</option>
                        <option value="Ferragens" <?php echo ($categoriaFiltro == "Ferragens") ? 'selected' : ''; ?>>Ferragens</option>
                        <option value="Adesivos" <?php echo ($categoriaFiltro == "Adesivos") ? 'selected' : ''; ?>>Adesivos</option>
                        <option value="Placas" <?php echo ($categoriaFiltro == "Placas") ? 'selected' : ''; ?>>Placas</option>
                    </select>
                </div>

                <div class="button-group">
                    <button type="submit" name="btnFiltrar" class="btn btn-primary">
                        Aplicar Filtros
                    </button>
                    <button type="submit" name="btnApenasCriticos" class="btn btn-accent">
                        Exibir Apenas Críticos
                    </button>
                </div>
            </form>
        </div>

        <!-- Renderização da Tabela com PHP Foreach -->
        <div class="table-container">
            <?php if (count($produtosExibidos) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">Código</th>
                            <th>Descrição do Produto</th>
                            <th>Categoria</th>
                            <th class="text-right" style="width: 120px;">Preço Unitário</th>
                            <th class="text-center" style="width: 110px;">Quantidade</th>
                            <th class="text-center" style="width: 150px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtosExibidos as $prod): ?>
                            <tr>
                                <td class="text-center"><strong>#<?php echo $prod["id"]; ?></strong></td>
                                <td><?php echo htmlspecialchars($prod["nome"]); ?></td>
                                <td><?php echo htmlspecialchars($prod["categoria"]); ?></td>
                                <td class="text-right">R$ <?php echo number_format($prod["preco"], 2, ',', '.'); ?></td>
                                <td class="text-center"><strong><?php echo $prod["quantidade"]; ?></strong></td>
                                <td class="text-center">
                                    <!-- Chamada de Função sem Retorno (Void) -->
                                    <?php exibirBadgeStatus($prod["quantidade"], $limiteAlerta); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div style="padding: 40px; text-align: center; color: #777;">
                    Nenhum produto atende aos filtros selecionados. <a href="" style="color: var(--primary-color); font-weight: 600;">Limpar Filtros</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Seção Reflexiva de Autoria Baseada no Modelo das Aulas -->
    <div class="reflection-card">
        <h2>Reflexão Prática: Estruturas de Repetição e Funções</h2>
        <p><strong>Desenvolvimento lógico para criação do Controle de Estoque com PHP:</strong></p>
        <p>A consolidação das regras de negócio do controle de estoque foi realizada a partir do modelo arquitetural adotado para a promoção de aniversário da empresa, focando nos princípios de reaproveitamento, modularidade e usabilidade:</p>
        <ol>
            <li><strong>Emprego de Estruturas de Repetição (Laço Foreach):</strong> O laço <code>foreach</code> foi selecionado por sua alta eficiência para ler coleções de dados estruturadas em arrays multidimensionais. Diferente dos laços numéricos rígidos como <code>for</code> ou <code>while</code>, o <code>foreach</code> realiza iterações limpas diretamente sobre cada chave de registro de produto, o que nos permitiu injetar dados dinamicamente no HTML da tabela sem poluir o código-fonte ou abrir chaves excessivas.</li>
            <li><strong>Uso Prático de Funções de Negócio (Com Retorno):</strong> Isolamos o cálculo monetário complexo dentro de <code>calcularValorTotalEstoque()</code>. Essa função recebe a coleção de produtos, faz a soma cumulativa multiplicando o preço pela quantidade e devolve um <code>float</code> que é capturado pelo dashboard estatístico no cabeçalho. Já as funções de filtragem (<code>filtrarProdutosPorEstoqueCritico()</code> e <code>filtrarProdutosPorCategoria()</code>) retornam arrays segmentados de dados, permitindo acoplar múltiplos critérios dinâmicos sem quebrar a fonte primária.</li>
            <li><strong>Implementação de Funções de Layout (Sem Retorno - Void):</strong> A rotina de estilização visual das linhas da tabela foi encapsulada na função <code>exibirBadgeStatus()</code>. Por não necessitar de um retorno matemático para o fluxo principal de dados, ela foi categorizada como <code>void</code>, assumindo a responsabilidade de interpretar a quantidade de itens comparada ao limite crítico e imprimir (<code>echo</code>) diretamente no navegador o elemento HTML estilizado com as cores de status (Crítico, Alerta ou Estável).</li>
            <li><strong>Polimento e Padronização UX/UI (Baseado no Modelo Madeira e Cia):</strong> Mantendo a identidade visual do PDF enviado, adotou-se a paleta de cores terrosas e foliares (verde escuro e marrom). A formatação monetária foi tratada com a função nativa do PHP <code>number_format()</code> para respeitar a convenção nacional do Real, e todas as interações dinâmicas utilizam o método de requisição segura <code>POST</code> com persistência nos inputs, de forma que o gestor nunca perca os filtros de busca ao atualizar a tela.</li>
        </ol>
    </div>

    <footer>
        <p>&copy; 2026 Madeira & Cia Ltda. - DS2 - Sistema de Controle de Estoque</p>
    </footer>

</body>
</html>
