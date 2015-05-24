<?php
namespace YangBo\Bundle\DreamBlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use YangBo\Bundle\DreamBlogBundle\Entity\Article;

class LoadArticleData extends AbstractFixture
    implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $article = new Article();
        $article->setTitle('测试标题一');
        $article->setContent('新浪体育讯据英国媒体《每日镜报》报道，皇马挖角德赫亚的交易有了新的进展，
        皇马方面已经主动联系了德赫亚的经纪人门德斯，他们已经将德赫亚列为自己引援的头号目标。
        《每日镜报》称皇马加速了收购德赫亚计划的进程，他们希望在赛季结束后完成转会，为此他们已经联系了德赫亚的经纪人门德斯，
        希望他能够推动转会。曼联并不想失去德赫亚，为此他们甚至给德赫亚提供了一份20万镑的周薪，但是德赫亚一直没有接受。
        考虑到他的合同只剩下最后一年，这让曼联很被动。现在的情况是，曼联希望留下德赫亚，即便是不得不将他卖掉，
        曼联也希望收回大约3000万镑的转会费。但是皇马方面吃准了德赫亚的合同只剩下一年，因此只愿意拿出半价即1500万镑的转会费来完成这笔交易，
        这让曼联无法接受，因为2011年曼联引进德赫亚时也花掉了1800万镑。不过这笔交易也并非没有转机，《每日镜报》称，如果皇马愿意将贝尔卖到曼联，
        那么红魔愿意接受对德赫亚2000万镑的报价。话虽如此，考虑到德赫亚如今的能力，曼联花费多年将他培养成世界级的门将，
        如今卖掉却只能比当年买下德赫亚时多赚200万镑，这笔交易无疑还是有些吃亏。但是由于德赫亚的合同只剩最后一年，因此曼联也没有多少主动权。');
        $article->setTag('曼联,皇马');
        $article->setPageViewCount(22);
        $article->setCreatedAt(new \DateTime());
        $article->setUser($this->getReference('user1'));
        $article->addCategory($manager->merge($this->getReference('category1')));
        $article->addCategory($manager->merge($this->getReference('category3')));
        $manager->persist($article);
        $this->setReference('article1', $article);

        $article = new Article();
        $article->setTitle('测试标题二');
        $article->setContent('新浪体育讯据英国媒体《每日镜报》报道，皇马挖角德赫亚的交易有了新的进展，
        皇马方面已经主动联系了德赫亚的经纪人门德斯，他们已经将德赫亚列为自己引援的头号目标。
        《每日镜报》称皇马加速了收购德赫亚计划的进程，他们希望在赛季结束后完成转会，为此他们已经联系了德赫亚的经纪人门德斯，
        希望他能够推动转会。曼联并不想失去德赫亚，为此他们甚至给德赫亚提供了一份20万镑的周薪，但是德赫亚一直没有接受。
        考虑到他的合同只剩下最后一年，这让曼联很被动。现在的情况是，曼联希望留下德赫亚，即便是不得不将他卖掉，
        曼联也希望收回大约3000万镑的转会费。但是皇马方面吃准了德赫亚的合同只剩下一年，因此只愿意拿出半价即1500万镑的转会费来完成这笔交易，
        这让曼联无法接受，因为2011年曼联引进德赫亚时也花掉了1800万镑。不过这笔交易也并非没有转机，《每日镜报》称，如果皇马愿意将贝尔卖到曼联，
        那么红魔愿意接受对德赫亚2000万镑的报价。话虽如此，考虑到德赫亚如今的能力，曼联花费多年将他培养成世界级的门将，
        如今卖掉却只能比当年买下德赫亚时多赚200万镑，这笔交易无疑还是有些吃亏。但是由于德赫亚的合同只剩最后一年，因此曼联也没有多少主动权。');
        $article->setTag('曼联,皇马');
        $article->setPageViewCount(22);
        $article->setCreatedAt(new \DateTime());
        $article->setUser($this->getReference('user2'));
        $article->addCategory($this->getReference('category2'));
        $manager->persist($article);
        $this->setReference('article2', $article);
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