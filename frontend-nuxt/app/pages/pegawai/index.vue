<template>
  <div>
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold">Data Pegawai</h1>
      <div class="flex gap-2">
        <button @click="showModal = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah</button>
        <button @click="handleDownloadPdf" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">PDF</button>
      </div>
    </div>

    <div class="flex gap-2 mb-4">
      <input v-model="search" @input="debounceSearch" placeholder="Cari NIP / Nama" class="border rounded px-3 py-2 w-64" />
      <select v-model="selectedUnit" @change="fetchData" class="border rounded px-3 py-2 w-64">
        <option value="">Semua Unit Kerja</option>
        <option v-for="u in flatUnits" :key="u.id" :value="u.id">{{ u.nama }}</option>
      </select>
    </div>

    <table class="w-full border-collapse border text-sm">
      <thead>
        <tr class="bg-gray-100">
          <th class="border p-2">No</th>
          <th class="border p-2">Foto</th>
          <th class="border p-2">NIP</th>
          <th class="border p-2">Nama</th>
          <th class="border p-2">Tempat Lahir</th>
          <th class="border p-2">Tgl Lahir</th>
          <th class="border p-2">L/P</th>
          <th class="border p-2">Golongan</th>
          <th class="border p-2">Eselon</th>
          <th class="border p-2">Jabatan</th>
          <th class="border p-2">Unit Kerja</th>
          <th class="border p-2">Tempat Tugas</th>
          <th class="border p-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(p, i) in store.pegawaiList" :key="p.id" class="hover:bg-gray-50">
          <td class="border p-2 text-center">{{ (store.pagination.current_page - 1) * store.pagination.per_page + i + 1 }}</td>
          <td class="border p-2 text-center">
            <img v-if="p.foto" :src="getFotoUrl(p.foto)" class="w-10 h-10 object-cover rounded mx-auto" />
            <span v-else class="text-gray-400">-</span>
          </td>
          <td class="border p-2">{{ p.nip }}</td>
          <td class="border p-2">{{ p.nama }}</td>
          <td class="border p-2">{{ p.tempat_lahir }}</td>
          <td class="border p-2">{{ p.tgl_lahir }}</td>
          <td class="border p-2 text-center">{{ p.jk }}</td>
          <td class="border p-2">{{ p.golongan?.nama }}</td>
          <td class="border p-2">{{ p.eselon?.nama || '-' }}</td>
          <td class="border p-2">{{ p.jabatan?.nama }}</td>
          <td class="border p-2">{{ p.unit_kerja?.nama }}</td>
          <td class="border p-2">{{ p.tempat_tugas?.nama }}</td>
          <td class="border p-2">
            <div class="flex gap-1 justify-center">
              <button @click="editPegawai(p)" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600">Edit</button>
              <button @click="confirmDelete(p)" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">Hapus</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-if="store.pagination.last_page > 1" class="flex justify-center gap-2 mt-4">
      <button v-for="page in store.pagination.last_page" :key="page" @click="goToPage(page)"
        :class="['px-3 py-1 rounded border', page === store.pagination.current_page ? 'bg-blue-600 text-white' : 'bg-white hover:bg-gray-100']">
        {{ page }}
      </button>
    </div>

    <ModalAddEdit v-model:visible="showModal" :data="editData" @saved="onSaved" />
  </div>
</template>

<script setup>
definePageMeta({
  middleware: 'auth',
  layout: 'default'
})

import { usePegawaiStore } from '~/stores/pegawai'
import { useAuthStore } from '~/stores/auth'

const config = useRuntimeConfig()
const store = usePegawaiStore()
const authStore = useAuthStore()

const search = ref('')
const selectedUnit = ref('')
const showModal = ref(false)
const editData = ref(null)

let searchTimeout = null

onMounted(() => {
  store.fetchMasterData()
  fetchData()
})

function debounceSearch() {
  clearTimeout(searchTimeout)
  searchTimeout = setTimeout(fetchData, 400)
}

function fetchData() {
  store.fetchPegawai({
    search: search.value,
    unit_kerja_id: selectedUnit.value,
    page: store.pagination.current_page || 1
  })
}

function goToPage(page) {
  store.pagination.current_page = page
  fetchData()
}

function getFotoUrl(path) {
  return config.public.apiBase.replace('/api', '') + '/storage/' + path
}

function editPegawai(p) {
  editData.value = { ...p }
  showModal.value = true
}

function onSaved() {
  showModal.value = false
  editData.value = null
  fetchData()
}

function confirmDelete(p) {
  if (confirm('Hapus pegawai ' + p.nama + '?')) {
    store.deletePegawai(p.id).then(() => fetchData())
  }
}

function handleDownloadPdf() {
  store.downloadPdf({
    search: search.value,
    unit_kerja_id: selectedUnit.value
  })
}

const flatUnits = computed(() => {
  const result = []
  function flatten(nodes, depth = 0) {
    for (const node of nodes || []) {
      result.push({ ...node, nama: '  '.repeat(depth) + node.nama })
      flatten(node.children, depth + 1)
    }
  }
  flatten(store.masterData.unit_kerja)
  return result
})
</script>
