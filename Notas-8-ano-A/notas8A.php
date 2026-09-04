<?php
/**
 * Projeto: Escola 8º Ano A - Diário de Classe de Notas e Médias
 * Desenvolvedor: Joseph
 * Arquivo: notas8A.php
 */

// 1. Array bidimensional contendo pelo menos 5 alunos fictícios e suas notas dos 4 bimestres
$alunos = [
    [
        "nome" => "Bruno Oliveira",
        "notas" => [8.5, 7.0, 9.0, 8.0]
    ],
    [
        "nome" => "Gabriel Santos",
        "notas" => [4.5, 5.0, 5.5, 4.0]
    ],
    [
        "nome" => "Diego Lima",
        "notas" => [7.5, 8.0, 6.0, 7.0]
    ],
    [
        "nome" => "Fernanda Costa",
        "notas" => [9.5, 9.0, 10.0, 9.5]
    ],
    [
        "nome" => "Camila Souza",
        "notas" => [5.0, 6.5, 4.0, 5.5]
    ],
    [
        "nome" => "Ana Paula",
        "notas" => [9.5, 6.0, 5.8, 4.0]
    ]
];

// 2. Processamento de dados: calcular a média de cada aluno (com uma casa decimal) e armazenar no array
foreach ($alunos as $chave => $aluno) {
    $soma = array_sum($aluno["notas"]);
    $media = round($soma / 4, 1);
    $alunos[$chave]["media"] = $media;
}

usort($alunos, function ($a, $b) {
    if ($a["media"] == $b["media"]) {
        return 0;
    }
    return ($a["media"] > $b["media"]) ? -1 : 1;
});

// // Ordenar a tabela por ordem alfabética (A -> Z)
// usort($alunos, function ($a, $b) {
//     return strcasecmp($a["nome"], $b["nome"]);
// });

// Desafio Opcional: Ordenar a tabela pela média (maior -> menor)
usort($alunos, function ($a, $b) {
    if ($a["media"] == $b["media"]) {
        return 0;
    }
    return ($a["media"] > $b["media"]) ? -1 : 1;
});

// Desafio Opcional: Calcular a média geral da turma
$somaMediasTurma = 0;
foreach ($alunos as $aluno) {
    $somaMediasTurma += $aluno["media"];
}
$mediaGeralTurma = round($somaMediasTurma / count($alunos), 1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diário de Classe - 8º Ano A | Notas</title>
    <!-- Importação de Fonte Moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e3a8a; /* Azul Escolar */
            --primary-dark: #1e40af;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-color: #1f2937;
            --success-color: #15803d; /* Verde para aprovados */
            --danger-color: #b91c1c; /* Vermelho para reprovados */
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border-top: 8px solid var(--primary-color);
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
        }

        header p {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .content {
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 15px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f8fafc;
            color: #4b5563;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: #f1f5f9;
        }

        /* Estilização das Médias (Verde >= 6.0 e Vermelho < 6.0) */
        .media-aprovado {
            color: var(--success-color);
            background-color: #dcfce7;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        .media-reprovado {
            color: var(--danger-color);
            background-color: #fee2e2;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        /* Linha Geral / Desafio */
        .linha-geral {
            background-color: #f8fafc;
            font-weight: 700;
            border-top: 2px solid #cbd5e1;
        }

        .media-geral-destaque {
            color: var(--primary-color);
            background-color: #dbeafe;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        /* Explicação do Código no Rodapé */
        .comment-section {
            background-color: #f8fafc;
            border-left: 4px solid #94a3b8;
            padding: 15px 20px;
            margin-top: 25px;
            font-size: 13px;
            color: #475569;
            border-radius: 0 8px 8px 0;
        }

        .comment-section h3 {
            font-size: 14px;
            margin-bottom: 8px;
            color: #1e293b;
            font-weight: 600;
        }

        .comment-section p {
            line-height: 1.5;
            font-style: italic;
        }

        footer {
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>Diário de Classe - 8º Ano A</h1>
            <p>Relatório de Desempenho e Médias dos Alunos | Primária de Springfield</p>
        </header>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Nome do Aluno</th>
                        <th style="text-align: center;">1º Bim</th>
                        <th style="text-align: center;">2º Bim</th>
                        <th style="text-align: center;">3º Bim</th>
                        <th style="text-align: center;">4º Bim</th>
                        <th style="text-align: center;">Média Final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // 3. Estrutura foreach para percorrer o array e gerar as linhas da tabela
                    foreach ($alunos as $aluno) {
                        echo "<tr>";
                        echo "<td><strong>" . htmlspecialchars($aluno["nome"]) . "</strong></td>";
                        foreach ($aluno["notas"] as $nota) {
                            echo "<td style='text-align: center;'>" . number_format($nota, 1, ',', '.') . "</td>";
                        }
                        
                        // 4 & 5. Destaque das médias (Verde para >= 6,0 e Vermelho para < 6,0)
                        $classeMedia = ($aluno["media"] >= 6.0) ? "media-aprovado" : "media-reprovado";
                        echo "<td style='text-align: center;'>";
                        echo "<span class='{$classeMedia}'>" . number_format($aluno["media"], 1, ',', '.') . "</span>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                    
                    <!-- Desafio Opcional: Linha final com a média geral da turma -->
                    <tr class="linha-geral">
                        <td colspan="5"><strong>MÉDIA GERAL DA TURMA</strong></td>
                        <td style="text-align: center;">
                            <span class="media-geral-destaque"><?php echo number_format($mediaGeralTurma, 1, ',', '.'); ?></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- 6. Explicação do comentário foreach (Exibida na tela para fins acadêmicos e presente no código) -->
            <div class="comment-section">
                <h3>Comentário de Autoria de Joseph (Foreach no Código):</h3>
                <p>
                    <?php
                    /*
                    O loop foreach percorre cada elemento do array bidimensional $alunos. 
                    A cada iteração, ele extrai os dados individuais de um estudante (como nome, notas e média) 
                    e gera dinamicamente uma nova linha (<tr>) na tabela HTML, preenchendo as colunas (<td>) 
                    com as respectivas informações de maneira totalmente automatizada.
                    */
                    echo "O loop foreach percorre cada elemento do array bidimensional \$alunos. " .
                         "A cada iteração, ele extrai os dados individuais de um estudante (como nome, notas e média) " .
                         "e gera dinamicamente uma nova linha (&lt;tr&gt;) na tabela HTML, preenchendo as colunas (&lt;td&gt;) " .
                         "com as respectivas informações de maneira totalmente automatizada.";
                    ?>
                </p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Escola Primária de Springfield | Joseph's Web Dev Studio</p>
    </footer>

</body>
</html>