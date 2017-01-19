<?php

/* Y:\home\test1.ru\www/themes/laratify-octobercms-octaskin/partials/pages-home/extension.htm */
class __TwigTemplate_9cbc4c12816f87006b239a8cda9b67f5430d7d8ed13a2909be6eadc98bace062 extends Twig_Template
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
    <h2 class=\"lt-title center\">Users Voice</h2>
  </div>
</div>

<div class=\"lt-row row\">
  <div class=\"col s12\">
    <div class=\"lt-owl-carousel owl-carousel owl-theme\">
        <div class=\"item\">
          <div class=\"lt-owl-carousel-item item\">
            <div class=\"lt-testimonial-container\">
              <div class=\"lt-testimonial-content flow-text\">
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit fugiat quia doloribus obcaecati libero eum doloremque neque amet fugit magni</span>
              </div>
              <div class=\"lt-testimonial-author\">
                <div class=\"lt-testimonial-author-img\"><img class=\"circle responsive-img\" src=\"";
        // line 17
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/img/pages/home/extension/img-01.jpg");
        echo "\" alt=\"user\"></div>
                <div class=\"lt-testimonial-author-name\">John Smith</div>
                <div class=\"lt-testimonial-author-position\">CEO of NVLex</div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"item\">
          <div class=\"lt-owl-carousel-item item\">
            <div class=\"lt-testimonial-container\">
              <div class=\"lt-testimonial-content flow-text\">
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit fugiat quia doloribus obcaecati libero eum doloremque neque amet fugit magni</span>
              </div>
              <div class=\"lt-testimonial-author\">
                <div class=\"lt-testimonial-author-img\"><img class=\"circle responsive-img\" src=\"";
        // line 31
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/img/pages/home/extension/img-02.jpg");
        echo "\" alt=\"user\"></div>
                <div class=\"lt-testimonial-author-name\">Robert Brown</div>
                <div class=\"lt-testimonial-author-position\">Manager of Desynz</div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"item\">
          <div class=\"lt-owl-carousel-item item\">
            <div class=\"lt-testimonial-container\">
              <div class=\"lt-testimonial-content flow-text\">
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit fugiat quia doloribus obcaecati libero eum doloremque neque amet fugit magni</span>
              </div>
              <div class=\"lt-testimonial-author\">
                <div class=\"lt-testimonial-author-img\"><img class=\"circle responsive-img\" src=\"";
        // line 45
        echo $this->env->getExtension('Cms\Twig\Extension')->themeFilter("assets/img/pages/home/extension/img-03.jpg");
        echo "\" alt=\"user\"></div>
                <div class=\"lt-testimonial-author-name\">James Powell</div>
                <div class=\"lt-testimonial-author-position\">CEO of iQooQ</div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "Y:\\home\\test1.ru\\www/themes/laratify-octobercms-octaskin/partials/pages-home/extension.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 45,  54 => 31,  37 => 17,  19 => 1,);
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
    <h2 class=\"lt-title center\">Users Voice</h2>
  </div>
</div>

<div class=\"lt-row row\">
  <div class=\"col s12\">
    <div class=\"lt-owl-carousel owl-carousel owl-theme\">
        <div class=\"item\">
          <div class=\"lt-owl-carousel-item item\">
            <div class=\"lt-testimonial-container\">
              <div class=\"lt-testimonial-content flow-text\">
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit fugiat quia doloribus obcaecati libero eum doloremque neque amet fugit magni</span>
              </div>
              <div class=\"lt-testimonial-author\">
                <div class=\"lt-testimonial-author-img\"><img class=\"circle responsive-img\" src=\"{{ 'assets/img/pages/home/extension/img-01.jpg'|theme }}\" alt=\"user\"></div>
                <div class=\"lt-testimonial-author-name\">John Smith</div>
                <div class=\"lt-testimonial-author-position\">CEO of NVLex</div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"item\">
          <div class=\"lt-owl-carousel-item item\">
            <div class=\"lt-testimonial-container\">
              <div class=\"lt-testimonial-content flow-text\">
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit fugiat quia doloribus obcaecati libero eum doloremque neque amet fugit magni</span>
              </div>
              <div class=\"lt-testimonial-author\">
                <div class=\"lt-testimonial-author-img\"><img class=\"circle responsive-img\" src=\"{{ 'assets/img/pages/home/extension/img-02.jpg'|theme }}\" alt=\"user\"></div>
                <div class=\"lt-testimonial-author-name\">Robert Brown</div>
                <div class=\"lt-testimonial-author-position\">Manager of Desynz</div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"item\">
          <div class=\"lt-owl-carousel-item item\">
            <div class=\"lt-testimonial-container\">
              <div class=\"lt-testimonial-content flow-text\">
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit fugiat quia doloribus obcaecati libero eum doloremque neque amet fugit magni</span>
              </div>
              <div class=\"lt-testimonial-author\">
                <div class=\"lt-testimonial-author-img\"><img class=\"circle responsive-img\" src=\"{{ 'assets/img/pages/home/extension/img-03.jpg'|theme }}\" alt=\"user\"></div>
                <div class=\"lt-testimonial-author-name\">James Powell</div>
                <div class=\"lt-testimonial-author-position\">CEO of iQooQ</div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>", "Y:\\home\\test1.ru\\www/themes/laratify-octobercms-octaskin/partials/pages-home/extension.htm", "");
    }
}
