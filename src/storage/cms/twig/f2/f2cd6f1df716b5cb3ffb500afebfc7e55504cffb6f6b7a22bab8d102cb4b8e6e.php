<?php

/* Y:\home\test1.ru\www/themes/laratify-octobercms-octaskin/partials/_addons/js.htm */
class __TwigTemplate_2085ca7c250ec0a0178aced7b43c7dd422d6bf25af7e74b68b03afdf7aee3369 extends Twig_Template
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
        if ($this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "theme", array()), "load_wow_js", array())) {
            // line 2
            echo "  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/graingert-wow/1.2.0/wow.min.js\"></script>
";
        }
        // line 4
        if ($this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "theme", array()), "load_owl_carousel", array())) {
            // line 5
            echo "  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/owl.carousel.min.js\"></script>
";
        }
    }

    public function getTemplateName()
    {
        return "Y:\\home\\test1.ru\\www/themes/laratify-octobercms-octaskin/partials/_addons/js.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 5,  25 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if this.theme.load_wow_js %}
  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/graingert-wow/1.2.0/wow.min.js\"></script>
{% endif %}
{% if this.theme.load_owl_carousel %}
  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/owl.carousel.min.js\"></script>
{% endif %}", "Y:\\home\\test1.ru\\www/themes/laratify-octobercms-octaskin/partials/_addons/js.htm", "");
    }
}
