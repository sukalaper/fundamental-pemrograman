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
import openpyxl
import numpy as np
import pandas as pd

def on_hue_change(value):
    global hue_value
    hue_value = value

hue_value = 0

cap = cv2.VideoCapture(0)

if not cap.isOpened():
    print("Tidak dapat membuka kamera!")
    exit()

cap.set(cv2.CAP_PROP_FRAME_WIDTH, 500)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 320)

cv2.namedWindow('Hasil Deteksi Objek')
cv2.createTrackbar('HUE', 'Hasil Deteksi Objek', hue_value, 180, on_hue_change)

data = {
    'Citra Hasil': [],
    'Toleransi (H, S, V)': [],
    'Jumlah Objek Terdeteksi': [],
    'Total Area Terdeteksi (Pixel)': [],
    'Persentase Area Terdeteksi (%)': []
}

while True:
    ret, frame = cap.read()

    if not ret:
        print("Tidak dapat membaca frame dari kamera")
        break

    hsv_image = cv2.cvtColor(frame, cv2.COLOR_BGR2HSV)


    lower_color = np.array([hue_value-10, 50, 50])  
    upper_color = np.array([hue_value+10, 255, 255]) 

    mask = cv2.inRange(hsv_image, lower_color, upper_color)

    result = cv2.bitwise_and(frame, frame, mask=mask)

    result_hex = result.copy()
    result_hex[np.where(mask != 0)] = [0, 0, 255]  

    contours, _ = cv2.findContours(mask, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
    jumlah_objek = len(contours)
    total_area = sum([cv2.contourArea(cnt) for cnt in contours])

    total_area_pixel = mask.shape[0] * mask.shape[1]
    persentase_area = (total_area / total_area_pixel) * 100

    data['Citra Hasil'].append(result_hex)
    data['Toleransi (H, S, V)'].append([hue_value, 10, 10])
    data['Jumlah Objek Terdeteksi'].append(jumlah_objek)
    data['Total Area Terdeteksi (Pixel)'].append(total_area)
    data['Persentase Area Terdeteksi (%)'].append(persentase_area)

    cv2.imshow('Gambar Asli', frame)
    cv2.imshow('Hasil Deteksi Objek', result)

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()

print("Mohon tunggu, hasil deteksi sedang di import kedalam format .xlsx")

df = pd.DataFrame(data)

df['Citra Hasil'] = df['Citra Hasil'].apply(lambda x: ['{:02X}'.format(pixel[2]) for pixel in x.reshape(-1, 3)])

print(df)

df.to_excel('hasil_deteksi.xlsx', index=False)

print("Proses import selesai. Hasil deteksi telah diexport ke hasil_deteksi.xlsx")
