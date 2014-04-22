<?php

/* app/user/login.html.twig */
class __TwigTemplate_77d4a592addb492f20da2002a203062e2ccfc2f20372848759dc51a3881ca477 extends Twig_Template
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
        if (isset($context["msg"])) { $_msg_ = $context["msg"]; } else { $_msg_ = null; }
        echo $_msg_;
        echo "
       
    <form name=\"loginForm\" method=\"post\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "login\">
        <p>
            <label for=\"email\">Email:</label><input type=\"text\" name=\"email\" id=\"email\" value=\"";
        // line 9
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "email"), "html", null, true);
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
        return array (  57 => 17,  45 => 9,  40 => 7,  34 => 5,  31 => 4,  28 => 3,);
    }
}
