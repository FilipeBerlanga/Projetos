import colorama
from colorama import Fore, Back, Style, init
colorama.init(autoreset=True)

mensagens = ["Muito baixo", "Baixo", "Medio", "Alto", "Muito alto"]
cores = [Fore.RED, Fore.YELLOW, Fore.GREEN, Fore.CYAN, Fore.BLUE]   
    
for cor, msg in zip(cores, mensagens):
    print(cor + msg)