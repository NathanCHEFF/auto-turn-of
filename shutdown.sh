#!/bin/bash

PIN=29
gpio mode $PIN in
while true; do
  check=$(gpio read $PIN)
  if [ $check -ne 1 ]; then
    echo "POWER HALT! we lost energy!"
    echo "if power does not resume - script turn power off"
    sleep 500
    check=$(gpio read $PIN)
    if [[ $check -ne 1 ]]; then
      echo "system off"
      shutdown -r now
    fi
  fi
  echo 00
  sleep 1
done
