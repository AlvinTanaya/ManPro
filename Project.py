import random as rand
import math

# INPUT RANGE JARAK
daftar_jarak = []
daftar_jarak.append([1,4])
daftar_jarak.append([5,10])
daftar_jarak.append([11,16])
daftar_jarak.append([17,25])

# INPUT TOTAL TRUK, LOADING TIME, DAN PERSENTASE
total_truk = 10
waktu_loading = 3
persentase_truk = [20, 10 , 30, 40]
total = 0
simulasi = True
for i in range(0,len(persentase_truk)):
    total+= persentase_truk[i]
if total > 100:
    print("Total persentase lebih dari 100%")
    simulasi = False
elif total < 100:
    print("Total persentase kurang dari 100%")
    simulasi = False

# INPUT JUMLAH GUDANG
jumlah_gudang = 4

# INPUT KEKHUSUSAN GUDANG
kekhususan_gudang = [[0,1,2,3], [0], [1], [3]]

# INPUT DURASI SIMULASI DIJALANKAN
durasi_simulasi = 50


class Gudang:
    
    def __init__(self, kriteria) -> None:
        self.kriteria = kriteria
        self.wait_list = []
        self.current_waktu_tunggu = 0
        self.total_waktu_tunggu = 0
        self.daftar_truk = []
        
    def cekWaitList(self):
        if len(self.wait_list) > 0:
            if self.current_waktu_tunggu < 1:
                self.loadingMuatan(self.wait_list.pop())
        
    def loadingMuatan(self, truk):
        self.daftar_truk.append(truk.getID())
        self.current_waktu_tunggu += truk.waktu_loading
        
    def masukWaitList(self, truk):
        self.wait_list.append(truk)
        
        
    def timeTick(self):
        if self.current_waktu_tunggu > 0 : self.current_waktu_tunggu -= 1
        if self.total_waktu_tunggu > 0 : self.total_waktu_tunggu -= 1
        
class Truk:
    
    def __init__(self, id, index_jarak, jarak, waktu_loading) -> None:
        self.id = id
        self.index_jarak = index_jarak
        self.jarak = jarak
        self.waktu_loading = waktu_loading
        
    def getID(self):
        return self.id
    
    def printInfo(self):
        print(self.id, self.index_jarak, self.jarak, self.waktu_loading)
    
    
# MENJALANKAN PROSES BERDASARKAN INPUT

# menambahkan gudang
daftar_gudang = []
for i in range(0, jumlah_gudang):
    daftar_gudang.append(Gudang(kekhususan_gudang[i]))

# menentukan jumlah truk dari setiap
jumlah_truk = []
for i in range(0, len(persentase_truk)):
    jumlah = (persentase_truk[i] / 100) * total_truk
    if jumlah % 1 > 0.5: jumlah = math.floor(jumlah) + 1
    else : jumlah = math.floor(jumlah)
    jumlah_truk.append(jumlah)

# randomize jarak truk berdasarkan range nya
daftar_truk = []
id = 1
for i in range(0, len(jumlah_truk)):
    for j in range(0, jumlah_truk[i]):
        daftar_truk.append(Truk(id, i, rand.randint(daftar_jarak[i][0], daftar_jarak[i][1]), waktu_loading))
        id += 1

# menjalankan simulasi sesuai dengan waktu simulasi
durasi = 0
daftar_tolak = []
while simulasi and durasi < durasi_simulasi:
    
    # mengecek apakah ada truk yang sudah selesai melakukan loading
    for i in range(0, len(daftar_gudang)):
        daftar_gudang[i].cekWaitList()
    
    # mengecek apakah sudah ada truk yang datang
    arrival_truk = []
    for i in range(0, len(daftar_truk)):
        if daftar_truk[i].jarak == durasi:
            arrival_truk.append(daftar_truk[i])
    
    # memproses truk yang sudah datang
    for i in range(0, len(arrival_truk)):
        jarak = arrival_truk[i].index_jarak
        # cek gudang
        waktu_tunggu = durasi_simulasi
        index_gudang = None
        for j in range(0, len(daftar_gudang)):
            temp = daftar_gudang[j].current_waktu_tunggu + daftar_gudang[j].total_waktu_tunggu
            if jarak in daftar_gudang[j].kriteria and temp == 0: # apabila memasuki kriteria dan tidak perlu menunggu
                index_gudang = j
                waktu_tunggu = 0
            elif jarak in daftar_gudang[j].kriteria: # apabila masuk kriteria tetapi perlu menunggu
                temp = daftar_gudang[j].current_waktu_tunggu + daftar_gudang[j].total_waktu_tunggu
                if waktu_tunggu > temp:
                    index_gudang = j
                    waktu_tunggu = temp
        
        # penentuan proses
        if index_gudang == None: # apabila index_gudang adalah None artinya tidak ditemukan gudang yang cocok
            daftar_tolak.append(arrival_truk[i])
        elif index_gudang is not None and waktu_tunggu == 0: # apabila sudah ditemukan gudang dan waktu_tunggu = 0 artinya dapat langsung melakukan loading
            daftar_gudang[index_gudang].loadingMuatan(arrival_truk[i])
        else: daftar_gudang[index_gudang].masukWaitList(arrival_truk[i]) # apabila waktu_tunggu tidak 0 artinya perlu masuk ke wait list gudang
    
    # menjalankan waktu untuk gudang dan durasi dari simulasi
    for i in range(0, len(daftar_gudang)):
        daftar_gudang[i].timeTick()
    durasi += 1


for i in range(0, len(daftar_truk)):
    daftar_truk[i].printInfo()
    
for i in range(0, len(daftar_gudang)):
    print(daftar_gudang[i].daftar_truk)