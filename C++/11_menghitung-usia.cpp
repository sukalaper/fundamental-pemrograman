#include <iostream>

int getInputFromUser(const std::string& message){
  int input;
  std::cout<<message;std::cin>>input;
  return input;
}

int hitungUmur(int tahunSekarang, int tahunLalu){
  return tahunSekarang - tahunLalu;
}

void displayUmur(int umur){
  std::cout<<'\n'<<"Umur Anda adalah: "<<umur<<" Tahun";
}

int main(int argc, char *argv[]){
  int tahunSekarang = getInputFromUser("Masukan tahun kelahiran: ");
  int tahunLalu = getInputFromUser("Masukan tahun sekarang: ");
  int hasil = hitungUmur(tahunSekarang, tahunLalu);

  displayUmur(hasil);
  return 0;
}
