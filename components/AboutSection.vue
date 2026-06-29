<template>
  <section id="about" class="section">
    <div class="reveal">
      <p class="sec-label">{{ t('about.label') }}</p>
      <h2 class="sec-title">{{ t('about.title') }}</h2>

      <div class="about-grid">
        <div class="about-text">
          <p>{{ t('about.p1') }}</p>
          <br />
          <p>{{ t('about.p2') }}</p>
          <br />
          <p>{{ t('about.p3') }}</p>
        </div>

        <div class="stats">
          <div v-for="stat in stats" :key="stat.label" class="stat-card">
            <div class="stat-num">{{ stat.value }}</div>
            <div class="stat-label">{{ stat.label }}</div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n'
import { computed } from 'vue'

const { t, tm, rt } = useI18n()

const stats = computed(() => {
  const raw = tm('about.stats')
  if (!Array.isArray(raw)) return []
  return (raw as unknown[]).map((item: any) => ({
    value: rt(item.value),
    label: rt(item.label),
  }))
})
</script>

<style scoped>
.section {
  padding: 3.5rem 2rem;
  max-width: 860px;
  margin: 0 auto;
}

.sec-label {
  font-size: 11px;
  color: var(--acc);
  text-transform: uppercase;
  letter-spacing: 0.12em;
  margin-bottom: 4px;
}

.sec-title {
  font-size: 27px;
  font-weight: 500;
  color: var(--txt);
  margin-bottom: 2rem;
}

.about-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2.5rem;
}

.about-text {
  font-size: 14px;
  color: var(--txt2);
  line-height: 1.9;
}


.stats {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.stat-card {
  background: var(--bg3);
  border: 0.5px solid var(--bdr);
  border-radius: var(--radius-lg);
  padding: 1rem 1.25rem;
  transition: border-color 0.2s, transform 0.2s;
}

.stat-card:hover {
  border-color: var(--acc-border);
  transform: translateX(4px);
}

.stat-num {
  font-size: 26px;
  font-weight: 500;
  color: var(--acc);
  font-family: var(--font-mono);
}

.stat-label {
  font-size: 12px;
  color: var(--txt3);
  margin-top: 2px;
}

@media (max-width: 640px) {
  .about-grid {
    grid-template-columns: 1fr;
  }
}
</style>
