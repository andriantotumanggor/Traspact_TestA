import { defineStore } from 'pinia'
import { useAuthStore } from '~/stores/auth'

export const usePegawaiStore = defineStore('pegawai', () => {
  const config = useRuntimeConfig()
  const auth = useAuthStore()

  const pegawaiList = ref<any[]>([])
  const pagination = ref<any>({})
  const masterData = ref<any>({
    golongan: [],
    eselon: [],
    jabatan: [],
    unit_kerja: [],
    tempat_tugas: []
  })

  const getHeaders = () => ({
    Authorization: `Bearer ${auth.token}`
  })

  async function fetchPegawai(params: any = {}) {
    const query = new URLSearchParams()
    if (params.search) query.append('search', params.search)
    if (params.unit_kerja_id) query.append('unit_kerja_id', params.unit_kerja_id)
    if (params.page) query.append('page', params.page)

    const res: any = await $fetch(`${config.public.apiBase}/pegawai?${query}`, {
      headers: getHeaders()
    })
    pegawaiList.value = res.data
    pagination.value = {
      current_page: res.current_page,
      last_page: res.last_page,
      total: res.total,
      per_page: res.per_page
    }
    return res
  }

  async function fetchMasterData() {
    const res: any = await $fetch(`${config.public.apiBase}/master-data`, {
      headers: getHeaders()
    })
    masterData.value = res
    return res
  }

  async function createPegawai(formData: FormData) {
    return await $fetch(`${config.public.apiBase}/pegawai`, {
      method: 'POST',
      body: formData,
      headers: getHeaders()
    })
  }

  async function updatePegawai(id: number, formData: FormData) {
    return await $fetch(`${config.public.apiBase}/pegawai/${id}`, {
      method: 'POST',
      body: formData,
      headers: getHeaders()
    })
  }

  async function deletePegawai(id: number) {
    return await $fetch(`${config.public.apiBase}/pegawai/${id}`, {
      method: 'DELETE',
      headers: getHeaders()
    })
  }

  async function downloadPdf(params: any = {}) {
    const query = new URLSearchParams()
    if (params.search) query.append('search', params.search)
    if (params.unit_kerja_id) query.append('unit_kerja_id', params.unit_kerja_id)

    const response = await fetch(`${config.public.apiBase}/pegawai/pdf/print?${query}`, {
      headers: getHeaders()
    })
    const blob = await response.blob()
    const url = window.URL.createObjectURL(blob)
    const a = document.createElement('a')
    a.href = url
    a.download = 'pegawai-list.pdf'
    document.body.appendChild(a)
    a.click()
    document.body.removeChild(a)
    window.URL.revokeObjectURL(url)
  }

  return {
    pegawaiList,
    pagination,
    masterData,
    fetchPegawai,
    fetchMasterData,
    createPegawai,
    updatePegawai,
    deletePegawai,
    downloadPdf
  }
})
