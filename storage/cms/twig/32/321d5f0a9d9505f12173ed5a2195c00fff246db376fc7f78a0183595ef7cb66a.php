<?php

/* Y:\home\test1.ru\www/plugins/clake/userextended/components/userui/default.htm */
class __TwigTemplate_d363ed01c7942ce5781de14219f869e4d906ced8641e25a9f11e18633c05682a extends Twig_Template
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
        echo "<p>This is the default markup for component UserUI</p>

<small>You can delete this file if you want</small>";
    }

    public function getTemplateName()
    {
        return "Y:\\home\\test1.ru\\www/plugins/clake/userextended/components/userui/default.htm";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<p>This is the default markup for component UserUI</p>

<small>You can delete this file if you want</small>", "Y:\\home\\test1.ru\\www/plugins/clake/userextended/components/userui/default.htm", "");
    }
}
