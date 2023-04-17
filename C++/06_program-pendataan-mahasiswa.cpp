#include <iostream>
#include <string>
#include <vector>

struct Mahasiswa{
  std::string nama;
  int npm;
  std::string jurusan;
  int penghasilan_orang_tua;
  char bidik_misi;
  int golongan;
  int ukt;
};

void header_program(){
  std::cout<<"Program Pendataan Mahasiswa Sederhana"<<'\n';
}

int cek_golongan(int penghasilan){
  int golongan = 0;
  if(penghasilan <= 2000000){
    golongan = 1;
  } else if(penghasilan > 2000000 && penghasilan <= 3000000){
    golongan = 2;
  } else if(penghasilan > 3000000 && penghasilan <= 4000000){
    golongan = 3;
  } else {
    golongan = 4;
  }
  return golongan;
}

Mahasiswa input_data(){
  Mahasiswa mhs;
  std::cout<<"Nama: ";std::cin>>mhs.nama;
  std::cout<<"NPM: ";std::cin>>mhs.npm;
  std::cout<<"Jurusan: ";std::cin>>mhs.jurusan;
  std::cout<<"Penghasilan orang tua: ";std::cin>>mhs.penghasilan_orang_tua;
  std::cout<<"Bidik misi [y/t]: ";std::cin>>mhs.bidik_misi;
  return mhs;
}

void hitung_golongan_dan_ukt(std::vector<Mahasiswa>& daftar_mahasiswa){
  for (Mahasiswa& mhs : daftar_mahasiswa){
    if(mhs.bidik_misi == 't' || mhs.bidik_misi == 'T'){
      mhs.golongan = cek_golongan(mhs.penghasilan_orang_tua);
      mhs.ukt = 900000 * mhs.golongan;
    } else if(mhs.bidik_misi == 'y' || mhs.bidik_misi == 'Y'){
      mhs.ukt = 0;
      mhs.golongan = 0;
    }
  }
}

void tampilkan_data(std::vector<Mahasiswa>& daftar_mahasiswa){
  std::cout<<"\nData Mahasiswa\n";
  std::cout<<"=============================================================================================\n";
  std::cout<<"No. | Nama\t\t| NPM\t\t| Jurusan\t| Penghasilan Orang Tua\t| Golongan | UKT\n";
  std::cout<<"=============================================================================================\n";
  int no = 1;
    for (Mahasiswa& mhs : daftar_mahasiswa) {
      std::cout<<no++<<"\t| "<<mhs.nama<<"\t\t| "<<mhs.npm<<"\t\t| " <<mhs.jurusan<<"\t| " <<mhs.penghasilan_orang_tua<<"\t\t\t\t| "<<mhs.golongan<<"\t  | "<<mhs.ukt<< '\n';
    }
  std::cout<< "=============================================================================================\n";
}


int main(int argc, char *argv[]){
  header_program();
  std::vector<Mahasiswa> daftar_mahasiswa;
  int n;
  std::cout<<"Masukkan jumlah mahasiswa yang akan diinputkan: ";std::cin>>n;
    for(int i = 0; i < n; ++i){
      Mahasiswa mhs = input_data();
      daftar_mahasiswa.push_back(mhs);
    }
  hitung_golongan_dan_ukt(daftar_mahasiswa);
  tampilkan_data(daftar_mahasiswa);

  return 0;
}
