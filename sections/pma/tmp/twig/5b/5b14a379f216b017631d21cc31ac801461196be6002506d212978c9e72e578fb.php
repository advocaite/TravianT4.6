<?php

/* columns_definitions/column_adjust_privileges.twig */
class __TwigTemplate_4faaea740239dcb6ed7429e4b163049c6a75f76ef74cacfdf7bb0f36b1587c5c extends Twig_Template
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
        if (($context["privs_available"] ?? null)) {
            // line 2
            echo "    <input name=\"field_adjust_privileges[";
            echo twig_escape_filter($this->env, ($context["column_number"] ?? null), "html", null, true);
            echo "]\"
        id=\"field_";
            // line 3
            echo twig_escape_filter($this->env, ($context["column_number"] ?? null), "html", null, true);
            echo "_";
            echo twig_escape_filter($this->env, (($context["ci"] ?? null) - ($context["ci_offset"] ?? null)), "html", null, true);
            echo "\"
        checked=\"checked\"
        type=\"checkbox\"
        value=\"NULL\"
        class=\"allow_null\"/>
";
        } else {
            // line 9
            echo "    <input name=\"field_adjust_privileges[";
            echo twig_escape_filter($this->env, ($context["column_number"] ?? null), "html", null, true);
            echo "]\"
        id=\"field_";
            // line 10
            echo twig_escape_filter($this->env, ($context["column_number"] ?? null), "html", null, true);
            echo "_";
            echo twig_escape_filter($this->env, (($context["ci"] ?? null) - ($context["ci_offset"] ?? null)), "html", null, true);
            echo "\"
        disabled
        type=\"checkbox\"
        value=\"NULL\"
        class=\"allow_null\"
        title=\"";
            // line 15
            echo _gettext("You don't have sufficient privileges to perform this operation; Please refer to the documentation for more details");
            echo "\"/>
";
        }
    }

    public function getTemplateName()
    {
        return "columns_definitions/column_adjust_privileges.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 15,  42 => 10,  37 => 9,  26 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "columns_definitions/column_adjust_privileges.twig", "/home/travian/pma/templates/columns_definitions/column_adjust_privileges.twig");
    }
}
