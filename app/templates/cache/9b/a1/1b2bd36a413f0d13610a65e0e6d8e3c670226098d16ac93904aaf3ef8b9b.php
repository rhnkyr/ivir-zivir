<?php

/* mail/activation.html.twig */
class __TwigTemplate_9ba11b2bd36a413f0d13610a65e0e6d8e3c670226098d16ac93904aaf3ef8b9b extends Twig_Template
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
\t<h4>";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["email"]) ? $context["email"] : null), "html", null, true);
        echo " hesabınızla yaptığınız Mekanlar.com üyeliğinizi aktifleştirmek için aşağıdaki linke tıklamanız gerekmektedir.</h4>
\t<p><strong>Aktivasyon için tıklayın:</strong></p>
\t<p><a href=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "activation/";
        echo twig_escape_filter($this->env, (isset($context["user_id"]) ? $context["user_id"] : null), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, (isset($context["ac_key"]) ? $context["ac_key"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "activation/";
        echo twig_escape_filter($this->env, (isset($context["user_id"]) ? $context["user_id"] : null), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, (isset($context["ac_key"]) ? $context["ac_key"] : null), "html", null, true);
        echo "</a></p>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "mail/activation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 5,  23 => 3,  19 => 1,);
    }
}
