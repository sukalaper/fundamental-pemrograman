import cv2
import numpy as np

# Fungsi untuk mendeteksi objek berwarna dalam citra
def detect_object(image):
    # Ubah citra ke skala keabuan
    gray_image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    # Lakukan Otsu's Thresholding
    _, thresholded_image = cv2.threshold(gray_image, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)

    # Terapkan operasi morfologi untuk membersihkan noise
    kernel = np.ones((5, 5), np.uint8)
    mask = cv2.erode(thresholded_image, kernel, iterations=2)
    mask = cv2.dilate(mask, kernel, iterations=2)

    # Aplikasikan mask pada citra asli
    result = cv2.bitwise_and(image, image, mask=mask)

    return 

# Buka kamera
cap = cv2.VideoCapture(0)

cap.set(cv2.CAP_PROP_FRAME_WIDTH, 1280)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 720)

while True:
    # Baca citra dari kamera
    ret, frame = cap.read()

    # Panggil fungsi deteksi objek dengan Otsu's Thresholding
    result = detect_object(frame)

    # Tampilkan citra asli dan hasil deteksi
    cv2.imshow('Original Image', frame)
    cv2.imshow('Detection Result', result)

    # Keluar dari loop jika tombol 'q' ditekan
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Tutup kamera dan jendela tampilan
cap.release()
cv2.destroyAllWindows()

