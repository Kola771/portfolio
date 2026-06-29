<template>
  <div :class="colorMode.value">
    <!-- Scroll progress -->
    <div class="scroll-progress" :style="{ width: scrollPct + '%' }" />

    <!-- Nav -->
    <nav class="nav">
      <NuxtLink to="/" class="logo">KMA</NuxtLink>

      <div class="nav-right">
        <div class="nav-links">
          <a href="#about">{{ t('nav.about') }}</a>
          <a href="#skills">{{ t('nav.skills') }}</a>
          <a href="#projects">{{ t('nav.projects') }}</a>
          <a href="#contact">{{ t('nav.contact') }}</a>
        </div>

        <!-- Language switcher -->
        <button class="lang-btn" @click="toggleLocale">
          {{ locale === 'fr' ? 'EN' : 'FR' }}
        </button>

        <!-- Theme toggle -->
        <button class="theme-btn" :aria-label="t('nav.theme_light')" @click="toggleTheme">
          <Icon :name="isDark ? 'tabler:moon' : 'tabler:sun'" size="15" />
          <span>{{ isDark ? t('nav.theme_dark') : t('nav.theme_light') }}</span>
        </button>

        <a href="#contact" class="nav-cta">{{ t('nav.cta') }}</a>
      </div>
    </nav>

    <!-- Page content -->
    <main>
      <slot />
    </main>

    <!-- Footer -->
    <footer class="footer">
      <p>{{ t('footer.text') }}</p>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n'
import { useNuxtApp } from 'nuxt/app'
import { computed, onMounted, onUnmounted, ref } from 'vue'

const { t, locale } = useI18n({ useScope: 'global' })
const colorMode = useColorMode()
const isDark = computed(() => colorMode.value === 'dark')

function toggleTheme() {
  colorMode.preference = isDark.value ? 'light' : 'dark'
}

async function toggleLocale() {
  const { $i18n } = useNuxtApp()
  const next = locale.value === 'fr' ? 'en' : 'fr'
  await ($i18n as any).setLocale(next)
}

// Scroll progress
const scrollPct = ref(0)
function onScroll() {
  const doc = document.documentElement
  scrollPct.value = (doc.scrollTop / (doc.scrollHeight - doc.clientHeight)) * 100
}
onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', onScroll))
</script>

<style scoped>
.nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 2rem;
  border-bottom: 0.5px solid var(--bdr);
  background: var(--bg);
  position: sticky;
  top: 0;
  z-index: 100;
  transition: background 0.35s;
}

.logo {
  font-size: 15px;
  font-weight: 500;
  color: var(--acc);
  letter-spacing: 0.06em;
  font-family: var(--font-mono);
}

.nav-right {
  display: flex;
  align-items: center;
  gap: 1.25rem;
}

.nav-links {
  display: flex;
  gap: 1.5rem;
}

.nav-links a {
  font-size: 13px;
  color: var(--txt2);
  transition: color 0.2s;
}

.nav-links a:hover {
  color: var(--acc);
}

.lang-btn {
  display: flex;
  align-items: center;
  background: var(--bg3);
  border: 0.5px solid var(--bdr2);
  border-radius: 20px;
  padding: 6px 13px;
  font-size: 12px;
  font-weight: 500;
  color: var(--txt2);
  transition: all 0.2s;
  letter-spacing: 0.06em;
  font-family: var(--font-mono);
}

.lang-btn:hover {
  border-color: var(--acc);
  color: var(--acc);
}

.theme-btn {
  display: flex;
  align-items: center;
  gap: 5px;
  background: var(--bg3);
  border: 0.5px solid var(--bdr2);
  border-radius: 20px;
  padding: 6px 13px;
  font-size: 12px;
  color: var(--txt2);
  transition: all 0.2s;
}

.theme-btn:hover {
  border-color: var(--acc);
  color: var(--acc);
}

.nav-cta {
  font-size: 13px;
  padding: 6px 16px;
  border: 0.5px solid var(--acc);
  border-radius: var(--radius-sm);
  color: var(--acc);
  background: transparent;
  transition: background 0.2s;
}

.nav-cta:hover {
  background: var(--acc-bg);
}

.footer {
  padding: 1.5rem 2rem;
  text-align: center;
  border-top: 0.5px solid var(--bdr);
}

.footer p {
  font-size: 12px;
  color: var(--txt3);
}

/* Mobile */
@media (max-width: 640px) {
  .nav-links {
    display: none;
  }
  .nav {
    padding: 0.875rem 1.25rem;
  }
  /* .lang-btn {
    display: none;
  } */
}
</style>
