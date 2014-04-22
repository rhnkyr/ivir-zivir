<?php
//hook to get segment for menu select class
$app->hook(
    'slim.before.router',
    function () use ($app) {
        $page = getSegment(2); //get current 2nd segment
        $app->view()->set('page', $page); //set view data
    }
);

// Panel Group
$app->group(
    '/panel',
    $sessionCheck("admin", "panel"),
    function () use ($app) {

        //region Common
        $app->get(
            "/welcome",
            function () use ($app) {
                $app->render('admin/welcome');
            }
        );

        $app->get(
            "/logout",
            function () use ($app) {
                unset($_SESSION["admin"]);
                $app->redirect("/panel");
            }
        );
        //endregion

        #region Content
        $app->get(
            "/conlist(/)",
            function () use ($app) {

                $content = Model::factory("Content")->find_many();

                $list = '';
                foreach ($content as $c) {

                    $status = $c->is_active == 1 ? '<span class="label label-sm label-success">Aktif</span>' : '<span class="label label-sm label-warning">Pasif</span>';
                    $list .= "<li id='slider-" . $c->id . "'>" . $c->title . " - " . image($c->small_image, 200) . " - " . $status . iconlink('', 'pencil', 'Düzenle', 'panel/addcontent/' . $c->id) . ' ' . iconjslink($c->id, 'delete bin', 'Sil', 'panel/deletecontent/' . $c->id) . "</li>";
                }

                $data["list"] = $list;
                $app->render('admin/list', $data);
            }
        )->name("contentlist");

        $app->get(
            '/addcontent(/:id)',
            function ($id = 0) use ($app) {
                if ($id > 0) {
                    $content = Model::factory("Content")->find_one($id);
                    if ($content instanceof Content) {
                        $data["button"]  = "Güncelle";
                        $data["content"] = $content;
                        $app->render('admin/content', $data);
                    } else {
                        $app->redirect('/panel/conlist');
                    }
                } else {
                    $data["button"] = "Kaydet";
                    $app->render('admin/content', $data);
                }
            }
        );

        $app->post(
            '/addcontent',
            function () use ($app) {
                $id = $app->request()->post('cid');
                if (isset($id)) {
                    $content = Model::factory('Content')->find_one($id);
                    if (!$content instanceof Content) {
                        $app->redirect('/panel/conlist');
                    }
                    $content->title       = $app->request()->post('title');
                    $content->location    = $app->request()->post('location');
                    $content->big_image   = $app->request()->post('big_image');
                    $content->small_image = $app->request()->post('small_image');
                    $content->link        = $app->request()->post('link');
                    $content->is_active   = $app->request()->post('is_active');
                    $content->save();
                    echo json_encode(array("result" => 1));
                } else {
                    $content              = Model::factory('Content')->create();
                    $content->title       = $app->request()->post('title');
                    $content->location    = $app->request()->post('location');
                    $content->big_image   = $app->request()->post('big_image');
                    $content->small_image = $app->request()->post('small_image');
                    $content->link        = $app->request()->post('link');
                    $content->order       = 1;
                    $content->is_active   = $app->request()->post('is_active');
                    $content->added_date  = date("Y-m-d H:i:s");
                    $content->save();
                    echo json_encode(array("result" => 1));
                }
            }
        );

        $app->get(
            '/deletecontent/:id',
            function ($id = 0) use ($app) {
                if ($id > 0) {
                    $content = Model::factory("Content")->find_one($id);
                    if ($content instanceof Content) {
                        $content->delete();
                        $app->redirect('/panel/conlist');
                    } else {
                        $app->redirect('/panel/conlist');
                    }
                }
                $app->redirect('/panel/conlist');
            }
        );

        $app->post(
            '/updateSliderOrder',
            function () use ($app) {
                $updateRecordsArray = $app->request()->post("slider");
                $listingCounter     = 1;

                foreach ($updateRecordsArray as $recordIDValue) {
                    $content = Model::factory("Content")->find_one($recordIDValue);
                    $content->set("order", $listingCounter);
                    $content->save();
                    $listingCounter = $listingCounter + 1;
                }
            });
        #endregion

        #region Admin
        $app->get(
            "/adlist",
            function () use ($app) {
                $admins = Model::factory("Admin")->find_many();


                $list = '<table class="table table-striped table-bordered table-hover table-full-width">
                            <thead>
                            <tr role="row">
                                <th>Kullanıcı Adı</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                            ';
                foreach ($admins as $a) {

                    $list .= '<tr>';
                    $list .= '<td>' . $a->user_name . '</td>';
                    $list .= '<td>' . iconlink('', 'pencil', 'Edit', 'panel/addadmin/' . $a->id) . ' ' . iconjslink(
                            $a->id,
                            'delete bin',
                            'Sil',
                            'panel/deleteadmin/' . $a->id
                        ) . '</td>';
                    $list .= '</tr>';
                }

                $list .= '</tbody></table>';
                $data["list"]  = $list;
                $data["title"] = "Admin List";
                $app->render('admin/list', $data);
            }
        )->name("adminlist");

        $app->get(
            '/addadmin(/:id)',
            function ($id = 0) use ($app) {
                if ($id > 0) {
                    $admin = Model::factory("Admin")->find_one($id);
                    if ($admin instanceof Admin) {
                        $data["button"] = "Güncelle";
                        $data["admin"]  = $admin;
                        $app->render('admin/admin', $data);
                    } else {
                        $app->redirect('/panel/adlist');
                    }
                } else {
                    $data["button"] = "Kaydet";
                    $app->render('admin/admin', $data);
                }
            }
        );
        $app->post(
            '/addadmin',
            function () use ($app) {
                $id = $app->request()->post('cid');
                if (isset($id)) {
                    $admin = Model::factory('Admin')->find_one($id);
                    if (!$admin instanceof Admin) {
                        $app->redirect('/panel/adlist');
                    }
                    $admin->user_name = $app->request()->post('user_name');
                    if (strlen($app->request()->post('password')) < 40) {
                        $admin->password = sha1($app->request()->post('password'));
                    } else {
                        $admin->password = $app->request()->post('password');
                    }
                    $admin->save();

                } else {
                    $admin            = Model::factory('Admin')->create();
                    $admin->user_name = $app->request()->post('user_name');
                    $admin->password  = sha1($app->request()->post('password'));
                    $admin->save();
                }
                echo json_encode(array("result" => 1));
            }
        );
        $app->get(
            '/deleteadmin/:id',
            function ($id = 0) use ($app) {
                if ($id > 0) {
                    $admin = Model::factory("Admin")->find_one($id);
                    if ($admin instanceof Admin) {
                        $admin->delete();
                        $app->redirect('/panel/adlist');
                    } else {
                        $app->redirect('/panel/adlist');
                    }
                }
                $app->redirect('/panel/adlist');
            }
        );
        #endregion

        $app->post(
            '/deletefile',
            function () use ($app) {
                $path_to_file = $_SERVER['DOCUMENT_ROOT'] . '/templates/uploads/' . $app->request->post("url");
                if (@unlink($path_to_file)) {
                    echo json_encode(array("result" => true));
                } else {
                    echo json_encode(array("result" => false));
                }
            }
        );
    }
);
//endregion

//region Login
$app->get(
    '/panel(/)',
    function () use ($app) {
        if (isset($_SESSION['slim.flash']["error"])) {
            $app->render('admin/index', array("error" => $_SESSION['slim.flash']["error"]));
        } else {
            $app->render('admin/index');
        }
    }
);

$app->post(
    '/panel(/)',
    function () use ($app) {

        $user_name = $app->request->post('user_name');
        $password  = $app->request->post('password');
        $user      = Model::factory('Admin')->where("user_name", $user_name)->find_one();

        if ($user instanceof Admin) {
            if ($user->password == sha1($password)) {

                $_SESSION["admin"] = $user->id;
                $user->last_login  = date("Y-m-d H:i:s");
                $user->save();

                $app->redirect("/panel/welcome");
            } else {
                $app->flash('error', 'Kullanıcı adı ve/veya şifre yanlış');
                $app->redirect("/panel");
            }

        } else {
            $app->flash('error', 'Kullanıcı adı ve/veya şifre yanlış');
            $app->redirect("/panel");
        }


    }
);
//endregion
