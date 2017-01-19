<?php

/* Y:\home\test1.ru\www/themes/laratify-octobercms-octaskin/layouts/fallback.htm */
class __TwigTemplate_2bb0bf59b3f344db010eed4a9d45779dc599a14e66de86f8d99876bff04b785a extends Twig_Template
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
        echo $this->env->getExtension('CMS')->pageFunction();
    }

    public function getTemplateName()
    {
        return "Y:\\home\\test1.ru\\www/themes/laratify-octobercms-octaskin/layouts/fallback.htm";
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
        return new Twig_Source("{% page %}", "Y:\\home\\test1.ru\\www/themes/laratify-octobercms-octaskin/layouts/fallback.htm", "");
    }
}
