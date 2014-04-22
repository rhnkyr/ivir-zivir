<?php

/* app/user/index.html.twig */
class __TwigTemplate_a87987d0a8fe2e2f542580997619e05d04a61b10c3b4eb921eac090f7027110e extends Twig_Template
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
        if (isset($context["user_place_photos"])) { $_user_place_photos_ = $context["user_place_photos"]; } else { $_user_place_photos_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_user_place_photos_);
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            // line 6
            echo "        ";
            if (isset($context["p"])) { $_p_ = $context["p"]; } else { $_p_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_p_, "image"), "html", null, true);
            echo "<br>";
            if (isset($context["p"])) { $_p_ = $context["p"]; } else { $_p_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_p_, "place_title"), "html", null, true);
            echo "<br/>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "

";
    }

    public function getTemplateName()
    {
        return "app/user/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 8,  39 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
