<?php

/* Y:\home\localhost\www\git\caretakers_october\src/themes/laratify-octobercms-octaskin/partials/pages-about/header.htm */
class __TwigTemplate_2a1e0137f815867d0e199dddbe7b859412ba448380c544abfb22e7ff5333b4c4 extends Twig_Template
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
  <div class=\"lt-col col s12\">
    <div class=\"lt-parallax-header parallax-container\" style=\"height: 400px;\">
      <div class=\"lt-parallax parallax\"><img src=\"";
        // line 4
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/img/pages/about/header/0_17992a_8db6d2d8_orig.jpg");
        echo "\" alt=\"image\"></div>
      <div class=\"lt-parallax-content\">
        <div class=\"valign-wrapper\" style=\"height: 400px;\">
          <div class=\"valign\">
            <h2 class=\"lt-title\">About Octaskin</h2>
            <p class=\"lt-subtitle flow-text\">Who We Are</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "Y:\\home\\localhost\\www\\git\\caretakers_october\\src/themes/laratify-octobercms-octaskin/partials/pages-about/header.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 4,  19 => 1,);
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
  <div class=\"lt-col col s12\">
    <div class=\"lt-parallax-header parallax-container\" style=\"height: 400px;\">
      <div class=\"lt-parallax parallax\"><img src=\"{{ 'assets/img/pages/about/header/0_17992a_8db6d2d8_orig.jpg'|theme }}\" alt=\"image\"></div>
      <div class=\"lt-parallax-content\">
        <div class=\"valign-wrapper\" style=\"height: 400px;\">
          <div class=\"valign\">
            <h2 class=\"lt-title\">About Octaskin</h2>
            <p class=\"lt-subtitle flow-text\">Who We Are</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>", "Y:\\home\\localhost\\www\\git\\caretakers_october\\src/themes/laratify-octobercms-octaskin/partials/pages-about/header.htm", "");
    }
}
