// UNFINISHED !

#include <iostream>
#include <iomanip>

float kapasitasTangki(){
  float getData;
  std::cout<<"Masukan kapasitas tangki motor anda: ";std::cin>>getData;
  return getData;
}

double isiTangkiAwal(){
  double getDataTangki;
  std::cout<<"Masukan angka pada speedometer anda saat ini: ";std::cin>>getDataTangki;
  return getDataTangki;
}

double isiTangkiAkhir(){
  double getDataTangkiAkhir;
  std::cout<<"Masukan angka pada speedometer anda setelah perjalanan: ";std::cin>>getDataTangkiAkhir;
  return getDataTangkiAkhir;
}

int main(int argc, char *argv[]){
  float resultTangki = kapasitasTangki();
  double resultIsi = isiTangkiAwal();
  double resultAkhir = isiTangkiAkhir();
  std::cout<<"Jumlah konsumsi BBM adalah: "<<std::setprecision(3)<<(resultIsi-resultAkhir)/resultTangki;
  return 0;
}
