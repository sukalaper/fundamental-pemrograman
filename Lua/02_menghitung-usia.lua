local Usia = {}

function Usia.hitung(tahunKelahiran)
  local tahunSaatIni = os.date("*t").year
  local usia = tahunSaatIni - tahunKelahiran
  return usia
end

return Usia

local Usia = require("usia")

print("Masukkan tahun kelahiran:")
local tahunKelahiran = tonumber(io.read())

local usia = Usia.hitung(tahunKelahiran)

print("Usia Anda adalah " .. usia .. " tahun.")
