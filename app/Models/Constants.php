<?php

namespace App\Models;

class Constants {
    
    public static $DEFAULT_PAGINATION_COUNT = 50;

    public static $USER_ROLE_SUPER_ADMIN = 'SUPER ADMIN';
    public static $USER_ROLE_ADMIN = 'ADMIN';
    public static $PERCENTAGE = 'PERCENTAGE';
    public static $AMOUNT = 'AMOUNT';

    public static $TRANSACTION_STATUS_DELIVERED = 'DELIVERED';


    public static $MESSAGE_SUCCESSFULLY_DISPLAYED = 'Data Berhasil Ditampilkan !!';
    public static $MESSAGE_SUCCESSFULLY_CREATED   = 'Data Berhasil Ditambahkan !!';
    public static $MESSAGE_SUCCESSFULLY_UPDATED   = 'Data Berhasil Update !!';
    public static $MESSAGE_SUCCESSFULLY_DESTROY   = 'Data Berhasil Dihapus !!';
    public static $MESSAGE_FAILED  = 'Data Gagal Disimpan !!';
    public static $MESSAGE_NOT_FOUND  = 'Data Tidak Ditemukan !!';
    public static $MESSAGE_INTERNAL_SERVER_ERROR  = 'Internal Server Error !!';
    public static $MESSAGE_EXPORT_EXCEL_PDF_NO_DATES  = 'Tanggal awal dan akhir harus diisi untuk mengekspor excel.';
    public static $MESSAGE_IMPORT_EXCEL_FAILED  = 'Gagal mengambil data dari file excel anda. Pastikan excel sesuai format dan data outlet no ktp semua ada di aplikasi.';
    public static $MESSAGE_IMPORT_EXCEL_SUCCEED  = 'Data dari excel berhasil di import.';

}