<?php

/* Y:\home\test1.ru\www/plugins/rainlab/forum/components/channel/title.htm */
class __TwigTemplate_dc958bd413ffbbfd4bb616f5a714e0396f5a929198e12655320f007a3454dd3d extends Twig_Template
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
        echo "<div class=\"row\">

    <div class=\"col-md-9\">
        ";
        // line 4
        echo call_user_func_array($this->env->getFunction('form_open')->getCallable(), array("open", array("method" => "get")));
        echo "
            <div class=\"search-box\">
                <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Search topics\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, input("search"));
        echo "\">
            </div>
        ";
        // line 8
        echo call_user_func_array($this->env->getFunction('form_close')->getCallable(), array("close"));
        echo "
    </div>
    <div class=\"col-md-3 text-right\">
        ";
        // line 11
        if ((isset($context["isGuest"]) ? $context["isGuest"] : null)) {
            // line 12
            echo "            <p>Log in to Post a new topic</p>
        ";
        } else {
            // line 14
            echo "            <a href=\"";
            echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter((isset($context["topicPage"]) ? $context["topicPage"] : null));
            echo "?channel=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["channel"]) ? $context["channel"] : null), "id", array()), "html", null, true);
            echo "\" class=\"btn btn-primary btn-block\">
                Post a new topic
            </a>
        ";
        }
        // line 18
        echo "    </div>

</div>
";
    }

    public function getTemplateName()
    {
        return "Y:\\home\\test1.ru\\www/plugins/rainlab/forum/components/channel/title.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 18,  46 => 14,  42 => 12,  40 => 11,  34 => 8,  29 => 6,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"row\">

    <div class=\"col-md-9\">
        {{ form_open({ method: 'get' })}}
            <div class=\"search-box\">
                <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Search topics\" value=\"{{ input('search')|e }}\">
            </div>
        {{ form_close() }}
    </div>
    <div class=\"col-md-3 text-right\">
        {% if isGuest %}
            <p>Log in to Post a new topic</p>
        {% else %}
            <a href=\"{{ topicPage|page }}?channel={{ channel.id }}\" class=\"btn btn-primary btn-block\">
                Post a new topic
            </a>
        {% endif %}
    </div>

</div>
", "Y:\\home\\test1.ru\\www/plugins/rainlab/forum/components/channel/title.htm", "");
    }
}
