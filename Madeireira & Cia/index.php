<?php
$nome = "";
$valorCompra = "";
$formaPagamento = "";
$mensagem = "";
$erro = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitização básica dos dados
    $nome = htmlspecialchars(trim($_POST["txtNome"]));
    $valorCompraInput = trim($_POST["txtValorCompra"]);
    $formaPagamento = trim($_POST["cmbPag"]);

    // Validação de segurança e integridade
    if (empty($nome) || empty($valorCompraInput) || empty($formaPagamento)) {
        $mensagem = "Por favor, preencha todos os campos do formulário.";
        $erro = true;
    } elseif (!is_numeric(str_replace(',', '.', $valorCompraInput)) || floatval(str_replace(',', '.', $valorCompraInput)) <= 0) {
        $mensagem = "Por favor, insira um valor de compra válido e maior que zero.";
        $erro = true;
    } else {
        $valorCompra = floatval(str_replace(',', '.', $valorCompraInput));
        $desconto = 0;
        $taxaDesconto = 0;
        $nomeFormaPagamento = "";

        // Estrutura de Decisão corrigida
        if ($formaPagamento == "cartaoCredito") {
            $taxaDesconto = 0;
            $nomeFormaPagamento = "Cartão de Crédito";
        } elseif ($formaPagamento == "boleto") {
            $taxaDesconto = 0.08; // Correção: Boleto recebe 8% de desconto
            $nomeFormaPagamento = "Boleto Bancário";
        } elseif ($formaPagamento == "deposito") {
            $taxaDesconto = 0.10; // Correção: Depósito recebe 10% de desconto
            $nomeFormaPagamento = "Depósito Bancário";
        } else {
            $mensagem = "Forma de pagamento inválida selecionada.";
            $erro = true;
        }

        if (!$erro) {
            // Cálculos lógicos
            $desconto = $valorCompra * $taxaDesconto;
            $valorFinal = $valorCompra - $desconto;

            // Formatação dos valores em formato de moeda brasileira (R$) com 2 casas decimais
            $valorCompraFormatado = "R$ " . number_format($valorCompra, 2, ',', '.');
            $descontoFormatado = "R$ " . number_format($desconto, 2, ',', '.');
            $valorFinalFormatado = "R$ " . number_format($valorFinal, 2, ',', '.');

            // Mensagem personalizada de sucesso
            if ($taxaDesconto > 0) {
                $porcentagemDesconto = $taxaDesconto * 100;
                $mensagem = "Olá,<strong> $nome!</strong> Sua compra no valor de <strong>$valorCompraFormatado</strong> foi realizada via <strong>$nomeFormaPagamento</strong>.<br>" .
                            "Você recebeu um desconto de <strong>$porcentagemDesconto%</strong> (economizou <strong>$descontoFormatado</strong>).<br>" .
                            "O valor final a ser pago é de <span class='valor-destaque'>$valorFinalFormatado</span>.";
            } else {
                $mensagem = "Olá,<strong> $nome!</strong> Sua compra no valor de <strong>$valorCompraFormatado</strong> foi realizada via <strong>$nomeFormaPagamento</strong>.<br>" .
                            "Não há desconto para esta forma de pagamento.<br>" .
                            "O valor total a ser pago é de <span class='valor-destaque'>$valorFinalFormatado</span>.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madeira & Cia Ltda. | Promoção de Aniversário</title>
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
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 650px;
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
            padding: 25px;
            text-align: center;
        }

        header h1 {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        header p {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .form-content {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            color: #444;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border-color var(--transition-speed);
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: var(--primary-color);
        }

        .input-with-symbol {
            position: relative;
        }

        .input-with-symbol span {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 600;
            color: #777;
        }

        .input-with-symbol input {
            padding-left: 45px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            background: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background var(--transition-speed), transform 0.1s;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        /* Área de Mensagens de Retorno */
        .result-panel {
            margin-top: 25px;
            padding: 20px;
            border-radius: 8px;
            font-size: 15px;
            line-height: 1.6;
        }

        .result-success {
            background-color: #e8f5e9;
            border-left: 5px solid #2e7d32;
            color: #1b5e20;
        }

        .result-error {
            background-color: #ffebee;
            border-left: 5px solid #c62828;
            color: #b71c1c;
        }

        .valor-destaque {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Rodapé com Crédito */
        footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-bottom: 20px;
        }

        /* Seção Reflexiva estilizada */
        .reflection-card {
            width: 100%;
            max-width: 650px;
            background: #ffffff;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
            border-left: 6px solid var(--accent-color);
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

        /* Simulação de Testes de Escopo para Relatório Acadêmico */
        .test-scenarios {
            width: 100%;
            max-width: 650px;
            background: #272822;
            color: #f8f8f2;
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
        }

        .test-scenarios h3 {
            color: #66d9ef;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
        }

        .test-scenarios .log-entry {
            margin-bottom: 10px;
            border-bottom: 1px dashed #444;
            padding-bottom: 10px;
        }

        .test-scenarios .log-entry:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .test-scenarios .green { color: #a6e22e; }
        .test-scenarios .blue { color: #66d9ef; }
        .test-scenarios .yellow { color: #e6db74; }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>Madeira & Cia Ltda.</h1>
            <p>Promoção de Aniversário — Cálculo de Desconto de Vendas</p>
        </header>

        <div class="form-content">
            <form action="" method="post">
                <div class="form-group">
                    <label for="txtNome">Nome do Cliente:</label>
                    <input type="text" id="txtNome" name="txtNome" placeholder="Digite o nome completo" value="<?php echo htmlspecialchars($nome); ?>" required>
                </div>

                <div class="form-group">
                    <label for="txtValorCompra">Valor da Compra:</label>
                    <div class="input-with-symbol">
                        <span>R$</span>
                        <input type="number" id="txtValorCompra" name="txtValorCompra" step="0.01" min="0.01" placeholder="0,00" value="<?php echo htmlspecialchars($valorCompraInput); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cmbPag">Forma de Pagamento:</label>
                    <select id="cmbPag" name="cmbPag" required>
                        <option value="" disabled <?php echo empty($formaPagamento) ? 'selected' : ''; ?>>Selecione a forma de pagamento</option>
                        <option value="deposito" <?php echo ($formaPagamento == "deposito") ? 'selected' : ''; ?>>Depósito (10% de desconto)</option>
                        <option value="boleto" <?php echo ($formaPagamento == "boleto") ? 'selected' : ''; ?>>Boleto (8% de desconto)</option>
                        <option value="cartaoCredito" <?php echo ($formaPagamento == "cartaoCredito") ? 'selected' : ''; ?>>Cartão de Crédito (Sem desconto)</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">Processar e Calcular</button>
            </form>

            <?php if (!empty($mensagem)): ?>
                <div class="result-panel <?php echo $erro ? 'result-error' : 'result-success'; ?>">
                    <?php echo $mensagem; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="reflection-card">
        <h2>O desenvolvimento</h2>
        <p><strong>Desenvolvimento lógico para correção dos erros e criação do formulário:</strong></p>
        <p>O processo de correção do código e criação do novo formulário web foi estruturado em quatro etapas essenciais do raciocínio lógico de programação:</p>
        <ol>
            <li><strong>Análise Crítica e Diagnóstico:</strong> O primeiro passo consistiu em identificar que a lógica de descontos do código original estava invertida de acordo com a regra de negócio da empresa (o Boleto aplicava incorretamente a taxa de 10% do Depósito, e vice-versa). Além disso, a saída de dados apenas exibia o montante economizado, sem apontar de forma clara o valor líquido final a ser pago pelo consumidor.</li>
            <li><strong>Estruturação da Lógica e Correção Algorítmica:</strong> As condicionais encadeadas (<code>if/elseif/else</code>) foram corrigidas, associando a taxa de <code>0.10</code> ao depósito e <code>0.08</code> ao boleto. Introduziu-se uma variável nova (<code>$valorFinal</code>), que realiza a operação de subtração (<code>$valorCompra - $desconto</code>) antes de formatar os dados.</li>
            <li><strong>Formatação e Apresentação de Dados:</strong> Para atender à exigência de exibição financeira profissional, empregou-se a função nativa do PHP <code>number_format()</code>. Isso garantiu que todos os valores numéricos gerados na página fossem exibidos com duas casas decimais e separadores de milhar/decimal adequados ao padrão brasileiro (R$).</li>
            <li><strong>Desenho do Layout UX/UI e Integração do Formulário:</strong> O formulário HTML foi remodelado do zero com CSS moderno (flexbox, variáveis de cor, bordas arredondadas e transições suaves). Utilizou-se um tema baseado em tons de verde e marrom florestal em alusão à identidade visual de uma madeireira ("Madeira & Cia"). O método de envio de formulário escolhido foi o <code>POST</code> por ocultar os dados na URL, e o atributo <code>action=""</code> direciona o formulário para recarregar a própria página, agilizando o processamento dinâmico sem necessidade de múltiplos arquivos separados.</li>
        </ol>
    </div>

    <footer>
        <p>&copy; 2026 Madeira & Cia Ltda. - DS2 - By: Filipe Berlanga</p>
    </footer>

</body>
</html>

