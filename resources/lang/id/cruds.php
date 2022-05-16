<?php

return [
    'userManagement' => [
        'title'          => 'Manajemen User',
        'title_singular' => 'Manajemen User',
    ],
    'permission' => [
        'title'          => 'Izin',
        'title_singular' => 'Izin',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Peranan',
        'title_singular' => 'Peranan',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Daftar Pengguna',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'school' => [
        'title'          => 'Sekolah',
        'title_singular' => 'Sekolah',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'school_name'             => 'Nama sekolah',
            'school_name_helper'      => 'Masukkan nama sekolah',
            'thumbnail_school'        => 'Thumbnail sekolah',
            'thumbnail_school_helper' => 'Masukkan gambar pratinjau untuk sekolah Anda',
            'address'                 => 'Alamat',
            'address_helper'          => 'Masukkan alamat sekolah',
            'contact'                 => 'Kontak',
            'contact_helper'          => 'Masukkan kontak sekolah Anda yang dapat dihubungi',
            'type'                    => 'Tipe',
            'type_helper'             => 'Pilih tipe sekolah Anda (default: Negeri)',
            'author'                  => 'Author',
            'author_helper'           => 'Pilih nama author untuk data sekolah ini',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'major'                   => 'Jurusan',
            'major_helper'            => 'Pilih jurusan yang terdapat pada sekolah Anda',
        ],
    ],
    'major' => [
        'title'          => 'Jurusan',
        'title_singular' => 'Jurusan',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Nama',
            'name_helper'        => 'Masukkan nama jurusan',
            'description'        => 'Description',
            'description_helper' => 'Masukkan deksripsi jurusan',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
];
