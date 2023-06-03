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

    # Aplikasikan mask pada citra asli
    result = cv2.bitwise_and(image, image, mask=mask)

    return result

# Buka kamera
cap = cv2.VideoCapture(0)

# Tentukan rentang warna HSV yang ingin Anda deteksi (misalnya, warna biru)
lower_hsv = np.array([0, 0, 0])  # Rentang bawah HSV
upper_hsv = np.array([255, 255, 255])  # Rentang atas HSV
cap.set(cv2.CAP_PROP_FRAME_WIDTH, 1280)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 720)

while True:
    # Baca citra dari kamera
    ret, frame = cap.read()

    # Panggil fungsi deteksi objek
    result = detect_object(frame, lower_hsv, upper_hsv)

    # Tampilkan citra asli dan hasil deteksi
    cv2.imshow('Original Image', frame)
    cv2.imshow('Detection Result', result)

    # Keluar dari loop jika tombol 'q' ditekan
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Tutup kamera dan jendela tampilan
cap.release()
cv2.destroyAllWindows()

