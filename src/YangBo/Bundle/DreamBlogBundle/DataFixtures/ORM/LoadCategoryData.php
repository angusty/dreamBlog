<?php
namespace YangBo\Bundle\DreamBlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use YangBo\Bundle\DreamBlogBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements
    OrderedFixtureInterface
{
    public  function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('推理');
//        $category->addArticle($this->getReference('article1'));
        $manager->persist($category);
        $this->setReference('category1', $category);

        $category = new Category();
        $category->setName('爱情');
//        $category->addArticle($manager->merge($this->getReference('article2')));
        $manager->persist($category);
        $this->setReference('category2', $category);

        $category = new Category();
        $category->setName('剧情');
        $manager->persist($category);
        $this->setReference('category3', $category);

        $category = new Category();
        $category->setName('悬疑');
        $manager->persist($category);
        $this->setReference('category4', $category);

        $category = new Category();
        $category->setName('推理之门');
        $category->setParent($this->getReference('category1'));
        $manager->persist($category);
        $this->setReference('category5', $category);

        $category = new Category();
        $category->setName('剧情之门');
        $category->setParent($this->getReference('category3'));
        $manager->persist($category);
        $this->setReference('category6', $category);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}