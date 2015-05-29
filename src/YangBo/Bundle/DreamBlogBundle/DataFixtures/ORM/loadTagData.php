<?php
namespace YangBo\Bundle\DreamBlogBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use YangBo\Bundle\DreamBlogBundle\Entity\Tag;

class LoadTagData extends AbstractFixture implements
    OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $tag = new Tag();
        $tag->setTagName('爱情');
        $manager->persist($tag);
        $this->setReference('tag1', $tag);

        $tag = new Tag();
        $tag->setTagName('伦理');
        $manager->persist($tag);
        $this->setReference('tag2', $tag);

        $tag = new Tag();
        $tag->setTagName('react');
        $manager->persist($tag);
        $this->setReference('tag3', $tag);

        $tag = new Tag();
        $tag->setTagName('体育');
        $manager->persist($tag);
        $this->setReference('tag4', $tag);

        $tag = new Tag();
        $tag->setTagName('你猜');
        $manager->persist($tag);
        $this->setReference('tag5', $tag);

        $tag = new Tag();
        $tag->setTagName('中日关系');
        $manager->persist($tag);
        $this->setReference('tag6', $tag);

        $tag = new Tag();
        $tag->setTagName('习近平');
        $manager->persist($tag);
        $this->setReference('tag7', $tag);

        $tag = new Tag();
        $tag->setTagName('响应式');
        $manager->persist($tag);
        $this->setReference('tag8', $tag);

        $tag = new Tag();
        $tag->setTagName('设计');
        $manager->persist($tag);
        $this->setReference('tag9', $tag);


        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 3;
    }

}