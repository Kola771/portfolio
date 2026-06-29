<template>
  <article class="card" :class="'card--' + project.status">
    <!-- Animated top border -->
    <div class="card-bar" />

    <!-- Status badge -->
    <div class="status-badge" :class="'badge--' + project.status">
      <Icon
        :name="project.status === 'wip' ? 'tabler:loader' : project.status === 'done' ? 'tabler:check' : 'tabler:clock'"
        size="10"
      />
      {{ statusLabel }}
    </div>

    <!-- Type -->
    <p class="card-type">{{ t(`projects.${project.id}.type`) }}</p>

    <!-- Name -->
    <h3 class="card-name">{{ project.name }}</h3>

    <!-- Description -->
    <p class="card-desc">{{ t(`projects.${project.id}.description`) }}</p>

    <!-- Tags -->
    <div class="card-tags">
      <span v-for="tag in project.tags" :key="tag" class="tag">{{ tag }}</span>
    </div>

    <!-- Links -->
    <div class="card-links">
      <a :href="project.github" target="_blank" rel="noopener" class="link">
        <Icon name="tabler:brand-github" size="14" />
        Code
      </a>
      <a v-if="project.demo" :href="project.demo" target="_blank" rel="noopener" class="link">
        <Icon name="tabler:external-link" size="14" />
        {{ t('projects.demo') }}
      </a>
    </div>
  </article>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n'
import { computed } from 'vue'
import type { Project } from '../data/projects'

const props = defineProps<{ project: Project }>()

const { t } = useI18n()

const statusLabel = computed(() => t(`projects.status.${props.project.status}`))
</script>

<style scoped>
.card {
  background: var(--bg3);
  border: 0.5px solid var(--bdr);
  border-radius: var(--radius-lg);
  padding: 1.4rem;
  position: relative;
  overflow: hidden;
  transition: border-color 0.3s, transform 0.3s;
}

.card:hover {
  border-color: var(--acc-border);
  transform: translateY(-4px);
}

.card::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(14, 165, 233, 0.04),
    transparent
  );
  transition: left 0.55s ease;
}

.card:hover::before {
  left: 100%;
}

.card-bar {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: var(--acc);
  opacity: 0.45;
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.3s ease;
}

.card:hover .card-bar {
  transform: scaleX(1);
}

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 10px;
  padding: 3px 8px;
  border-radius: 10px;
  margin-bottom: 8px;
}

.badge--wip {
  background: rgba(251, 191, 36, 0.1);
  color: #f59e0b;
  border: 0.5px solid rgba(251, 191, 36, 0.2);
}

.badge--planned {
  background: rgba(148, 163, 184, 0.08);
  color: var(--txt3);
  border: 0.5px solid var(--bdr2);
}

.badge--done {
  background: rgba(34, 197, 94, 0.1);
  color: #22c55e;
  border: 0.5px solid rgba(34, 197, 94, 0.2);
}

.card-type {
  font-size: 11px;
  color: var(--acc);
  text-transform: uppercase;
  letter-spacing: 0.07em;
  margin-bottom: 6px;
}

.card-name {
  font-size: 16px;
  font-weight: 500;
  color: var(--txt);
  margin-bottom: 6px;
}

.card-desc {
  font-size: 13px;
  color: var(--txt2);
  line-height: 1.75;
  margin-bottom: 1rem;
}

.card-tags {
  display: flex;
  gap: 5px;
  flex-wrap: wrap;
  margin-bottom: 1rem;
}

.tag {
  font-size: 11px;
  padding: 3px 8px;
  border-radius: 4px;
  background: var(--acc-bg);
  color: var(--acc);
  border: 0.5px solid var(--acc-border);
}

.card-links {
  display: flex;
  gap: 1rem;
}

.link {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 12px;
  color: var(--txt3);
  transition: color 0.2s;
}

.link:hover {
  color: var(--acc);
}
</style>
