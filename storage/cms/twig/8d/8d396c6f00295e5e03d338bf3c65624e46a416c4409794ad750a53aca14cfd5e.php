<?php

/* Y:\home\test1.ru\www/plugins/rainlab/forum/components/channel/topics.htm */
class __TwigTemplate_13687e14507201b98ee0b2befd36bc6d5ed871b1fc2113bb306156f0a5e023c4 extends Twig_Template
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
        echo "<table class=\"forum-table\">
    <tr>
        <th colspan=\"2\">Topic</th>
        <th class=\"counter-column\">Replies</th>
        <th class=\"counter-column\">Views</th>
        <th class=\"activity-column\">Last post</th>
    </tr>

    ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["topics"]) ? $context["topics"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["topic"]) {
            // line 10
            echo "        <tr class=\"forum-topic\">
            <td class=\"indicator-column\">
                <div class=\"topic-indicator ";
            // line 12
            echo (($this->getAttribute($context["topic"], "hasNew", array())) ? ("has-new") : (""));
            echo "\"></div>
            </td>
            <td>
                <h5>
                    ";
            // line 16
            if ($this->getAttribute($context["topic"], "is_sticky", array())) {
                echo "<strong>Sticky:</strong>";
            }
            // line 17
            echo "                    ";
            if ($this->getAttribute($context["topic"], "is_locked", array())) {
                echo "<i class=\"icon icon-lock\"></i> <strong>Locked:</strong>";
            }
            // line 18
            echo "                    <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["topic"], "url", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["topic"], "subject", array()), "html", null, true);
            echo "</a>
                    <br/><small>by <a href=\"";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["topic"], "start_member", array()), "url", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["topic"], "start_member", array()), "username", array()), "html", null, true);
            echo "</a></small>
                </h5>
            </td>
            <td class=\"counter-column\">
                <p>";
            // line 23
            echo twig_escape_filter($this->env, ($this->getAttribute($context["topic"], "count_posts", array()) - 1), "html", null, true);
            echo "</p>
            </td>
            <td class=\"counter-column\">
                <p>";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute($context["topic"], "count_views", array()), "html", null, true);
            echo "</p>
            </td>
            <td class=\"activity-column\">
                <p>
                    <img src=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["topic"], "last_post_member", array()), "user", array()), "avatarThumb", array(0 => 24), "method"), "html", null, true);
            echo "\" class=\"member-avatar\" />
                    <a href=\"";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["topic"], "last_post_member", array()), "url", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["topic"], "last_post_member", array()), "username", array()), "html", null, true);
            echo "</a>
                    <small>
                        posted <a href=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute($context["topic"], "url", array()), "html", null, true);
            echo "?page=last#post-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["topic"], "last_post_id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["topic"], "last_post_at", array()), "diffForHumans", array()), "html", null, true);
            echo "</a>
                    </small>
                </p>
            </td>
        </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['topic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "
    ";
        // line 40
        if ( !twig_length_filter($this->env, (isset($context["topics"]) ? $context["topics"] : null))) {
            // line 41
            echo "        <tr>
            <td colspan=\"100\">There are no topics in this channel.</td>
        </tr>
    ";
        }
        // line 45
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "Y:\\home\\test1.ru\\www/plugins/rainlab/forum/components/channel/topics.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 45,  114 => 41,  112 => 40,  109 => 39,  93 => 33,  86 => 31,  82 => 30,  75 => 26,  69 => 23,  60 => 19,  53 => 18,  48 => 17,  44 => 16,  37 => 12,  33 => 10,  29 => 9,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<table class=\"forum-table\">
    <tr>
        <th colspan=\"2\">Topic</th>
        <th class=\"counter-column\">Replies</th>
        <th class=\"counter-column\">Views</th>
        <th class=\"activity-column\">Last post</th>
    </tr>

    {% for topic in topics %}
        <tr class=\"forum-topic\">
            <td class=\"indicator-column\">
                <div class=\"topic-indicator {{ topic.hasNew ? 'has-new' }}\"></div>
            </td>
            <td>
                <h5>
                    {% if topic.is_sticky %}<strong>Sticky:</strong>{% endif %}
                    {% if topic.is_locked %}<i class=\"icon icon-lock\"></i> <strong>Locked:</strong>{% endif %}
                    <a href=\"{{ topic.url }}\">{{ topic.subject }}</a>
                    <br/><small>by <a href=\"{{ topic.start_member.url }}\">{{ topic.start_member.username }}</a></small>
                </h5>
            </td>
            <td class=\"counter-column\">
                <p>{{ (topic.count_posts-1) }}</p>
            </td>
            <td class=\"counter-column\">
                <p>{{ topic.count_views }}</p>
            </td>
            <td class=\"activity-column\">
                <p>
                    <img src=\"{{ topic.last_post_member.user.avatarThumb(24) }}\" class=\"member-avatar\" />
                    <a href=\"{{ topic.last_post_member.url }}\">{{ topic.last_post_member.username }}</a>
                    <small>
                        posted <a href=\"{{ topic.url }}?page=last#post-{{ topic.last_post_id }}\">{{ topic.last_post_at.diffForHumans }}</a>
                    </small>
                </p>
            </td>
        </tr>
    {% endfor %}

    {% if not topics|length %}
        <tr>
            <td colspan=\"100\">There are no topics in this channel.</td>
        </tr>
    {% endif %}
</table>
", "Y:\\home\\test1.ru\\www/plugins/rainlab/forum/components/channel/topics.htm", "");
    }
}
