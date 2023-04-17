#include <iostream>

int getInputFromUser(const std::string& message){
  int input;
  std::cout<<message;std::cin>>input;
  return input;
}

int hitungLuas(int panjang, int lebar){
  return panjang * lebar;
}

int hitungKeliling(int panjang, int lebar){
  return 2 * (panjang + lebar);
}

int main(int argc, char *argv[]){
  int panjang = getInputFromUser("Masukkan panjang: ");
  int lebar = getInputFromUser("Masukkan lebar: ");
  int luas = hitungLuas(panjang, lebar);
  int keliling = hitungKeliling(panjang, lebar);

  std::cout<<"Luas: "<<luas<<'\n';
  std::cout<<"Keliling: "<<keliling<<'\n';
  return 0;
}
