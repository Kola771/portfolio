<template>
  <div>
    <HeroSection />
    <hr class="divider" />
    <AboutSection />
    <hr class="divider" />
    <SkillsSection />
    <hr class="divider" />
    <ProjectsSection />
    <hr class="divider" />
    <ExperienceSection />
    <hr class="divider" />
    <ContactSection />
  </div>
</template>

<script setup lang="ts">
useHead({
  title: 'Koladé Aboudou — Développeur Full Stack Remote',
})

// Trigger scroll reveal on all .reveal elements
useReveal()
</script>

<style scoped>
.divider {
  border: none;
  border-top: 0.5px solid var(--bdr);
  margin: 0 2rem;
}
</style>
