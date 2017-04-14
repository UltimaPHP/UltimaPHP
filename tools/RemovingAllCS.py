import os, sys

'''
    Fiz essa função para remover todos os arquivos .cs da pasta do RunUO depois da conversão
'''
def RemoveFiles(subDir=None):
    extensions = ['cs']
    root = 'C:\\runuo-master\\Scripts'
    runUOdir = "C:\\runuo-master\\Scripts"
    listFilesPath = []

    if sys.argv[1].lower() == "items":
        root += "\\Items"
        listDir = os.listdir(runUOdir)        
    elif sys.argv[1].lower() == "mobiles":
        root += "\\Mobiles"
        listDir = os.listdir(runUOdir)
    else:
        listDir = os.listdir(sys.argv[1])
        
    walk_gen = os.walk(root)
    for root,dirs,files in walk_gen:
        for cur_file in files:
            if cur_file.endswith('cs'):
                os.remove(os.path.join(root,cur_file))
                


if __name__ == "__main__":
    if sys.argv == None:
        print("Digite items ou mobiles ex: RunUOtoUltimaPHP.py items \n Com isso ja vai exportar todos os scripts.")
    
    RemoveFiles()