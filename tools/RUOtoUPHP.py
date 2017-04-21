import os, sys, re


items = False

'''
    Lista todos os arquivos e suas respectivas subpastas
'''
def ListFiles(subDir=None):
    global items
    extensions = ['cs']
    root = runUOdir = 'C:\\runuo-master\\Scripts'
    
    listFilesPath = []

    if sys.argv[1].lower() == "items":
        items = True
        root += "\\Items"
        listDir = os.listdir(runUOdir)        
    elif sys.argv[1].lower() == "mobiles":
        root += "\\Mobiles"
        listDir = os.listdir(runUOdir)
    else:
        listDir = os.listdir(sys.argv[1])
        
    walk_gen = os.walk(root)
    for root,dirs,files in walk_gen:
        for ext in extensions:
            images = [os.sep.join([root, cur_file]) for cur_file in files if cur_file.endswith('.{0}'.format(ext))]
            if images:
                if items:
                    readItemsFiles(root, images)
                else:                                         
                    readMobilesFiles(root, images)                    

'''
    Recebe a raiz completa do RunUO e a lista de todos os arquivos, le cada um linha por linha e 
    preenche todo o dicionario quando ele verifica baseid e name nao estao com valores default 
    ele envia para a proxima funcao
'''
def readMobilesFiles(path, filesList):
    mobileProperty = propriedades = {'name': '', 'body': 0,
                   'basesoundid': 0x00, 'str': 0,
                   'dex': 0, 'int': 0,
                   'hits': 0, 'maxhits': 0, 'damage_min': 0,
                   'damage_max': 0, 'resist_physical': 0,
                   'resist_fire': 0, 'resist_cold': 0,
                   'resist_poison': 0, 'resist_energy': 0,
                   'fame': 0, 'karma': 0, 'virtualarmor': 0}

    
    try:
        for file in filesList:
            if file != path+"\PlayerMobile.cs" and file != path+"\BaseCreature.cs":                
                arquivo = open(file,'r')
                print(file)
                for readLine in arquivo:
                    if re.search(r'Name = ', readLine, re.IGNORECASE):
                        m = re.search(r'\"(\w+)\"', readLine, re.IGNORECASE)
                        if m != None:                        
                            propriedades['name'] = m.group(1)
                    if re.search(r'Body', readLine, re.IGNORECASE):
                        if re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE):
                            m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)
                            if m != None:
                                propriedades['body'] = 'Functions::RandomList(array('+m.group(1)+', '+m.group(2)+'))'
                        elif re.search(r'= (\d+)', readLine, re.IGNORECASE):
                            n = re.search(r'= (\d+)', readLine, re.IGNORECASE)
                            if n != None:
                                propriedades['body'] = n.group(1)
                        elif re.search(r'(0x[0-9a-fA-F]+),(0x[0-9a-fA-F]+)', readLine, re.IGNORECASE):
                            o = re.search(r'(0x[0-9a-fA-F]+)\, (0x[0-9a-fA-F]+)', readLine, re.IGNORECASE)
                            if o != None:
                                    propriedades['body'] = 'Functions::RandomList(array('+o.group(1)+', '+o.group(2)+'))'
                        elif re.search(r'0x[0-9a-fA-F]+', readLine, re.IGNORECASE):
                            p = re.search(r'0x[0-9a-fA-F]+', readLine, re.IGNORECASE)
                            if p != None:
                                    propriedades['body'] = p.group(0)
                    elif re.search(r'BaseSoundID', readLine, re.IGNORECASE):                    
                        m = re.search(r'0x[0-9a-fA-F]+', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['basesoundid'] = m.group(0)
                    elif re.search(r'SetStr', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['str'] = 'rand('+m.group(1)+', '+m.group(2)+')'
                    elif re.search(r'SetDex', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['dex'] = 'rand('+m.group(1)+', '+m.group(2)+')'
                    elif re.search(r'SetInt', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['int'] = 'rand('+m.group(1)+', '+m.group(2)+')'
                    elif re.search(r'SetDamage', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['damage_min'] = m.group(1)
                            propriedades['damage_max'] = m.group(2)
                    elif re.search(r'ResistanceType.Physical, ', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)                        
                        if m != None:
                            propriedades['resist_physical'] = 'rand('+m.group(1)+', '+m.group(2)+')'
                    elif re.search(r'ResistanceType.Fire', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['resist_fire'] = 'rand('+m.group(1)+', '+m.group(2)+')'
                    elif re.search(r'ResistanceType.Cold', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['resist_cold'] = 'rand('+m.group(1)+', '+m.group(2)+')'
                    elif re.search(r'ResistanceType.Poison', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['resist_poison'] = 'rand('+m.group(1)+', '+m.group(2)+')'
                    elif re.search(r'ResistanceType.Energy', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)\, (\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['resist_energy'] = 'rand('+m.group(1)+', '+m.group(2)+')'
                    elif re.search(r'Fame =', readLine, re.IGNORECASE):
                        m = re.search(r'(\-?\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['fame'] = m.group(0)
                        else:
                            n = re.search(r'(\d+)', readLine, re.IGNORECASE)
                            if n != None:
                                propriedades['fame'] = m.group(0)
                    elif re.search(r'Karma =', readLine, re.IGNORECASE):
                        m = re.search(r'(\-?\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['karma'] = m.group(0)
                        else:
                            n = re.search(r'(\d+)', readLine, re.IGNORECASE)
                            if n != None:
                                propriedades['karma'] = m.group(0)
                    elif re.search(r'VirtualArmor = ', readLine, re.IGNORECASE):
                        m = re.search(r'(\d+)', readLine, re.IGNORECASE)
                        if m != None:
                            propriedades['virtualarmor'] = m.group(0)                            

                if propriedades['name'] != "" and propriedades['name'] != "male" and propriedades['name'] != "female":                        
                    convertData(path, propriedades)
                    propriedades = mobileProperty

    except ValueError as er:
        print(er)


'''
    Recebe a raiz completa do RunUO e a lista de todos os arquivos, le cada um linha por linha e 
    preenche todo o dicionario quando ele verifica baseid e name nao estao com valores default 
    ele envia para a proxima funcao
'''
def readItemsFiles(path, filesList):
    proprieadesStart = propriedades = {'name': '', 'weight': 0,
                   'baseid': 0x00, 'initmaxhits': 0,
                   'initminhits': 0, 'defmisssound': 0,
                   'defhitsound': 0, 'oldspeed': 0,
                   'oldmaxdamage': 0, 'oldmindamage': 0,
                   'oldstrengthreq': 0, 'mlspeed': 0,
                   'aosspeed': 0, 'aosmaxdamage': 0,
                   'aosmindamage': 0, 'aosstrengthreq': 0,
                   'hue': 0x00}

    
    try:
        for file in filesList:
            arquivo = open(file,'r')
            for readLine in arquivo:
                if re.search(r'public class ', readLine, re.IGNORECASE):
                    m = re.search(r'class (\w+)', readLine, re.IGNORECASE)
                    if m != None:                        
                        propriedades['name'] = m.group(1)
                if re.search(r'weight', readLine, re.IGNORECASE):
                    m = re.search(r'= (\d+\.\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['weight'] = m.group(1)
                elif re.search(r'base\( ', readLine, re.IGNORECASE):                    
                    m = re.search(r'0x[0-9a-fA-F]+', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['baseid'] = m.group(0)
                elif re.search(r'InitMaxHits', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['initmaxhits'] = m.group(1)
                elif re.search(r'InitMinHits', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['initminhits'] = m.group(1)
                elif re.search(r'DefMissSound', readLine, re.IGNORECASE):
                    m = re.search(r'0x[0-9a-fA-F]+', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['defmisssound'] = m.group(0)
                elif re.search(r'DefHitSound', readLine, re.IGNORECASE):
                    m = re.search(r'0x[0-9a-fA-F]+', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['defhitsound'] = m.group(0)
                elif re.search(r'OldSpeed', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['oldspeed'] = m.group(1)
                elif re.search(r'OldMaxDamage', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['oldmaxdamage'] = m.group(1)
                elif re.search(r'OldMinDamage', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['oldmindamage'] = m.group(1)
                elif re.search(r'OldStrengthReq', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['oldstrengthreq'] = m.group(1)
                elif re.search(r'MlSpeed', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['mlspeed'] = m.group(1)
                elif re.search(r'AosSpeed', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['aosspeed'] = m.group(1)
                elif re.search(r'AosMaxDamage', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['aosmaxdamage'] = m.group(1)
                elif re.search(r'AosMinDamage', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['aosmindamage'] = m.group(1)
                elif re.search(r'AosStrengthReq', readLine, re.IGNORECASE):
                    m = re.search(r'return (\d+)', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['aosstrengthreq'] = m.group(1)
                elif re.search(r'Hue =', readLine, re.IGNORECASE):
                    m = re.search(r'0x[0-9a-fA-F]+', readLine, re.IGNORECASE)
                    if m != None:
                        propriedades['hue'] = m.group(0)
                if propriedades['name'] != "" and propriedades['baseid'] != 0x00:
                    convertData(path, propriedades)
                    propriedades = proprieadesStart
    except ValueError as er:
        print(er)

def criaEspaco(string):
    m = re.split(r'([A-Z][a-z]+)', string)

    word = ""
    count_words = 0
    for sil in m[:-1]:
        count_words += 1
        if sil != "" and count_words < len(m[:-1]):
            word += sil + " "
        elif sil != "" and count_words == len(m[:-1]):
            word += sil

    return word
    #print(m.group(0).replace(m.group(0),m.group(0)+" "))

'''
    Recebe o dicionario preenchido e a raiz do arquivo de origem, assim ele cria o arquivo .php
    na mesma pasta do original .cs
'''
def convertData(path, readLine):
    global items

    if items:
        item_php_template = '<?php\n\n'\
        '/**\n'\
        '* Ultima PHP - OpenSource Ultima Online Server written in PHP\n'\
        '* Version: 0.1 - Pre Alpha\n'\
        '*/\n\n'\
        'class '+readLine['name'].lower()+' extends Object {\n'\
        '	public function build() {\n'\
        '		$this->name = \"'+criaEspaco(readLine['name']).lower()+'\";\n'\
        '		$this->graphic = '+str(readLine['baseid'])+';\n'\
        '		$this->type = "";\n'\
        '		$this->flags = 0x00;\n'\
        '		$this->value = 0;\n'\
        '		$this->amount = 1;\n'\
        '		$this->color = '+str(readLine['hue'])+';\n'\
        '		$this->aosstrengthreq = '+str(readLine['aosstrengthreq'])+';\n'\
        '		$this->aosmindamage = '+str(readLine['aosmindamage'])+';\n'\
        '		$this->aosmaxdamage = '+str(readLine['aosmaxdamage'])+';\n'\
        '		$this->aosspeed = '+str(readLine['aosspeed'])+';\n'\
        '		$this->mlspeed = '+str(readLine['mlspeed'])+';\n'\
        '		$this->oldstrengthreq = '+str(readLine['oldstrengthreq'])+';\n'\
        '		$this->oldmindamage = '+str(readLine['oldmindamage'])+';\n'\
        '		$this->oldspeed = '+str(readLine['oldspeed'])+';\n'\
        '		$this->defhitsound = '+str(readLine['defhitsound'])+';\n'\
        '		$this->defmisssound = '+str(readLine['defmisssound'])+';\n'\
        '		$this->hits = '+str(readLine['initminhits'])+';\n'\
        '		$this->maxHits = '+str(readLine['initmaxhits'])+';\n'\
        '		$this->weight = '+str(readLine['weight'])+';\n\n'\
        '}}\n?>\n'
    else:
        mobile_php_template = '<?php\n\n'\
        '/**\n'\
        '* Ultima PHP - OpenSource Ultima Online Server written in PHP\n'\
        '* Version: 0.1 - Pre Alpha\n'\
        '*/\n\n'\
        'class '+readLine['name'].lower()+' extends Mobile {\n'\
        '	public function summon() {\n'\
        '		$this->name = \"'+readLine['name'].lower()+'\";\n'\
        '		$this->body = '+str(readLine['body'])+';\n'\
        '		$this->type = "";\n'\
        '		$this->flags = 0x00;\n'\
        '		$this->color = 0x00;\n'\
        '		$this->basesoundid = '+str(readLine['basesoundid'])+';\n'\
        '		$this->str = '+str(readLine['str'])+';\n'\
        '		$this->dex = '+str(readLine['dex'])+';\n'\
        '		$this->int = '+str(readLine['int'])+';\n'\
        '		$this->hits = '+str(readLine['hits'])+';\n'\
        '		$this->maxhits = '+str(readLine['maxhits'])+';\n'\
        '		$this->damage_min = '+str(readLine['damage_min'])+';\n'\
        '		$this->damage_max = '+str(readLine['damage_max'])+';\n'\
        '		$this->resist_physical = '+str(readLine['resist_physical'])+';\n'\
        '		$this->resist_fire = '+str(readLine['resist_fire'])+';\n'\
        '		$this->resist_cold = '+str(readLine['resist_cold'])+';\n'\
        '		$this->resist_poison = '+str(readLine['resist_poison'])+';\n'\
        '		$this->resist_energy = '+str(readLine['resist_energy'])+';\n'\
        '		$this->karma = '+str(readLine['karma'])+';\n'\
        '		$this->fame = '+str(readLine['fame'])+';\n'\
        '		$this->virtualarmor = '+str(readLine['virtualarmor'])+';\n\n'\
        '}}\n?>\n'

    
    fileCreated = open(path+'\\'+readLine['name']+'.php','w')    
    print(path+'\\'+readLine['name']+'.php')
    if items:
        fileCreated.write(item_php_template)
    else:
        fileCreated.write(mobile_php_template)
    fileCreated.close()

if __name__ == "__main__":
    if sys.argv == None:
        print("Digite items ou mobiles ex: RunUOtoUltimaPHP.py items \n Com isso ja vai exportar todos os scripts.")
    
    ListFiles()