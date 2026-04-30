import { defineStore } from 'pinia'
import type { User, LoginResponse } from '../types/auth'

export const useAuthStore = defineStore('auth', () => {
  const config = useRuntimeConfig()
  const token = ref<string | null>(null)
  const user = ref<User | null>(null)

  const isLoggedIn = computed(() => !!token.value)

  const setToken = (newToken: string) => {
    token.value = newToken
    if (process.client) {
      localStorage.setItem('token', newToken)
    }
  }

const setUser = (newUser: User | null) => {
    user.value = newUser
  }

  const login = async (credentials: { email: string, password: string }) => {
    try {
      const res = await $fetch<LoginResponse>(`${config.public.apiBase}/login`, {
        method: 'POST',
        body: credentials
      })
      setToken(res.token)
      setUser(res.user)
      return res
    } catch (error) {
      console.error('Login failed:', error)
      throw error
    }
  }

const logout = async () => {
    try {
      await $fetch(`${config.public.apiBase}/logout`, {
        headers: {
          Authorization: `Bearer ${token.value}`
        }
      })
    } catch (error) {
      // Continue with logout even if API call fails
      console.error('Logout API error:', error)
    }
    clearAuth()
    await navigateTo('/login')
  }

  const getUser = async () => {
    if (!token.value) return null
    try {
      const fetchedUser = await $fetch<User>(`${config.public.apiBase}/user`, {
        headers: {
          Authorization: `Bearer ${token.value}`
        }
      })
      user.value = fetchedUser
      return user.value
    } catch (error) {
      console.error('Get user failed:', error)
      clearAuth()
      return null
    }
  }

  const clearAuth = () => {
    token.value = null
    user.value = null
    if (process.client) localStorage.removeItem('token')
  }

  const initAuth = () => {
    if (process.client) {
      const savedToken = localStorage.getItem('token')
      if (savedToken) {
        token.value = savedToken
        return getUser()
      }
    }
  }

  return { 
    token, 
    user, 
    isLoggedIn, 
    login, 
    logout, 
    getUser, 
    clearAuth, 
    initAuth, 
    setToken 
  }
})

