<?php

/* app/layout.html.twig */
class __TwigTemplate_1d9ef42aadfb839365e70bd84db329530f58d16745711ac4f42e65ff36bd02dc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"tr\">
<head>
    <meta charset=\"utf-8\">
</head>
<body>

";
        // line 8
        $this->displayBlock('content', $context, $blocks);
        // line 9
        echo "
</body>
</html>";
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        echo " ";
    }

    public function getTemplateName()
    {
        return "app/layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 8,  29 => 8,  20 => 1,  39 => 7,  34 => 5,  31 => 9,  28 => 3,);
    }
}
