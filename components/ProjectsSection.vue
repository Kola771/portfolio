<template>
  <section id="projects" class="section">
    <div class="reveal">
      <p class="sec-label">{{ t('projects.label') }}</p>
      <h2 class="sec-title">{{ t('projects.title') }}</h2>
      <p class="sec-sub">{{ t('projects.sub') }}</p>

      <div class="projects-grid">
        <ProjectCard v-for="p in projects" :key="p.id" :project="p" />
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n'
import { projects } from '../data/projects'

const { t } = useI18n()
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

.projects-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.1rem;
}

@media (max-width: 640px) {
  .projects-grid {
    grid-template-columns: 1fr;
  }
}
</style>
