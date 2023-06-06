import cv2
import numpy as np

def detect_color(image):
    hsv_image = cv2.cvtColor(image, cv2.COLOR_BGR2HSV)

    # Tentukan 2 rentang warna berbeda
    # Untuk warna dapat ditentukan pada website dibawah ini :
    # https://www.color-blindness.com/color-name-hue/
    lower_blue = np.array([0, 0, 50])  # Rentang bawah warna (misal: biru)
    lower_blue = np.array([10, 225, 225])  # Rentang atas warna (misal: biru)
    lower_red = np.array([0, 50, 50])  # Rentang bawah warna merah
    upper_red = np.array([10, 255, 255])  # Rentang atas warna merah
    
    # Buat mask dengan rentang warna yang ditentukan
    mask_blue = cv2.inRange(hsv_image, lower_blue, upper_blue)
    mask_red = cv2.inRange(hsv_image, lower_red, upper_red)

    # Gabungkan kedua mask menjadi satu
    mask = cv2.bitwise_or(mask_blue, mask_red)

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
