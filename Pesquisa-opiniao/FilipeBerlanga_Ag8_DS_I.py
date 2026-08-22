qtd_excelente = 0
qtd_ruim = 0

print("--- Pesquisa de Atendimento com Validação ---")

for i in range(50):
    print(f"\nEntrevistado nº {i + 1}:")
    nome = input("Digite o nome: ")

    # Trava para IDADE (apenas números inteiros)
    while True:
        idade_str = input("Digite a idade: ")
        if idade_str.isdigit(): # Verifica se a string contém apenas números
            idade = int(idade_str)
            break
        else:
            print("Erro: Por favor, digite um número inteiro válido para a idade.")

    # Trava para OPINIÃO (apenas 1, 2 ou 3)
    while True:
        print("Opinião: 1-EXCELENTE | 2-BOM | 3-RUIM")
        opiniao = input("Sua resposta: ")
        
        if opiniao in ['1', '2', '3']:
            break
        else:
            print("Erro: Opção inválida! Escolha entre 1, 2 ou 3.")

    # Processamento dos resultados
    if opiniao == '1':
        qtd_excelente += 1
    elif opiniao == '3':
        qtd_ruim += 1

# Exibição dos resultados finais
print("\n" + "="*30)
print("RESULTADO FINAL DA PESQUISA")
print("="*30)
print(f"Respostas EXCELENTE: {qtd_excelente}")
print(f"Respostas RUIM:      {qtd_ruim}")
print("="*30)