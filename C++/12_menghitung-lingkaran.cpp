#include <iostream>
#include <cmath>

class Lingkaran{
private:
  double jari_jari;
  double luas;
  double keliling;

public:
Lingkaran(double jari_jari){
  this->jari_jari = jari_jari;
}

double hitungLuas(){
  this->luas = M_PI * this->jari_jari * this->jari_jari;
  return this->luas;
}

double hitungKeliling(){
  this->keliling = 2 * M_PI * this->jari_jari;
  return this->keliling;
}

void tampilkanHasil(){
  std::cout<<"Jari-jari: "<<this->jari_jari<<'\n';
  std::cout<<"Luas: "<<this->luas<<'\n';
  std::cout<<"Keliling: "<<this->keliling<<'\n';
  }
};

int main(int argc, char *argv[]){
  double jari_jari;
  Lingkaran lingkaran(0);

  std::cout<<"Program Menghitung Lingkaran"<<'\n';

  std::cout<<"Masukkan jari-jari: ";std::cin>>jari_jari;

  lingkaran = Lingkaran(jari_jari);
  lingkaran.hitungLuas();
  lingkaran.hitungKeliling();
  lingkaran.tampilkanHasil();

  return 0;
}
