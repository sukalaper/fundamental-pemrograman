package main

import (
  "fmt"
  "strconv"
)

func getInput() int{
  var number int
  fmt.Println("Masukan Angka: ")
  fmt.Scanln(&number)
  return number
}

func isEven(number int) bool{
  return number%2 == 0
}

func main(){
  number := getInput()
    if isEven(number) {
      fmt.Println(strconv.Itoa(number) + " Ini bilangan genap.")
    } else {
      fmt.Println(strconv.Itoa(number) + " Ini bilangan ganjil.")
    }
}
