// composables/useReveal.ts
export function useReveal() {
  onMounted(() => {
    const els = document.querySelectorAll<HTMLElement>('.reveal')

    const obs = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible')
            // Animate skill bars when they enter viewport
            const bars = entry.target.querySelectorAll<HTMLElement>('[data-width]')
            bars.forEach((bar) => {
              setTimeout(() => {
                bar.style.width = bar.dataset.width + '%'
              }, 200)
            })
          }
        })
      },
      { threshold: 0.12 },
    )

    els.forEach((el) => obs.observe(el))

    onUnmounted(() => obs.disconnect())
  })
}
