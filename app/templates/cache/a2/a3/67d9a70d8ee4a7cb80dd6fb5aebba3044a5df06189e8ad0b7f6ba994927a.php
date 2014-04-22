<?php

/* app/user/activation.html.twig */
class __TwigTemplate_a2a367d9a70d8ee4a7cb80dd6fb5aebba3044a5df06189e8ad0b7f6ba994927a extends Twig_Template
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
       
    <form name=\"activationForm\" method=\"post\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "activation\">
        <p>
            <label for=\"email\">Email:</label><input type=\"text\" name=\"email\" id=\"email\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "email"), "html", null, true);
        echo "\" >
        </p>
        <p>
            <input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Aktivasyon Kodunu Gönder\" >
        </p>
    </form>

";
    }

    public function getTemplateName()
    {
        return "app/user/activation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 9,  39 => 7,  34 => 5,  31 => 4,  28 => 3,);
    }
}
