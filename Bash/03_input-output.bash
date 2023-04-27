#!/bin/bash

function getInput{
  read -p "Enter your name: " name
  echo $name
}

function printMessage{
  echo "Hello, $1!"
}

name=$(getInput)
printMessage "$name"
