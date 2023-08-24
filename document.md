Dépendances à installer avec les commandes :
- npm install
- npm install @inertiajs/inertia


Pour créer juste le model, la migration et le controller:
php artisan make:model NomDeLelememt -mrc

Pour faire la migration d'une seule table, il faut :
 php artisan migrate --path=chemin_du_fichier
 Ex: php artisan migrate --path=database/migrations/2023_08_24_123557_create_bibliographies_table.php

 Pour exécuter un seeder spécifique:
 php artisan db:seed --class=NomDuSeeder