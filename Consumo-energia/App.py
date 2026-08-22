def obter_valor(mensagem):
    while True:
        try:
            # O 'try' tenta executar a conversao
            return float(input(mensagem))
        except ValueError:
            # Se o usuario nao digitar numeros, o programa cai aqui em vez de travar
            print("Erro: Digite apenas números (use ponto para decimais, ex: 10.5)")

# funçao principal
aparelho = input("Nome do aparelho: ")
potencia = obter_valor(f"Digite a potência do(a) {aparelho} em Watts (W): ")

def obter_horas():
    while True:
        try:
            valor = float(input("Digite o tempo médio de uso diário em horas: "))
            
            # Validaçao da regra de 24 horas
            if valor > 24:
                print("Erro: O dia tem apenas 24 horas! Digite um valor entre 0 e 24.")
            elif valor < 0:
                print("Erro: O tempo de uso não pode ser negativo.")
            else:
                return valor  # So sai do loop se for um numero valido E entre 0 e 24
                
        except ValueError:
            print("Erro: Digite apenas números (use ponto para decimais, ex: 1.5).")


horas = obter_horas()

# Calculos
consumo = (potencia * horas * 30) / 1000
custo = consumo * 0.75

print(f"\nAparelho: {aparelho}")
print(f"Consumo: {consumo:.2f} kWh/mês")
print(f"Custo: R$ {custo:.2f}")