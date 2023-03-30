#include <iostream>
#include <string>

const std::string HEADER = "UPIN & IPIN BAKAL LEBIH BAGUS TANPA KATA PIN\n";

std::string cartoonOne(){
  std::string str("Upin");
  str.erase(1);
  std::cout<<str;
  return str;
}

std::string cartoonTwo(){
  std::string str("Ipin");
  str.erase(1);
  std::cout<<str<<'\n';
  return str;
}

void spacingLetter(){
  std::cout << "&";
}

int main(int argc, char *argv[]){
  std::cout<<HEADER;
  sleep(2);
  while(true){
    cartoonOne();
    spacingLetter();
    cartoonTwo();
  }
  return 0;
}
