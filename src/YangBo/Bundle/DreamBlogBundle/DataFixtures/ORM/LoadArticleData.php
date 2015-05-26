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
        $article->setTitle('曼联将失去德赫亚');
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
        $article->setTitle('论中日关系');
        $article->setContent('习近平强调，中日一衣带水，2000多年来，和平友好是两国人民心中的主旋律，两国人民互学互鉴，
            促进了各自发展，也为人类文明进步作出了重要贡献。
            近代以后，由于日本走上对外侵略扩张道路，中日两国经历了一段惨痛历史，给中国人民带来了深重灾难。两国老一代领导人以高度的政治智慧，
            作出重要政治决断，克服重重困难，实现了中日邦交正常化，并缔结了和平友好条约，开启了两国关系新纪元。中日两国一批有识之士曾为此积
            极奔走，做了大量工作。历史证明，中日友好事业对两国和两国人民有利，对亚洲和世界有利，值得我们倍加珍惜和精心维护，继续付出不懈努力。
            习近平指出，“德不孤，必有邻。”只要中日两国人民真诚友好、以德为邻，就一定能实现世代友好。中国高度重视发展中日关系。
            我们愿同日方一道，在中日四个政治文件基础上，推进两国睦邻友好合作。');
        $article->setTag('中国,日本');
        $article->setPageViewCount(22);
        $article->setCreatedAt(new \DateTime());
        $article->setUser($this->getReference('user2'));
        $article->addCategory($this->getReference('category2'));
        $manager->persist($article);
        $this->setReference('article2', $article);

        $article = new Article();
        $article->setTitle('React 介绍');
        $article->setContent('React不多做介绍，就是Facebook的一个开源JS框架，专注的层面为View层，不包括数据访问层或者那种Hash路由
            （不过React有插件支持），与Angularjs，Emberjs等大而全的框架不同，React专注的中心是Component，即组件，React认为一切页面
            元素都可以抽象成组件，比如一个表单，或者表单中的某一项。states就是组件的可变属性，states的改变会触发组件的render函数，
            react与其他mvvm框架的最大的不同点就是，react组件可以想象成一个状态机，状态的改变会重绘UI，然后根据 dom diff 算法来绘制UI，
            而其他的mvvm框架则是对js对象的dirty check（Angularjs）或者defineProperty时指定的回调函数（Emberjs），
            因此，状态机制与dom diff的存在声称React更快。');
        $article->setTag('react,js');
//        $article->setPageViewCount(22);
        $article->setCreatedAt(new \DateTime());
        $article->setUser($this->getReference('user3'));
        $article->addCategory($this->getReference('category3'));
        $article->setIsRecommend(true);
        $manager->persist($article);
        $this->setReference('article3', $article);

        $article = new Article();
        $article->setTitle('响应式设计');
        $article->setContent('在响应式设计中，设备的宽度是不确定的，而有时需要根据宽度来设置高度，如上面的例子，想要一个与宽度相同的
            高度的div，即一个正方形。原理：padding-top使用百分比时，计算的是父元素的宽度。利用这一点，使用padding-top:100%设置子元素
            std-rect，然后给子元素的子元素content设置一个负数的margin-top:-100%，也使用百分比，这样，content元素里面的内容就会出现
            在正方形中。为了使得内容不会撑开div，将content相对于std-rect定位，并设置std-rect为overflow:hidden。在上面的例子中，
            还有一个clearfix的技巧值得记住。另外，CSS3的calc()好像也能解决这中问题');
        $article->setTag('响应式,设计');
//        $article->setPageViewCount(22);
        $article->setCreatedAt(new \DateTime());
        $article->setUser($this->getReference('user3'));
        $article->addCategory($this->getReference('category4'));
        $article->setIsRecommend(true);
        $manager->persist($article);
        $this->setReference('article4', $article);

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