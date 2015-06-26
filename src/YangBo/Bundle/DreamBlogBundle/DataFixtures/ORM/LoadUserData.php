<?php
namespace YangBo\Bundle\DreamBlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use YangBo\Bundle\DreamBlogBundle\Entity\User;

class LoadUserData extends AbstractFixture implements
    OrderedFixtureInterface,
    ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $user = new User();
        $user->setUsername('李华');
//        $user->setPassword('oneByone');
        $password = 'admin';
        $salt = 'ahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaaha';
        $user->setSalt($salt);
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user);
        $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
        $user->setSex(true);
        $user->setNickname('lihua');
        $last_date = new \DateTime('2012-12-12');
        $user->setUpdatedAt($last_date);
        $now = new \DateTime('-2 week');
        $user->setCreatedAt($now);
        $manager->persist($user);
        $this->addReference('user1', $user);

        $user = new User();
        $user->setUsername('李华2');
        $password = 'oneByOne';
        $salt = 'ahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaaha';
        $user->setSalt($salt);
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user);
        $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
        $user->setSex(true);
        $user->setNickname('lihua2');
        $last_date = new \DateTime('2015-12-12');
        $user->setUpdatedAt($last_date);
        $now = new \DateTime('-2 month');
        $user->setCreatedAt($now);
        $manager->persist($user);
        $this->addReference('user2', $user);

        $user = new User();
        $user->setUsername('yangbo');
        $password = 'yangbo';
        $salt = null;
        $user->setSalt($salt);
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user);
        $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
        $user->setSex(true);
        $user->setNickname('yangbo');
        $last_date = new \DateTime('2015-12-12');
        $user->setUpdatedAt($last_date);
        $now = new \DateTime('-2 day');
        $user->setCreatedAt($now);
        $manager->persist($user);
        $this->addReference('user3', $user);

        $user = new User();
        $user->setUsername('yangbo2');
        $password = 'admin';
        $salt = 'ahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaahaaha';
        $user->setSalt($salt);
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user);
        $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
        $user->setSex(true);
        $user->setNickname('yangbo2');
        $last_date = new \DateTime('2015-12-12');
        $user->setUpdatedAt($last_date);
        $now = new \DateTime('-2 day');
        $user->setCreatedAt($now);
        $manager->persist($user);
        $this->addReference('user4', $user);

        $user = new User();
        $user->setUsername('admin');
        $password = 'admin';
        $salt = 'adminadminadminadminadminadmin';
        $user->setSalt($salt);
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user);
        $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
        $user->setSex(true);
        $user->setNickname('lihua2');
        $last_date = new \DateTime('2015-12-12');
        $user->setUpdatedAt($last_date);
        $now = new \DateTime();
        $user->setCreatedAt($now);
        $manager->persist($user);
        $this->addReference('user5', $user);

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
        return 1;
    }

}