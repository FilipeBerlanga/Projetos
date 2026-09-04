# Diário de Classe - Notas do 8º Ano A

[![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)](https://developer.mozilla.org/pt-BR/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)](https://developer.mozilla.org/pt-BR/docs/Web/CSS)
[![Status](https://img.shields.io/badge/status-acad%C3%AAmico%20%7C%20funcional-2ea44f)](#status)
[![License](https://img.shields.io/badge/licen%C3%A7a-n%C3%A3o%20definida-lightgrey)](#licenca)

Aplicação web acadêmica desenvolvida em PHP para exibir o desempenho dos alunos do 8º Ano A. O sistema calcula automaticamente as médias finais, ordena os estudantes por desempenho e apresenta os resultados em uma tabela com indicação visual de aprovação ou reprovação.

## Visão geral

O projeto simula um diário de classe simples para uma turma da **Escola Primária de Springfield**. Os dados dos alunos são mantidos em um array bidimensional no próprio arquivo PHP, sem necessidade de banco de dados.

### Funcionalidades

- Cadastro demonstrativo de alunos e notas dos quatro bimestres.
- Cálculo automático da média final de cada aluno.
- Arredondamento das médias para uma casa decimal.
- Ordenação da turma da maior para a menor média.
- Cálculo da média geral da turma.
- Destaque visual para alunos aprovados e reprovados.
- Formatação de notas no padrão brasileiro, com vírgula decimal.
- Layout visual responsivo com HTML e CSS.
- Escape do nome dos alunos com `htmlspecialchars()` antes da renderização.

## Regra de cálculo

A média final é calculada pela média aritmética simples das quatro notas bimestrais:

```text
média final = (nota 1 + nota 2 + nota 3 + nota 4) / 4
```

O critério utilizado na interface é:

| Média final          | Situação  |
| -------------------- | --------- |
| Maior ou igual a 6,0 | Aprovado  |
| Menor que 6,0        | Reprovado |

## Tecnologias

- **PHP**: processamento dos dados e geração dinâmica do HTML.
- **HTML5**: estrutura da página e da tabela de notas.
- **CSS3**: layout, cores, tipografia e estados visuais.
- **Google Fonts**: carregamento da fonte Poppins via CDN.

## Pré-requisitos

- PHP 7.4 ou superior.
- XAMPP, WampServer ou outro servidor web compatível com PHP.
- Navegador atualizado.
- Acesso à internet apenas para carregar a fonte Poppins do Google Fonts.

## Como executar

### Com XAMPP

1. Copie ou mantenha a pasta do projeto dentro de `htdocs`.
2. Inicie o módulo **Apache** no painel do XAMPP.
3. Abra no navegador:

   ```text
   http://localhost/Desenvolvimento-sistema/Notas%208%20ano%20A/notas8A.php
   ```

### Com o servidor embutido do PHP

No terminal, dentro da pasta do projeto, execute:

```bash
php -S localhost:8000
```

Depois acesse:

```text
http://localhost:8000/notas8A.php
```

## Estrutura do projeto

```text
Notas 8 ano A/
├── notas8A.php       # Aplicação principal
├── README.md         # Documentação do projeto
└── FilipeBerlanga_AG5_DS2.pdf  # Material acadêmico relacionado
```

## Personalização

Para alterar os dados exibidos, edite o array `$alunos` no início de `notas8A.php`. Cada registro deve conter um nome e exatamente quatro notas:

```php
[
    "nome" => "Nome do aluno",
    "notas" => [7.5, 8.0, 6.5, 9.0]
]
```

O cálculo das médias, a ordenação e a renderização da tabela serão atualizados automaticamente.

## Status

Projeto acadêmico funcional, executado de forma local e sem persistência em banco de dados.

## Melhorias futuras

- Separar a apresentação em arquivos de template e estilos.
- Adicionar formulário para inclusão e edição de alunos.
- Persistir os dados em um banco de dados.
- Criar filtros por nome e situação.
- Adicionar testes automatizados para o cálculo das médias.
- Implementar autenticação para acesso de professores e administradores.

## Licença

Nenhuma licença de distribuição foi definida para este projeto. Consulte o autor antes de reutilizar ou publicar o código.

---

Desenvolvido por **Joseph** como projeto acadêmico de desenvolvimento web.
