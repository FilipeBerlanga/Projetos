# 🤝 Pesquisa de Atendimento com Validação

![Python](https://img.shields.io/badge/python-3670A0?style=for-the-badge&logo=python&logoColor=ffdd54)
![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)

## 🎯 Objetivo do Sistema

Este sistema foi desenvolvido como parte do curso técnico de Desenvolvimento de Sistemas (DS_1). O objetivo é auxiliar na coleta de uma **pesquisa de satisfação de atendimento**, registrando nome, idade e opinião dos entrevistados com validações para garantir a consistência dos dados.

O programa entrevista **50 pessoas**.

## 🛠️ Tecnologias Utilizadas

- Linguagem: Python 3
- Ambiente: VS Code
- Controle de Versão: Git & GitHub

## 🧮 Lógica de Cálculo / Validação

O sistema aplica validações simples para manter a qualidade dos dados:

- **Idade**: permite apenas números inteiros.  
- **Opinião**: aceita apenas `1`, `2` ou `3`.

A partir das respostas, o script conta automaticamente as avaliações:

- `1` → EXCELENTE  
- `2` → BOM  
- `3` → RUIM

O relatório final exibe a soma de respostas **EXCELENTE** e **RUIM**.

## 🚀 Funcionalidades

- Entrada de nome do entrevistado.
- Validação de dados numéricos (impede letras em campos numéricos).
- Validação de opções de opinião (só `1`, `2` ou `3`).
- Relatório final com contagem de respostas `EXCELENTE` e `RUIM`.
- Estrutura simples para exibição no console.

## 📋 Como executar o programa

1. Certifique-se de ter o Python instalado em sua máquina.
2. Clone este repositório ou baixe o arquivo `FilipeBerlanga_Ag8_DS_I.py`.
3. Abra o terminal na pasta do projeto.
4. Execute o comando:

```bash
python FilipeBerlanga_Ag8_DS_I.py
```

## 📌 Observações

- O projeto não salva dados em arquivo; todos os resultados são exibidos no console.
- Caso queira alterar a quantidade de entrevistas, ajuste o valor do laço `for` no arquivo `FilipeBerlanga_Ag8_DS_I.py`.

## 📂 Estrutura do Repositório

- `FilipeBerlanga_Ag8_DS_I.py` — script principal.
- `README.md` — documentação do projeto.
