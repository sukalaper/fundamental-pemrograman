# Script untuk menampilkan kecepatan fan pada polybar
#!/bin/bash

getFanSpeed=$(sensors | grep -i "fan1" | head -1 | awk '{print $2}')
echo '' $getFanSpeed" RPM"
