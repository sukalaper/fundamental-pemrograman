#include <iostream>

char getOperatorFromUser(){
  char userInput;
  std::cout<<"Masukan operator [+ - *]: ";std::cin>>userInput;
  return userInput;
}

int getResultFromUser1(){
  int numberOne;
  std::cout<<"Masukan angka pertama: ";std::cin>>numberOne;
  return numberOne;
}

int getResultFromUser2(){
  int numberTwo;
  std::cout<<"Masukan angka kedua: ";std::cin>>numberTwo;
  return numberTwo;
}

int main(int argc, char *argv[]){
  int getAverageUser1 = getResultFromUser1();
  int getAverageUser2 = getResultFromUser2();
  switch(getOperatorFromUser()){
    case '+':
      std::cout<<getAverageUser1<<"+"<<getAverageUser2<<"= "<<getAverageUser1+getAverageUser2;
      break;
    case '-':
      std::cout<<getAverageUser1<<"-"<<getAverageUser2<<"= "<<getAverageUser1-getAverageUser2;
      break;
    case '*':
      std::cout<<getAverageUser1<<"*"<<getAverageUser2<<"= "<<getAverageUser1*getAverageUser2;
      break;
    default:
      std::cout<<"Operator incorrect!";
      break;
  }
  return 0;
}
