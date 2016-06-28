<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\News;
use app\models\RssLink;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RssReaderController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        $rss = RssLink::find()->where(['status'=>1])->all();
        foreach ($rss as $r){
            $RSS[] = $r;
        }
        foreach ($RSS as $rss){
            $content = $this->actionGetContent($rss->rss_link);
            foreach ($content as $c){
                if ( !News::find()->where(['news_id'=>md5((string)$c->link)])->one() ) {
                    $news = new News();
                    $news->rss_id = $rss->id;
                    $news->news_id = md5((string)$c->link);
                    $news->category_id = $rss->category_id;
                    $news->agency_id = $rss->agency_id;
                    $news->title =  (string)$c->title;
                    $news->description = (string)$c->description;
                    $news->link = (string)$c->link;
                    $news->news_date = (string)strtotime((string)$c->pubDate);
                    $news->save();
                }
            }
        }
    }

    public function actionGetContent($url)
    {
        $feed = file_get_contents($url);
        $rss = simplexml_load_string($feed);

        foreach ($rss->channel->item as $k=>$v){
            $items [] = $v;
        }

        return ($items);
    }
}
