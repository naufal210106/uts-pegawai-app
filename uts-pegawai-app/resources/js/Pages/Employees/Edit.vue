<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
 
const props = defineProps({
    employee: Object,
});
 
const form = useForm({
    nip: props.employee.nip,
    nama: props.employee.nama,
    jabatan: props.employee.jabatan,
    departemen: props.employee.departemen,
    gaji: props.employee.gaji,
});
 
const submit = () => {
    form.put(route('employees.update', props.employee.id));
};
</script>
 
<template>
    <Head title="Edit Pegawai" />
 
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Data Pegawai: {{ employee.nama }}
            </h2>
        </template>
 
        <div class="max-w-2xl bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIP (Unik)</label>
                    <input
                        v-model="form.nip"
                        type="text"
                        class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm"
                    />
                    <div v-if="form.errors.nip" class="text-red-600 text-xs mt-1">{{ form.errors.nip }}</div>
                </div>
 
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Pegawai</label>
                    <input
                        v-model="form.nama"
                        type="text"
                        class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm"
                    />
                    <div v-if="form.errors.nama" class="text-red-600 text-xs mt-1">{{ form.errors.nama }}</div>
                </div>
 
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input
                            v-model="form.jabatan"
                            type="text"
                            class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm"
                        />
                        <div v-if="form.errors.jabatan" class="text-red-600 text-xs mt-1">{{ form.errors.jabatan }}</div>
                    </div>
 
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                        <select
                            v-model="form.departemen"
                            class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm"
                        >
                            <option value="Teknologi Informasi">Teknologi Informasi</option>
                            <option value="Sumber Daya Manusia">Sumber Daya Manusia</option>
                            <option value="Keuangan & Akuntansi">Keuangan &amp; Akuntansi</option>
                            <option value="Operasional">Operasional</option>
                            <option value="Pemasaran">Pemasaran</option>
                        </select>
                        <div v-if="form.errors.departemen" class="text-red-600 text-xs mt-1">{{ form.errors.departemen }}</div>
                    </div>
                </div>
 
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gaji Pokok (Rp)</label>
                    <input
                        v-model="form.gaji"
                        type="number"
                        min="0"
                        class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm"
                    />
                    <div v-if="form.errors.gaji" class="text-red-600 text-xs mt-1">{{ form.errors.gaji }}</div>
                </div>
 
                <div class="flex items-center justify-end gap-3 pt-4 border-t">
                    <Link
                        :href="route('employees.index')"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded transition"
                    >
                        Batal
                    </Link>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="px-5 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded shadow-sm transition"
                    >
                        Perbarui Pegawai
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
