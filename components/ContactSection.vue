<template>
  <section id="contact" class="section">
    <div class="reveal">
      <div class="contact-box">
        <h2 class="contact-title">{{ t('contact.title') }}</h2>
        <p class="contact-sub">
          {{ t('contact.sub1') }}<br />{{ t('contact.sub2') }}
        </p>
        <div class="contact-links">
          <a href="mailto:koladeaboudou@gmail.com" class="link-email">
            <Icon name="tabler:mail" size="16" />
            koladeaboudou@gmail.com
          </a>
          <a
            href="https://github.com/Kola771"
            target="_blank"
            rel="noopener"
            class="link-other"
          >
            <Icon name="tabler:brand-github" size="16" />
            GitHub
          </a>
          <a
            href="https://linkedin.com/in/koladeaboudou"
            target="_blank"
            rel="noopener"
            class="link-other"
          >
            <Icon name="tabler:brand-linkedin" size="16" />
            LinkedIn
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
</script>

<style scoped>
.section {
  padding: 3.5rem 2rem 4rem;
  max-width: 860px;
  margin: 0 auto;
}

.contact-box {
  background: var(--acc-bg);
  border: 0.5px solid var(--acc-border);
  border-radius: var(--radius-xl);
  padding: 3.5rem 2.5rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.contact-box::before {
  content: '';
  position: absolute;
  top: -60%;
  left: 50%;
  transform: translateX(-50%);
  width: 320px;
  height: 320px;
  border-radius: 50%;
  background: radial-gradient(
    circle,
    rgba(14, 165, 233, 0.09),
    transparent 70%
  );
  animation: glow 4.5s ease-in-out infinite alternate;
  pointer-events: none;
}

@keyframes glow {
  from { transform: translateX(-50%) scale(1); }
  to   { transform: translateX(-50%) scale(1.35); }
}

.contact-title {
  font-size: 28px;
  font-weight: 500;
  color: var(--txt);
  margin-bottom: 10px;
  position: relative;
}

.contact-sub {
  font-size: 14px;
  color: var(--txt2);
  margin-bottom: 2rem;
  line-height: 1.8;
  position: relative;
}

.contact-links {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
  position: relative;
}

.link-email {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 10px 20px;
  border-radius: var(--radius);
  background: var(--acc);
  color: #fff;
  font-size: 13px;
  transition: transform 0.2s, opacity 0.2s;
}

.link-email:hover {
  transform: translateY(-2px);
  opacity: 0.88;
}

.link-other {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 10px 20px;
  border-radius: var(--radius);
  border: 0.5px solid var(--bdr2);
  color: var(--txt2);
  font-size: 13px;
  transition: all 0.2s;
}

.link-other:hover {
  border-color: var(--acc);
  color: var(--acc);
  transform: translateY(-2px);
}

@media (max-width: 640px) {
  .contact-box { padding: 2.5rem 1.25rem; }
  .contact-links { flex-direction: column; align-items: stretch; }
  .link-email, .link-other { justify-content: center; }
}
</style>
