
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

# Load citra
# Ganti lokasi alamat menuju gambar yang ingin di deteksi
image = cv2.imread('/home/anggiramadyansyah/Downloads/Solid_yellow.png')

# Sesuaikan rentang warna HSV yang ingin di deteksi
lower_hsv = np.array([90, 50, 50])  # Rentang bawah HSV
upper_hsv = np.array([130, 255, 255])  # Rentang atas HSV

# Panggil fungsi deteksi objek
result = detect_object(image, lower_hsv, upper_hsv)

# Tampilkan citra asli dan hasil deteksi
cv2.imshow('Original Image', image)
cv2.imshow('Detection Result', result)
cv2.waitKey(0)
cv2.destroyAllWindows()
