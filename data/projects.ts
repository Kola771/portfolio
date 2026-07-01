export interface Project {
  id: string
  name: string
  tags: string[]
  status: 'wip' | 'planned' | 'done'
  github: string
  demo?: string
}

export const projects: Project[] = [
  {
    id: 'twitter-clone',
    name: 'Twitter / X Clone',
    tags: ['Next.js', 'NestJS', 'TypeScript', 'PostgreSQL', 'Prisma'],
    status: 'wip',
    github: 'https://github.com/Kola771/twitter-clone',
    demo: '#',
  },
  {
    id: 'airbnb-clone',
    name: 'Airbnb Clone',
    tags: ['Nuxt 3', 'NestJS', 'TypeScript', 'Prisma', 'Mapbox'],
    status: 'planned',
    github: '#',
    demo: '#'
  },
  {
    id: 'shopify-clone',
    name: 'Shopify Clone',
    tags: ['Next.js', 'NestJS', 'TypeScript', 'Stripe', 'Redis'],
    status: 'planned',
    github: '#',
    demo: '#'
  },
  {
    id: 'perso',
    name: 'Mon projet en cours',
    tags: ['Next.js', 'NestJS', 'TypeScript', 'PostgreSQL', 'Redis'],
    status: 'wip',
    github: '#',
    demo: '#'
  },
]
