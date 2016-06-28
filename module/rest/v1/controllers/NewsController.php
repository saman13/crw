<?php

namespace app\module\rest\v1\controllers;

use app\models\Category;
use app\models\News;
use Yii;
use yii\rest\Controller;
use himiklab\sitemap\behaviors\SitemapBehavior;


class NewsController extends Controller
{

//    public function behaviors()
//    {
//        return [
//            'sitemap' => [
//                'class' => SitemapBehavior::className(),
//                'scope' => function ($model) {
//                    /** @var \yii\db\ActiveQuery $model */
//                    $model->select(['url', 'lastmod']);
//                    $model->andWhere(['is_deleted' => 0]);
//                },
//                'dataClosure' => function ($model) {
//                    /** @var self $model */
//                    return [
//                        'loc' => Url::to($model->url, true),
//                        'lastmod' => strtotime($model->lastmod),
//                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
//                        'priority' => 0.8
//                    ];
//                }
//            ],
//        ];
//    }
    
    public function actionIndex($limit = 10)
    {
        $category = Category::find()->all();
        foreach ($category as $c){
            $news[$c->id]['category'] = $c->id;
            $news[$c->id]['data'] = News::find()->where(['category_id'=>$c->id])->limit($limit)->all();
        }
        return $news;
    }

    public function actionView($id)
    {
        News::updateAllCounters(['view'=>1], ['id' => $id]);
        return News::find()
            ->where(['id'=>$id])
            ->one();
    }

    public function actionCategory($id, $limit = 10, $view = false)
    {
        if ( $view == false){
            return News::find()
                ->where(['category_id'=>$id])
                ->orderBy(['news_date'=>SORT_DESC])
                ->limit($limit)
                ->all();
        }else{
            return News::find()
                ->where(['category_id'=>$id])
                ->orderBy(['view'=>SORT_DESC])
                ->limit($limit)
                ->all();
        }

    }
}
