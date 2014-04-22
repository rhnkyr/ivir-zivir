<?php
/**
 * Created by PhpStorm.
 * User: erhankayar
 * Date: 6.12.2013
 * Time: 00:53
 */

class Mail_Helper
{
    protected $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getMessage($identifier, $parameters = array())
    {
        $template = $this->twig->loadTemplate('mail/' . $identifier . '.twig'); // Define your own schema
        $subject  = $template->renderBlock('subject', $parameters);
        $bodyHtml = $template->renderBlock('body_html', $parameters);
        $bodyText = $template->renderBlock('body_text', $parameters);


        $transport = Swift_SmtpTransport::newInstance('smtp.example.org', 25)
            ->setUsername('your username')
            ->setPassword('your password');

        $mailer = Swift_Mailer::newInstance($transport);


        $message = Swift_Message::newInstance()
            ->setTo($parameters["to"])
            ->setSubject($subject)
            ->setBody($bodyText, 'text/plain')
            ->addPart($bodyHtml, 'text/html');

        return $mailer->send($message);
    }
}