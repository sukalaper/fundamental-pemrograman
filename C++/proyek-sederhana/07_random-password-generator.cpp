#include <iostream>
#include <string>

static const char ALNUM[] = 
"0123456789" 
"ABCDEFGHIJKLMNOPQRSTUVWXYZ"
"abcdefghijklmnopqrstuvwxyz"
"@#$_&+()!?*";

int myLen = sizeof(ALNUM) - 1;

char randomStr() {
  return ALNUM[rand() % myLen];
}

int main(int argc, char *argv[]){
  srand(time(0));
  int l;
  std::cout<<"Masukan angka: ";std::cin>>l;
    for(int m = 0; m < l; m++) {
      std::cout<<randomStr();
    }
  return 0;
}
