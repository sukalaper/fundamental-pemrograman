#include <iostream>
 
char getStudentGrade(int arrivalTime){
  const int ON_TIME = 7;
  return arrivalTime < ON_TIME ? 'A' : 'C';
}

void displayResult(char grade){
  std::cout<<"Nilai Siswa = "<<grade;
}
 
int main(int argc, char *argv[]){
  int arrivalTime;
  std::cout<<"Masukan Jam Kehadiran Siswa = ";std::cin>>arrivalTime;
  char grade = getStudentGrade(arrivalTime);
  displayResult(grade);
  return 0;
}
