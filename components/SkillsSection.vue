<template>
  <section id="skills" class="section">
    <div class="reveal">
      <p class="sec-label">{{ t('skills.label') }}</p>
      <h2 class="sec-title">{{ t('skills.title') }}</h2>
      <p class="sec-sub">{{ t('skills.sub') }}</p>

      <div class="skills-grid">
        <div v-for="group in skillGroups" :key="group.title" class="skill-group">
          <div class="group-title">{{ group.title }}</div>

          <div v-for="skill in group.items" :key="skill.name" class="skill-item">
            <span class="skill-name">{{ skill.name }}</span>
            <div class="skill-bar">
              <div
                class="skill-fill"
                :data-width="skill.level"
                :style="{ width: '0%' }"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const skillGroups = [
  {
    title: 'Backend',
    items: [
      { name: 'NestJS', level: 92 },
      { name: 'Laravel', level: 85 },
      { name: 'Node.js', level: 88 },
      { name: 'TypeScript', level: 84 },
      { name: 'Prisma / SQL', level: 80 },
    ],
  },
  {
    title: 'Frontend',
    items: [
      { name: 'Vue 3 / Nuxt 3', level: 92 },
      { name: 'Next.js (TSX)', level: 88 },
      { name: 'Inertia.js', level: 82 },
      { name: 'React', level: 70 },
      { name: 'TailwindCSS', level: 85 },
    ],
  },
]
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
  margin-bottom: 6px;
}

.sec-sub {
  font-size: 13px;
  color: var(--txt3);
  margin-bottom: 2rem;
}

.skills-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}

.skill-group {
  background: var(--bg3);
  border: 0.5px solid var(--bdr);
  border-radius: var(--radius-lg);
  padding: 1.25rem;
  transition: border-color 0.2s;
}

.skill-group:hover {
  border-color: var(--acc-border);
}

.group-title {
  font-size: 11px;
  color: var(--acc);
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 1.1rem;
  font-family: var(--font-mono);
}

.skill-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 10px;
  gap: 1rem;
}

.skill-name {
  font-size: 13px;
  color: var(--txt);
  flex-shrink: 0;
  min-width: 110px;
}

.skill-bar {
  flex: 1;
  height: 3px;
  background: var(--bdr2);
  border-radius: 2px;
  overflow: hidden;
}

.skill-fill {
  height: 100%;
  background: var(--acc);
  border-radius: 2px;
  transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
}

@media (max-width: 640px) {
  .skills-grid {
    grid-template-columns: 1fr;
  }
}
</style>
