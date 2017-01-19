<?php

/* Y:\home\test1.ru\www/plugins/rainlab/user/components/account/register.htm */
class __TwigTemplate_0c9d3e97394188904172218e1afe33207f6b6369add2999c0bbf534714ea5a66 extends Twig_Template
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
        echo "<form
    data-request=\"onRegister\">
    <div class=\"form-group\">
        <label for=\"registerName\">Full Name</label>
        <input
            name=\"name\"
            type=\"text\"
            class=\"form-control\"
            id=\"registerName\"
            placeholder=\"Enter your full name\" />
    </div>

    <div class=\"form-group\">
        <label for=\"registerEmail\">Email</label>
        <input
            name=\"email\"
            type=\"email\"
            class=\"form-control\"
            id=\"registerEmail\"
            placeholder=\"Enter your email\" />
    </div>

    <div class=\"form-group\">
        <label for=\"registerPassword\">Password</label>
        <input
            name=\"password\"
            type=\"password\"
            class=\"form-control\"
            id=\"registerPassword\"
            placeholder=\"Choose a password\" />
    </div>

    <button type=\"submit\" class=\"btn btn-default\">Register</button>
</form>
";
    }

    public function getTemplateName()
    {
        return "Y:\\home\\test1.ru\\www/plugins/rainlab/user/components/account/register.htm";
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
        return new Twig_Source("<form
    data-request=\"onRegister\">
    <div class=\"form-group\">
        <label for=\"registerName\">Full Name</label>
        <input
            name=\"name\"
            type=\"text\"
            class=\"form-control\"
            id=\"registerName\"
            placeholder=\"Enter your full name\" />
    </div>

    <div class=\"form-group\">
        <label for=\"registerEmail\">Email</label>
        <input
            name=\"email\"
            type=\"email\"
            class=\"form-control\"
            id=\"registerEmail\"
            placeholder=\"Enter your email\" />
    </div>

    <div class=\"form-group\">
        <label for=\"registerPassword\">Password</label>
        <input
            name=\"password\"
            type=\"password\"
            class=\"form-control\"
            id=\"registerPassword\"
            placeholder=\"Choose a password\" />
    </div>

    <button type=\"submit\" class=\"btn btn-default\">Register</button>
</form>
", "Y:\\home\\test1.ru\\www/plugins/rainlab/user/components/account/register.htm", "");
    }
}
