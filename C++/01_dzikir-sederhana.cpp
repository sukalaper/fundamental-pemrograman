#include <iostream>
#include <string>

void headerProgram(){
  std::cout<<R"(
██████╗░███████╗██╗██╗░░██╗██╗██████╗░
██╔══██╗╚════██║██║██║░██╔╝██║██╔══██╗
██║░░██║░░███╔═╝██║█████═╝░██║██████╔╝
██║░░██║██╔══╝░░██║██╔═██╗░██║██╔══██╗
██████╔╝███████╗██║██║░╚██╗██║██║░░██║
╚═════╝░╚══════╝╚═╝╚═╝░░╚═╝╚═╝╚═╝░░╚═╝
-------------------------------------
)"<<'\n';
}

std::string getInput(){
  std::string input;
  std::cout<<"Masukan kalimat Dzikir\t: ";std::cin>>input;
  return input;
}

int getNumForLooping(){
  std::string numForLooping;
  std::cout<<'\n'<<"Ingin berapa Dzikir hari ini\t: ";std::cin>>numForLooping;
  int finalOutput = 0;
  for (int i = 0; i < numForLooping.length(); i++){
    if ((numForLooping[i] >= 'a' && numForLooping[i] <= 'z') || (numForLooping[i] >= 'A' && numForLooping[i] <= 'Z')){
      std::cout<<"Input harus berupa Angka!"<<'\n';
      return getNumForLooping();
    }
    finalOutput = finalOutput * 10 + numForLooping[i] - '0';
  }
  return finalOutput;
}

void performDzikir(int numIterations){
  for(int i = 0; i < numIterations; i++){
    std::string input = getInput();
  }
}

void displayResult(int numIterations){
  std::cout<<"Dzikir selesai dengan total sejumlah "<<numIterations<<'\n';
}

bool askForRepeat(){
  char answer;
  std::cout<<"Apakah Anda ingin mengulang kembali [Y/n]: ";std::cin>>answer;
  return (answer == 'y' || answer == 'Y');
}

int main(int argc, char* argv[]){
  headerProgram();
  char u;
  do{
    int finalOutput = getNumForLooping();
    performDzikir(finalOutput);
    displayResult(finalOutput);
    u = askForRepeat();
  }while(u);
  return 0;
}
