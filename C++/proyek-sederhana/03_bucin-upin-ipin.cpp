#include <iostream>
#include <string>

std::string removeCharAtOne(const std::string& str) {
  std::string newStr(str);
  newStr.erase(1);
  return newStr;
}

void printString(const std::string& str) {
  std::cout << str << '\n';
}

std::string cartoonOne() {
  std::string str("Upin");
  std::string newStr = removeCharAtOne(str);
  printString(newStr);
  return newStr;
}

std::string cartoonTwo() {
  std::string str("Ipin");
  std::string newStr = removeCharAtOne(str);
  printString(newStr);
  return newStr;
}

int main(int argc, char *argv[]){
 cartoonOne();
 cartoonTwo();
}
