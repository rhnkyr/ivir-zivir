<?php
/**
 * Created by PhpStorm.
 * User: erhankayar
 * Date: 31/10/13
 * Time: 18:55
 */

define("URI", $app->request()->getUrl());

/**
 * Creates a tag with icon
 *
 * @param string $id
 * @param string $class
 * @param string $title
 * @param string $href
 *
 * @return string
 */
function iconlink($id = '', $class = '', $title = '', $href = '')
{
    return '<a id="' . $id . '" href="' . URI . '/' . $href . '" class="btn mini green-stripe ' . $class . '" data-href="">Güncelle</a>';
}

/**
 * Create confirm link with icon
 *
 * @param string $id
 * @param string $class
 * @param string $title
 * @param string $href
 *
 * @return string
 */
function iconjslink($id = '', $class = '', $title = '', $href = '')
{
    return '<a id="' . $id . '" href="javascript:;" class="btn mini red-stripe ' . $class . '" data-href="' . URI . '/' . $href . '">Sil</a>';
}

/**
 * Cretaes image tag
 *
 * @param $url
 * @param $w
 *
 * @return string
 */
function image($url, $w)
{
    return '<img src="' . URI . '/templates/uploads/' . $url . '" style="width:' . $w . 'px;"/>';
}


/**
 * Clear segment
 *
 * @param $str
 *
 * @return mixed
 */
function clearSegment($str)
{
    // Convert programatic characters to entities
    $bad  = array('$', '(', ')', '%28', '%29');
    $good = array('&#36;', '&#40;', '&#41;', '&#40;', '&#41;');

    return str_replace($bad, $good, $str);
}

/**
 * Returns nth segment of uri
 * @param $n
 * @return string
 */
function getSegment($n)
{
    foreach (explode("/", preg_replace("|/*(.+?)/*$|", "\\1", RURL)) as $val) {
        $val = clearSegment($val);
        if ($val != '') {
            $segments[] = $val;
        }
    }

    return isset($segments[$n - 1]) ? $segments[$n - 1] : "";
}

/**
 * MongoDate timezone algılayamıyor. Bu yüzden biz o anki zaman
 * farkını GMT ye göre bulup saniye olarak time() a ekliyoruz
 * @return int
 */
function timeDiffForMongo()
{
    $dtz        = new DateTimeZone('Europe/Istanbul');
    $time_in_tr = new DateTime('now', $dtz);

    return time() + $dtz->getOffset($time_in_tr);
}

/**
 * Creates seo friendly urls
 *
 * @param $text
 *
 * @return mixed|string
 */
function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    // trim
    $text = trim($text, '-');

    // transliterate
    if (function_exists('iconv')) {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }

    // lowercase
    $text = strtolower($text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

function customMsg($message, $field_class="field")
{
    return '<span class="' . $field_class . '">' . $message . '</span>';
}

function sendSmtpMail($to, $subject, $body, $from=FALSE)
{

    $transporter = Swift_SmtpTransport::newInstance('smtp.live.com', 587, 'tls')
          ->setUsername('')
          ->setPassword('');
        $transporter->setAuthMode('login');
        $mailer = Swift_Mailer::newInstance($transporter);

        if (!$from) {
            $from = array('mekanlardev@live.com'=>'Mekanlar.com');
        }

        $message = Swift_Message::newInstance($subject)
          ->setFrom($from)
          ->setTo($to)
          ->setBody($body,'text/html');

        return $mailer->send($message);
}

function getValidMongoId($id)
{
    try {
        return new MongoId($id);
    } catch (MongoException $ex) {
        return FALSE;
    }
}