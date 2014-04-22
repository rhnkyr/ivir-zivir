<?php

/* mail/activation.html.twig */
class __TwigTemplate_66da795637911588a05b18b18c0b97c744eeac425eda40390f0d4b66ab2c6114 extends Twig_Template
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
        if (isset($context["email"])) { $_email_ = $context["email"]; } else { $_email_ = null; }
        echo twig_escape_filter($this->env, $_email_, "html", null, true);
        echo " hesabınızla yaptığınız Mekanlar.com üyeliğinizi aktifleştirmek için aşağıdaki linke tıklamanız gerekmektedir.</h4>
\t<p><strong>Aktivasyon için tıklayın:</strong></p>
\t<p><a href=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "activation/";
        if (isset($context["user_id"])) { $_user_id_ = $context["user_id"]; } else { $_user_id_ = null; }
        echo twig_escape_filter($this->env, $_user_id_, "html", null, true);
        echo "/";
        if (isset($context["ac_key"])) { $_ac_key_ = $context["ac_key"]; } else { $_ac_key_ = null; }
        echo twig_escape_filter($this->env, $_ac_key_, "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_constant("BASE"), "html", null, true);
        echo "activation/";
        if (isset($context["user_id"])) { $_user_id_ = $context["user_id"]; } else { $_user_id_ = null; }
        echo twig_escape_filter($this->env, $_user_id_, "html", null, true);
        echo "/";
        if (isset($context["ac_key"])) { $_ac_key_ = $context["ac_key"]; } else { $_ac_key_ = null; }
        echo twig_escape_filter($this->env, $_ac_key_, "html", null, true);
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
        return array (  29 => 5,  23 => 3,  19 => 1,);
    }
}
