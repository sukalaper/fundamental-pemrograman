import cv2
import numpy as np

def detect_color(image):
    hsv_image = cv2.cvtColor(image, cv2.COLOR_BGR2HSV)

    # Tentukan rentang warna
    # Untuk warna dapat ditentukan pada website dibawah ini :
    # https://www.color-blindness.com/color-name-hue/
    lower_color = np.array([0, 0, 50])  # Rentang bawah warna (misal: Hijau)
    upper_color = np.array([10, 225, 225])  # Rentang atas warna (misal: Hijau)

    # Buat mask dengan rentang warna yang ditentukan
    mask = cv2.inRange(hsv_image, lower_color, upper_color)

    # Aplikasikan mask pada citra asli
    result = cv2.bitwise_and(image, image, mask=mask)

    return result

# Buka kamera
cap = cv2.VideoCapture(0)

# Periksa apakah kamera terbuka dengan sukses
if not cap.isOpened():
    print("Tidak dapat membuka kamera")
    exit()

# Set ukuran frame kamera
cap.set(cv2.CAP_PROP_FRAME_WIDTH, 1280)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 720)

while True:
    # Baca citra dari kamera
    ret, frame = cap.read()

    # Periksa apakah citra berhasil dibaca
    if not ret:
        print("Tidak dapat membaca frame dari kamera")
        break

    # Panggil fungsi deteksi warna
    result = detect_color(frame)

    # Tampilkan citra asli dan hasil deteksi
    cv2.imshow('Gambar Asli', frame)
    cv2.imshow('Hasil Deteksi Objek', result)

    # Keluar dari loop jika tombol 'q' ditekan
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Tutup kamera dan jendela tampilan
cap.release()
cv2.destroyAllWindows()
