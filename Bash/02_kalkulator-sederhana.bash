#!/bin/bash

function add(){
  echo $(($1 + $2))
}

function subtract(){
  echo $(($1 - $2))
}

function multiply(){
  echo $(($1 * $2))
}

function divide(){
  if [ $2 -eq 0 ]; then
    echo "Error: division by zero"
  else
    echo $(($1 / $2))
  fi
}

case "$1" in
  "add")
    add $2 $3
    ;;
  "subtract")
    subtract $2 $3
    ;;
  "multiply")
    multiply $2 $3
    ;;
  "divide")
    divide $2 $3
    ;;
  *)
  
  echo "Usage: calculator.sh {add|subtract|multiply|divide} <num1> <num2>"
  ;;
esac
