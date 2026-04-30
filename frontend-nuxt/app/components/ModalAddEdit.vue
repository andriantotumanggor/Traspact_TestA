<template>
  <Dialog v-model:visible="visible" modal header="Pegawai" :style="{ width: '90vw', maxWidth: '800px' }">
    <form @submit.prevent="handleSubmit">
      <div class="flex flex-col gap-4">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">NIP</label>
            <input v-model="form.nip" type="text" class="w-full p-2 border rounded" required />
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input v-model="form.nama" type="text" class="w-full p-2 border rounded" required />
          </div>
        </div>
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">Tempat Lahir</label>
            <input v-model="form.tempat_lahir" type="text" class="w-full p-2 border rounded" required />
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">Tgl Lahir</label>
            <input v-model="form.tgl_lahir" type="date" class="w-full p-2 border rounded" required />
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Alamat</label>
          <textarea v-model="form.alamat" class="w-full p-2 border rounded" required></textarea>
        </div>
        <div class="flex gap-4">
          <div>
            <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
            <div class="flex gap-4">
              <label class="flex items-center gap-1">
                <input v-model="form.jk" type="radio" value="L" required /> Laki-laki
              </label>
              <label class="flex items-center gap-1">
                <input v-model="form.jk" type="radio" value="P" required /> Perempuan
              </label>
            </div>
          </div>
        </div>
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">Agama</label>
            <input v-model="form.agama" type="text" class="w-full p-2 border rounded" />
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">No HP</label>
            <input v-model="form.no_hp" type="text" class="w-full p-2 border rounded" />
          </div>
        </div>
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">NPWP</label>
            <input v-model="form.npwp" type="text" class="w-full p-2 border rounded" />
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">Foto</label>
            <input type="file" @change="handleFileChange" accept="image/*" class="w-full p-2 border rounded" />
            <img v-if="form.foto_preview" :src="form.foto_preview" class="mt-2 w-20 h-20 object-cover rounded" />
          </div>
        </div>
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">Golongan</label>
            <select v-model="form.golongan_id" class="w-full p-2 border rounded" required>
              <option v-for="g in store.masterData.golongan" :key="g.id" :value="g.id">{{ g.nama }}</option>
            </select>
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">Eselon</label>
            <select v-model="form.eselon_id" class="w-full p-2 border rounded">
              <option :value="null">-</option>
              <option v-for="e in store.masterData.eselon" :key="e.id" :value="e.id">{{ e.nama }}</option>
            </select>
          </div>
        </div>
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">Jabatan</label>
            <select v-model="form.jabatan_id" class="w-full p-2 border rounded" required>
              <option v-for="j in store.masterData.jabatan" :key="j.id" :value="j.id">{{ j.nama }}</option>
            </select>
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium mb-1">Tempat Tugas</label>
            <select v-model="form.tempat_tugas_id" class="w-full p-2 border rounded" required>
              <option v-for="t in store.masterData.tempat_tugas" :key="t.id" :value="t.id">{{ t.nama }}</option>
            </select>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Unit Kerja</label>
          <select v-model="form.unit_kerja_id" class="w-full p-2 border rounded" required>
            <option v-for="u in flatUnits" :key="u.id" :value="u.id">{{ u.nama }}</option>
          </select>
        </div>
        <div class="flex justify-end gap-2 mt-6">
          <button type="button" @click="visible = false" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
      </div>
    </form>
  </Dialog>
</template>

<script setup>
const props = defineProps(['visible', 'data'])
const emit = defineEmits(['update:visible', 'saved'])

const visible = computed({
  get: () => props.visible,
  set: (v) => emit('update:visible', v)
})

import { usePegawaiStore } from '~/stores/pegawai'

const store = usePegawaiStore()

const form = ref({
  nip: '',
  nama: '',
  tempat_lahir: '',
  tgl_lahir: '',
  alamat: '',
  jk: 'L',
  agama: '',
  no_hp: '',
  npwp: '',
  foto: null,
  foto_preview: '',
  golongan_id: '',
  eselon_id: null,
  jabatan_id: '',
  unit_kerja_id: '',
  tempat_tugas_id: ''
})

watch(() => props.data, (val) => {
  if (val) {
    form.value = {
      nip: val.nip,
      nama: val.nama,
      tempat_lahir: val.tempat_lahir,
      tgl_lahir: val.tgl_lahir,
      alamat: val.alamat,
      jk: val.jk,
      agama: val.agama || '',
      no_hp: val.no_hp || '',
      npwp: val.npwp || '',
      foto: null,
      foto_preview: val.foto ? getFotoUrl(val.foto) : '',
      golongan_id: val.golongan_id,
      eselon_id: val.eselon_id,
      jabatan_id: val.jabatan_id,
      unit_kerja_id: val.unit_kerja_id,
      tempat_tugas_id: val.tempat_tugas_id
    }
  } else {
    resetForm()
  }
}, { immediate: true })

function resetForm() {
  form.value = {
    nip: '',
    nama: '',
    tempat_lahir: '',
    tgl_lahir: '',
    alamat: '',
    jk: 'L',
    agama: '',
    no_hp: '',
    npwp: '',
    foto: null,
    foto_preview: '',
    golongan_id: '',
    eselon_id: null,
    jabatan_id: '',
    unit_kerja_id: '',
    tempat_tugas_id: ''
  }
}

function handleFileChange(e) {
  const file = e.target.files[0]
  if (file) {
    form.value.foto = file
    form.value.foto_preview = URL.createObjectURL(file)
  }
}

async function handleSubmit() {
  const fd = new FormData()
  for (const key in form.value) {
    if (key === 'foto_preview') continue
    if (form.value[key] !== null && form.value[key] !== '') {
      fd.append(key, form.value[key])
    }
  }
  if (props.data) {
    fd.append('_method', 'PUT')
    await store.updatePegawai(props.data.id, fd)
  } else {
    await store.createPegawai(fd)
  }
  emit('saved')
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

function getFotoUrl(path) {
  const config = useRuntimeConfig()
  return config.public.apiBase.replace('/api', '') + '/storage/' + path
}
</script>
