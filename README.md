# API for nutapos
Author : 
- Parama Fadli Kurnia

# storeTransaction
URL: localhost/nutapos/apis/storeTransaction
method: POST
body:
{
    "NamaPelanggan": "Andi",
    "Tanggal": "2019-01-07",
    "Jam": "10:45",
    "Total": 38000,
    "BayarTunai": 50000,
    "Kembali": 12000,
    "DetilPenjualan":
            [
                {
                    "Item": "Roti",
                    "Qty": 10,
                    "HargaSatuan": 2000,
                    "SubTotal": 20000
                },
                {
                    "Item": "Keju",
                    "Qty": 4,
                    "HargaSatuan": 4500,
                    "SubTotal": 18000
                }
            ]
}
