<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
 
const props = defineProps({
    employees: Array,
    filters: Object,
});
 
const search = ref(props.filters?.search || '');
 
const handleSearch = () => {
    router.get(route('employees.index'), { search: search.value }, {
        preserveState: true,
        replace: true,
    });
};
 
const resetSearch = () => {
    search.value = '';
    router.get(route('employees.index'));
};
 
const deleteEmployee = (id, nama) => {
    if (confirm(`Apakah Anda yakin ingin menghapus data pegawai "${nama}"?`)) {
        router.delete(route('employees.destroy', id));
    }
};
 
const formatRupiah = (angka) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(angka);
};
</script>
 
<template>
    <Head title="Data Pegawai" />
 
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Manajemen Data Pegawai
                </h2>
                <Link
                    :href="route('employees.create')"
                    class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded shadow-sm transition"
                >
                    + Tambah Pegawai Baru
                </Link>
            </div>
        </template>
 
        <!-- Flash message -->
        <div
            v-if="$page.props.flash?.success"
            class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded"
        >
            {{ $page.props.flash.success }}
        </div>
 
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <!-- Pencarian -->
            <form @submit.prevent="handleSearch" class="flex gap-3 mb-6">
                <input
                    v-model="search"
                    type="text"
                    placeholder="Cari berdasarkan NIP, nama, jabatan, atau departemen..."
                    class="flex-1 border border-gray-300 rounded-md shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm px-4 py-2"
                />
                <button
                    type="submit"
                    class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium rounded transition"
                >
                    Cari
                </button>
                <button
                    v-if="search"
                    type="button"
                    @click="resetSearch"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded transition"
                >
                    Reset
                </button>
            </form>
 
            <!-- Tabel -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">NIP</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Pegawai</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Jabatan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Departemen</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Gaji Pokok</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                        <tr v-for="(item, index) in employees" :key="item.id" class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ index + 1 }}</td>
                            <td class="px-4 py-3 whitespace-nowrap font-mono font-medium text-teal-700">{{ item.nip }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ item.nama }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ item.jabatan }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-600">{{ item.departemen }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-gray-800">{{ formatRupiah(item.gaji) }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center space-x-2">
                                <Link
                                    :href="route('employees.edit', item.id)"
                                    class="inline-block px-3 py-1 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded"
                                >
                                    Edit
                                </Link>
                                <button
                                    type="button"
                                    @click="deleteEmployee(item.id, item.nama)"
                                    class="inline-block px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        <tr v-if="employees.length === 0">
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data pegawai yang tersimpan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
