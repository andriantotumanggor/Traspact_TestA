export default defineNuxtRouteMiddleware(async () => {
  const auth = useAuthStore()
  await auth.initAuth()
  if (!auth.isLoggedIn || !auth.user) {
    return navigateTo('/login')
  }
})
