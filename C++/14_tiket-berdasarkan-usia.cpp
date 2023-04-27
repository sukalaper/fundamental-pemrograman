#include <iostream>

class AgeChecker{
public:
  bool requiresTicket(int age) const{
    if (age >= 18){
      return true;
    } else {
      return false;
    }
  }
};

class InputOutput{
public:
  int getAgeFromUser() const{
  int age;
  std::cout<<"Masukkan usia Anda: ";std::cin>>age;
  return age;
  }
  
  void printRequiresTicket(bool requiresTicket) const{
    if (requiresTicket){
      std::cout << "Anda memerlukan tiket"<<'\n';
    } else {
      std::cout<<"Anda tidak memerlukan tiket"<<'\n';
    }
  }
};

class TicketChecker{
public:
  void checkTicketRequirement(){
  int age = inputOutput.getAgeFromUser();
  bool requiresTicket = ageChecker.requiresTicket(age);
  inputOutput.printRequiresTicket(requiresTicket);
  }

private:
  AgeChecker ageChecker;
  InputOutput inputOutput;
};

int main(int argc, char *argv[]){
  TicketChecker ticketChecker;
  ticketChecker.checkTicketRequirement();
  return 0;
}
