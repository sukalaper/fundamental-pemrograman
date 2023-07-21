# The MIT License (MIT)
#
# Copyright (c) 2023 Anggiramadyansyah
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in all
# copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
# SOFTWARE

import cv2
from tabulate import tabulate

def on_hue_change(value):
    global hue_value
    hue_value = value

def get_color_name(hue, sat, val):
    if 0 <= hue < 15 or 165 <= hue <= 180:
        return "Merah"
    elif 75 <= hue < 105:
        return "Biru"
    elif 15 <= hue < 45 or 135 <= hue < 165:
        return "Orange"

hue_value = 0

cap1 = cv2.VideoCapture(0)

if not cap1.isOpened():
    print("Kesalahan. Tidak dapat membuka kamera!")
    exit()

cap1.set(cv2.CAP_PROP_FRAME_WIDTH, 800)
cap1.set(cv2.CAP_PROP_FRAME_HEIGHT, 478)

cv2.namedWindow('Hasil Deteksi Objek 1')
cv2.createTrackbar('HUE', 'Hasil Deteksi Objek 1', hue_value, 180, on_hue_change)

detected_objects = []

while True:
    ret1, frame1 = cap1.read()

    if not ret1:
        print("Kesalahan. Tidak dapat membaca frame dari kamera!")
        break

    hsv_image1 = cv2.cvtColor(frame1, cv2.COLOR_BGR2HSV)

    lower_color = (hue_value - 10, 50, 50)
    upper_color = (hue_value + 10, 255, 255)

    mask1 = cv2.inRange(hsv_image1, lower_color, upper_color)

    result1 = cv2.bitwise_and(frame1, frame1, mask=mask1)

    contours1, _ = cv2.findContours(mask1, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

    jumlah_objek1 = len(contours1)

    total_area1 = sum([cv2.contourArea(cnt) for cnt in contours1])

    total_area_pixel1 = mask1.shape[0] * mask1.shape[1]

    persentase_area1 = (total_area1 / total_area_pixel1) * 100

    cv2.imshow('Gambar Asli 1', frame1)
    cv2.imshow('Hasil Deteksi Objek 1', result1)

    key = cv2.waitKey(1) & 0xFF
    if key == ord('q'):
        break

    detected_objects.append([result1, hue_value, 50, 50, jumlah_objek1, persentase_area1])

cap1.release()
cv2.destroyAllWindows()

if len(detected_objects) > 0:
    print("\nHasil Deteksi Objek:")
    table_headers = ["No.", "Warna", "Toleransi (H, S, V)", "Objek Terdeteksi", "Area Terdeteksi (%)", "Jarak terdeteksi (m3)"]
    table_data = [[i+1, get_color_name(data[1], data[2], data[3]), (data[1], data[2], data[3]), data[4], data[5], data[4]*data[5]] for i, data in enumerate(detected_objects)]
    print(tabulate(table_data, headers=table_headers, tablefmt="grid"))
else:
    print("\nKesalahan. Tidak ada hasil deteksi objek!")
