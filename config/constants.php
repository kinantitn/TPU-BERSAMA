<?php

return [
    'area' => [
        'jakarta_utara' => [
            'name' => 'Jakarta Utara',
            'value' => 'jakarta_utara',
        ],
        'jakarta_selatan' => [
            'name' => 'Jakarta Selatan',
            'value' => 'jakarta_selatan',
        ],
        'jakarta_timur' => [
            'name' => 'Jakarta Timur',
            'value' => 'jakarta_timur',
        ],
        'jakarta_barat' => [
            'name' => 'Jakarta Barat',
            'value' => 'jakarta_barat',
        ],
        'jakarta_pusat' => [
            'name' => 'Jakarta Pusat',
            'value' => 'jakarta_pusat',
        ],
        'kepulauan_seribu' => [
            'name' => 'Kepulauan Seribu',
            'value' => 'kepulauan_seribu',
        ],
    ],
    'type_tpu' => [
        'umum' => [
            'name' => 'Umum',
            'value' => 'umum',
        ],
        'covid' => [
            'name' => 'COVID-19',
            'value' => 'covid',
        ]
    ],
    'class_tpu' => [
        'KELAS_A' => [
            'name' => 'Kelas A',
            'description' => [
                'Memiliki area yang sangat luas, sehingga sangat cocok apabila terdapat keluarga besar yang akan atau ingin berziarah',
                'Dibersihkan secara rutin oleh petugas kebersihan setempat dengan frekuensi 2 hari sekali',
                'Berada pada area teduh, dikelilingi pohon yang rindang di sekitar pemakaman',
                'Jarak yang berjauhan dengan makam-makam lainnya',
                'Akses yang mudah dengan menggunakan kendaraan pribadi (motor dan mobil)'
            ],
            'param' => 'A',
            'class' => 'primary',
            'price_table' => 'price_a',
            'area_table' => 'area_class_a',
            'value' => 'KELAS_A'
        ],
        'KELAS_B' => [
            'name' => 'Kelas B',
            'description' => [
                'Memiliki area yang cukup luas, sehingga cocok apabila terdapat beberapa keluarga yang akan atau ingin berziarah',
                'Dibersihkan secara rutin oleh petugas kebersihan setempat dengan frekuensi 4 hari sekali',
                'Berada pada area yang cukup teduh, dikelilingi pohon yang cukup rindang di sekitar pemakaman',
                'Jarak yang cukup berjauhan dengan makam-makam lainnya',
                'Akses yang cukup mudah dengan menggunakan kendaraan pribadi (motor dan mobil)'
            ],
            'param' => 'B',
            'class' => 'warning',
            'price_table' => 'price_b',
            'area_table' => 'area_class_b',
            'value' => 'KELAS_B'
        ],
        'KELAS_C' => [
            'name' => 'Kelas C',
            'description' => [
                'Memiliki area yang tidak terlalu luas, sehingga sangat cocok apabila terdapat keluarga kecil yang akan atau ingin berziarah',
                'Dibersihkan secara rutin oleh petugas kebersihan setempat dengan frekuensi seminggu sekali',
                'Berada pada area yang sedikit teduh, dikelilingi tidak terlalu banyak pohon di sekitar',
                'Jarak yang cukup berdekatan dengan makam-makam lainnya',
                'Akses yang cukup mudah dengan menggunakan kendaraan pribadi (motor)'
            ],
            'param' => 'C',
            'class' => 'danger',
            'price_table' => 'price_c',
            'area_table' => 'area_class_c',
            'value' => 'KELAS_C'
        ],
    ],
    'customer_type' => [
        'WNA' => [
            'name' => 'Warga Negara Asing',
            'value' => 'WNA',
        ],
        'WARGA_JAKARTA' => [
            'name' => 'Warga Jakarta',
            'value' => 'WARGA_JAKARTA',
        ],
        'WARGA_LUAR_JAKARTA' => [
            'name' => 'Warga Luar Jakarta',
            'value' => 'WARGA_LUAR_JAKARTA',
        ],
        'KELUARGA_MISKIN' => [
            'name' => 'Keluarga Miskin',
            'value' => 'KELUARGA_MISKIN',
        ],
        // 'ORANG_TERLANTAR' => [
        //     'name' => 'Orang Terlantar',
        //     'value' => 'ORANG_TERLANTAR',
        // ],
    ],
    'gender' => [
        'MALE' => [
            'name' => 'Laki-laki',
            'value' => 'MALE'
        ],
        'FEMALE' => [
            'name' => 'Perempuan',
            'value' => 'FEMALE'
        ],
    ],
    'religion' => [
        'ISLAM' => [
            'name' => 'Islam',
            'value' => 'ISLAM'
        ],
        'PROTESTAN' => [
            'name' => 'Kristen Prostestan',
            'value' => 'PROTESTAN'
        ],
        'KATOLIK' => [
            'name' => 'Kristen Katolik',
            'value' => 'KATOLIK'
        ],
        'HINDU' => [
            'name' => 'Hindu',
            'value' => 'HINDU'
        ],
        'BUDHA' => [
            'name' => 'Budha',
            'value' => 'BUDHA'
        ],
        'KONGHUCHU' => [
            'name' => 'Kong Hu Chu',
            'value' => 'KONGHUCHU'
        ],
        'LAINNYA' => [
            'name' => 'Lainnya',
            'value' => 'LAINNYA'
        ],
    ],
    'payment_method' => [
        'BCA' => [
            'name' => 'Transfer Bank BCA',
            'value' => 'BCA',
            'image' => 'images/bank/logo-bca.jpg',
            'reference_number' => '123123123',
            'name_reference' => 'TPU Bersama'
        ],
        'BNI' => [
            'name' => 'Transfer Bank BNI',
            'value' => 'BNI',
            'image' => 'images/bank/logo-bni.jpg',
            'reference_number' => '123123123',
            'name_reference' => 'TPU Bersama'
        ],
        'BRI' => [
            'name' => 'Transfer Bank BRI',
            'value' => 'BRI',
            'image' => 'images/bank/logo-bri.jpg',
            'reference_number' => '123123123',
            'name_reference' => 'TPU Bersama'
        ],
        'MANDIRI' => [
            'name' => 'Transfer Bank Mandiri',
            'value' => 'MANDIRI',
            'image' => 'images/bank/logo-mandiri.jpg',
            'reference_number' => '123123123',
            'name_reference' => 'TPU Bersama'
        ],
    ],
    'payment_status' => [
        'PENDING' => [
            'name' => 'Belum Dibayar',
            'class' => 'warning',
        ],
        'PAID' => [
            'name' => 'Sudah Dibayar',
            'class' => 'primary',
        ],
    ],
    'status' => [
        'CANCEL' => [
            'name' => 'Dibatalkan',
            'class' => 'danger',
        ],
        'PENDING' => [
            'name' => 'Belum Dikonfirmasi',
            'class' => 'warning',
        ],
        'CONFIRM' => [
            'name' => 'Sudah Dikonfirmasi',
            'class' => 'info',
        ],
        'ARRIVE' => [
            'name' => 'Sudah Tiba di TPU',
            'class' => 'info',
        ],
        'COMPLETE' => [
            'name' => 'Selesai',
            'class' => 'primary',
        ],
    ],
];
