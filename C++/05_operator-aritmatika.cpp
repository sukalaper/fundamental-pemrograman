#include <iostream>

int main(int argc, char *argv[]){
	int a = 22;
	int b = 2;
	int hasil;

  // pertambahan
  hasil = a + b;
  std::cout<<a<<" + "<<b<<" = "<<hasil<<'\n';
	// pengurangan
	hasil = a - b;
  std::cout<<a<<" - "<<b<<" = "<<hasil<<'\n';
	// perkalian
	hasil = a * b;
  std::cout<<a<<" x "<<b<<" = "<<hasil<<'\n';
	// pembagian
	hasil = a / b;
  std::cout<<a<<" / "<<b<<" = "<<hasil<<'\n';
	// modulus
	hasil = a % b;
  std::cout<<a<<" % "<<b<<" = "<<hasil<<'\n';
	return 0;
}
