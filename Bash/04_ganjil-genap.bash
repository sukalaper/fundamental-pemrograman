#!/bin/bash

function getInput(){
  echo "Masukan angka: "
  read number
}

function isEven(){
  if (( $1 % 2 == 0 )); then
    echo "Ini adalah bilangan ganjil."
  else
    echo "Ini adalah bilangan genap."
  fi
}

getInput
isEven $number
