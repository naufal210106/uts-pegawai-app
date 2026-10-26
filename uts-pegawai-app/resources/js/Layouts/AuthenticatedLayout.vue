<script setup>
import { Link } from '@inertiajs/vue3';
</script>
 
<template>
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar kiri -->
        <aside class="w-64 bg-slate-900 text-white min-h-screen flex flex-col justify-between p-5">
            <div>
                <div class="text-xl font-bold tracking-wide border-b border-slate-700 pb-4 mb-6">
                    SIM DATA PEGAWAI
                </div>
 
                <nav class="space-y-2">
                    <Link
                        :href="route('dashboard')"
                        class="block px-4 py-2.5 rounded transition"
                        :class="route().current('dashboard')
                            ? 'bg-teal-600 text-white font-semibold'
                            : 'text-slate-300 hover:bg-slate-800'"
                    >
                        Dashboard
                    </Link>
 
                    <Link
                        :href="route('employees.index')"
                        class="block px-4 py-2.5 rounded transition"
                        :class="route().current('employees.*')
                            ? 'bg-teal-600 text-white font-semibold'
                            : 'text-slate-300 hover:bg-slate-800'"
                    >
                        Data Pegawai (CRUD)
                    </Link>
 
                    <Link
                        :href="route('info.kepegawaian')"
                        class="block px-4 py-2.5 rounded transition"
                        :class="route().current('info.kepegawaian')
                            ? 'bg-teal-600 text-white font-semibold'
                            : 'text-slate-300 hover:bg-slate-800'"
                    >
                        Info Kepegawaian
                    </Link>
                </nav>
            </div>
 
            <div class="border-t border-slate-700 pt-4">
                <div class="text-sm text-slate-300 mb-3">
                    Login sebagai:
                    <span class="font-semibold text-white">{{ $page.props.auth.user.name }}</span>
                </div>
 
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="w-full text-left px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded transition"
                >
                    Logout
                </Link>
            </div>
        </aside>
 
        <!-- Konten utama -->
        <div class="flex-1 flex flex-col">
            <header v-if="$slots.header" class="bg-white shadow-sm px-8 py-5">
                <slot name="header" />
            </header>
 
            <main class="p-8 flex-1">
                <slot />
            </main>
        </div>
    </div>
</template>
