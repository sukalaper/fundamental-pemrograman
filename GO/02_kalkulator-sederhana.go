package main

import (
  "fmt"
  "strconv"
)

func getInput() (float64, float64, string){
  var number1, number2 float64
  var operator string
  fmt.Println("Masukan angka pertama: ")
  fmt.Scanln(&number1)
  fmt.Println("Masukan angka kedua: ")
  fmt.Scanln(&number2)
  fmt.Println("Pilih operator yang digunakan (+, -, *, /): ")
  fmt.Scanln(&operator)
  return number1, number2, operator
}

func calculate(num1 float64, num2 float64, operator string) float64{
  var result float64
    switch operator {
      case "+":
	result = num1 + num2
      case "-":
	result = num1 - num2
      case "*":
	result = num1 * num2
      case "/":
	result = num1 / num2
      default:
	fmt.Println("Operator salah!")
    }
  return result
}

func main(){
  num1, num2, operator := getInput()
  result := calculate(num1, num2, operator)
  fmt.Println(strconv.FormatFloat(num1, 'f', -1, 64) + " " + operator + " " + strconv.FormatFloat(num2, 'f', -1, 64) + " = " + strconv.FormatFloat(result, 'f', -1, 64))
}
