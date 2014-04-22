<?php

/* app/index.html.twig */
class __TwigTemplate_91fbeacf4b68f9ad0b00cedd9cfb94a3f5dc0e0d3b5253c2d86bcae2ff388a2b extends Twig_Template
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
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["res"]) ? $context["res"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 6
            echo "        ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["r"]) ? $context["r"] : null), "place_title"), "html", null, true);
            echo "<br>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["r"]) ? $context["r"] : null), "place_loc"), "lng"), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["r"]) ? $context["r"] : null), "place_loc"), "lat"), "html", null, true);
            echo "<br/>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "
    ";
        // line 9
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["res"]) ? $context["res"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 10
            echo "        ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["r"]) ? $context["r"] : null), "place_title"), "html", null, true);
            echo "<br>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["r"]) ? $context["r"] : null), "place_loc"), "lng"), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["r"]) ? $context["r"] : null), "place_loc"), "lat"), "html", null, true);
            echo "<br/>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
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
        return array (  71 => 12,  58 => 10,  54 => 9,  51 => 8,  38 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
