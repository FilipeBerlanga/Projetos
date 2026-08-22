# Madeira & Cia Ltda.

![PHP](https://img.shields.io/badge/PHP-%3E%3D%207.4-777BB4?logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-D22128?logo=apache&logoColor=white)
![Idioma](https://img.shields.io/badge/idioma-pt--BR-009C3B)

Aplicação web acadêmica desenvolvida em PHP para a promoção de aniversário da **Madeira & Cia Ltda.**. A página coleta os dados básicos de uma compra, aplica o desconto correspondente à forma de pagamento e apresenta o valor final em reais, no padrão brasileiro.

## Sumário

- [Funcionalidades](#funcionalidades)
- [Regras de desconto](#regras-de-desconto)
- [Tecnologias](#tecnologias)
- [Pré-requisitos](#pré-requisitos)
- [Como executar](#como-executar)
- [Como usar](#como-usar)
- [Validações](#validações)
- [Estrutura do projeto](#estrutura-do-projeto)
- [Observações](#observações)

## Funcionalidades

- Formulário para nome do cliente, valor da compra e forma de pagamento.
- Envio dos dados pelo método `POST`.
- Validação de campos obrigatórios.
- Validação de valores numéricos maiores que zero.
- Cálculo automático do desconto e do valor líquido a pagar.
- Formatação monetária no padrão brasileiro (`R$ 1.234,56`).
- Mensagens de sucesso e erro exibidas na própria página.
- Layout responsivo com CSS integrado ao arquivo PHP.
- Seção explicativa sobre as decisões de desenvolvimento e a lógica aplicada.

## Regras de desconto

| Forma de pagamento | Desconto | Resultado        |
| ------------------ | :------: | ---------------- |
| Depósito bancário  |   10%    | Compra menos 10% |
| Boleto bancário    |    8%    | Compra menos 8%  |
| Cartão de crédito  |    0%    | Valor integral   |

O cálculo utilizado é:

```text
desconto = valor da compra x taxa de desconto
valor final = valor da compra - desconto
```

## Tecnologias

- **PHP**: processamento do formulário, validação e cálculo.
- **HTML5**: estrutura semântica da página e do formulário.
- **CSS3**: layout, responsividade, cores e estados visuais.
- **Apache**: servidor web recomendado para execução local via XAMPP.
- **Google Fonts**: fonte Poppins carregada externamente.

## Pré-requisitos

- PHP 7.4 ou superior.
- XAMPP com o Apache habilitado, ou outro servidor PHP compatível.
- Navegador web atualizado.
- Acesso à internet caso queira carregar a fonte Poppins do Google Fonts.

## Como executar

### Com XAMPP

1. Copie ou mantenha a pasta do projeto dentro de `C:\xampp\htdocs\`.
2. Abra o painel de controle do XAMPP.
3. Inicie o módulo **Apache**.
4. Acesse no navegador:

   ```text
   http://localhost/Desenvolvimento-sistema/DS2_AG3/
   ```

### Com o servidor embutido do PHP

No terminal, dentro da pasta do projeto, execute:

```bash
php -S localhost:8000
```

Depois, abra [http://localhost:8000](http://localhost:8000) no navegador.

## Como usar

1. Informe o nome completo do cliente.
2. Digite o valor da compra usando um número positivo.
3. Selecione a forma de pagamento.
4. Clique em **Processar e Calcular**.
5. Confira o desconto aplicado, a economia obtida e o valor final.

### Exemplo

Para uma compra de `R$ 1.000,00` paga via depósito:

- Desconto: `R$ 100,00`.
- Valor final: `R$ 900,00`.

## Validações

A aplicação rejeita o envio quando:

- algum campo obrigatório está vazio;
- o valor da compra não é numérico;
- o valor da compra é menor ou igual a zero;
- a forma de pagamento não corresponde a uma opção válida.

O nome informado também passa por remoção de espaços excedentes e escape HTML antes de ser exibido novamente na página.

## Estrutura do projeto

```text
DS2_AG3/
└── index.php    # Interface, estilos, validações e regras de negócio
```

## Observações

- O projeto não utiliza banco de dados, dependências externas instaladas ou arquivos de configuração.
- Os dados são processados somente durante a requisição e não são armazenados.
- A fonte Poppins depende de uma conexão externa; sem internet, o navegador usará a fonte alternativa definida pelo CSS.
- O arquivo reúne PHP, HTML e CSS para manter a proposta simples e adequada ao exercício acadêmico.

## Contexto acadêmico

Projeto desenvolvido para a disciplina **DS2**, com foco em estruturas condicionais, validação de entrada, cálculo de descontos, formatação de valores monetários e construção de um formulário web responsivo.

## Autor

**Filipe Berlanga**
