<?php

/* app/user/login.html.twig */
class __TwigTemplate_f01615fff364856fba56691ad438c48790ca4ea498b17af19d23cbc4b2f0b293 extends Twig_Template
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
       
    <form name=\"loginForm\" method=\"post\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "login\">
        <p>
            <label for=\"email\">Email:</label><input type=\"text\" name=\"email\" id=\"email\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "email"), "html", null, true);
        echo "\" >
        </p>
        <p>
            <label for=\"password\">Şifre:</label><input type=\"password\" name=\"password\" id=\"password\" >
        </p>
        <p>
            <input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Giriş Yap\" >
        </p>
        <p><a href=\"";
        // line 17
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "forgotten_password\">Şifremi Unuttum</a></p>
    </form>

";
    }

    public function getTemplateName()
    {
        return "app/user/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 17,  44 => 9,  39 => 7,  34 => 5,  31 => 4,  28 => 3,);
    }
}
