<?php

/* app/user/register.html.twig */
class __TwigTemplate_f455ef3e5163f382f0a79a9e2b4812316f007c1521d44fec379d0e481dff0851 extends Twig_Template
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
       
    <form name=\"registerForm\" method=\"post\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "register\">
        <p>
            <label for=\"first_name\">Ad:</label><input type=\"text\" name=\"first_name\" id=\"first_name\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "first_name"), "html", null, true);
        echo "\" >
        </p>
        <p>
            <label for=\"last_name\">Soyad:</label><input type=\"text\" name=\"last_name\" id=\"last_name\" value=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "last_name"), "html", null, true);
        echo "\" >
        </p>
        <p>
            <label for=\"email\">Email:</label><input type=\"text\" name=\"email\" id=\"email\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "email"), "html", null, true);
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
        return array (  56 => 15,  50 => 12,  44 => 9,  39 => 7,  34 => 5,  31 => 4,  28 => 3,);
    }
}
