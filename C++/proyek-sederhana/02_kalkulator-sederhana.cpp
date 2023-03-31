#include <iostream>

char getOperatorFromUser(){
  char userInput;
  std::cout<<"Masukan operator [+ - *]: ";std::cin>>userInput;
  return userInput;
}

int getResultFromUser(const std::string& message){
  int result;
  std::cout<<message;std::cin>>result;
  return result;
}

int performOperation(int numberOne, int numberTwo, char op){
  switch(op){
    case '+':
      return numberOne + numberTwo;
    case '-':
      return numberOne - numberTwo;
    case '*':
      return numberOne * numberTwo;
    default:
      return -1;
  }
}

void printResult(int result){
  if(result == -1){
    std::cout<<"Operator incorrect!";
  }
  else{
    std::cout<<"Hasil: "<<result;
  }
}

int main(int argc, char *argv[]){
  int numberOne = getResultFromUser("Masukan angka pertama: ");
  int numberTwo = getResultFromUser("Masukan angka kedua: ");
  char op = getOperatorFromUser();
  int result = performOperation(numberOne, numberTwo, op);
  printResult(result);
  return 0;
}
