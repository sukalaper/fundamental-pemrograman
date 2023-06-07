# Deteksi Objek dengan Kamera dan Pengaturan Toleransi Warna

> **Note**: Perlu diingat bahwa persepsi warna dapat bervariasi tergantung pada pengaturan monitor atau perangkat tampilan Anda. Jadi, warna yang Anda lihat pada layar Anda mungkin sedikit berbeda dari warna sebenarnya.

1. Impor Libraries

Pada bagian ini, kita mengimpor library yang dibutuhkan untuk menjalankan deteksi objek dengan kamera dan pengaturan toleransi warna.
```
import cv2
import numpy as np
import pandas as pd
```

2. Fungsi Callback Untuk Slider HUE

Fungsi `on_hue_change()` digunakan sebagai callback untuk mengubah nilai HUE saat slider digeser.
```
def on_hue_change(value):
    global hue_value
    hue_value = value
```

