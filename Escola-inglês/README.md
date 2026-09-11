# Escola de Inglês - Alunos Concluintes

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-Layout-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-Estilo-1572B6?logo=css3&logoColor=white)
![Status](https://img.shields.io/badge/Status-Completo-brightgreen)
![Servidor](https://img.shields.io/badge/Servidor-XAMPP-FF6B35)

Sistema web em PHP para listar, buscar e classificar alunos concluintes do curso de inglês por média final. A aplicação conecta ao banco de dados MySQL, exibe as notas dos quatro módulos e organiza os registros em ranking conforme desempenho.

## 📌 Objetivo do projeto

Este projeto foi desenvolvido para:

- conectar-se a um banco de dados MySQL;
- consultar os alunos cadastrados;
- exibir as quatro notas por módulo;
- calcular a média final automaticamente;
- permitir busca por nome;
- ordenar os resultados por ranking, nome ou código;
- apresentar os dados em uma interface visual moderna e responsiva.

## 🧩 Funcionalidades implementadas

- Consulta dinâmica ao banco de dados;
- Cálculo da média final com fórmula:

  $$\text{Média} = \frac{\text{nota1} + \text{nota2} + \text{nota3} + \text{nota4}}{4}$$

- Filtro por nome com o campo de busca;
- Ordenação por:
  - ranking da maior média para a menor;
  - nome em ordem alfabética;
  - código do aluno;
- Destaque visual para o topo do ranking;
- Badge de status da média:
  - aprovado quando a média for maior ou igual a 7,0;
  - reprovado quando a média for menor que 7,0;
- Layout estilizado com CSS moderno e responsivo.

## 🏗️ Estrutura do projeto

```text
Escola-inglês/
├── alunos_concluintes.php
└── README.md
```

## 🗂️ Banco de dados

A aplicação assume que o banco de dados `school` existe e contém uma tabela chamada `alunoconcluinte`.

Exemplo de estrutura:

```sql
CREATE DATABASE school;

USE school;

CREATE TABLE alunoconcluinte (
    idalunoconcluinte INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    nota1 DECIMAL(3,1),
    nota2 DECIMAL(3,1),
    nota3 DECIMAL(3,1),
    nota4 DECIMAL(3,1)
);
```

Exemplo de inserção:

```sql
INSERT INTO alunoconcluinte (nome, nota1, nota2, nota3, nota4)
VALUES
('Maria Silva', 8.5, 9.0, 7.8, 8.7),
('João Pereira', 6.5, 7.0, 8.2, 7.4),
('Ana Costa', 9.1, 8.8, 9.5, 9.0);
```

## ⚙️ Configuração inicial

1. Instale e inicie o XAMPP ou outro ambiente com Apache + MySQL.
2. Crie o banco de dados e a tabela conforme o exemplo acima.
3. Coloque a pasta do projeto dentro da pasta `htdocs` do XAMPP.
4. Acesse no navegador:

```text
http://localhost/Escola-inglês/alunos_concluintes.php
```

## 🧠 Explicação do código

### 1. Conexão com o banco

O arquivo inicia com a criação da conexão MySQLi:

```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conexao = new mysqli($servername, $username, $password, $dbname);
```

Esse trecho estabelece a comunicação com o banco de dados local. Caso a conexão falhe, a aplicação interrompe a execução com `die(...)` para evitar erros posteriores.

### 2. Tratamento da busca e ordenação

Os parâmetros enviados pela URL são capturados via `$_GET`:

```php
$termoBusca = isset($_GET['busca']) ? trim($_GET['busca']) : '';
$ordenacao = isset($_GET['ordem']) ? $_GET['ordem'] : 'ranking';
```

- `busca`: texto digitado para filtrar alunos.
- `ordem`: tipo de ordenação escolhido pela interface.

### 3. Consulta SQL com média

A consulta calcula a média diretamente no banco:

```php
$sql = "SELECT idalunoconcluinte, nome, nota1, nota2, nota3, nota4,
               ((nota1 + nota2 + nota3 + nota4) / 4) AS media
        FROM alunoconcluinte";
```

Essa abordagem permite que a média seja gerada pelo próprio banco de dados, deixando a consulta mais eficiente e organizada.

### 4. Filtro por nome

Se houver texto no campo de busca, a consulta recebe um filtro com `LIKE`:

```php
if (!empty($termoBusca)) {
    $termoSeguro = $conexao->real_escape_string($termoBusca);
    $sql .= " WHERE nome LIKE '%$termoSeguro%'";
}
```

A função `real_escape_string()` ajuda a evitar problemas com caracteres especiais e aumenta a segurança da aplicação.

### 5. Ordenação dos resultados

A ordenação depende do valor recebido em `ordem`:

```php
if ($ordenacao === 'nome') {
    $sql .= " ORDER BY nome ASC";
} elseif ($ordenacao === 'codigo') {
    $sql .= " ORDER BY idalunoconcluinte ASC";
} else {
    $sql .= " ORDER BY media DESC, nome ASC";
}
```

- `ranking`: maior média primeiro;
- `nome`: ordem alfabética;
- `codigo`: ordem pelo identificador do aluno.

### 6. Renderização da tabela HTML

A consulta executada é percorre com `fetch_assoc()` e cada linha é exibida em tabela HTML:

```php
while ($linha = $resultado->fetch_assoc()) {
    $mediaNum = floatval($linha['media']);
    $mediaFormatada = number_format($mediaNum, 1, ',', '.');
```

Os valores são formatados para melhor apresentação, com vírgula para decimais e destaque visual para a média final.

### 7. Estilo visual

A página conta com CSS interno para criar uma aparência moderna e acadêmica, incluindo:

- esquema de cores em azul e dourado;
- cabeçalho destacando o projeto;
- painel de busca e ordenação;
- tabela com responsividade;
- medalhas para os primeiros lugares;
- badges para aprovação/reprovação.

### 8. Mensagem de ausência de resultados

Quando a busca não retorna nenhum aluno, a aplicação exibe uma mensagem amigável:

```php
else {
    echo "<tr><td colspan='8' class='no-results'>";
    echo "Nenhum aluno encontrado com o termo ...";
}
```

Essa parte melhora a experiência do usuário e comunica claramente que a pesquisa não encontrou registros.

## 🧪 Como funciona a lógica de média e aprovação

A média é calculada como a soma das quatro notas dividida por quatro:

```php
((nota1 + nota2 + nota3 + nota4) / 4)
```

O código usa a seguinte regra:

- média >= 7,0 → aprovado;
- média < 7,0 → reprovado.

Isso é refletido na classe CSS do badge, que altera a cor do quadro de média.

## 📎 Observações importantes

- O projeto utiliza `mysqli`, que é o driver recomendado para conexão com MySQL em PHP.
- O charset é configurado com UTF-8 para suportar acentuação em nomes.
- A página é integrada ao banco em tempo real, então qualquer alteração nos dados reflete imediatamente na visualização.
- A interface foi pensada para uso em ambiente escolar e apresentação acadêmica.

## 👩‍🏫 Créditos

Projeto desenvolvido para a disciplina de Desenvolvimento de Sistemas, com foco em:

- PHP;
- MySQL;
- HTML e CSS;
- manipulação de dados em web;
- lógica de busca e classificação.

Desenvolvido por Filipe Berlanga.

## 📝 Licença

Este projeto foi criado para fins educacionais e de aprendizagem.

---

Se quiser, posso criar também uma versão mais profissional do README em inglês ou adaptar esse arquivo para um estilo de portfolio com capa, screenshots e instruções de instalação mais detalhadas.
