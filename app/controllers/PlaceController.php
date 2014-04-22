<?php
/**
 * Mekan ile ilgili işlemler
 *
 * Created by PhpStorm.
 * User: erhankayar
 * Date: 11.11.2013
 * Time: 17:54
 */

namespace Controllers;
use App\Helpers\Collections;
use App\Helpers\CrudTypes;

class PlaceController
{
    public function __construct()
    {
        $this->app   = \Slim\Slim::getInstance();
        $this->mongo = $this->app->mongo;
        $this->redis = $this->app->redis;
    }

    /**
     * Place _id ye göre mekan bilgilerii getirir
     * @param $pid
     * @access public
     * @return array
     */
    public function getPlaceById($pid)
    {
        return $this->mongo->where("_id", new \MongoId($pid))
            ->limit(1)
            ->get(Collections::PLACES);
    }

    /**
     * Place slug ye göre mekan bilgilerii getirir
     * @param $slug
     * @access public
     * @return array
     */
    public function getPlaceBySlug($slug)
    {
        return $this->mongo->where("place_slug", $slug)
            ->limit(1)
            ->get(Collections::PLACES);
    }

    /**
     * Place _id ye göre mekan sayfa görüntülenmeye 1 ekler
     * @param $pid
     * @access public
     * @return array
     */
    public function addPageViewToPlace($pid)
    {
        return $this->mongo->where("_id", new \MongoId($pid))
            ->inc("place_page_view", 1)
            ->update(Collections::PLACES);
    }

    /**
     * Place _id ye göre mekanın toplam like (favori) sayısını getirir
     * @param $pid
     * @access public
     * @return array
     */
    public function likeCountOfPlace($pid)
    {
        return $this->mongo->where("place_id", new \MongoId($pid))
            ->count(Collections::FAVORITES);
    }

    /**
     * Place _id ye göre mekan resimlerini getirir
     * @param $pid
     * @access public
     * @return array
     */
    public function getPlacePhotos($pid)
    {
        return $this->mongo->where("place_id", new \MongoId($pid))
            ->get(Collections::PHOTOS);
    }

    /**
     * Place _id ye göre mekan yorumlarını getirir
     * @param $pid
     * @access public
     * @return array
     */
    public function getPlaceComments($pid)
    {
        return $this->mongo->where("pid", new \MongoId($pid))
            ->get(Collections::COMMENTS);
    }


    /**
     * Place _id ye göre mekanı like (favorilerine) ekleyen kullanıcılar
     * @param $pid
     * @access public
     * @return array
     */
    public function getWhoLikeThisPlace($pid)
    {
        $user_ids = $this->mongo->select(array("user_id"))
            ->where("place_id", new \MongoId($pid))
            ->get(Collections::FAVORITES);

        $user_array = array();
        foreach ($user_ids as $uid)
            array_push($user_array, new \MongoId($uid["user_id"]));

        return $this->mongo->whereIn("_id", $user_array)
            ->get(Collections::USERS);

    }

    /**
     * Place _id ye göre mekanı istek listesine ekleyen kullanıcılar
     * @param $pid
     * @access public
     * @return array
     */
    public function getWhoWishThisPlace($pid)
    {
        $user_ids = $this->mongo->select(array("user_id"))
            ->where("place_id", new \MongoId($pid))
            ->get(Collections::WISHLISTS);

        $user_array = array();
        foreach ($user_ids as $uid)
            array_push($user_array, new \MongoId($uid["user_id"]));

        return $this->mongo->whereIn("_id", $user_array)
            ->get(Collections::USERS);

    }

    /**
     * Mekana yorum ekler
     * @param $comment
     * @access public
     * @return array
     */
    public function addCommentToPlace($comment = array())
    {
        //parent_id mekan tarafından yorum yazılırsa ilgili yorumun id si işlenecek
        $data = array(
            "uid"        => new \MongoId($comment["user_id"]),
            "pid"        => new \MongoId($comment["place_id"]),
            "comment"    => $comment["content"],
            "parent_id"  => 0,
            "like_count" => 0,
            "added_date" => new MongoDate(timeDiffForMongo()),
            "status"     => 0
        );

        $this->addToLog($comment["user_id"], Collections::COMMENTS, CrudTypes::INSERT, $data);

        return $this->mongo->insert(Collections::COMMENTS, $data);
    }

    /**
     * Mekana görsel ekler
     * @param $photo
     * @access public
     * @return array
     */
    public function addPhotoToPlace($photo = array())
    {
        //todo : image type ne içindi hatırlayamadım :)
        $data = array(
            "image_description" => $photo["desc"],
            "image_file"        => $photo["path"],
            "image_path"        => $photo["place_id"], //resmi tutan folder
            "image_type"        => 1,
            "user_id"           => new \MongoId($photo["user_id"]),
            "place_id"          => new \MongoId($photo["place_id"]),
            "added_date"        => new \MongoDate(timeDiffForMongo()),
            "like_count"        => 0,
            "status"            => 0
        );

        $this->addToLog($photo["user_id"], Collections::PHOTOS, CrudTypes::INSERT, $data);

        return $this->mongo->insert(Collections::PHOTOS, $data);
    }

    /**
     * Loglama işlemi
     * @param $uid
     * @param $collection
     * @param $type
     * @param $data
     * @access private
     * @return array
     */
    private function addToLog($uid, $collection, $type, $data)
    {
        $d = array(
            "user_id"         => new \MongoId($uid),
            "collection_name" => $collection,
            "type"            => $type,
            "added_date"      => new \MongoDate(timeDiffForMongo()),
            "data"            => $data
        );
        $this->mongo->insert(Collections::LOGS, $d);
    }

}