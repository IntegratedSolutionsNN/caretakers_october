<?php

/* Y:\home\localhost\www\git\caretakers_october\src/themes/laratify-octobercms-octaskin/partials/pages-all/copyright.htm */
class __TwigTemplate_496c2dfdc2f700e823136433a861f5826a11eceac792636d3683084a2050f6b4 extends Twig_Template
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
        echo "<div class=\"lt-row row\">
  ";
        // line 2
        $context['__cms_content_params'] = [];
        echo $this->env->getExtension('CMS')->contentFunction("copyright"        , $context['__cms_content_params']        );
        unset($context['__cms_content_params']);
        // line 3
        echo "</div>
<div class=\"lt-row row\">
  ";
        // line 5
        $context['__cms_content_params'] = [];
        echo $this->env->getExtension('CMS')->contentFunction("social"        , $context['__cms_content_params']        );
        unset($context['__cms_content_params']);
        // line 6
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "Y:\\home\\localhost\\www\\git\\caretakers_october\\src/themes/laratify-octobercms-octaskin/partials/pages-all/copyright.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 6,  30 => 5,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"lt-row row\">
  {% content \"copyright\" %}
</div>
<div class=\"lt-row row\">
  {% content \"social\" %}
</div>", "Y:\\home\\localhost\\www\\git\\caretakers_october\\src/themes/laratify-octobercms-octaskin/partials/pages-all/copyright.htm", "");
    }
}
