#include <iostream>

int generateRandomNumber(){
  srand(time(NULL));
  return rand() % 100 + 1;
}

void playGame(int randomNumber){
  int player_guess, guess_count = 0;
    while(true){
      std::cout<<"Masukan tebakan Anda: ";std::cin >> player_guess;
      guess_count++;
        if(player_guess > randomNumber) {
          std::cout<<"Angka terlalu tinggi, silahkan coba lagi."<<'\n';
        } else if(player_guess < randomNumber) {
          std::cout<<"Angka terlalu rendah, silahkan coba lagi."<<'\n';
        } else {
          std::cout<<"Selamat, Anda benar dengan"<<guess_count << " percobaan!"<<'\n';
          break;
        }
    }
}

void displayWelcomeMessage(){
  std::cout<<"GAME TEBAK ANGKA SEDERHANA"<<'\n';
  std::cout<<"Dapatkah Anda menebak angka dari 0-100?"<<"\n\n";
}

int main(int argc, char *argv[]){
  int randomNumber = generateRandomNumber();
  displayWelcomeMessage();
  playGame(randomNumber);
  return 0;
}
