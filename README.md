# Portfolio — Koladé Moussè Aboudou

Portfolio personnel développé avec **Nuxt 3 + TypeScript**.

## Stack

- **Framework** : Nuxt 3 (SSG/SSR)
- **Langage** : TypeScript
- **Styles** : CSS custom properties (pas de framework CSS)
- **Animations** : CSS + IntersectionObserver
- **Icônes** : nuxt-icon + Tabler Icons
- **Theme** : @nuxtjs/color-mode (dark/light)

## Structure

```
portfolio-kolade/
├── assets/
│   └── css/main.css          # Design tokens, reset, animations globales
├── components/
│   ├── HeroSection.vue        # Hero + typing animation + cursor glow
│   ├── AboutSection.vue       # Présentation + stats
│   ├── SkillsSection.vue      # Barres de compétences animées
│   ├── ProjectsSection.vue    # Grille de projets
│   ├── ProjectCard.vue        # Carte projet avec shimmer hover
│   ├── ExperienceSection.vue  # Timeline expérience
│   └── ContactSection.vue     # Section contact + ambient glow
├── composables/
│   └── useReveal.ts           # Scroll reveal (IntersectionObserver)
├── data/
│   └── projects.ts            # Données des projets (modifier ici)
├── layouts/
│   └── default.vue            # Nav sticky + scroll progress + footer
├── pages/
│   └── index.vue              # Page principale
└── nuxt.config.ts
```

## Démarrage rapide

```bash
# Installer les dépendances
npm install

# Mode développement
npm run dev

# Build production
npm run build

# Générer site statique
npm run generate
```

## Personnalisation

### Ajouter / modifier un projet
Édite le fichier `data/projects.ts` :

```ts
{
  id: 'mon-projet',
  type: 'Clone · Réseau social',
  name: 'Nom du projet',
  description: 'Description courte et percutante.',
  tags: ['Nuxt 3', 'NestJS', 'TypeScript'],
  status: 'wip',           // 'wip' | 'planned' | 'done'
  github: 'https://github.com/...',
  demo: 'https://...',     // optionnel
}
```

### Changer la couleur d'accentuation
Dans `assets/css/main.css`, modifie les variables `--acc` et `--acc2` :

```css
:root {
  --acc: #0ea5e9;   /* couleur principale */
  --acc2: #06b6d4;  /* couleur secondaire (typing) */
}
```

### Ajouter ton CV
Place ton fichier PDF dans `public/cv-kolade-aboudou.pdf`.

## Déploiement

Compatible avec **Vercel**, **Netlify**, **Cloudflare Pages** en mode static (`npm run generate`).

```bash
# Vercel (recommandé)
npx vercel

# Ou Netlify
npm run generate && netlify deploy --dir=.output/public
```
