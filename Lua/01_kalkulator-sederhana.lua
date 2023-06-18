function tambah(a, b)
    return a + b
end

function kurang(a, b)
    return a - b
end

function kali(a, b)
    return a * b
end

function bagi(a, b)
    return a / b
end

local matematika = require("matematika")

print("Masukkan angka pertama:")
local angka1 = tonumber(io.read())

print("Masukkan angka kedua:")
local angka2 = tonumber(io.read())

print("Pilih operasi: ")
print("1. Penjumlahan")
print("2. Pengurangan")
print("3. Perkalian")
print("4. Pembagian")

local pilihan = tonumber(io.read())

if pilihan == 1 then
  hasil = matematika.tambah(angka1, angka2)
  print("Hasil penjumlahan: " .. hasil)
elseif pilihan == 2 then
  hasil = matematika.kurang(angka1, angka2)
  print("Hasil pengurangan: " .. hasil)
elseif pilihan == 3 then
  hasil = matematika.kali(angka1, angka2)
  print("Hasil perkalian: " .. hasil)
elseif pilihan == 4 then
  hasil = matematika.bagi(angka1, angka2)
  print("Hasil pembagian: " .. hasil)
else
  print("Pilihan tidak valid silahkan ulangi!")
end
