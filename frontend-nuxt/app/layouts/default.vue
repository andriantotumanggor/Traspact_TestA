<template>
  <div>
    <nav class="bg-blue-600 text-white p-4 shadow-md">
      <div class="container mx-auto flex justify-between items-center">
        <NuxtLink to="/pegawai" class="text-xl font-bold">Pegawai System</NuxtLink>
        <div v-if="authStore.isLoggedIn" class="flex items-center gap-4">
          <span>{{ authStore.user?.name || 'User' }}</span>
          <button @click="authStore.logout" class="bg-red-500 px-4 py-1 rounded hover:bg-red-600">Logout</button>
        </div>
      </div>
    </nav>
    <main class="container mx-auto p-6 min-h-screen bg-gray-50">
      <slot />
    </main>
  </div>
</template>

<script setup>
// Composables are auto-imported, but store needs explicit
const authStore = useAuthStore()
</script>

