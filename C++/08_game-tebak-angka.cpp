#include <iostream>
#include <cstdlib>
#include <ctime>

int generateRandomNumber(){
  srand(time(NULL));
  return rand() % 100 + 1;
}

int getUserGuess(){
  int guess;
  std::cout<<"Masukan tebakan Anda: ";std::cin>>guess;
  return guess;
}

void checkGuess(int guess, int randomNumber){
  if (guess > randomNumber){
    std::cout<<"Angka terlalu tinggi, silahkan coba lagi."<<'\n';
  } else if (guess < randomNumber){
    std::cout<<"Angka terlalu rendah, silahkan coba lagi."<<'\n';
  }
}

void displaySuccessMessage(int guessCount){
  std::cout<<"Selamat, Anda benar dengan "<<guessCount<<" percobaan!"<<'\n';
}

void playGame(){
  int randomNumber = generateRandomNumber();
  int guessCount = 0;

  while (true){
    int playerGuess = getUserGuess();
    guessCount++;

    checkGuess(playerGuess, randomNumber);

    if (playerGuess == randomNumber){
      displaySuccessMessage(guessCount);
      break;
    }
  }
}

void displayWelcomeMessage(){
  std::cout<<"GAME TEBAK ANGKA SEDERHANA"<<'\n';
  std::cout<<"Dapatkah Anda menebak angka dari 0-100?"<<"\n\n";
}

int main(int argc, char* argv[]){
  displayWelcomeMessage();
  playGame();
  return 0;
}
