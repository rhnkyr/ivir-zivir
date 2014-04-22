<?php

/* app/index.html.twig */
class __TwigTemplate_ab3917f58a48d5d37eaf6bc86a07b23bd592f6445cbd151497cdcbc99db287c2 extends Twig_Template
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
        if (isset($context["res"])) { $_res_ = $context["res"]; } else { $_res_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_res_);
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 6
            echo "        ";
            if (isset($context["r"])) { $_r_ = $context["r"]; } else { $_r_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_r_, "place_title"), "html", null, true);
            echo "<br>";
            if (isset($context["r"])) { $_r_ = $context["r"]; } else { $_r_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_r_, "place_loc"), "lng"), "html", null, true);
            echo ",";
            if (isset($context["r"])) { $_r_ = $context["r"]; } else { $_r_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_r_, "place_loc"), "lat"), "html", null, true);
            echo "<br/>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "
";
    }

    public function getTemplateName()
    {
        return "app/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 8,  39 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
