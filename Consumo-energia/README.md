# ⚡ Calculadora de Consumo de Energia Residencial

![Python](https://img.shields.io/badge/python-3670A0?style=for-the-badge&logo=python&logoColor=ffdd54)
![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)
![Status](https://img.shields.io/badge/Status-Em_Desenvolvimento-green?style=for-the-badge)

## 🎯 Objetivo do Sistema
Este sistema foi desenvolvido como parte do curso técnico de **Desenvolvimento de Sistemas (DS_1)**. O objetivo é auxiliar usuários a calcularem o consumo elétrico mensal de seus aparelhos domésticos e prever o custo na conta de luz, ajudando no controle de gastos residenciais.

## 🛠️ Tecnologias Utilizadas
* **Linguagem:** Python 3
* **Ambiente:** VS Code
* **Controle de Versão:** Git & GitHub

## 🧮 Lógica de Cálculo
O sistema utiliza a fórmula técnica padrão para conversão de Watts para Quilowatt-hora (kWh):

$$consumoMensal = \frac{potencia(W) \times horasDia \times 30}{1000}$$

O custo estimado é calculado multiplicando o `consumoMensal` por uma tarifa fixa de **R$ 0,75/kWh**.

## 🚀 Funcionalidades
- [x] Entrada de nome do aparelho.
- [x] Validação de dados (impede letras em campos numéricos).
- [x] Regra de Negócio: Impede digitação de mais de 24 horas por dia.
- [x] Formatação de saída com duas casas decimais.

## 📋 Como executar o programa
1. Certifique-se de ter o **Python** instalado em sua máquina.
2. Clone este repositório ou baixe o arquivo `App.py`.
3. Abra o terminal na pasta do projeto.
4. Execute o comando:
   ```bash
   python App.py