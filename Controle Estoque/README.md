# Sistema de Controle de Estoque | Madeira & Cia

![PHP](https://img.shields.io/badge/PHP-%3E%3D%207.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![Status](https://img.shields.io/badge/status-acad%C3%AAmico-2E7D32?style=for-the-badge)
![Idioma](https://img.shields.io/badge/idioma-pt--BR-009C3B?style=for-the-badge)

Aplicação web acadêmica para consulta e monitoramento do estoque da **Madeira & Cia Ltda.**. O sistema apresenta indicadores gerais, permite filtrar produtos por categoria ou nível crítico e identifica visualmente a situação de cada item por meio de badges.

> Projeto desenvolvido na disciplina de Desenvolvimento de Sistemas, com foco em arrays multidimensionais, funções com e sem retorno, estruturas de repetição, validação de entradas e integração entre PHP e HTML.

## Sumário

- [Funcionalidades](#funcionalidades)
- [Regras de status](#regras-de-status)
- [Tecnologias](#tecnologias)
- [Pré-requisitos](#pré-requisitos)
- [Como executar](#como-executar)
- [Como usar](#como-usar)
- [Validações e segurança](#validações-e-segurança)
- [Estrutura do projeto](#estrutura-do-projeto)
- [Limitações atuais](#limitações-atuais)
- [Autor](#autor)

## Funcionalidades

- Exibe o total de produtos cadastrados.
- Calcula o valor financeiro total do estoque, considerando preço unitário e quantidade.
- Mostra a quantidade de produtos em situação crítica.
- Filtra os produtos por categoria:
  - Madeiras;
  - Acabamentos;
  - Ferragens;
  - Adesivos;
  - Placas.
- Permite definir um limite personalizado para estoque crítico.
- Exibe somente os produtos críticos com um botão específico.
- Apresenta código, descrição, categoria, preço, quantidade e status de cada produto.
- Formata valores no padrão brasileiro, como `R$ 1.234,56`.
- Mantém a categoria e o limite selecionados após o envio do formulário.
- Possui layout responsivo e identidade visual inspirada no segmento de madeira e construção.
- Mostra uma seção reflexiva sobre as decisões de programação utilizadas no projeto.

## Regras de status

O status é calculado com base na quantidade disponível e no limite crítico informado:

| Condição                            | Status exibido      | Interpretação                    |
| ----------------------------------- | ------------------- | -------------------------------- |
| `quantidade <= limite`              | **Crítico (Repor)** | O produto precisa ser reposto.   |
| `limite < quantidade <= limite * 2` | **Atenção (Médio)** | O estoque merece acompanhamento. |
| `quantidade > limite * 2`           | **Estável (OK)**    | O estoque está em nível estável. |

O limite utilizado inicialmente é **10 unidades**. O cálculo financeiro geral considera todos os produtos cadastrados, mesmo quando a tabela está filtrada.

## Tecnologias

- **PHP 7.4+**: regras de negócio, validação, filtros e processamento do formulário.
- **HTML5**: estrutura da página e tabela de produtos.
- **CSS3**: layout, responsividade, cores, badges e estados visuais.
- **Google Fonts**: fonte Poppins carregada externamente.
- **Apache ou servidor embutido do PHP**: execução local.

## Pré-requisitos

- PHP 7.4 ou superior instalado.
- Navegador web atualizado.
- Apache via XAMPP ou acesso ao comando `php -S`.
- Conexão com a internet somente para carregar a fonte Poppins do Google Fonts.

## Como executar

### Servidor embutido do PHP

1. Abra o terminal na pasta `Controle Estoque`.
2. Inicie o servidor local:

   ```bash
   php -S localhost:8000
   ```

3. Acesse [http://localhost:8000/controle_estoque.php](http://localhost:8000/controle_estoque.php).

### XAMPP

1. Copie a pasta `Controle Estoque` para `C:\xampp\htdocs\`.
2. Inicie o módulo **Apache** no painel do XAMPP.
3. Acesse no navegador:

   ```text
   http://localhost/Controle%20Estoque/controle_estoque.php
   ```

## Como usar

1. Consulte os indicadores no topo da página.
2. Informe o limite desejado para estoque crítico.
3. Escolha uma categoria ou mantenha **Todas as Categorias**.
4. Clique em **Aplicar Filtros** para visualizar a combinação selecionada.
5. Use **Exibir Apenas Críticos** para listar somente os produtos cuja quantidade esteja no limite definido.
6. Analise as badges de status na coluna **Status**.

## Validações e segurança

- O limite é recebido por `POST` e validado como valor numérico inteiro não negativo no backend.
- O campo visual do formulário aceita valores entre 1 e 100.
- Entradas de categoria, nome de produto e mensagens exibidas na tabela passam por `htmlspecialchars()` antes da renderização.
- Quando o limite enviado é inválido, o sistema informa o problema e utiliza o valor padrão de 10.
- O sistema não realiza persistência de dados nem possui autenticação.

## Estrutura do projeto

```text
Controle Estoque/
├── controle_estoque.php       # Aplicação, dados, regras, HTML e CSS
├── Mapa_mental_AG4_DS2.png     # Material visual de apoio do projeto
└── README.md                   # Documentação
```

## Limitações atuais

- Os oito produtos são definidos diretamente em um array PHP.
- Não há banco de dados, cadastro, edição ou exclusão de produtos.
- As alterações feitas nos filtros valem apenas para a requisição atual.
- O arquivo concentra backend, HTML e CSS em uma única página.

## Contexto acadêmico

O projeto demonstra o uso de `foreach`, arrays multidimensionais, funções tipadas com retorno (`float` e `array`), função `void`, condicionais, requisições `POST`, tratamento de valores monetários e construção de uma interface web responsiva.

## Autor

**Filipe Berlanga**
