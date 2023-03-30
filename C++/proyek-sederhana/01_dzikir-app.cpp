/*
 اللَّهُمَّ رَبَّ النَّاسِ أَذْهِبِ الْبَأْسَ اشْفِ أَنْتَ الشَّافِي لَا شَافِيَ إلَّا أَنْتَ شِفَاءً لَا يُغَادِرُ سَقْمًا
 Luhud trisnyawati bin fulan.
*/
#include <iostream>
#include <string>
#include <iomanip>

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

std::string checkValiInput(){
  std::string numForLooping;
  std::cout<<'\n'<<"Ingin berapa Dzikir hari ini\t: ";std::cin>>numForLooping;
  for (int i=0; i<numForLooping.length(); i++){
    if ((numForLooping[i]>='a' && numForLooping[i]<='z')
        || (numForLooping[i]>='A' && numForLooping[i]<='Z')) {
      std::cout<<"Input harus berupa Angka!"<<'\n';
      return checkValiInput();
    }
  }
  return numForLooping;
}

int stringToInteger(const std::string& str) {
  int tempConverter = 0;
  int valueChar;
  for (int i=0; i<str.length(); i++) {
    tempConverter *= 10;
    valueChar = str[i] - '0';
    tempConverter = (tempConverter + valueChar);
  }
  return tempConverter;
}

int main(int argc, char *argv[]){  
  headerProgram();
  char u;
  std::string input;
  do{
    std::string ResultValidation = checkValiInput();
    int finalOutput = stringToInteger(ResultValidation);
      for(int i=0; i<finalOutput; i++){
        std::cout<<(i+1)<<". Masukan kalimat Dzikir\t: ";std::cin>>input;
      }
    std::cout<<"Dzikir selesai dengan kalimat "<<input<<" dengan total sejumlah "<<finalOutput<<'\n';
    std::cout<<"Apakah anda ingin mengulang kembali [Y/n]: ";std::cin>> u;
  }while(u=='y' || u=='Y');
  return 0;
}
