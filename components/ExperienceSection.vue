<template>
  <section id="experience" class="section">
    <div class="reveal">
      <p class="sec-label">{{ t('experience.label') }}</p>
      <h2 class="sec-title">{{ t('experience.title') }}</h2>

      <div class="timeline">
        <div v-for="(item, i) in items" :key="i" class="exp-item">
          <div class="exp-line">
            <div class="exp-dot" />
            <div v-if="i < items.length - 1" class="exp-conn" />
          </div>
          <div class="exp-body">
            <div v-if="item.isMission" class="mission-badge">{{ t('experience.mission_badge') }}</div>
            <div class="exp-role">{{ item.role }}</div>
            <div class="exp-company">
              {{ item.company }}
              <span v-if="item.via" class="exp-via">· {{ item.via }}</span>
            </div>
            <div class="exp-date">{{ item.date }}</div>
            <p v-if="item.desc" class="exp-desc">{{ item.desc }}</p>
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

interface StructureItem {
  company: string
  isMission?: boolean
  via?: string
}

const structure: StructureItem[] = [
  { company: 'Vocalcom', isMission: true },
  { company: 'Factolead', isMission: true },
  { company: 'Opportunity', isMission: true },
  { company: 'HighFive University — Vipp Interstis' },
  { company: 'Direction Générale du Trésor Public' },
  { company: '2025 – 2026' },
]

const items = computed(() => {
  const raw = tm('experience.items')
  if (!Array.isArray(raw)) return []
  return (raw as unknown[]).map((item: any, i) => ({
    role: rt(item.role),
    date: rt(item.date),
    desc: rt(item.desc),
    ...structure[i],
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

.timeline {
  display: flex;
  flex-direction: column;
}

.exp-item {
  display: flex;
  gap: 1.25rem;
}

.exp-line {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex-shrink: 0;
}

.exp-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  border: 2px solid var(--acc);
  background: var(--bg);
  flex-shrink: 0;
  margin-top: 4px;
  transition: background 0.25s;
}

.exp-item:hover .exp-dot {
  background: var(--acc);
}

.exp-conn {
  width: 1px;
  flex: 1;
  background: var(--bdr2);
  margin-top: 5px;
  min-height: 20px;
}

.exp-body {
  padding-bottom: 1.75rem;
}

.exp-role {
  font-size: 15px;
  font-weight: 500;
  color: var(--txt);
}

.exp-company {
  font-size: 13px;
  color: var(--acc);
  margin-bottom: 3px;
}

.exp-date {
  font-size: 12px;
  color: var(--txt3);
  margin-bottom: 7px;
}

.exp-desc {
  font-size: 13px;
  color: var(--txt2);
  line-height: 1.8;
}

.mission-badge {
  display: inline-flex;
  align-items: center;
  font-size: 10px;
  padding: 2px 8px;
  border-radius: 10px;
  background: var(--acc-bg);
  color: var(--acc);
  border: 0.5px solid var(--acc-border);
  margin-bottom: 5px;
}

.exp-via {
  font-size: 12px;
  color: var(--txt3);
  font-style: italic;
}
</style>
