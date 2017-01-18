<?php

/* Y:\home\test1.ru\www/themes/laratify-octobercms-octaskin/partials/plugin-userextended/profile.htm */
class __TwigTemplate_b95e4a4a05e932ae60d303a8ff20faafd180feb936cf0b22bf1f931f1863d073 extends Twig_Template
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
        echo "<div class=\"col s12 \">
    <div class=\"row\">
        <div class=\"col s12 m2\">
            <img src=\"";
        // line 4
        if ($this->getAttribute($this->getAttribute((isset($context["user"]) ? $context["user"] : null), "avatar", array()), "path", array())) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["user"]) ? $context["user"] : null), "avatar", array()), "path", array()), "html", null, true);
            echo " ";
        } else {
            echo " https://diasp.eu/assets/user/default.png ";
        }
        echo "\" width=120 height=120 /> <br>
            <span style=\"font-size:19px;font-style:bold;\">";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "name", array()), "html", null, true);
        echo "</span> <br>
            ";
        // line 6
        if ((isset($context["unrestricted"]) ? $context["unrestricted"] : null)) {
            echo "<span style=\"font-size:11px;font-style:italic;\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : null), "email", array()), "html", null, true);
            echo "</span>";
        }
        // line 7
        echo "        </div>
        <div class=\"col s12 m4\">
            Stars: 0
            <br>
            ThumbUps: 0
            <br>
            Gold: 5
        </div>
        <div class=\"col s12 m3\">

        ";
        // line 17
        if ( !$this->getAttribute((isset($context["userui"]) ? $context["userui"] : null), "unrestricted", array())) {
            // line 18
            echo "            See more of this persons profile by adding them as a friend
            <div style=\"bottom:0;\">
                ";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["userui"]) ? $context["userui"] : null), "user", array()), "name", array()), "html", null, true);
            echo " <button data-request-data=\"id: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["userui"]) ? $context["userui"] : null), "user", array()), "id", array()), "html", null, true);
            echo "\" data-request=\"userui::onFriendUser\">Add</button>
            </div>
        ";
        }
        // line 23
        echo "
        </div>

    </div>

    <div class=\"row\">
        <div class=\"col s12 m6\">
            <h4>Comments</h4>
            <div id=\"comment_section\">

                ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["userui"]) ? $context["userui"] : null), "comments", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 34
            echo "                    <div class=\"userblock\">
                        ";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "content", array()), "html", null, true);
            echo " <br>
                        <span><a href=\"#\" data-request-data=\"commentid: ";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "id", array()), "html", null, true);
            echo "\" data-request=\"userui::onDeleteComment\"><span class=\"glyphicon glyphicon-remove\">X</span></a></span> <i style=\"font-size:11px;\">Written at: ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["comment"], "created_at", array()), "html", null, true);
            echo " by <a href=\"/users/";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["comment"], "author", array()), "id", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["comment"], "author", array()), "name", array()), "html", null, true);
            echo "</a></i>
                        <hr>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "
            </div>
            <h5>Write a comment</h5>
            ";
        // line 43
        if ($this->getAttribute((isset($context["userui"]) ? $context["userui"] : null), "unrestricted", array())) {
            // line 44
            echo "                <form data-request=\"userui::onComment\">
                    <textarea rows=\"2\" name=\"comment\"></textarea>
                    <input type=\"submit\" value=\"Comment\" />
                </form>
            ";
        } else {
            // line 49
            echo "                Leave a comment for ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["userui"]) ? $context["userui"] : null), "user", array()), "name", array()), "html", null, true);
            echo " by ";
            if ( !(isset($context["user"]) ? $context["user"] : null)) {
                echo " signing in and ";
            }
            echo " friending them.
            ";
        }
        // line 51
        echo "        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "Y:\\home\\test1.ru\\www/themes/laratify-octobercms-octaskin/partials/plugin-userextended/profile.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 51,  122 => 49,  115 => 44,  113 => 43,  108 => 40,  92 => 36,  88 => 35,  85 => 34,  81 => 33,  69 => 23,  61 => 20,  57 => 18,  55 => 17,  43 => 7,  37 => 6,  33 => 5,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"col s12 \">
    <div class=\"row\">
        <div class=\"col s12 m2\">
            <img src=\"{% if user.avatar.path %}{{user.avatar.path}} {% else %} https://diasp.eu/assets/user/default.png {% endif %}\" width=120 height=120 /> <br>
            <span style=\"font-size:19px;font-style:bold;\">{{user.name}}</span> <br>
            {% if unrestricted %}<span style=\"font-size:11px;font-style:italic;\">{{user.email}}</span>{% endif %}
        </div>
        <div class=\"col s12 m4\">
            Stars: 0
            <br>
            ThumbUps: 0
            <br>
            Gold: 5
        </div>
        <div class=\"col s12 m3\">

        {% if not userui.unrestricted %}
            See more of this persons profile by adding them as a friend
            <div style=\"bottom:0;\">
                {{userui.user.name}} <button data-request-data=\"id: {{userui.user.id}}\" data-request=\"userui::onFriendUser\">Add</button>
            </div>
        {% endif %}

        </div>

    </div>

    <div class=\"row\">
        <div class=\"col s12 m6\">
            <h4>Comments</h4>
            <div id=\"comment_section\">

                {% for comment in userui.comments %}
                    <div class=\"userblock\">
                        {{comment.content}} <br>
                        <span><a href=\"#\" data-request-data=\"commentid: {{comment.id}}\" data-request=\"userui::onDeleteComment\"><span class=\"glyphicon glyphicon-remove\">X</span></a></span> <i style=\"font-size:11px;\">Written at: {{comment.created_at}} by <a href=\"/users/{{comment.author.id}}\">{{comment.author.name}}</a></i>
                        <hr>
                    </div>
                {% endfor %}

            </div>
            <h5>Write a comment</h5>
            {% if userui.unrestricted %}
                <form data-request=\"userui::onComment\">
                    <textarea rows=\"2\" name=\"comment\"></textarea>
                    <input type=\"submit\" value=\"Comment\" />
                </form>
            {% else %}
                Leave a comment for {{userui.user.name}} by {% if not user %} signing in and {% endif %} friending them.
            {% endif %}
        </div>
    </div>
</div>", "Y:\\home\\test1.ru\\www/themes/laratify-octobercms-octaskin/partials/plugin-userextended/profile.htm", "");
    }
}
