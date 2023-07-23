#include <iostream>
#include <string>

class UIManager{
public:
  static void printHeader(){
    std::cout<<"\tPASSWORD RANDOM GENERATOR\n";
    std::cout<<"\t-------------------------\n\n";
  }
};

const std::string ALNUM = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$_&+()!?*/\\[]^{}";

int getRandomIndex(int maxIndex){
  return rand() % maxIndex;
}

int getLengthFromUser(){
  std::string inputUser;
  int finalOutput = 0;
  std::cout<<"- Berapa panjang password yang diinginkan? ";std::cin>>inputUser;
    for(int a = 0; a < inputUser.length(); a++){
      if((inputUser[a] >= 'a' && inputUser[a] <= 'z') || (inputUser[a] >= 'A' && inputUser[a] <= 'Z')){
        std::cout<<"- Input harus berupa angka, bukan abjad!"<<'\n';
          return getLengthFromUser();
      }
      finalOutput = finalOutput * 10 + inputUser[a] - '0';
    }
   return finalOutput;
}

int getNumStringFromUser(){
  int numStrings;  
  std::cout<<"- Berapa banyaknya keluaran password yang diinginkan? ";std::cin>>numStrings;
  return numStrings;
}

std::string generateRandomString(int length){
 std::string randomStr;
  for(int i = 0; i < length; ++i){
    randomStr += ALNUM[getRandomIndex(ALNUM.size())];
  }
  return randomStr;
}

int main(int argc, char* argv[]){
  UIManager::printHeader();
  srand(time(0));
  int length = getLengthFromUser();
  int numStrings = getNumStringFromUser();
    for (int i = 0; i < numStrings; ++i){
      std::string randomString = generateRandomString(length);
      std::cout<<'\n'<<randomString;
    }
  return 0;
}
