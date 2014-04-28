<?php
/**
 * Kullanıcı ile ilgili işlemler
 *
 * Created by PhpStorm.
 * User: erhankayar
 * Date: 11.11.2013
 * Time: 17:54
 */

namespace App\Controllers;

use App\Helpers\Collections;
use App\Helpers\CrudTypes;

class UserController
{
    public function __construct()
    {
        $this->app   = \Slim\Slim::getInstance();
        $this->mongo = $this->app->mongo;
        $this->redis = $this->app->redis;
    }

    /**
     * Username e göre kullanıcı bilgilerini getirir
     * @param $username
     * @access private
     * @return array
     */
    public function index($username)
    {

        $user = $this->getUserByUserName($username);
        $user = $user[0];
        //print_r($user);die;
        //Adamın yorumları
        $comments = $this->getUserComments($user["_id"]);
        //Adamın toplam yorum sayısı
        $total_comments = count($comments);
        //İlk 5 yorumu getir
        //todo: tarihte sıkıntı var
        $comments = array_slice($comments, 0, 5);
        //Adamın toplam takipçi sayısı
        $total_followers = count($this->getUserFollowers($user["_id"]));
        //Adamın toplam takipçi sayısı
        $friends = $this->getUserFriends($user["_id"]);
        //Adamın son yorum yaptığı yerler
        $last_reviews = $this->getUserReviews($user["_id"], 0, 5);
        //Adamın eklediği resimler
        //todo: Table joinleri araştır. belongsTo vs
        $user_place_photos = $this->getUserPlacePhotos($user["_id"], 0, 10);
        //todo: checkin tablosu
        //Adamın favorileri
        $user_favs = $this->getUserFavorites($user["_id"], 0, 5);

        //Adamın gitmek istediği mekanlar
        $this->app->render('app/user/index.html.twig', array('user'              => $user,
                                                             'comments'          => $comments,
                                                             'total_comments'    => $total_comments,
                                                             'total_followers'   => $total_followers,
                                                             'friends'           => $friends,
                                                             'user_place_photos' => $user_place_photos,
                                                             'user_favs'         => $user_favs,
                                                             'last_reviews'      => $last_reviews));

        //$data["user_place_photos"] = $this->getUserPlacePhotos($user["_id"], 0, 10);


        //$this->app->render('app/user/index.html.twig', $data);
    }

    public function friends($user_name)
    {
        $user = $this->getUserByUserName($user_name);
        $this->getUserFriends($user["_id"]);
    }

    public function comments($user_name)
    {
        $this->getUserComments($user_name);
    }

    public function checkins($user_name)
    {
        $this->getUserComments($user_name);
    }

    public function favorites($user_name)
    {
        $this->getUserFavs($user_name);
    }

    public function reviews($user_name)
    {
        $user = $this->getUserByUserName($user_name);
        $this->getUserReviews($user["_id"], 0, 5);
    }

    //region Privates
    /**
     * _id ye göre kullanıcı bilgilerini getirir
     * @param $uid
     * @access public
     * @return array
     */
    private function getUser($uid)
    {
        return $this->mongo->where("_id", new \MongoId($uid))
            ->limit(1)
            ->get(Collections::USERS);
    }

    private function getUserByUserName($user_name)
    {
        return $this->mongo->where("user_name", $user_name)
            ->limit(1)
            ->get(Collections::USERS);
    }

    /**
     * User _id ye göre kullanıcının son puanladığı mekanlarını getirir
     * @param $uid
     * @param $skip
     * @param $limit
     * @access private
     * @return array
     */
    private function getUserFavorites($uid, $skip, $limit)
    {
        $place_ids = $this->mongo->select(array("place_id"))->where("user_id", new \MongoId($uid))->orderBy(array('added_date' => 'desc'))->get(Collections::PLACES);

        $place_array = array();
        foreach ($place_ids as $pid)
            array_push($place_array, new \MongoId($pid["place_id"]));

        return $this->mongo->whereIn("_id", $place_array)->get(Collections::PLACES);

    }

    /**
     * User _id ye göre kullanıcının arkadaşlarını (takip ettiklerini) getirir
     * @param $uid
     * @access private
     * @return array
     */
    private function getUserFollowers($uid)
    {
        $user_ids = $this->mongo->select(array("uid2"))->where("uid1", new \MongoId($uid))->get(Collections::FOLLOWERS);

        $user_array = array();
        foreach ($user_ids as $uid)
            array_push($user_array, new \MongoId($uid["uid2"]));

        return $this->mongo->whereIn("_id", $user_array)->get(Collections::USERS);

    }

    /**
     * User _id ye göre kullanıcının son puanladığı mekanlarını getirir
     * @param $uid
     * @param $skip
     * @param $limit
     * @access private
     * @return array
     */
    private function getUserReviews($uid, $skip, $limit)
    {
        $place_ids = $this->mongo->select(array("pid"))->where("uid", new \MongoId($uid))->where("status", 1)->orderBy(array('added_date' => 'desc'))->get(Collections::COMMENTS);

        $place_array = array();
        foreach ($place_ids as $pid)
            array_push($place_array, new \MongoId($pid["pid"]));

        return $this->mongo->whereIn("_id", $place_array)->get(Collections::PLACES);

    }

    /**
     * User _id ye göre kullanıcının eklediği mekan resimlerini getirir
     * @param $uid
     * @param $skip
     * @param $limit
     * @access private
     * @return array
     */
    private function getUserPlacePhotos($uid, $skip, $limit)
    {
        //$photos = $this->mongo->where("user_id", new \MongoId($uid))->where("status", 1)->skip($skip)->limit($limit)->get(Collections::PHOTOS);
        $photos = $this->mongo->where("user_id", new \MongoId($uid))->where("status", 1)->orderBy(array('added_date' => 'desc'))->get(Collections::PHOTOS);

        $place_array = array();
        foreach ($photos as $pid)
            array_push($place_array, new \MongoId($pid["place_id"]));

        $places = $this->mongo->whereIn("_id", $place_array)->get(Collections::PLACES);

        $joined = array();
        foreach ($photos as $photo) {
            foreach ($places as $place) {
                if ($photo["place_id"] == $place["_id"]) {
                    $inner                = array();
                    $inner["image"]       = $photo["image_file"];
                    $inner["place_title"] = $place["place_title"];
                    array_push($joined, $inner);
                }
            }
        }

        return $joined;
    }

    /**
     * User name e göre kullanıcı yorumlarını getirir
     * @param $user_name
     * @access private
     * @return array
     */
    private function getUserComments($user_name)
    {
        return $this->mongo->where("user_name", $user_name)
            ->where("status", 1)
            ->get(Collections::COMMENTS);
    }

    /**
     * User _id ye göre kullanıcının favori mekanlarını getirir
     * @param $uid
     * @access private
     * @return array
     */
    private function getUserFavs($uid)
    {
        $place_ids = $this->mongo->select(array("place_id"))
            ->where("user_id", new \MongoId($uid))
            ->get(Collections::FAVORITES);

        $place_array = array();
        foreach ($place_ids as $pid)
            array_push($place_array, new \MongoId($pid["place_id"]));

        return $this->mongo->whereIn("_id", $place_array)
            ->get(Collections::PLACES);

    }

    /**
     * User _id ye göre kullanıcının favorilerine mekanı ekler
     * @param $fav
     * @access private
     * @return array
     */
    private function addUserFavs($fav = array())
    {
        $data = array(
            "user_id"    => new \MongoId($fav["user_id"]),
            "place_id"   => new \MongoId($fav["place_id"]),
            "added_date" => new \MongoDate(timeDiffForMongo())
        );

        $this->addToLog($fav["user_id"], Collections::FAVORITES, CrudTypes::INSERT, $data);

        return $this->mongo->insert(Collections::FAVORITES, $data);

    }

    /**
     * User _id ye göre kullanıcının gitmek istediği mekanlarını getirir
     * @param $uid
     * @access private
     * @return array
     */
    private function getUserWishList($uid)
    {
        $place_ids = $this->mongo->select(array("place_id"))
            ->where("user_id", new \MongoId($uid))
            ->get(Collections::WISHLISTS);

        $place_array = array();
        foreach ($place_ids as $pid)
            array_push($place_array, new \MongoId($pid["place_id"]));

        return $this->mongo->whereIn("_id", $place_array)
            ->get(Collections::PLACES);

    }

    /**
     * User _id ye göre kullanıcının gitmek istediği mekanı ekler
     * @param $wish
     * @access private
     * @return array
     */
    private function addUserWishList($wish = array())
    {
        $data = array(
            "user_id"    => new \MongoId($wish["user_id"]),
            "place_id"   => new \MongoId($wish["place_id"]),
            "added_date" => new \MongoDate(timeDiffForMongo())
        );

        $this->mongo->where("_id", new \MongoId($wish["place_id"]))
            ->inc("place_on_wishlist", 1)
            ->update(Collections::PLACES);

        $this->addToLog($wish["user_id"], Collections::WISHLISTS, CrudTypes::INSERT, $data);

        return $this->mongo->insert(Collections::WISHLISTS, $data);

    }

    /**
     * User _id ye göre kullanıcının arkadaşlarını (takip ettiklerini) getirir
     * @param $uid
     * @access private
     * @return array
     */
    private function getUserFriends($uid)
    {
        $user_ids = $this->mongo->select(array("uid2"))
            ->where("uid1", new \MongoId($uid))
            ->get(Collections::NETWORK);

        $user_array = array();
        foreach ($user_ids as $uid)
            array_push($user_array, new \MongoId($uid["uid2"]));

        return $this->mongo->whereIn("_id", $user_array)
            ->get(Collections::USERS);

    }

    /**
     * Field a göre üye getirir
     * @param $field
     * @param $value
     * @access private
     * @return array
     */
    private function getUserByField($field, $value)
    {
        return $this->mongo->where($field, $value)
            ->limit(1)
            ->get(Collections::USERS);
    }


    /**
     * Yeni üye kaydı.
     * @param $da
     * @access private
     * @return array
     */
    private function addUser($da)
    {
        $id     = new \MongoId();
        $ac_key = sha1($id . time() . rand(0, 50));
        $data   = array(
            "_id"             => $id,
            "user"            => $da['first_name'] . ' ' . $da['last_name'],
            "user_name"       => null,
            "email"           => $da['email'],
            "password"        => sha1($da['password']),
            "profile_image"   => null,
            "social_share"    => 0,
            "is_active"       => 0,
            "activation_code" => $ac_key,
            "rm_key"          => null, //remember key
            "fp_key"          => null, //forgotten password key
            "joined_date"     => new \MongoDate(timeDiffForMongo()),
            "last_login"      => null,
            "ip"              => IP,
            "role"            => 3, //1 admin olur 2 moderator olabilir 3 member
            "profile"         => array(
                "fb_id"       => null,
                "first_name"  => $da['first_name'],
                "last_name"   => $da['last_name'],
                "fb_username" => null,
                "fb_link"     => null,
                "birthday"    => null,
                "gender"      => null,
                "hometown"    => null,
                "education"   => null,
                "website"     => null
            )
        );

        $insert_id = $this->mongo->insert(Collections::USERS, $data);

        if ($insert_id) {
            $this->app->view()->setTemplatesDirectory(SS_APP_PATH . '/templates');
            $twig     = $this->app->view()->getEnvironment();
            $template = $twig->loadTemplate('mail/activation.html.twig');
            $body     = $template->render(array(
                'email'   => $da['email'],
                'user_id' => $insert_id,
                'ac_key'  => $ac_key
            ));

            sendSmtpMail($da['email'], 'Mekanlar.com - Aktivasyon', $body);

            return true;
        } else {
            return false;
        }
    }

    /**
     * İstenilen kolona göre güncelleme
     * @param $where
     * @param $data
     * @return mixed
     */
    private function updateUserByField($where, $data)
    {
        return $this->mongo->where($where)
            ->set($data)
            ->update(Collections::USERS);

    }

    /**
     * Son giriş güncelleme
     * @param $uid
     * @return mixed
     */
    private function updateLastLogin($uid)
    {
        return $this->mongo->where(array('_id' => new \MongoId($uid)))
            ->set(array('last_login' => new \MongoDate(timeDiffForMongo())))
            ->update(Collections::USERS);
    }

    /**
     * Loglama işlemi
     * @param $uid
     * @param $collection
     * @param $type
     * @param $data
     * @access private
     * @return void
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

    public function register()
    {
        if ($this->app->request()->isPost()) {

            $gump = new \GUMP();

            $gump->validation_rules(array(
                'first_name' => 'required|alpha_numeric',
                'last_name'  => 'required|alpha_numeric',
                'password'   => 'required|max_len,16|min_len,8',
                'email'      => 'required|valid_email'
            ));

            $v       = $gump->run($this->app->request()->post());
            $u_check = $this->service->getUserCustom('email', $this->app->request()->post('email'));

            if ($u_check)
                $msg = 'Bu email adresi zaten kayıtlı';

            if ($v !== false and !$u_check) {

                if ($this->service->addUser($this->app->request()->post())) {
                    $this->app->flash('msg', 'Üyeliğini aktivleştirmek için eposta adresinize bir mail gönderildi.');
                    $this->app->redirect(BASE . 'register');
                } else {
                    $msg = 'Üye kaydı sırasında bir sorun oluştu.';
                }
            }
        }
        $data['post'] = $this->app->request()->post();
        $data['msg']  = (isset($msg)) ? customMsg($msg) . $gump->get_readable_errors(true) : ((isset($v)) ? $gump->get_readable_errors(true) : ((isset($_SESSION['slim.flash']['msg'])) ? customMsg($_SESSION['slim.flash']['msg']) : ''));
        //return $this->service->register($insert_data);
        $this->app->render('app/user/register', $data);
    }

    /**
     * Kullanıcı giriş kontorl
     */
    public function login()
    {
        if ($this->app->request->isPost()) {

            $gump = new \GUMP();

            $gump->validation_rules(array(
                'email'    => 'required|valid_email',
                'password' => 'required'
            ));

            $v = $gump->run($this->app->request()->post());

            if ($v !== false) {
                $user = $this->service->getUserCustom('email', $this->app->request()->post('email'));

                if ($user && sha1($this->app->request()->post('password')) == $user[0]['password']) {

                    if ($user[0]['is_active'] != 1) {
                        $this->app->flash('msg', 'Eposta adresinizi onaylamanız gerekmektedir.');
                        $this->app->redirect(BASE . 'activation');
                    }

                    $_SESSION['user'] = array(
                        'id'   => $user[0]['_id'],
                        'name' => $user[0]['user'],
                        'role' => $user[0]['role']
                    );

                    $last_login = $user[0]['last_login'];

                    $this->service->updateLastLogin($user[0]['_id']);

                    if ($last_login == null) {
                        $this->app->flash('msg', 'Bu ilk girişiniz. Profil bilgilerinizi tamamlayabilirsiniz.');
                        $this->app->redirect(BASE . 'user/edit_profile');
                    } else {
                        $this->app->redirect(BASE);
                    }


                } else {
                    $this->app->flash('msg', 'Eposta adresi veya şifre yanlış');
                    $this->app->redirect(BASE . 'login');
                }
            }
        }

        $data['msg'] = (isset($msg)) ? customMsg($msg) . $gump->get_readable_errors(true) : ((isset($v)) ? $gump->get_readable_errors(true) : ((isset($_SESSION['slim.flash']['msg'])) ? customMsg($_SESSION['slim.flash']['msg']) : ''));
        $this->app->render('app/user/login', $data);
    }

    public function activation($user_id, $ac_key)
    {
        if ($this->app->request()->isPost()) {

            $gump = new \GUMP();

            $gump->validation_rules(array(
                'email' => 'required|valid_email'
            ));

            $v = $gump->run($this->app->request()->post());

            if ($v !== false) {
                $user = $this->service->getUserCustom('email', $this->app->request()->post('email'));

                if ($user) {
                    if ($user[0]['is_active'] == 1) {
                        $this->app->flash('msg', 'Heabınız zaten aktif edilmiş.');
                        $this->app->redirect(BASE . 'login');
                    }
                    $this->app->view()->setTemplatesDirectory(SS_APP_PATH . '/templates');
                    $twig     = $this->app->view()->getEnvironment();
                    $template = $twig->loadTemplate('mail/activation.html.twig');
                    $body     = $template->render(array(
                        'email'   => $user[0]['email'],
                        'user_id' => $user[0]['_id'],
                        'ac_key'  => $user[0]['activation_code']
                    ));

                    sendSmtpMail($user[0]['email'], 'Mekanlar.com - Aktivasyon', $body);
                }

                $this->app->flash('msg', 'Eposta adresinizi doğru girdiyseniz aktivasyon maili eposta adresinize gönderilmiştir.');
                $this->app->redirect(BASE . 'login');
            }

        }

        if ($user_id && $ac_key) {
            if (getValidMongoId($user_id))
                $user = $this->service->getUser(new \MongoId($user_id));
            else
                $user = false;

            if ($user) {
                if ($user[0]['is_active'] == 1) {
                    $this->app->flash('msg', 'Geçersiz aktivasyon linki. Heabınız zaten aktif edilmiş.');
                    $this->app->redirect(BASE . 'login');
                }

                if ($user[0]['activation_code'] == $ac_key) {
                    $update_data = array(
                        'is_active'       => 1,
                        'activation_code' => null
                    );
                    $this->service->updateUserCustom(array('_id' => new \MongoId($user_id)), $update_data);
                    $this->app->flash('msg', 'Hesabınız açılmıştır. Giriş yaparak kullanmaya başlayabilirsiniz.');
                    $this->app->redirect(BASE . 'login');
                } else {
                    $msg = 'Geçersiz aktivasyon linki. Aktivasyon mailini tekrar göndermek için eposta adresinizi giriniz.';
                }
            } else
                $msg = 'Geçersiz aktivasyon linki. Aktivasyon mailini tekrar göndermek için eposta adresinizi giriniz.';
        }


        $data['msg'] = (isset($msg)) ? customMsg($msg) : ((isset($v)) ? $gump->get_readable_errors(true) : ((isset($_SESSION['slim.flash']['msg'])) ? customMsg($_SESSION['slim.flash']['msg']) : ''));
        $this->app->render('app/user/activation', $data);
    }

    public function forgotten_password()
    {
        if ($this->app->request()->isPost()) {

            $gump = new \GUMP();

            $gump->validation_rules(array(
                'email' => 'required|valid_email'
            ));

            $v = $gump->run($this->app->request()->post());

            if ($v !== false) {
                $user = $this->service->getUserCustom('email', $this->app->request()->post('email'));

                if ($user) {
                    $fp_key = sha1($user[0]['_id'] . $user[0]['password'] . time() . rand(0, 50));

                    $update_data = array(
                        'fp_key' => $fp_key
                    );

                    $this->service->updateUserCustom(array('_id' => new \MongoId($user[0]['_id'])), $update_data);

                    $this->app->view()->setTemplatesDirectory(SS_APP_PATH . '/templates');
                    $twig     = $this->app->view()->getEnvironment();
                    $template = $twig->loadTemplate('mail/reset_passwd.html.twig');
                    $body     = $template->render(array(
                        'email'   => $user[0]['email'],
                        'user_id' => $user[0]['_id'],
                        'fp_key'  => $fp_key
                    ));

                    sendSmtpMail($user[0]['email'], 'Mekanlar.com - Şifre Sıfırlama', $body);
                }

                $this->app->flash('msg', 'Eposta adresinizi doğru girdiyseniz şifrenizi sıfırlamak için bir eposta gönderildi.');
                $this->app->redirect(BASE . 'login');
            }
        }


        $data['msg'] = (isset($msg)) ? customMsg($msg) : ((isset($v)) ? $gump->get_readable_errors(true) : ((isset($_SESSION['slim.flash']['msg'])) ? customMsg($_SESSION['slim.flash']['msg']) : ''));
        $this->app->render('app/user/forgotten_password', $data);
    }

    public function reset_passwd($user_id, $fp_key)
    {
        if (getValidMongoId($user_id))
            $user = $this->service->getUser(new \MongoId($user_id));
        else
            $user = false;

        if (!$user) {
            $this->app->flash('msg', 'Geçersiz bir şifre sıfırlama bağlantısına tıkladınız.');
            $this->app->redirect(BASE . 'forgotten_password');
        }

        if ($user[0]['fp_key'] != $fp_key) {
            $this->app->flash('msg', 'Geçersiz bir şifre sıfırlama bağlantısına tıkladınız.');
            $this->app->redirect(BASE . 'forgotten_password');
        }


        if ($this->app->request()->isPost()) {

            $gump = new \GUMP();

            $gump->validation_rules(array(
                'password'    => 'required|max_len,16|min_len,8',
                're_password' => 'required|max_len,16|min_len,8',
            ));

            $v = $gump->run($this->app->request()->post());

            if ($v !== false && $this->app->request()->post('password') != $this->app->request()->post('re_password')) {
                $msg = 'İki alana aynı şifreyi girmelisiniz';
                $v   = false;
            }

            if ($v !== false) {

                $update_data = array(
                    'fp_key'   => null,
                    'password' => sha1($this->app->request()->post('password'))
                );

                $this->service->updateUserCustom(array('_id' => new \MongoId($user[0]['_id'])), $update_data);

                $this->app->flash('msg', 'Şifreniz değiştirildi. Yeni şifrenizle giriş yapabilirsiniz.');
                $this->app->redirect(BASE . 'login');
            }

        }

        $data['msg'] = (isset($msg)) ? customMsg($msg) : ((isset($v)) ? $gump->get_readable_errors(true) : ((isset($_SESSION['slim.flash']['msg'])) ? customMsg($_SESSION['slim.flash']['msg']) : ''));
        $this->app->render('app/user/reset_passwd', $data);
    }
    //endregion
} 