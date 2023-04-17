<?php

namespace App\DataFixtures;

use App\Entity\Plat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlatFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Récupération des références à la fixture Category
        $catAperitif    = $this->getReference('category_aperitif');
        $catEntree      = $this->getReference('category_entree');
        $catPlat        = $this->getReference('category_plat');
        $catDessert     = $this->getReference('category_dessert');
        $catAlcool      = $this->getReference('category_alcool');
        $catSsAlcool    = $this->getReference('category_ss_alcool');
        $catVin         = $this->getReference('category_vin');

        $platsExample = [
            ['Ravioles Maison', 'Ravioles farcies d’une mousseline d’artichaut et ricotta, condiment câpre, artichauts frits et jus Barigoule', 20.00, $catPlat, 0],
            ['Pêche "Petits Bateaux"', 'Poisson, endives grillées au paprika, jeunes navets au miel, orge fumé, beurre Nantais au vermouth', 28.00, $catPlat, 0],
            ['Lapin rôti', 'Lapin rôti à l’ail des ours, purée de patate douce à la moutarde, brocolis grillés aux amandes, tapenade olive-citron', 28.00, $catPlat, 0],
            ['Agneau', 'Travail autour de l’agneau de lait des Pyrénées, à partager pour deux personnes minimum', 30.00, $catPlat, 0],
            ['Baba', 'Baba infusé à la cardamone, textures de poire et chantilly cardamone verte', 13.00, $catDessert, 0],
            ['Coulant chocolat', 'Chocolat Hukambi « pure origine Brésil » crème Anglaise Oabika, tuile grué de cacao', 14.00, $catDessert, 0],
            ['Dans l’esprit d’une Pavlova', 'Avec grenade et estragon', 12.00, $catDessert, 0],
            ['Focaccia maison', 'au levain naturel, condiment anchois', 4.00, $catAperitif, 0],
            ['Coppa', 'Fines tranches de coppa di Parma IGP', 4.00, $catAperitif, 0],
            ['Crevettes grises', 'Crevettes grises croustillantes, condiment Karashi', 4.00, $catAperitif, 0],
            ['Parfait de foies de volaille', 'Foies de volaille, crumble de graines, salade d’herbes fraiches, condiment échalotes', 15.00, $catEntree, 0],
            ['Asperges vertes grillées', 'Asperges vertes du Gers, kumquats confites, émulsion café, Jaune d’œuf et cheddar fumés', 15.00, $catEntree, 0],
            ['Poissons de roche grillés', 'Avec pommes de terre fondantes, rouille maison, fraicheur de fenouil, découvrez notre Bouillabaisse', 15.00, $catEntree, 0],
            ['Coupe de champagne brut rosé 12 cl', '', 13.00, $catAlcool, 0],
            ['Whisky Malt Michel Couvreur Cuvée Overaged 4cl', '', 10.00, $catAlcool, 0],
            ['Notre Cocktail Maison 10cl', '', 12.00, $catAlcool, 0],
            ['Nos Bières (Brasserie Nautile) 33cl', '', 6.00, $catAlcool, 0],
            ['Pastis Bardouin 4cl', '', 6.00, $catAlcool, 0],
            ['Cocktail de fruits Borderline 25cl', '', 6.00, $catSsAlcool, 0],
            ['Lemonade naturel La Loere 33cl', '', 6.00, $catSsAlcool, 0],
            ['Cola naturel La loere 33cl', '', 6.00, $catSsAlcool, 0],
            ['Perrier 33cl', '', 5.00, $catSsAlcool, 0],
            ['Tarte de légumes printaniers d’harald hermans, sabayon au curry', '', 0.00, $catEntree, 1],
            ['Rôti de bœuf, polenta à l’ail des ours, chou-pointu grillé, condiment raifort', '', 0.00, $catPlat, 2],
            ['Déclinaison, chocolat et kiwi', '', 0.00, $catDessert, 3]
        ];


        foreach ($platsExample as [$name, $description, $price, $category, $inMenu]) {
            $plat = new Plat();
            $plat->setNom($name);
            $plat->setDescription($description);
            $plat->setPrix($price);
            $plat->setCategorie($category);
            $manager->persist($plat);
            switch ($inMenu) {
                case 1:
                    $this->setReference('entree_menu', $plat);
                    break;
                case 2:
                    $this->setReference('plat_menu', $plat);
                    break;
                case 3:
                    $this->setReference('dessert_menu', $plat);
                    break;
            }
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CategorieFixtures::class,
        ];
    }
}
