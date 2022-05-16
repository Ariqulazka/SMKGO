# **SMK GO**

---

## Installation

Silahkan ikuti instruksi dibawah ini untuk menjalankan project ini :

1. Clone project ini pada komputer Anda. Pastikan sudah terinstall git.

    ```bash
    git clone https://github.com/IhsanDevs/SMKGO.git
    ```

2. Buka terminal Anda pada project ini. Gunakan command :

    ```bash
    cd SMKGO
    ```

3. Kemudian install semua dependency composer yang dibutuhkan. Pastikan sudah terinstall composer juga.

    ```bash
    composer install
    ```

    ```bash
    composer update
    ```

4. Setelah itu, copy paste file `.env.example` menjadi file `.env`.

5. Buka project di code editor Anda.

6. Konfigurasikan database username, database password, dan database name sesuai dengan server database Anda.

7. Buat `app_key` untuk project Anda dengan cara:

    ```bash
    php artisan key:generate
    ```

8. Kemudian lakukan migrasi serta seeding table.

    ```bash
    php artisan migrate:fresh --seed
    ```

9. Setelah itu hubungkan path storage ke public agar file yang diupload user dapat diakses.

    ```bash
    php artisan storage:link
    ```

10. Jika sudah semua, silahkan jalankan aplikasi dengan ketik :

    ```bash
    php artisan serve
    ```

## Credentials

Akun default admin:

**Email : ** `admin@site.com`

**Password : ** `password`

Akun default user:

**Email : ** `user@site.com`

**Password : ** `password`

## Reference

-   Dokumentasi Role and Permission : https://spatie.be/docs/laravel-permission/v5/introduction
-   Dokumentasi Laravel Multi Languange : https://laravel.com/docs/9.x/localization
-   Dokumentasi Laravel Relationship Table : https://laravel.com/docs/9.x/eloquent-relationships#main-content
-   Template CoreUI : https://coreui.io/
