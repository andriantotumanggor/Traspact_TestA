# Nuxt IPC Connection Fix TODO

## Plan Steps (Approved)
- [x] 1. Kill conflicting process on port 3000 (PID 14964)
- [ ] 2. Clean Vite cache (rm -rf node_modules/.vite)
- [ ] 3. Update nuxt.config.ts with vite.server config + ssr:false (temp)
- [ ] 4. Test `npx nuxt dev`
- [ ] 5. Re-enable SSR if stable
- [ ] 6. Verify app loads at http://localhost:3001

Progress: Completed step 1 ✓, starting step 2

