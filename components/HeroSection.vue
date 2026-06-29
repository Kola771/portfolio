<template>
  <section class="hero" ref="heroRef" @mousemove="onMouseMove">
    <!-- Cursor glow -->
    <div
      class="cursor-glow"
      :style="{ left: glowX + 'px', top: glowY + 'px' }"
    />

    <div class="hero-content">
      <!-- Live badge -->
      <div class="badge">
        <span class="dot-live" />
        {{ t('hero.badge') }}
      </div>

      <!-- Name -->
      <h1 class="hero-title">
        Koladé<br />
        <span class="hero-acc">Aboudou</span>
      </h1>

      <!-- Typing -->
      <p class="hero-typing">
        {{ t('hero.typing_prefix') }}
        <span class="typing-text">{{ displayText }}</span>
        <span class="cursor-blink" />
      </p>

      <!-- Description -->
      <p class="hero-desc">{{ t('hero.desc') }}</p>

      <!-- CTAs -->
      <div class="hero-btns">
        <a href="#projects" class="btn-primary">{{ t('hero.btn_projects') }}</a>
        <a :href="`/${t('hero.file_cv')}`" download class="btn-secondary">
          <Icon name="tabler:download" size="16" />
          {{ t('hero.btn_cv') }}
        </a>
      </div>

      <!-- Stack chips -->
      <div class="stack-section">
        <p class="stack-label">{{ t('hero.stack_label') }}</p>
        <div class="chips">
          <span
            v-for="chip in chips"
            :key="chip.label"
            class="chip"
            :class="{ hi: chip.highlight }"
          >
            {{ chip.label }}
          </span>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n'
import { ref, computed, onMounted, watch } from 'vue'

const { t, tm, rt, locale } = useI18n()

// Cursor glow
const heroRef = ref<HTMLElement | null>(null)
const glowX = ref(200)
const glowY = ref(200)

function onMouseMove(e: MouseEvent) {
  const rect = heroRef.value?.getBoundingClientRect()
  if (!rect) return
  glowX.value = e.clientX - rect.left
  glowY.value = e.clientY - rect.top
}

// Typing animation — rt() converts raw compiled AST to string
const words = computed(() => {
  const raw = tm('hero.words')
  if (!Array.isArray(raw)) return []
  return (raw as unknown[]).map(w => rt(w as string))
})
let wordIdx = 0
let charIdx = 0
let deleting = false
const displayText = ref('')
let typingTimer: ReturnType<typeof setTimeout> | null = null

function type() {
  const list = words.value
  if (!list.length) return
  const word = list[wordIdx % list.length]
  if (!deleting) {
    displayText.value = word.slice(0, charIdx + 1)
    charIdx++
    if (charIdx === word.length) {
      deleting = true
      typingTimer = setTimeout(type, 1600)
      return
    }
  } else {
    displayText.value = word.slice(0, charIdx - 1)
    charIdx--
    if (charIdx === 0) {
      deleting = false
      wordIdx = (wordIdx + 1) % list.length
    }
  }
  typingTimer = setTimeout(type, deleting ? 45 : 80)
}

function restartTyping() {
  if (typingTimer) clearTimeout(typingTimer)
  wordIdx = 0
  charIdx = 0
  deleting = false
  displayText.value = ''
  typingTimer = setTimeout(type, 500)
}

onMounted(() => setTimeout(type, 1000))
watch(locale, restartTyping)
// Also restart when words become available (async locale load)
watch(words, (list) => { if (list.length && !displayText.value) restartTyping() })

// Stack chips
const chips = [
  { label: 'Next.js TSX', highlight: true },
  { label: 'NestJS', highlight: true },
  { label: 'Nuxt 3 TS', highlight: true },
  { label: 'TypeScript', highlight: true },
  { label: 'Vue 3', highlight: false },
  { label: 'Laravel', highlight: false },
  { label: 'Node.js', highlight: false },
  { label: 'React', highlight: false },
]
</script>

<style scoped>
.hero {
  padding: 5rem 2rem 4rem;
  max-width: 860px;
  margin: 0 auto;
  position: relative;
  overflow: hidden;
}

.cursor-glow {
  position: absolute;
  width: 420px;
  height: 420px;
  border-radius: 50%;
  background: radial-gradient(
    circle,
    rgba(14, 165, 233, 0.07) 0%,
    transparent 70%
  );
  pointer-events: none;
  transform: translate(-50%, -50%);
  transition: left 0.5s ease, top 0.5s ease;
  z-index: 0;
}

.hero-content {
  position: relative;
  z-index: 1;
}

.badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  color: var(--acc);
  background: var(--acc-bg);
  border: 0.5px solid var(--acc-border);
  padding: 5px 13px;
  border-radius: 20px;
  margin-bottom: 1.5rem;
  animation: fadeUp 0.6s 0.2s both;
}

.dot-live {
  display: inline-block;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--acc);
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.4; transform: scale(0.8); }
}

.hero-title {
  font-size: clamp(36px, 6vw, 54px);
  font-weight: 500;
  line-height: 1.08;
  color: var(--txt);
  margin-bottom: 0.6rem;
  animation: fadeUp 0.7s 0.35s both;
}

.hero-acc {
  color: var(--acc);
  display: inline-block;
  animation: slideAcc 0.8s 0.9s both;
}

@keyframes slideAcc {
  from { opacity: 0; transform: translateX(-14px); }
  to   { opacity: 1; transform: translateX(0); }
}

.hero-typing {
  font-size: 20px;
  color: var(--txt3);
  margin-bottom: 1.25rem;
  min-height: 30px;
  animation: fadeUp 0.7s 0.5s both;
}

.typing-text {
  color: var(--acc2);
  font-weight: 500;
}

.cursor-blink {
  display: inline-block;
  width: 2px;
  height: 20px;
  background: var(--acc);
  margin-left: 2px;
  vertical-align: middle;
  animation: blink 1s infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}

.hero-desc {
  font-size: 14px;
  color: var(--txt2);
  line-height: 1.9;
  max-width: 530px;
  margin-bottom: 2rem;
  animation: fadeUp 0.7s 0.65s both;
}


.hero-btns {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-bottom: 2.5rem;
  animation: fadeUp 0.7s 0.8s both;
}

.btn-primary {
  padding: 11px 24px;
  border-radius: var(--radius);
  background: var(--acc);
  color: #fff;
  font-size: 14px;
  font-weight: 500;
  transition: transform 0.15s, opacity 0.15s;
}

.btn-primary:hover {
  transform: translateY(-2px);
  opacity: 0.88;
}

.btn-secondary {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 11px 24px;
  border-radius: var(--radius);
  border: 0.5px solid var(--bdr2);
  color: var(--txt2);
  font-size: 14px;
  transition: all 0.2s;
}

.btn-secondary:hover {
  border-color: var(--acc);
  color: var(--acc);
  transform: translateY(-2px);
}

.stack-section {
  animation: fadeUp 0.7s 0.95s both;
}

.stack-label {
  font-size: 11px;
  color: var(--txt3);
  text-transform: uppercase;
  letter-spacing: 0.1em;
  margin-bottom: 0.7rem;
}

.chips {
  display: flex;
  gap: 7px;
  flex-wrap: wrap;
}

.chip {
  font-size: 12px;
  padding: 4px 11px;
  border-radius: 5px;
  background: var(--bg3);
  border: 0.5px solid var(--bdr);
  color: var(--txt2);
  transition: all 0.2s;
  cursor: default;
}

.chip:hover {
  border-color: var(--acc);
  color: var(--acc);
  transform: translateY(-2px);
}

.chip.hi {
  background: var(--acc-bg);
  border-color: var(--acc-border);
  color: var(--acc);
}

@keyframes fadeUp {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 640px) {
  .hero { padding: 3.5rem 1.25rem 2.5rem; }
  .hero-btns { flex-direction: column; }
  .btn-primary, .btn-secondary { text-align: center; justify-content: center; }
}
</style>
