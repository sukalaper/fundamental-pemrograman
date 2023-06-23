#include <iostream>
#include <string>

void headerProgram(){
std::cout<<R"(
______  ___  _____ _____ _    _ _________________   _____ _____ _   _ ___________  ___ _____ ___________ 
| ___ \/ _ \/  ___/  ___| |  | |  _  | ___ |  _  \ |  __ |  ___| \ | |  ___| ___ \/ _ |_   _|  _  | ___ \
| |_/ / /_\ \ `--.\ `--.| |  | | | | | |_/ | | | | | |  \| |__ |  \| | |__ | |_/ / /_\ \| | | | | | |_/ /
|  __/|  _  |`--. \`--. | |/\| | | | |    /| | | | | | __|  __|| . ` |  __||    /|  _  || | | | | |    / 
| |   | | | /\__/ /\__/ \  /\  \ \_/ | |\ \| |/ /  | |_\ | |___| |\  | |___| |\ \| | | || | \ \_/ | |\ \ 
\_|   \_| |_\____/\____/ \/  \/ \___/\_| \_|___/    \____\____/\_| \_\____/\_| \_\_| |_/\_/  \___/\_| \_|                                                                              
)"<<'\n';
}

const std::string ALNUM = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$_&+()!?*/\\[]^{}";

int getRandomIndex(int maxIndex){
  return rand() % maxIndex;
}

int getLengthFromUser(){
  std::string inputUser;
  int finalOutput = 0;
  std::cout<<"Masukan panjang password yang diinginkan: ";std::cin>>inputUser;
  for (int a=0; a<inputUser.length(); a++){ // NEW FEATURE JIKA INPUT BUKAN ANGKA, MAKA PROGRAM AKAN SELALU LOOPING SAMPAI INPUT BERNILAI ANGKA.
    if ((inputUser[a]>='a' && inputUser[a]<='z') || (inputUser[a] >= 'A' && inputUser[a] <= 'Z')){
      std::cout<<"Input harus berupa angka, bukan abjad!"<<'\n';
      return getLengthFromUser();
    }
     finalOutput = finalOutput * 10 + inputUser[a] - '0';
  }
  return finalOutput;
}

int getNumStringFromUser(){ // NEW FEATURE OUTPUT DISESUAIKAN DARI PENGGUNA
  int numStrings;
  std::cout<<"Masukan banyaknya output password yang diinginkan: ";std::cin>>numStrings;
  return numStrings;
}

std::string generateRandomString(int length){
  std::string randomStr;
  for (int i=0; i<length; ++i){
    randomStr += ALNUM[getRandomIndex(ALNUM.size())];
  }
  return randomStr;
}

int main(int argc, char *argv[]){
  headerProgram();
  srand(time(0));
  int length = getLengthFromUser();
  int numStrings = getNumStringFromUser();
  for (int i=0; i<numStrings; ++i){ 
    std::string randomString = generateRandomString(length);
    std::cout<<'\n'<<randomString;
  }
  return 0;
}
