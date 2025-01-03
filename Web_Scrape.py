from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
import pandas as pd
import time

def scrap():
    # Konfigurasi browser
    options = webdriver.ChromeOptions()
    options.headless = False  # Agar browser terlihat saat berjalan
    driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=options)
    
    url = "https://pddikti.kemdiktisaintek.go.id/perguruan-tinggi"
    driver.get(url)

    try:
        # Tunggu hingga elemen filter pertama dapat diklik, lalu klik
        WebDriverWait(driver, 30).until(
            EC.element_to_be_clickable((By.ID, ":r9:"))
        ).click()
        print("Filter pertama berhasil diklik.")
        time.sleep(5)  # Penundaan untuk memuat halaman

        # Tunggu hingga elemen filter kedua dapat diklik, lalu klik
        WebDriverWait(driver, 30).until(
            EC.element_to_be_clickable((By.ID, ":ri:"))
        ).click()
        print("Filter kedua berhasil diklik.")
        time.sleep(10)  # Penundaan untuk memuat halaman
        
        pagination_dropdown = WebDriverWait(driver, 30).until(
        EC.presence_of_element_located((By.CSS_SELECTOR, 'select[name="pagination"]'))
        )
        # Pilih opsi "48" menggunakan Select
        select = Select(pagination_dropdown)
        select.select_by_value("48")  # Pilih opsi dengan nilai "48"
        print("Berhasil memilih opsi 48 pada pagination.")
        time.sleep(5) 

        # Klik elemen terakhir
        element = WebDriverWait(driver, 30).until(
            EC.element_to_be_clickable((By.ID, ":rk:"))
        )
        driver.execute_script("arguments[0].click();", element)
        print("Filter ketiga berhasil diklik.")

    except Exception as e:
        print(f"Terjadi error saat memproses filter: {e}")
        driver.save_screenshot("error_screenshot.png")  # Simpan screenshot untuk debugging
        driver.quit()
        return

    # Menyiapkan list untuk menampung data
    university_data = []

    # Loop untuk scraping data
    while True:
        try:
            # Ambil elemen-elemen yang relevan
            universities = driver.find_elements(By.CSS_SELECTOR, '.text-black.font-semibold.line-clamp-2.text-base')
            provinces = driver.find_elements(By.CSS_SELECTOR, '.px-4.mt-1.text-sm h5')
            accreditations = driver.find_elements(By.CSS_SELECTOR, '.flex.items-center.gap-2 img[alt="certificate"] + p')
            programs = driver.find_elements(By.CSS_SELECTOR, '.flex.items-center.gap-2 img[alt="prodi"] + p')
            graduations = driver.find_elements(By.CSS_SELECTOR, '.flex.items-center.gap-2 img[alt="graduateCap"] + p')
            fees = driver.find_elements(By.CSS_SELECTOR, '.px-4 .text-sm .font-regular')

            # Loop melalui elemen untuk mengumpulkan data
            for i in range(len(universities)):
                university_info = {
                    "Nama Universitas": universities[i].text.strip(),
                    "Provinsi": provinces[i].text.strip() if i < len(provinces) else "",
                    "Akreditasi": accreditations[i].text.strip() if i < len(accreditations) else "",
                    "Jumlah Prodi": programs[i].text.strip() if i < len(programs) else "",
                    "Presentasi Kelulusan": graduations[i].text.strip() if i < len(graduations) else "",
                    "Biaya Kuliah": fees[i].text.strip() if i < len(fees) else ""
                }
                university_data.append(university_info)

            # Simpan data ke file Excel
            df = pd.DataFrame(university_data)
            df.to_excel("universitas_data_cleaned.xlsx", index=False)
            print("Data berhasil disimpan ke file Excel.")

            # Klik tombol "Next"
            next_button = WebDriverWait(driver, 30).until(
                EC.element_to_be_clickable((By.XPATH, '//button[img[@alt="right"] and not(@disabled)]'))
            )
            next_button.click()
            print("Berpindah ke halaman berikutnya.")
            time.sleep(20)  # Tunggu lebih lama agar halaman termuat sepenuhnya

        except Exception as e:
            print(f"Error saat memproses data: {e}")
            print("Tidak ada tombol 'Next' atau sudah sampai halaman terakhir.")
            break

    # Jangan menutup driver agar browser tetap terbuka
    # driver.quit()  # Komentari jika ingin browser tetap terbuka

scrap()
