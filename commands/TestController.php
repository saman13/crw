<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Agency;
use app\models\Category;
use app\models\Cpostmeta;
use app\models\Cposts;
use app\models\CtermRelationships;
use app\models\Cterms;
use app\models\CtermTaxonomy;
use app\models\Cusers;
use app\models\News;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TestController extends Controller
{
    public function actionTest()
    {


        //var_dump(html_entity_decode('&#1575;&#1740;&#1606;'));

        /*$str = 'رئیس';
        echo htmlspecialchars($str);

        die;

        var_dump(rawurlencode('یسیسیسی'));
        var_dump('/////////////////////');


        //var_dump(($ss));
        die;*/

        $news = News::find()->where(['status'=>1])->all();




        $categoris = Category::find()->all();

        foreach ($categoris as $category){

            $c[$category->id] = $category->name;

        }

        foreach ($news as $n){

            $user = Cusers::find()->where(['user_login'=>$n['agency_id']])->one();


            if (is_null($user)){
                $agencyName = Agency::find()->where(['id'=>$n['agency_id']])->one()->name;

                $user = new Cusers();
                $user->user_login = (string)$n['agency_id'];
                $user->user_pass = (string)$n['agency_id'];
                $user->user_nicename = $agencyName;
                $user->user_email = rand(1000000,9999999).'info'.rand(1000000,9999999).'@gmail.com';
                $user->user_registered = date('Y-m-d H:m:s');
                $user->user_status = 0;
                $user->display_name = $agencyName;
                $user->save();
            }

            $author = $user->ID;

            $terms = [];

            ///// category
            $cat = $c[$n['category_id']];
            $findCat = Cterms::find()->where(['name'=>$cat])->one();

            if ($findCat == null){
                $term = new Cterms();
                $term->name = $cat;
                $term->slug = rawurlencode($cat);
                $term->term_group = 0;
                $term->save();
                $termCat = $term->term_id;

                $termTaxonomy = new CtermTaxonomy();
                $termTaxonomy->term_id = $termCat;
                $termTaxonomy->taxonomy = 'category';
                $termTaxonomy->description = '-';
                $termTaxonomy->parent = 0;
                $termTaxonomy->count = 0;
                $termTaxonomy->save();

                $terms [] = $termTaxonomy->term_taxonomy_id;

            }else{
                $termCat = $findCat->term_id;

                $termTaxonomy = CtermTaxonomy::find()->where(['term_id' => $termCat, 'taxonomy'=>'category'])->one();

                $termTaxonomy->count +=1;
                $termTaxonomy->save();

                $terms [] = $termTaxonomy->term_taxonomy_id;
            }


            ///// tag
            $filter = [
                ' ',
                '(',
                ')',
                ':',
                '/',
                '\\',
            ];

            $tags = str_replace($filter, '-', $n['title']);
            $tags = explode('-',$tags);

            foreach ($tags as $tag){

                $findTerm = Cterms::find()->where(['name'=>$tag])->one();

                if ($findTerm == null){
                    $term = new Cterms();
                    $term->name = $tag;
                    $term->slug = rawurlencode($tag);
                    $term->term_group = 0;
                    $term->save();
                    $termTag[] = $term->term_id;

                    $termTaxonomy = new CtermTaxonomy();
                    $termTaxonomy->term_id = $term->term_id;;
                    $termTaxonomy->taxonomy = 'post_tag';
                    $termTaxonomy->description = '-';
                    $termTaxonomy->parent = 0;
                    $termTaxonomy->count = 0;
                    $termTaxonomy->save();

                    $terms [] = $termTaxonomy->term_taxonomy_id;

                }else{
                    $termTag[] = $findTerm->term_id;

                    $termTaxonomy = CtermTaxonomy::find()->where(['term_id' => $findTerm->term_id, 'taxonomy'=>'post_tag'])->one();

                    $termTaxonomy->count +=1;
                    $termTaxonomy->save();

                    $terms [] = $termTaxonomy->term_taxonomy_id;
                }

            }


            // remove space
            $filter = [
                ' ',
                '(',
                ')',
                ':',
                '/',
                '\\',
            ];
            $postName = str_replace($filter, '-', trim($n['title'],'():/'));
            $filter = ['--'];
            $postName = str_replace($filter, '-', $postName);


//            $postName = 'تماشا-کنید-رندر-جدید-از-آیفون-7-و-آیفون-7-پ';
//            var_dump($postName);
//            var_dump(rawurldecode('%D8%AA%D9%85%D8%A7%D8%B4%D8%A7-%DA%A9%D9%86%DB%8C%D8%AF-%D8%B1%D9%86%D8%AF%D8%B1-%D8%AC%D8%AF%DB%8C%D8%AF-%D8%A7%D8%B2-%D8%A2%DB%8C%D9%81%D9%88%D9%86-7-%D9%88-%D8%A2%DB%8C%D9%81%D9%88%D9%86-7-%D9%BE%D9%84%D8%A7%D8%B3'));
//            die;


            //// post

            $post = new  Cposts();

            $post->post_author = $author;
            $post->post_date = date('Y-m-d H:m:s');
            $post->post_date_gmt = date('Y-m-d H:m:s');
            $post->post_content = $n['description'];
            $post->post_title = $n['title'];
            $post->post_status = 'publish';
            $post->comment_status = 'closed';
            $post->ping_status = 'closed';
            $post->post_name = rawurlencode($postName);
            $post->post_modified = date('Y-m-d H:m:s');
            $post->post_modified_gmt = date('Y-m-d H:m:s');
            $post->post_parent = 0;
            $post->guid = \Yii::$app->params['guid'].$post->ID;
            $post->menu_order = 0;
            $post->post_type = 'post';
            $post->comment_count = 0;

            $post->post_excerpt = '-';
            $post->to_ping = '-';
            $post->pinged = '-';
            $post->post_content_filtered = '-';

            $post->save();
            
            $post->guid = \Yii::$app->params['guid'].$post->ID;
            $post->save();
            


            $postRevision = new  Cposts();
            $postRevision->post_author = $author;
            $postRevision->post_date = date('Y-m-d H:m:s');
            $postRevision->post_date_gmt = date('Y-m-d H:m:s');
            $postRevision->post_content = $n['description'];
            $postRevision->post_title = $n['title'];
            $postRevision->post_status = 'inherit';
            $postRevision->comment_status = 'closed';
            $postRevision->ping_status = 'closed';
            $postRevision->post_name = $post->ID.'-revision-v1';
            $postRevision->post_modified = date('Y-m-d H:m:s');
            $postRevision->post_modified_gmt = date('Y-m-d H:m:s');
            $postRevision->post_parent = $post->ID;
            $postRevision->guid = \Yii::$app->params['guid'].$postRevision->post_name;
            $postRevision->menu_order = 0;
            $postRevision->post_type = 'revision';
            $postRevision->comment_count = 0;

            $postRevision->post_excerpt = '-';
            $postRevision->to_ping = '-';
            $postRevision->pinged = '-';
            $postRevision->post_content_filtered = '-';

            $postRevision->save();


            //post meta

            $postMeta = new Cpostmeta();
            $postMeta->post_id = $post->ID;
            $postMeta->meta_key = 'syndication_permalink';
            $postMeta->meta_value = $n['link'];
            $postMeta->save();





            foreach ($terms as $t){

                if ( CtermRelationships::find()->where(['object_id' => $post->ID, 'term_taxonomy_id' => $t])->one() == null ){
                    $termRelationship = new CtermRelationships();
                    $termRelationship->object_id = $post->ID;
                    $termRelationship->term_taxonomy_id = $t;
                    $termRelationship->term_order = 0;
                    $termRelationship->save();
                }

            }
        }
    }

    public function actionName()
    {
        $length = 6;
        $characters = 'abdefijklmnoprstvwz';
        //$characters = 'rtiopadklbnm123';
        $charactersLength = strlen($characters);

        for ($j=0;$j<100;$j++){
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            echo ($randomString.'.ir');
            echo "\n";
        }

    }
}
