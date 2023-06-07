import cv2
import numpy as np

# Fungsi callback untuk mengubah nilai HUE saat slider digeser
def on_hue_change(value):
    global hue_value
    hue_value = value

# Inisialisasi nilai HUE awal
hue_value = 0

# Buka kamera
cap = cv2.VideoCapture(0)

# Periksa apakah kamera terbuka dengan sukses
if not cap.isOpened():
    print("Tidak dapat membuka kamera")
    exit()

# Set ukuran frame kamera
cap.set(cv2.CAP_PROP_FRAME_WIDTH, 430)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 350)

# Buat jendela tampilan dengan slider HUE
cv2.namedWindow('Hasil Deteksi Objek')
cv2.createTrackbar('HUE', 'Hasil Deteksi Objek', hue_value, 180, on_hue_change)

while True:
    # Baca citra dari kamera
    ret, frame = cap.read()

    # Periksa apakah citra berhasil dibaca
    if not ret:
        print("Tidak dapat membaca frame dari kamera")
        break

    # Konversi citra menjadi HSV
    hsv_image = cv2.cvtColor(frame, cv2.COLOR_BGR2HSV)

    # Tentukan rentang warna berdasarkan nilai HUE dari slider
    lower_color = np.array([hue_value-10, 50, 50])  # Rentang bawah warna
    upper_color = np.array([hue_value+10, 255, 255])  # Rentang atas warna

    # Buat mask dengan rentang warna yang ditentukan
    mask = cv2.inRange(hsv_image, lower_color, upper_color)

    # Aplikasikan mask pada citra asli
    result = cv2.bitwise_and(frame, frame, mask=mask)

    # Tampilkan citra asli dan hasil deteksi
    cv2.imshow('Gambar Asli', frame)
    cv2.imshow('Hasil Deteksi Objek', result)

    # Keluar dari loop jika tombol 'q' ditekan
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Tutup kamera dan jendela tampilan
cap.release()
cv2.destroyAllWindows()
