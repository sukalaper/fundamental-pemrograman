#include <iostream>
#include <string>

class StringManipulator{
public:
  std::string removeNonAlphabeticChars(std::string str){
    std::string result = "";
      for (char c : str){
        if (isalpha(c)){
          result += c;
        }
      }
  return result;
  }
};

class UserInput{
public:
  std::string getString(){
    std::string input;
    std::cout<<"Masukan Kalimat: ";std::getline(std::cin, input);
    return input;
  }
};

int main(int argc, char *argv[]){
    UserInput input;
    StringManipulator manipulator;
    std::string str = input.getString();
    std::string result = manipulator.removeNonAlphabeticChars(str);
    std::cout<<"Hasil: "<<result<<'\n';
    return 0;
}
