#include <iostream>
#include <string>

class inputReader{
public:
  std::string readInput(){
    std::string input;
    std::cout<<"Masukkan input Anda: ";std::getline(std::cin, input);
    return input;
  }
};

class characterCounter{
public:
  int countCharacters(const std::string& input){
    return input.length();
  }
};

class outputPrinter{
public:
  void printResult(int count){
    std::cout<<"Jumlah karakter pada input Anda adalah: "<<count<<'\n';
  }
};

int main(int argc, char *argv[]){
  inputReader reader;
  characterCounter counter;
  outputPrinter printer;

  std::string input = reader.readInput();
  int count = counter.countCharacters(input);
  printer.printResult(count);

  return 0;
}
