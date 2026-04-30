<template>
  <div></div>
</template>

<script setup>
import { useAuthStore } from '~/stores/auth'

const auth = useAuthStore()

// Initialize auth from localStorage (handles token from previous session)
await auth.initAuth()

// Redirect based on auth status
if (auth.isLoggedIn) {
  await navigateTo('/pegawai')
} else {
  await navigateTo('/login')
}
</script>
