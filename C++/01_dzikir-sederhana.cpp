/*
 اللَّهُمَّ رَبَّ النَّاسِ أَذْهِبِ الْبَأْسَ اشْفِ أَنْتَ الشَّافِي لَا شَافِيَ إلَّا أَنْتَ شِفَاءً لَا يُغَادِرُ سَقْمًا
 Luhud trisnyawati bin fulan.
*/

#include <iostream>
#include <string>

void headerProgram(){
    std::cout << R"(
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

int main(int argc, char *argv[]){
  headerProgram();
  char u;
    do{
      int finalOutput = getNumForLooping();
        for (int i = 0; i < finalOutput; i++){
          std::string input = getInput();
        }
        std::cout<<"Dzikir selesai dengan total sejumlah "<<finalOutput<<'\n';
        std::cout<<"Apakah anda ingin mengulang kembali [Y/n]: ";std::cin>>u;
    } while(u == 'y' || u == 'Y');
  return 0;
}
