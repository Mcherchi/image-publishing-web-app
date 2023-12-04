<?php

namespace App\DataFixtures;

use App\Entity\Image;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $image = new Image();
        $image->setTitle('Batman');
        $image->setImageUrl('https://cdn.pixabay.com/photo/2023/03/14/22/20/relationship-7853278_1280.jpg');
        $manager->persist($image);

        $image2 = new Image();
        $image2->setTitle('Iron Man');
        $image2->setImageUrl('https://cdn.pixabay.com/photo/2015/11/14/21/31/ironman-1043700_1280.jpg');
        $manager->persist($image2);

        $image3 = new Image();
        $image3->setTitle('Hulk');
        $image3->setImageUrl('https://cdn.pixabay.com/photo/2023/06/29/02/54/hulk-8095537_1280.png');
        $manager->persist($image3);

        $image4 = new Image();
        $image4->setTitle('Spider Man');
        $image4->setImageUrl('https://cdn.pixabay.com/photo/2023/07/30/13/07/spiderman-8158916_1280.png');
        $manager->persist($image4);

        $image5 = new Image();
        $image5->setTitle('Black Widow');
        $image5->setImageUrl('https://cdn.pixabay.com/photo/2023/05/20/09/49/ai-generated-8006208_1280.jpg');
        $manager->persist($image5);

        $image6 = new Image();
        $image6->setTitle('Flash');
        $image6->setImageUrl('https://cdn.pixabay.com/photo/2023/06/22/01/16/superhero-8080314_1280.jpg');
        $manager->persist($image6);

        $image7 = new Image();
        $image7->setTitle('Thanos');
        $image7->setImageUrl('https://cdn.pixabay.com/photo/2023/07/01/16/46/ai-generated-8100509_640.png');
        $manager->persist($image7);

        $image8 = new Image();
        $image8->setTitle('Captain Marvel');
        $image8->setImageUrl('https://cdn.pixabay.com/photo/2023/09/12/10/10/ai-generated-8248520_640.jpg');
        $image8->setLoadDate(new DateTime('2023-12-01'));
        $manager->persist($image8);

        $image9 = new Image();
        $image9->setTitle('Groot');
        $image9->setImageUrl('https://cdn.pixabay.com/photo/2023/06/24/05/24/ai-generated-8084559_1280.png');
        $manager->persist($image9);

        $image10 = new Image();
        $image10->setTitle('Deadpool');
        $image10->setImageUrl('https://cdn.pixabay.com/photo/2023/07/28/09/50/ai-generated-8154910_1280.jpg');
        $image10->setLoadDate(new \DateTime('2023-12-01'));
        $manager->persist($image10);

        $image11 = new Image();
        $image11->setTitle('Captain America');
        $image11->setImageUrl('https://cdn.pixabay.com/photo/2023/06/18/02/59/ai-generated-8071118_1280.png');
        $manager->persist($image11);

        $image12 = new Image();
        $image12->setTitle('Doctor Strange');
        $image12->setImageUrl('https://cdn.pixabay.com/photo/2023/06/28/12/10/ai-generated-8094321_1280.jpg');
        $manager->persist($image12);

        $manager->flush();
    }
}
