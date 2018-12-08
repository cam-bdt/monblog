<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory ::create('fr_FR');

        for($j = 1; $j <4 ; $j++){
            $category = new Category();
            $category -> setTitle($faker -> sentence());
            $category -> setDescription($faker -> sentence());

            $manager->persist($category) ; 
        }
            
for($k = 1; $k<= 6 ; $k++){
    $article = new Article();

    $leContenu = '<p>' . join($faker -> sentences(5), '</p> <p>') . '</p>';
    
    $article ->setTitle($faker -> sentence());
    $article ->setCategory($category);
    $article ->setContent($leContenu);
    $article ->setImage($faker -> imageURL());
    $article ->setCreatedAt(new \DateTime());

    $manager->persist($article);
}


for($i = 1; $i<= 3 ; $i++){
            $comment = new Comment();
            $comment -> setAuthor($faker -> userName());
            $comment -> setContent($faker -> sentence());
            $comment -> setCreatedAt($faker -> dateTime());
            $comment -> setArticle($article);

            $manager->persist($comment) ; 
        }
$manager->flush();
} 
}