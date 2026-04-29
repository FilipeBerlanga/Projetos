# 💧 Sistema de Controle de Níveis de Água

<div align="center">

![Python](https://img.shields.io/badge/Python-3.8+-blue?style=flat-square&logo=python)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)
![Status](https://img.shields.io/badge/Status-Active-success?style=flat-square)
![Maintenance](https://img.shields.io/maintenance/yes/2026?style=flat-square)

**Um programa educacional para demonstração visual de níveis de água com saída colorida em terminal**

</div>

---

## 📋 Descrição

O **Sistema de Controle de Níveis de Água** é um programa Python que exibe de forma visual e colorida os diferentes níveis de água, variando de "Muito baixo" até "Muito alto". Utiliza a biblioteca `colorama` para apresentar as mensagens em cores distintas no terminal, melhorando a clareza e compreensão dos dados.

### 🎯 Objetivo

Demonstrar o monitoramento de níveis de água através de um sistema de classificação visual com código de cores intuitivo para fácil identificação do status.

---

## 🚀 Características

- ✅ Classificação automática de 5 níveis de água
- 🎨 Código de cores intuitivo:
  - 🔴 **Vermelho** - Muito baixo
  - 🟡 **Amarelo** - Baixo
  - 🟢 **Verde** - Médio
  - 🔵 **Ciano** - Alto
  - 🟦 **Azul** - Muito alto
- 💻 Interface simples e direta no terminal
- 📦 Dependências mínimas

---

## 📦 Requisitos

- **Python**: 3.8 ou superior
- **Bibliotecas**:
  - `colorama` - Para suporte a cores ANSI no terminal

---

## 🔧 Instalação

### 1. Clone ou baixe o repositório

```bash
git clone https://github.com/FilipeBerlanga/Projetos.git
cd "Controle de Níveis de Água"
```

### 2. Instale as dependências

```bash
pip install colorama
```

Ou use o arquivo `requirements.txt` (se disponível):

```bash
pip install -r requirements.txt
```

---

## 💡 Como Usar

### Execução Básica

```bash
python Nivel_agua.py
```

### Saída Esperada

```
Muito baixo
Baixo
Medio
Alto
Muito alto
```

*(As mensagens aparecerão em cores diferentes conforme especificado)*

---

## 📄 Estrutura do Código

```python
import colorama
from colorama import Fore, Back, Style, init

# Inicializa o colorama com auto-reset
colorama.init(autoreset=True)

# Definição dos níveis de água
mensagens = ["Muito baixo", "Baixo", "Medio", "Alto", "Muito alto"]

# Cores correspondentes a cada nível
cores = [Fore.RED, Fore.YELLOW, Fore.GREEN, Fore.CYAN, Fore.BLUE]

# Exibição colorida
for cor, msg in zip(cores, mensagens):
    print(cor + msg)
```

---

## 🎓 Conceitos Demonstrados

- **Iteração com `zip()`**: Combinação de duas listas para iteração sincronizada
- **Manipulação de Cores ANSI**: Utilização da biblioteca `colorama`
- **Formatação de Terminal**: Personalização de saída em console
- **Boas práticas Python**: Código limpo e legível

---

## 📚 Bibliotecas Utilizadas

| Biblioteca | Versão | Propósito                        |
| ---------- | ------ | -------------------------------- |
| `colorama` | 0.4.6+ | Suporte a cores ANSI no terminal |

---

## 🔄 Possíveis Extensões

- 📊 Integração com sensores reais de nível de água
- 💾 Armazenamento de histórico de leituras
- 📈 Gráficos de tendência ao longo do tempo
- 🔔 Sistema de alertas para níveis críticos
- 🌐 Interface web para visualização remota

---

## 📝 Notas de Desenvolvimento

- O programa foi desenvolvido como parte de um projeto educacional
- Usa a abordagem simples de mapeamento cor-mensagem para fins demonstrativos
- Pode ser facilmente adaptado para integração com sistemas reais de monitoramento

---

## 👨‍💻 Autor

**Filipe Berlanga**

- GitHub: [@FilipeBerlanga](https://github.com/FilipeBerlanga)

---

## 📄 Licença

Este projeto está licenciado sob a **Licença MIT** - veja detalhes no arquivo [LICENSE](LICENSE) para mais informações.

---

## 🤝 Contribuições

Contribuições são bem-vindas! Por favor:

1. Faça um **Fork** do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um **Pull Request**

---

## 📧 Contato

Para dúvidas ou sugestões, entre em contato através do GitHub ou crie uma **Issue** no repositório.

---

<div align="center">

⭐ Se este projeto foi útil para você, considere deixar uma estrela! ⭐

</div>
