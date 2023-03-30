#include <iostream>

int getInputFromUser(){
  int panjang;
  std::cout<<"Masukan panjang: "; 
  std::cin>>panjang;
  return panjang;
}

int getInputFromUser2(){
  int lebar;
  std::cout<<"Masukan lebar: ";
  std::cin>>lebar;
  return lebar;
}

int ResultPanjang = getInputFromUser();
int ResultLebar = getInputFromUser2();
int LUAS = ResultPanjang+ResultLebar;
const int KELILING = 2*(ResultPanjang+ResultLebar);

int main(int argc, char *argv[]){
  std::cout<<"Luas: "<<LUAS<<'\n';
  std::cout<<"Keliling: "<<KELILING;
  return 0;
}
