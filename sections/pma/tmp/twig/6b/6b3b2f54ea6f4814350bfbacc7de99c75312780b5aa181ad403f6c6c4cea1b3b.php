<?php

/* database/designer/js_fields.twig */
class __TwigTemplate_d1ed4dfb95c8488509b9a9dc856e3b357738be11470c994e6b347cfab71d3af2 extends Twig_Template
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
        // line 2
        ob_start();
        // line 3
        echo "<div id=\"script_server\" class=\"hide\">";
        echo twig_escape_filter($this->env, ($context["server"] ?? null), "html", null, true);
        echo "</div>
<div id=\"script_db\" class=\"hide\">";
        // line 4
        echo twig_escape_filter($this->env, ($context["db"] ?? null), "html", null, true);
        echo "</div>
<div id=\"script_tables\" class=\"hide\">";
        // line 5
        echo twig_escape_filter($this->env, ($context["script_tables"] ?? null), "html", null, true);
        echo "</div>
<div id=\"script_contr\" class=\"hide\">";
        // line 6
        echo twig_escape_filter($this->env, ($context["script_contr"] ?? null), "html", null, true);
        echo "</div>
<div id=\"script_display_field\" class=\"hide\">";
        // line 7
        echo twig_escape_filter($this->env, ($context["script_display_field"] ?? null), "html", null, true);
        echo "</div>
<div id=\"script_display_page\" class=\"hide\">";
        // line 8
        echo twig_escape_filter($this->env, ($context["display_page"] ?? null), "html", null, true);
        echo "</div>
<div id=\"designer_tables_enabled\" class=\"hide\">";
        // line 9
        echo twig_escape_filter($this->env, ($context["relation_pdfwork"] ?? null), "html", null, true);
        echo "</div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "database/designer/js_fields.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 9,  42 => 8,  38 => 7,  34 => 6,  30 => 5,  26 => 4,  21 => 3,  19 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/designer/js_fields.twig", "/home/travian/pma/templates/database/designer/js_fields.twig");
    }
}
