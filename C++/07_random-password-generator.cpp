#include <iostream>
#include <string>

const std::string ALNUM = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$_&+()!?*";

int getRandomIndex(int maxIndex){
  return rand() % maxIndex;
}

int getLengthFromUser(){
  int length;
  std::cout << "Masukan angka: ";std::cin >> length;
  return length;
}

std::string generateRandomString(int length){
  std::string randomStr;
  for (int i = 0; i < length; ++i){
    randomStr += ALNUM[getRandomIndex(ALNUM.size())];
  }
  return randomStr;
}

int main(int argc, char *argv[]){
  srand(time(0));
  int length = getLengthFromUser();
  std::string randomString = generateRandomString(length);
  std::cout << randomString;
  return 0;
}
