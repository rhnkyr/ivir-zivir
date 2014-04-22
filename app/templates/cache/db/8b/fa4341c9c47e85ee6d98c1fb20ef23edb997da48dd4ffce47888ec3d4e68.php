<?php

/* app/user/register.html.twig */
class __TwigTemplate_db8bfa4341c9c47e85ee6d98c1fb20ef23edb997da48dd4ffce47888ec3d4e68 extends Twig_Template
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
       
    <form name=\"registerForm\" method=\"post\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "register\">
        <p>
            <label for=\"first_name\">Ad:</label><input type=\"text\" name=\"first_name\" id=\"first_name\" value=\"";
        // line 9
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "first_name"), "html", null, true);
        echo "\" >
        </p>
        <p>
            <label for=\"last_name\">Soyad:</label><input type=\"text\" name=\"last_name\" id=\"last_name\" value=\"";
        // line 12
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "last_name"), "html", null, true);
        echo "\" >
        </p>
        <p>
            <label for=\"email\">Email:</label><input type=\"text\" name=\"email\" id=\"email\" value=\"";
        // line 15
        if (isset($context["post"])) { $_post_ = $context["post"]; } else { $_post_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_post_, "email"), "html", null, true);
        echo "\" >
        </p>
        <p>
            <label for=\"password\">Şifre:</label><input type=\"password\" name=\"password\" id=\"password\" >
        </p>
        <p>
            <input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Kayıt Ol\" >
        </p>
    </form>

";
    }

    public function getTemplateName()
    {
        return "app/user/register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 15,  52 => 12,  45 => 9,  40 => 7,  34 => 5,  31 => 4,  28 => 3,);
    }
}
