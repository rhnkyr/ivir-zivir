<?php

/* app/user/reset_passwd.html.twig */
class __TwigTemplate_9633c9228404d157b546fd38b6a6f0fbe8cbf8d3dabac9bcf48ac1117ca7f7b3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("app/layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "app/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
    ";
        // line 5
        echo (isset($context["msg"]) ? $context["msg"] : null);
        echo "
       
    <form name=\"resetPasswdForm\" method=\"post\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_constant("FURL"), "html", null, true);
        echo "\">
        <p>
            <label for=\"password\">Yeni Şifre:</label><input type=\"password\" name=\"password\" id=\"password\" >
        </p>
        <p>
            <label for=\"re_password\">Yeni Şifre Tekrar:</label><input type=\"password\" name=\"re_password\" id=\"re_password\" >
        </p>
        <p>
            <input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Şifremi Değiştir\" >
        </p>
    </form>

";
    }

    public function getTemplateName()
    {
        return "app/user/reset_passwd.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  34 => 5,  31 => 4,  28 => 3,);
    }
}
