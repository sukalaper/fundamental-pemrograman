import cv2
import numpy as np

# Fungsi untuk mendeteksi objek berwarna dalam citra
def detect_object(image, lower_hsv, upper_hsv):
    # Konversi citra ke ruang warna HSV
    hsv_image = cv2.cvtColor(image, cv2.COLOR_BGR2HSV)
    
    # Buat mask menggunakan rentang warna HSV yang ditentukan
    mask = cv2.inRange(hsv_image, lower_hsv, upper_hsv)
    
    # Terapkan operasi morfologi untuk membersihkan noise
    kernel = np.ones((5, 5), np.uint8)
    mask = cv2.erode(mask, kernel, iterations=2)
    mask = cv2.dilate(mask, kernel, iterations=2)
    
    # Temukan kontur objek yang terdeteksi
    contours, _ = cv2.findContours(mask, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
    
    # Gambar kotak di sekitar setiap objek yang terdeteksi
    for contour in contours:
        x, y, w, h = cv2.boundingRect(contour)
        cv2.rectangle(image, (x, y), (x+w, y+h), (0, 255, 0), 2)
    
    return image

# Buka kamera
cap = cv2.VideoCapture(0)

# Tentukan rentang warna HSV yang ingin di deteksi
lower_hsv = np.array([90, 50, 50])  # Rentang bawah HSV
upper_hsv = np.array([130, 255, 255])  # Rentang atas HSV

while True:
    # Baca citra dari kamera
    ret, frame = cap.read()
    
    # Panggil fungsi deteksi objek
    result = detect_object(frame, lower_hsv, upper_hsv)
    
    # Tampilkan citra asli dan hasil deteksi
    cv2.imshow('Detection Result', result)
    
    # Keluar dari loop jika tombol 'q' ditekan
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Tutup kamera dan jendela tampilan
cap.release()
cv2.destroyAllWindows()
