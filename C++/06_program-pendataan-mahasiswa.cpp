#include <iostream>

void headerProgram(){
  std::cout<<"Program Pendataan Mahasiswa"<<'\n';
}

int cekGolongan(int penghasilan){
  int golongan = 0;
  if(penghasilan <= 2000000){
    golongan = 1;
  } 
  else if(penghasilan > 2000000 && penghasilan <= 3000000){
    golongan = 2;
  } 
  else if(penghasilan > 3000000 && penghasilan <= 4000000){
    golongan = 3;
  } 
  else{
    golongan = 4;
  }
  return golongan;
}

const int UKT = 900000;
const int TAHUN_MASUK = 2022;
int jumlah,npm[13],tempPenghasilan[10],golongan[10],ukt[10];
std::string nama[50],jurusan[50];
char ulang,bidikMisi[1];

int main(int argc, char *argv[]){
  do{
    headerProgram();
    std::cout<<'\n'<<"Jumlah yang di input: ";
    std::cin>>jumlah;
      for(int a=0; a<jumlah; a++){
        std::cout<<"Data ke- "<<a+1<<'\n';
        std::cout<<"Nama: "; std::cin>>nama[a];
        std::cout<<"NPM: "; std::cin>>npm[a];
        std::cout<<"Jurusan: "; std::cin>>jurusan[a];
        std::cout<<"Penghasilan orang tua: "; std::cin>>tempPenghasilan[a];
        std::cout<<"Bidik misi [y/t]: "; std::cin>>bidikMisi[a];
          if(bidikMisi[a] == 't' || bidikMisi[a] == 'T'){
            golongan[a] = cekGolongan(tempPenghasilan[a]);
            ukt[a] = UKT * golongan[a];
          }
          else if(bidikMisi[a] == 'y' || bidikMisi[a] == 'Y'){
            ukt[a] = 0;
            golongan[a] = 0;
          }
      }
    int b = 0;
    while(b<jumlah){
      std::cout<<"\n\n"<<"HASIL"<<'\n';
      std::cout<<"Data ke- "<<b+1<<'\n';
      std::cout<<"----------"<<'\n';
      std::cout<<"Tahun masuk: "<<TAHUN_MASUK<<'\n';
      std::cout<<"Nama: "<<nama[b]<<'\n';
      std::cout<<"NPM: "<<npm[b]<<'\n';
      std::cout<<"Jurusan: "<<jurusan[b]<<'\n';
      std::cout<<"Golongan: "<<golongan[b]<<'\n';
      std::cout<<"UKT: "<<ukt[b]<<'\n';
      std::cout<<"Penghasilan: "<<tempPenghasilan[b]<<'\n';
       b++;
    }
    std::cout<<'\n'<<"Ingin mengulang [y/t]: "; std::cin>>ulang;
  }while(ulang == 'Y' || ulang == 'y');
  return 0;
}
