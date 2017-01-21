<?php

/* /var/www/phpci/PHPCI/build/104_53799/src/plugins/keios/support/components/ticketlist/default.htm */
class __TwigTemplate_07aaae423e132b433f00d70d4287bebc7430e5063382e0e1a70d4908fcf8294d extends Twig_Template
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
        echo "<div id=\"ticket-list\">
    <table class=\"table\">
        <thead>
        <tr>
            <th>";
        // line 5
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), array("Ticket Number"));
        echo "</th>
            <th>";
        // line 6
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), array("Ticket Topic"));
        echo "</th>
            <th>";
        // line 7
        echo "Ticket Status";
        echo "</th>
            <th>";
        // line 8
        echo "Last update";
        echo "</th>
        </tr>
        </thead>
        <tbody>
        ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tickets"]) ? $context["tickets"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["ticket"]) {
            // line 13
            echo "            <tr>
                <td><a href=\"";
            // line 14
            echo twig_escape_filter($this->env, (isset($context["ticket_page"]) ? $context["ticket_page"] : null), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ticket"], "hash_id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ticket"], "hash_id", array()), "html", null, true);
            echo "</a></td>
                <td>";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($context["ticket"], "topic", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 16
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), array($this->getAttribute($this->getAttribute($context["ticket"], "status", array()), "name", array())));
            echo "</td>
                <td>";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["ticket"], "updated_at", array()), "html", null, true);
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ticket'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "        </tbody>
    </table>
</div>
";
    }

    public function getTemplateName()
    {
        return "/var/www/phpci/PHPCI/build/104_53799/src/plugins/keios/support/components/ticketlist/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 20,  67 => 17,  63 => 16,  59 => 15,  51 => 14,  48 => 13,  44 => 12,  37 => 8,  33 => 7,  29 => 6,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"ticket-list\">
    <table class=\"table\">
        <thead>
        <tr>
            <th>{{ 'Ticket Number'|_ }}</th>
            <th>{{ 'Ticket Topic'|_ }}</th>
            <th>{{ 'Ticket Status' }}</th>
            <th>{{ 'Last update' }}</th>
        </tr>
        </thead>
        <tbody>
        {% for ticket in tickets %}
            <tr>
                <td><a href=\"{{ ticket_page }}/{{ ticket.hash_id }}\">{{ ticket.hash_id }}</a></td>
                <td>{{ ticket.topic }}</td>
                <td>{{ ticket.status.name|_ }}</td>
                <td>{{ ticket.updated_at }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
</div>
", "/var/www/phpci/PHPCI/build/104_53799/src/plugins/keios/support/components/ticketlist/default.htm", "");
    }
}
