<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
 
<template>
    <Head title="Informasi Kepegawaian" />
 
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Informasi Sistem Kepegawaian
            </h2>
        </template>
 
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-2">
                Sistem Informasi Data Pegawai (Studi Kasus F.1)
            </h3>
            <p class="text-gray-600 leading-relaxed mb-4">
                Halaman ini merupakan halaman tambahan sederhana menggunakan arsitektur
                Route - Inertia - Vue untuk memenuhi spesifikasi wajib G.1 Nomor 2 pada
                Ujian Tengah Semester (UTS) Pemrograman Web II.
            </p>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li><strong>Nama Entitas:</strong> Pegawai (employees)</li>
                <li><strong>Atribut Tabel:</strong> nip (unik), nama, jabatan, departemen, gaji</li>
                <li><strong>Fitur Aplikasi:</strong> Autentikasi Breeze, Sidebar Navigasi, CRUD Pegawai Lengkap, dan Pencarian Data.</li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>

