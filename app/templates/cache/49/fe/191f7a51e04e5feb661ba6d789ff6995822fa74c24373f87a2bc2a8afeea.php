<?php

/* mail/reset_passwd.html.twig */
class __TwigTemplate_49fe191f7a51e04e5feb661ba6d789ff6995822fa74c24373f87a2bc2a8afeea extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
<body>
\t<h4>Bu eposta Mekanlar.com tarafından şifre sıfırlama talebiniz üzerine gönderilmiştir.</h4>
\t<p><strong>Şifrenizi değiştirmek için tıklayın:</strong></p>
\t<p><a href=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "reset_passwd/";
        echo twig_escape_filter($this->env, (isset($context["user_id"]) ? $context["user_id"] : null), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, (isset($context["ac_key"]) ? $context["ac_key"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "activation/";
        echo twig_escape_filter($this->env, (isset($context["user_id"]) ? $context["user_id"] : null), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, (isset($context["fp_key"]) ? $context["fp_key"] : null), "html", null, true);
        echo "</a></p>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "mail/reset_passwd.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 5,  19 => 1,);
    }
}
