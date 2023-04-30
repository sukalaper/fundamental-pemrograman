package main

import (
	"fmt"
)

func getStudentGrade(arrivalTime int) rune{
  const onTime = 7
	if arrivalTime < onTime{
		return 'A'
	} else {
		return 'C'
	}
}

func displayResult(grade rune){
	fmt.Printf("Nilai Siswa = %c", grade)
}

func main(){
	var arrivalTime int
	fmt.Print("Masukan Jam Kehadiran Siswa = ")
	fmt.Scanln(&arrivalTime)
	grade := getStudentGrade(arrivalTime)
	displayResult(grade)
}
