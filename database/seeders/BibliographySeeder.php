<?php

namespace Database\Seeders;

use App\Models\Bibliography;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BibliographySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variable = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore possimus corporis iusto pariatur? Eius, libero provident! Amet earum minima modi nisi laborum vero eius esse animi at, pariatur doloremque. Iste beatae labore numquam? Dolor maxime corrupti nostrum inventore magnam neque eveniet.
        <br />
        Ipsum iste animi doloremque omnis expedita saepe facilis laborum voluptas nobis velit quod, labore quia doloribus sit, reiciendis magnam explicabo adipisci ducimus odio, voluptate pariatur ex aperiam. Cum possimus aspernatur consequuntur, fugiat tenetur dolores laborum ipsam expedita sint qui natus est totam alias ut soluta error animi reprehenderit modi inventore.!
        <br />
        Corporis hic quas suscipit porro, magnam quaerat? Adipisci et dolore earum libero cupiditate harum minus ex ea? Quas harum mollitia autem quos explicabo aliquid, libero dicta nemo sapiente doloremque soluta, ad, repellendus nisi excepturi non magnam cupiditate temporibus commodi est facere quibusdam porro sint eos voluptas. Amet, id! Consectetur quasi, eum voluptate voluptas dolorum porro pariatur rem perferendis maiores tempora consequatur?";

        $bibliographies = [
            [
                'bibliographie' => $variable,
                'image' => 'bibliographie-64e765b09af9e1.14165331.jpg',
            ],
           
        ];

        foreach ($bibliographies as $bibliography) {
            Bibliography::create($bibliography);
        }
    }
}
