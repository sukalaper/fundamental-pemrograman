#include <iostream>

class Vehicle{
private:
  double fuelEfficiency; // Efisiensi bahan bakar dalam kilometer per liter

public:
  Vehicle(double efficiency) : fuelEfficiency(efficiency){}

  double calculateFuelConsumption(double distance){
    return distance / fuelEfficiency;
  }
};

int main(int argc, char *argv[]){
  double efficiency, distance;

  std::cout<<"Masukkan efisiensi bahan bakar kendaraan (km/liter): ";std::cin>>efficiency;
  std::cout<<"Masukkan jarak yang ditempuh (kilometer): ";std::cin>>distance;

  Vehicle vehicle(efficiency);
  double fuelConsumption = vehicle.calculateFuelConsumption(distance);

  std::cout<<"Konsumsi bahan bakar: "<<fuelConsumption<<" liter\n";

  return 0;
}
