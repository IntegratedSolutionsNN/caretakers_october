<?php

/* Y:\home\localhost\www/themes/laratify-octobercms-octaskin/partials/pages-home/feature.htm */
class __TwigTemplate_7c6eeed0cdc5ab72bca3884cb58dde358a19762cc55a759610104b68fdd5fbb9 extends Twig_Template
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
        echo "<div class=\"center\">
    <div class=\"lt-row row\">
        <a href=\"\">
            <div class=\"lt-col col m3 s12\">
                <i class=\"large pe-7s-portfolio primary-color-text\"></i>
                <h5>Документы</h5>
            </div>
        </a>
        <a href=\"";
        // line 9
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter("community");
        echo "\">
            <div class=\"lt-col col m3 s12\">
              <i class=\"large pe-7s-chat primary-color-text\"></i>
              <h5>Общение</h5>
            </div>
        </a>
        <a href=\"\">
            <div class=\"lt-col col m3 s12\">
              <i class=\"large pe-7s-attention primary-color-text\"></i>
              <h5>Трекер проблем</h5>
            </div>
        </a>
        <a href=\"";
        // line 21
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter("contact");
        echo "\">
            <div class=\"lt-col col m3 s12\">
              <i class=\"large pe-7s-map-2 primary-color-text\"></i>
              <h5>Контакты</h5>
            </div>
        </a>
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "Y:\\home\\localhost\\www/themes/laratify-octobercms-octaskin/partials/pages-home/feature.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 21,  29 => 9,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"center\">
    <div class=\"lt-row row\">
        <a href=\"\">
            <div class=\"lt-col col m3 s12\">
                <i class=\"large pe-7s-portfolio primary-color-text\"></i>
                <h5>Документы</h5>
            </div>
        </a>
        <a href=\"{{ 'community'|page }}\">
            <div class=\"lt-col col m3 s12\">
              <i class=\"large pe-7s-chat primary-color-text\"></i>
              <h5>Общение</h5>
            </div>
        </a>
        <a href=\"\">
            <div class=\"lt-col col m3 s12\">
              <i class=\"large pe-7s-attention primary-color-text\"></i>
              <h5>Трекер проблем</h5>
            </div>
        </a>
        <a href=\"{{ 'contact'|page }}\">
            <div class=\"lt-col col m3 s12\">
              <i class=\"large pe-7s-map-2 primary-color-text\"></i>
              <h5>Контакты</h5>
            </div>
        </a>
  </div>
</div>", "Y:\\home\\localhost\\www/themes/laratify-octobercms-octaskin/partials/pages-home/feature.htm", "");
    }
}
